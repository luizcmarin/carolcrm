<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Arquivo extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome_arquivo' => null,
        'tipo_arquivo' => null,
        'sn_visivel_cliente' => 'Não',
        'chave_anexo' => null,
        'pessoa_id' => null,
        'comentario_tarefa_id' => null,
        'created_at' => null,
        'updated_at' => null,
        'criado_em' => null,
        'editado_em' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id' => 'int',
        'pessoa_id' => 'int',
        'comentario_tarefa_id' => 'int'
    ];

    
    // Método para carregar a entidade do arquivo associado
    private $arquivo = null;
    public function getArquivo()
    {
      if ($this->arquivo === null && $this->attributes['comentario_tarefa_id'] !== null) {
        $arquivo = new Arquivo();
        $this->arquivo = $this->ArquivosModel->find($this->attributes['comentario_tarefa_id']);
      }
      return $this->arquivo;
    }
}