<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cotacao extends Entity
{
    protected $attributes = [
        'id' => null,
        'pais_id' => null,
        'valor_cotacao' => null,
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int',
        'pais_id' => 'int',
        'valor_cotacao' => 'int'
    ];

    
}