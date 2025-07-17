<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity
{
  protected $attributes = [
    'id' => null,
    'nome' => null,
    'usuario_grupo_id' => null,
    'celular' => null,
    'telefone' => null,
    'email' => null,
    'imagem_id' => null,
    'sobre' => null,
    'endereco' => null,
    'bairro' => null,
    'cidade_id' => null,
    'cep' => null,
    'complemento' => null,
    'redes_sociais' => null,
    'genero' => null,
    'cpf' => null,
    'documentos' => null,
    'cargo_id' => null,
    'profissao_id' => null,
    'nacionalidade_id' => null,
    'assinatura_email' => null,
    'nome_usuario' => null,
    'senha' => null,
    'ultimo_ip' => null,
    'data_ultimo_login' => null,
    'sn_administrador' => 'Não',
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
    'usuario_grupo_id' => 'int',
    'cidade_id' => 'int',
    'cargo_id' => 'int',
    'profissao_id' => 'int',
    'nacionalidade_id' => 'int'
  ];
}
