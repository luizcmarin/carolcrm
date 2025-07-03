<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class GrupoUsuario extends Entity
{
  protected $attributes = [
    'id'            => null,
    'nome'          => null,
    'criado_em'     => null,
    'atualizado_em' => null,
    'deletado_em'   => null,
  ];

  protected $casts = [
    'id'            => 'integer',
  ];

  protected $datamap = [];
  protected $dates = ['criado_em', 'atualizado_em', 'deletado_em'];
}
