<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCargos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nome' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id', 'usuarios', 'cargo_id'->onDelete('RESTRICT')->onUpdate('CASCADE'));

        $this->forge->createTable('cargos');
    }

    public function down()
    {
        $this->forge->dropTable('cargos');
    }
}