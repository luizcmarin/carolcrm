<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAvisos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nome' => ['type' => 'VARCHAR', 'constraint' => 255],
            'mensagem' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'data_inicio' => ['type' => 'VARCHAR', 'constraint' => 255],
            'data_fim' => ['type' => 'VARCHAR', 'constraint' => 255],
            'sn_visivel_cliente' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Não'],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('avisos');
    }

    public function down()
    {
        $this->forge->dropTable('avisos');
    }
}