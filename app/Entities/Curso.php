<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Curso extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome' => null,
        'texto' => null,
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int'
    ];

    
}