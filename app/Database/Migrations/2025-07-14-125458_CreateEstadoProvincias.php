<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEstadoProvincias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nome' => ['type' => 'VARCHAR', 'constraint' => 255],
            'abreviatura' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pais_id' => ['type' => 'INT', 'constraint' => 11],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pais_id', 'paises', 'id'->onDelete('RESTRICT')->onUpdate('CASCADE'));

        $this->forge->createTable('estado_provincias');
    }

    public function down()
    {
        $this->forge->dropTable('estado_provincias');
    }
}