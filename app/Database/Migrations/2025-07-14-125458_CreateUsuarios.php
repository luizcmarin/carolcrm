<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nome' => ['type' => 'VARCHAR', 'constraint' => 255],
            'usuario_grupo_id' => ['type' => 'INT', 'constraint' => 11],
            'celular' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'telefone' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'imagem_perfil' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sobre' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'endereco' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'bairro' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cidade_id' => ['type' => 'INT', 'constraint' => 11],
            'cep' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'complemento' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'redes_sociais' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'genero' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cpf' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'documentos' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cargo_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'profissao_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'nacionalidade_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'assinatura_email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'senha' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ultimo_ip' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'data_ultimo_login' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sn_administrador' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Não'],
            'sn_ativo' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Não'],
            'created_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'criado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'editado_em' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('profissao_id', 'profissoes', 'id'->onDelete('RESTRICT')->onUpdate('CASCADE'));
        $this->forge->addForeignKey('nacionalidade_id', 'nacionalidades', 'id'->onDelete('RESTRICT')->onUpdate('CASCADE'));
        $this->forge->addForeignKey('usuario_grupo_id', 'usuario_grupos', 'id'->onDelete('RESTRICT')->onUpdate('CASCADE'));
        $this->forge->addForeignKey('cidade_id', 'cidades', 'id'->onDelete('RESTRICT')->onUpdate('CASCADE'));
        $this->forge->addForeignKey('cargo_id', 'cargos', 'id'->onDelete('RESTRICT')->onUpdate('CASCADE'));

        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}