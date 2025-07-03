<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\GrupoUsuarioModel;

class Usuario extends Entity
{
  protected $attributes = [
    'id'               => null,
    'grupo_usuario_id' => null,
    'nome'             => null,
    'status'           => null,
    'mensagem_status'  => null,
    'ativo'            => 'Não',
    'ultimo_acesso'    => null,
    'criado_em'        => null,
    'atualizado_em'    => null,
    'deletado_em'      => null,
  ];

  protected $datamap = [];
  protected $dates   = ['ultimo_acesso', 'criado_em', 'atualizado_em', 'deletado_em'];
  protected $casts   = [
    'id'               => 'integer',
    'grupo_usuario_id' => 'integer',
  ];

  // Método para carregar a entidade do grupo associado
  private $grupo = null;
  public function getGrupo()
  {
    if ($this->grupo === null && $this->attributes['grupo_usuario_id'] !== null) {
      $grupoModel = new GrupoUsuarioModel();
      $this->grupo = $grupoModel->find($this->attributes['grupo_usuario_id']);
    }
    return $this->grupo;
  }
}
