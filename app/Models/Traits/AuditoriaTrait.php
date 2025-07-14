<?php

namespace App\Models\Traits;

use Config\Services;
use CodeIgniter\Database\BaseBuilder;

trait AuditoriaTrait
{
  /**
   * Callback para preencher o campo 'criado_em' antes de inserir um registro.
   */
  protected function setAuditoriaCriacao(array $data): array
  {
    $data['data']['criado_em'] = Services::Carol()->gerarStringAuditoria();
    return $data;
  }

  /**
   * Callback para preencher o campo 'editado_em' antes de atualizar um registro.
   */
  protected function setAuditoriaEdicao(array $data): array
  {
    $data['data']['editado_em'] = Services::Carol()->gerarStringAuditoria();
    return $data;
  }
}
