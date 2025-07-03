<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
  protected $table            = 'tbl_usuarios';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'App\Entities\Usuario';
  protected $useSoftDeletes   = true; // Habilita soft deletes
  protected $protectFields    = true;
  protected $allowedFields    = ['grupo_usuario_id', 'nome', 'status', 'mensagem_status', 'ativo', 'ultimo_acesso'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'criado_em';
  protected $updatedField  = 'atualizado_em';
  protected $deletedField  = 'deletado_em';

  protected $validationRules = [
    'nome'             => 'required|min_length[3]|max_length[255]',
    'grupo_usuario_id' => 'required|integer|is_not_unique[tbl_grupos_usuarios.id]',
    'status'           => 'permit_empty|max_length[50]',
    'mensagem_status'  => 'permit_empty|max_length[255]',
    'ativo'            => "in_list[Sim,Não]",
  ];

  protected $validationMessages = [
    'nome' => [
      'required'   => 'O campo Nome é obrigatório.',
      'min_length' => 'O campo Nome deve ter pelo menos {param} caracteres.',
      'max_length' => 'O campo Nome deve ter no máximo {param} caracteres.',
      'is_unique'  => 'Este Nome de usuário já está em uso. Por favor, escolha outro.', // Mensagem para a regra 'is_unique'
    ],
    'grupo_usuario_id' => [
      'required'      => 'O campo Grupo do Usuário é obrigatório.',
      'integer'       => 'O Grupo do Usuário deve ser um número inteiro.',
      'is_not_unique' => 'O Grupo do Usuário selecionado não é válido.',
    ],
    'ativo' => [
      'in_list' => 'O campo Ativo deve ser "Sim" ou "Não".',
    ],
  ];

  // Grupos de Validação para Insert e Update
  protected $validationRulesInsert = [
    'nome' => 'required|min_length[3]|max_length[255]|is_unique[tbl_usuarios.nome]', // Apenas aqui 'is_unique' sem {id}
  ];

  protected $validationRulesUpdate = [
    'nome' => 'required|min_length[3]|max_length[255]|is_unique[tbl_usuarios.nome,id,{id}]', // Apenas aqui 'is_unique' com {id}
  ];

  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  /**
   * Retorna usuários com o nome do grupo.
   */
  public function getUsuariosComGrupo($perPage = 10)
  {
    return $this->select('tbl_usuarios.*, tbl_grupos_usuarios.nome as nome_grupo')
      ->join('tbl_grupos_usuarios', 'tbl_grupos_usuarios.id = tbl_usuarios.grupo_usuario_id', 'left')
      ->paginate($perPage);
  }

  /**
   * Busca um único usuário com o nome do grupo.
   */
  public function getUsuarioComGrupo($id)
  {
    return $this->select('tbl_usuarios.*, tbl_grupos_usuarios.nome as nome_grupo')
      ->join('tbl_grupos_usuarios', 'tbl_grupos_usuarios.id = tbl_usuarios.grupo_usuario_id', 'left')
      ->find($id);
  }
}
