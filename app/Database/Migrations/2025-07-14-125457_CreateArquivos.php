<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArquivos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nome_arquivo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tipo_arquivo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sn_visivel_cliente' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Não'],
            'chave_anexo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pessoa_id' => ['type' => 'INT', 'constraint' => 11],
            'comentario_tarefa_id' => ['type' => 'INT', 'constraint' => 11],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('arquivos');
    }

    public function down()
    {
        $this->forge->dropTable('arquivos');
    }
}