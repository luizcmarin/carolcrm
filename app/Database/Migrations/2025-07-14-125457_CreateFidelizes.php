<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFidelizes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nivel_fidelidade1' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pontos_de1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'pontos_ate1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'nivel_fidelidade2' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pontos_de2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'pontos_ate2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'nivel_fidelidade3' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pontos_de3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'pontos_ate3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'nivel_fidelidade4' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pontos_de4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'pontos_ate4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'faturamento_pontos1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_de1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_ate1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'faturamento_pontos2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_de2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_ate2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'faturamento_pontos3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_de3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_ate3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'faturamento_pontos4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_de4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_ate4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'faturamento_pontos5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_de5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'valor_faturamento_ate5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_pontos1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_de1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_ate1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_pontos2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_de2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_ate2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_pontos3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_de3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_ate3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_pontos4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_de4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_ate4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_pontos5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_de5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'frequencia_ate5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_pontos1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_de1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_ate1' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_pontos2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_de2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_ate2' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_pontos3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_de3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_ate3' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_pontos4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_de4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_ate4' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_pontos5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_de5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'permanencia_ate5' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('fidelizes');
    }

    public function down()
    {
        $this->forge->dropTable('fidelizes');
    }
}