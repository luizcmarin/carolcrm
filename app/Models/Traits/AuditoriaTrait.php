<?php

namespace App\Models\Traits;

use Config\Services;
use CodeIgniter\Database\BaseBuilder;

trait AuditoriaTrait
{
  protected $criado_em  = 'criado_em';
  protected $editado_em  = 'editado_em';
  protected $excluido_em  = 'excluido_em';

  // Adiciona callbacks para os eventos do modelo
  protected $beforeInsert = ['setAuditoriaCriacao'];
  protected $beforeUpdate = ['setAuditoriaEdicao'];
  protected $beforeDelete = ['setAuditoriaExclusao'];

  /**
   * Callback para preencher o campo 'criado_em' antes de inserir um registro.
   */
  protected function setAuditoriaCriacao(array $data): array
  {
    if (isset($data['data'][$this->criado_em])) {
      return $data;
    }
    $data['data'][$this->criado_em] = Services::Carol()->gerarStringAuditoria();
    return $data;
  }

  /**
   * Callback para preencher o campo 'editado_em' antes de atualizar um registro.
   */
  protected function setAuditoriaEdicao(array $data): array
  {
    if (empty($data['data'])) {
      return $data;
    }
    $data['data'][$this->editado_em] = Services::Carol()->gerarStringAuditoria();
    return $data;
  }

  /**
   * Callback para preencher o campo 'excluido_em' com a string de auditoria
   * quando um soft delete é realizado.
   */
  protected function setAuditoriaExclusao(array $data): array
  {
    // Se o modelo usa soft deletes, 'beforeDelete' é chamado
    // ANTES que o campo $excluido_em seja atualizado com o timestamp do CI.
    // Isso nos permite injetar nossa string no campo $excluido_em.

    // Certifique-se que o campo existe no 'data' para não dar erro
    if (isset($data['data']) && !isset($data['data'][$this->excluido_em])) {
      $data['data'][$this->excluido_em] = Services::Carol()->gerarStringAuditoria();
    }

    return $data;
  }
}
