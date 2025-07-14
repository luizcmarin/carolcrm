<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AvisosSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        // Usando insertBatch para inserir múltiplos registros
        // Ajuste conforme necessário se a tabela tiver gatilhos ou colunas auto-preenchidas
        // $this->db->table('avisos')->truncate(); // Descomente para limpar antes de inserir
        if (!empty($data)) {
            $this->db->table('avisos')->insertBatch($data);
        } else {
            // Se o array de dados estiver vazio, você pode optar por não fazer nada
            // ou logar uma mensagem.
            // $this->db->table('avisos')->where('id IS NOT NULL')->delete(); // Exemplo: limpar a tabela se o seed for vazio
        }
    }
}