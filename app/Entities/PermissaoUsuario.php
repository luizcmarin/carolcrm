<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PermissaoUsuario extends Entity
{
    protected $attributes = [
        'id' => null,
        'usuario_id' => null,
        'permissao' => null,
        'criado_em' => null,
        'atualizado_em' => null,
        'deletado_em' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'int',
        'usuario_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $permissaousuario = null;
    public function getPermissaoUsuario()
    {
      if ($this->permissaousuario === null && $this->attributes['usuario_id'] !== null) {
        $permissaousuario = new PermissaoUsuario();
        $this->permissaousuario = $this->PermissaoUsuariosModel->find($this->attributes['usuario_id']);
      }
      return $this->permissaousuario;
    }
}