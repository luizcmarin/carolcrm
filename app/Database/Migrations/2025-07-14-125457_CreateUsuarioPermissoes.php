<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuarioPermissoes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'usuario_id' => ['type' => 'INT', 'constraint' => 11],
            'categoria' => ['type' => 'VARCHAR', 'constraint' => 255],
            'chave' => ['type' => 'VARCHAR', 'constraint' => 255],
            'sn_ativo' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Não'],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id'->onDelete('CASCADE')->onUpdate('NO ACTION'));

        $this->forge->createTable('usuario_permissoes');
    }

    public function down()
    {
        $this->forge->dropTable('usuario_permissoes');
    }
}