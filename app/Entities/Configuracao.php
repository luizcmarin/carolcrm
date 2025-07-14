<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Configuracao extends Entity
{
    protected $attributes = [
        'id' => null,
        'chave' => null,
        'categoria' => null,
        'valor' => null,
        'descricao' => null,
        'sn_sistema' => 'Não',
        'tipo' => null,
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