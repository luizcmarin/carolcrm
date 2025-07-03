<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\GrupoUsuario; // Importa a Entity que acabamos de criar

class GrupoUsuarioModel extends Model
{
  protected $table            = 'tbl_grupos_usuarios';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = GrupoUsuario::class; // <-- ALTERADO PARA A CLASSE DA ENTITY
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['nome',];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'criado_em';
  protected $updatedField  = 'atualizado_em';
  protected $deletedField  = 'deletado_em';

  // Validation
  protected $validationRules = [
    'nome'      => 'required|min_length[3]|max_length[100]', // Regra base para nome
  ];

  protected $validationMessages = [
    'nome' => [
      'required'   => 'O campo Nome é obrigatório.',
      'min_length' => 'O campo Nome deve ter pelo menos {param} caracteres.',
      'max_length' => 'O campo Nome deve ter no máximo {param} caracteres.',
      'is_unique'  => 'Este Nome de grupo já está em uso. Por favor, escolha outro.',
    ],
  ];

  // Adicione validação específica para 'insert' e 'update'
  protected $validationRulesInsert = [
    'nome'      => 'required|min_length[3]|max_length[100]|is_unique[tbl_grupos_usuarios.nome]',
  ];

  protected $validationRulesUpdate = [
    'nome'      => 'required|min_length[3]|max_length[100]|is_unique[tbl_grupos_usuarios.nome,id,{id}]',
  ];

  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = [];
  protected $afterInsert    = [];
  protected $beforeUpdate   = [];
  protected $afterUpdate    = [];
  protected $beforeFind     = [];
  protected $afterFind      = [];
  protected $beforeDelete   = [];
  protected $afterDelete    = [];
}
