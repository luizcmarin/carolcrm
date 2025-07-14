<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaises extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'iso2' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'nome_curto' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nome_longo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'iso3' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'codigo_numerico' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'codigo_chamada' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cctld' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('paises');
    }

    public function down()
    {
        $this->forge->dropTable('paises');
    }
}