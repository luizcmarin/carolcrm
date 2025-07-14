<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCotacoes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'pais_id' => ['type' => 'INT', 'constraint' => 11],
            'valor_cotacao' => ['type' => 'INT', 'constraint' => 11],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('cotacoes');
    }

    public function down()
    {
        $this->forge->dropTable('cotacoes');
    }
}