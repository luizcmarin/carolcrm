<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NacionalidadesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1,
                 'nome' => 'Brasileira',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 2,
                 'nome' => 'Italiana',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 3,
                 'nome' => 'Peruana',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 4,
                 'nome' => 'Argentina',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 5,
                 'nome' => 'Paraguaia',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 6,
                 'nome' => 'Uruguaia',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 7,
                 'nome' => 'Venezuelana',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 8,
                 'nome' => 'Boliviana',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 9,
                 'nome' => 'Portuguesa',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 10,
                 'nome' => 'Espanhola',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 11,
                 'nome' => 'Alemã',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 12,
                 'nome' => 'Francesa',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 13,
                 'nome' => 'Japonesa',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 14,
                 'nome' => 'Chinesa',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 15,
                 'nome' => 'Americana',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 16,
                 'nome' => 'Canadense',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null],
            ['id' => 17,
                 'nome' => 'Mexicana',
                 'created_at' => '2025-07-09 14:21:00',
                 'updated_at' => null,
                 'criado_em' => '2025-07-09 14:21:00',
                 'editado_em' => null]
        ];

        // Usando insertBatch para inserir múltiplos registros
        // Ajuste conforme necessário se a tabela tiver gatilhos ou colunas auto-preenchidas
        // $this->db->table('nacionalidades')->truncate(); // Descomente para limpar antes de inserir
        if (!empty($data)) {
            $this->db->table('nacionalidades')->insertBatch($data);
        } else {
            // Se o array de dados estiver vazio, você pode optar por não fazer nada
            // ou logar uma mensagem.
            // $this->db->table('nacionalidades')->where('id IS NOT NULL')->delete(); // Exemplo: limpar a tabela se o seed for vazio
        }
    }
}