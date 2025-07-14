<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConfiguracoes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'chave' => ['type' => 'VARCHAR', 'constraint' => 255],
            'categoria' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'valor' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'descricao' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sn_sistema' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'default' => 'Não'],
            'tipo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('configuracoes');
    }

    public function down()
    {
        $this->forge->dropTable('configuracoes');
    }
}