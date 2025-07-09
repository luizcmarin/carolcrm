<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Logim extends Entity
{
    protected $attributes = [
        'id' => null,
        'endereco_ip' => null,
        'user_agent' => null,
        'usuario' => null,
        'data_tentativa' => null,
        'sucesso' => 'Não',
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
        'id' => 'int'
    ];

    
}