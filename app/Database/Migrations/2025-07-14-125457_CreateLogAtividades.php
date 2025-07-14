<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogAtividades extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nome_usuario' => ['type' => 'VARCHAR', 'constraint' => 255],
            'atividade' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('log_atividades');
    }

    public function down()
    {
        $this->forge->dropTable('log_atividades');
    }
}