<?php

namespace App\Models\Admin;

use Config\Services;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use App\Entities\Admin\Usuario;

class UsuarioModel extends Model
{
  protected $table                      = 'tbl_usuarios';
  protected $primaryKey                 = 'id';
  protected $returnType                 = Usuario::class;
  protected $useSoftDeletes             = true;
  protected bool $allowEmptyInserts     = false;
  protected bool $updateOnlyChanged     = true;
  protected $skipValidation             = false;
  protected $cleanValidationRules        = true;
  protected $useTimestamps              = false;
  protected $dateFormat                 = 'datetime';
  protected $createdField               = 'criado_em';
  protected $updatedField               = 'atualizado_em';
  protected $deletedField               = 'deletado_em';

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = ['hashSenhaCallback', 'auditarCriacao'];
  protected $beforeUpdate   = ['hashSenhaCallback', 'auditarAtualizacao'];
  protected $afterInsert    = [];
  protected $afterUpdate    = [];
  protected $beforeFind     = [];
  protected $afterFind      = [];
  protected $beforeDelete   = [];
  protected $afterDelete    = [];

  protected $allowedFields  = [
    'nome',
    'email',
    'hash_senha',
    'ativo',
    'status',
    'mensagem_status',
    'ultimo_acesso',
    'criado_em',
    'atualizado_em',
    'deletado_em',
  ];

  protected $validationRules = [
    'nome'  => 'required|min_length[3]|max_length[255]',
    'ativo' => 'permit_empty|in_list[0,1]',
  ];

  protected $validationMessages = [
    'nome' => [
      'required'   => 'O campo "Nome" é obrigatório.',
      'min_length' => 'O campo "Nome" deve ter pelo menos {param} caracteres.',
      'max_length' => 'O campo "Nome" não pode exceder {param} caracteres.',
    ],
    'ativo' => [
      'in_list'    => 'O campo "Ativo" deve ser Sim ou Não.',
    ],
  ];

  protected function hashSenhaCallback(array $data)
  {
    return $data;
  }

  /**
   * Callback para auditar a criação de um usuário.
   * @param array $data
   * @return array
   */
  protected function auditarCriacao(array $data): array
  {
    if (isset($data['data']['criado_em'])) {
      $data['data']['criado_em'] = $this->gerarStringAuditoria();
    }
    if (isset($data['data']['atualizado_em'])) {
      $data['data']['atualizado_em'] = $this->gerarStringAuditoria();
    }
    return $data;
  }

  /**
   * Callback para auditar a atualização de um usuário.
   * @param array $data
   * @return array
   */
  protected function auditarAtualizacao(array $data): array
  {
    if (isset($data['data']['atualizado_em'])) {
      $data['data']['atualizado_em'] = $this->gerarStringAuditoria();
    }
    return $data;
  }
}
