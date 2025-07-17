<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Arquivo extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome_arquivo' => null,
        'nome_original' => null,
        'tipo_arquivo' => null,
        'tamanho_bytes' => null,
        'caminho_servidor' => null,
        'url_publica' => null,
        'descricao' => null,
        'entidade_tipo' => null,
        'entidade_id' => null,
        'sn_visivel_cliente' => 'Não',
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int',
        'tamanho_bytes' => 'int',
        'entidade_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $arquivo = null;
    public function getArquivo()
    {
      if ($this->arquivo === null && $this->attributes['entidade_id'] !== null) {
        $arquivo = new Arquivo();
        $this->arquivo = $this->ArquivosModel->find($this->attributes['entidade_id']);
      }
      return $this->arquivo;
    }
}