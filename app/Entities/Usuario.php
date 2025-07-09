<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity
{
    protected $attributes = [
        'id' => null,
        'grupo_usuario_id' => null,
        'nome' => null,
        'status' => null,
        'mensagem_status' => null,
        'ativo' => 'Não',
        'ultimo_acesso' => null,
        'criado_em' => null,
        'atualizado_em' => null,
        'deletado_em' => null,
        'expira_em' => null,
        'senha' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'int',
        'grupo_usuario_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $usuario = null;
    public function getUsuario()
    {
      if ($this->usuario === null && $this->attributes['grupo_usuario_id'] !== null) {
        $usuario = new Usuario();
        $this->usuario = $this->UsuariosModel->find($this->attributes['grupo_usuario_id']);
      }
      return $this->usuario;
    }
}