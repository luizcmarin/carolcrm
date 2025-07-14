<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioGruposSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1,
                 'nome' => 'Clientes',
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null],
            ['id' => 2,
                 'nome' => 'Fornecedores',
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null],
            ['id' => 3,
                 'nome' => 'Parceiros',
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null],
            ['id' => 4,
                 'nome' => 'Funcionários',
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null],
            ['id' => 5,
                 'nome' => 'Leads',
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null],
            ['id' => 6,
                 'nome' => 'Outros',
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null]
        ];

        // Usando insertBatch para inserir múltiplos registros
        // Ajuste conforme necessário se a tabela tiver gatilhos ou colunas auto-preenchidas
        // $this->db->table('usuario_grupos')->truncate(); // Descomente para limpar antes de inserir
        if (!empty($data)) {
            $this->db->table('usuario_grupos')->insertBatch($data);
        } else {
            // Se o array de dados estiver vazio, você pode optar por não fazer nada
            // ou logar uma mensagem.
            // $this->db->table('usuario_grupos')->where('id IS NOT NULL')->delete(); // Exemplo: limpar a tabela se o seed for vazio
        }
    }
}