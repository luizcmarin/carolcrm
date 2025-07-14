<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Aviso extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome' => null,
        'mensagem' => null,
        'data_inicio' => null,
        'data_fim' => null,
        'sn_visivel_cliente' => 'Não',
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