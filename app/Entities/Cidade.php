<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cidade extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome' => null,
        'estado_id' => null,
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int',
        'estado_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $cidade = null;
    public function getCidade()
    {
      if ($this->cidade === null && $this->attributes['estado_id'] !== null) {
        $cidade = new Cidade();
        $this->cidade = $this->CidadesModel->find($this->attributes['estado_id']);
      }
      return $this->cidade;
    }
}