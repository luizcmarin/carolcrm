<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Pais extends Entity
{
    protected $attributes = [
        'id' => null,
        'iso2' => null,
        'nome_curto' => null,
        'nome_longo' => null,
        'iso3' => null,
        'codigo_numerico' => null,
        'codigo_chamada' => null,
        'cctld' => null,
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