<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EstadoProvincia extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome' => null,
        'abreviatura' => null,
        'pais_id' => null,
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int',
        'pais_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $estadoprovincia = null;
    public function getEstadoProvincia()
    {
      if ($this->estadoprovincia === null && $this->attributes['pais_id'] !== null) {
        $estadoprovincia = new EstadoProvincia();
        $this->estadoprovincia = $this->EstadoProvinciasModel->find($this->attributes['pais_id']);
      }
      return $this->estadoprovincia;
    }
}