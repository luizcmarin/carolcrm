<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UsuarioPermissao extends Entity
{
    protected $attributes = [
        'id' => null,
        'usuario_id' => null,
        'categoria' => null,
        'chave' => null,
        'sn_ativo' => 'Não',
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int',
        'usuario_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $usuariopermissao = null;
    public function getUsuarioPermissao()
    {
      if ($this->usuariopermissao === null && $this->attributes['usuario_id'] !== null) {
        $usuariopermissao = new UsuarioPermissao();
        $this->usuariopermissao = $this->UsuarioPermissoesModel->find($this->attributes['usuario_id']);
      }
      return $this->usuariopermissao;
    }
}