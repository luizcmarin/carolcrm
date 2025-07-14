<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FidelizesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1,
                 'nivel_fidelidade1' => 'OURO',
                 'pontos_de1' => 24,
                 'pontos_ate1' => 30,
                 'nivel_fidelidade2' => 'PRATA',
                 'pontos_de2' => 22,
                 'pontos_ate2' => 24,
                 'nivel_fidelidade3' => 'BRONZE',
                 'pontos_de3' => 19,
                 'pontos_ate3' => 21,
                 'nivel_fidelidade4' => 'COBRE',
                 'pontos_de4' => 14,
                 'pontos_ate4' => 18,
                 'faturamento_pontos1' => 1,
                 'valor_faturamento_de1' => 199,
                 'valor_faturamento_ate1' => 20999,
                 'faturamento_pontos2' => 7,
                 'valor_faturamento_de2' => 21000,
                 'valor_faturamento_ate2' => 90099,
                 'faturamento_pontos3' => 8,
                 'valor_faturamento_de3' => 90100,
                 'valor_faturamento_ate3' => 180099,
                 'faturamento_pontos4' => 9,
                 'valor_faturamento_de4' => 180100,
                 'valor_faturamento_ate4' => 300099,
                 'faturamento_pontos5' => 10,
                 'valor_faturamento_de5' => 300100,
                 'valor_faturamento_ate5' => 0,
                 'frequencia_pontos1' => 1,
                 'frequencia_de1' => 1,
                 'frequencia_ate1' => 2,
                 'frequencia_pontos2' => 2,
                 'frequencia_de2' => 3,
                 'frequencia_ate2' => 6,
                 'frequencia_pontos3' => 3,
                 'frequencia_de3' => 7,
                 'frequencia_ate3' => 10,
                 'frequencia_pontos4' => 4,
                 'frequencia_de4' => 11,
                 'frequencia_ate4' => 14,
                 'frequencia_pontos5' => 5,
                 'frequencia_de5' => 15,
                 'frequencia_ate5' => 0,
                 'permanencia_pontos1' => 11,
                 'permanencia_de1' => 0,
                 'permanencia_ate1' => 9,
                 'permanencia_pontos2' => 12,
                 'permanencia_de2' => 11,
                 'permanencia_ate2' => 19,
                 'permanencia_pontos3' => 13,
                 'permanencia_de3' => 20,
                 'permanencia_ate3' => 29,
                 'permanencia_pontos4' => 14,
                 'permanencia_de4' => 30,
                 'permanencia_ate4' => 39,
                 'permanencia_pontos5' => 15,
                 'permanencia_de5' => 40,
                 'permanencia_ate5' => 0,
                 'created_at' => null,
                 'updated_at' => null,
                 'criado_em' => null,
                 'editado_em' => null]
        ];

        // Usando insertBatch para inserir múltiplos registros
        // Ajuste conforme necessário se a tabela tiver gatilhos ou colunas auto-preenchidas
        // $this->db->table('fidelizes')->truncate(); // Descomente para limpar antes de inserir
        if (!empty($data)) {
            $this->db->table('fidelizes')->insertBatch($data);
        } else {
            // Se o array de dados estiver vazio, você pode optar por não fazer nada
            // ou logar uma mensagem.
            // $this->db->table('fidelizes')->where('id IS NOT NULL')->delete(); // Exemplo: limpar a tabela se o seed for vazio
        }
    }
}