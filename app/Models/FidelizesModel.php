<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Traits\AuditoriaTrait;

class FidelizesModel extends Model
{
    use AuditoriaTrait;

    protected $table           = 'fidelizes';
    protected $primaryKey      = 'id';
    protected $useAutoIncrement = true;
    protected $returnType      = 'App\Entities\Fideliz';
    protected $useSoftDeletes  = false;
    protected $protectFields   = true;
    protected $allowedFields   = ['nivel_fidelidade1', 'pontos_de1', 'pontos_ate1', 'nivel_fidelidade2', 'pontos_de2', 'pontos_ate2', 'nivel_fidelidade3', 'pontos_de3', 'pontos_ate3', 'nivel_fidelidade4', 'pontos_de4', 'pontos_ate4', 'faturamento_pontos1', 'valor_faturamento_de1', 'valor_faturamento_ate1', 'faturamento_pontos2', 'valor_faturamento_de2', 'valor_faturamento_ate2', 'faturamento_pontos3', 'valor_faturamento_de3', 'valor_faturamento_ate3', 'faturamento_pontos4', 'valor_faturamento_de4', 'valor_faturamento_ate4', 'faturamento_pontos5', 'valor_faturamento_de5', 'valor_faturamento_ate5', 'frequencia_pontos1', 'frequencia_de1', 'frequencia_ate1', 'frequencia_pontos2', 'frequencia_de2', 'frequencia_ate2', 'frequencia_pontos3', 'frequencia_de3', 'frequencia_ate3', 'frequencia_pontos4', 'frequencia_de4', 'frequencia_ate4', 'frequencia_pontos5', 'frequencia_de5', 'frequencia_ate5', 'permanencia_pontos1', 'permanencia_de1', 'permanencia_ate1', 'permanencia_pontos2', 'permanencia_de2', 'permanencia_ate2', 'permanencia_pontos3', 'permanencia_de3', 'permanencia_ate3', 'permanencia_pontos4', 'permanencia_de4', 'permanencia_ate4', 'permanencia_pontos5', 'permanencia_de5', 'permanencia_ate5', 'created_at', 'updated_at', 'criado_em', 'editado_em'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [
        'nivel_fidelidade1' => [
            'label' => 'Nivel Fidelidade1',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'pontos_de1' => [
            'label' => 'Pontos De1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'pontos_ate1' => [
            'label' => 'Pontos Ate1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'nivel_fidelidade2' => [
            'label' => 'Nivel Fidelidade2',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'pontos_de2' => [
            'label' => 'Pontos De2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'pontos_ate2' => [
            'label' => 'Pontos Ate2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'nivel_fidelidade3' => [
            'label' => 'Nivel Fidelidade3',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'pontos_de3' => [
            'label' => 'Pontos De3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'pontos_ate3' => [
            'label' => 'Pontos Ate3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'nivel_fidelidade4' => [
            'label' => 'Nivel Fidelidade4',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'pontos_de4' => [
            'label' => 'Pontos De4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'pontos_ate4' => [
            'label' => 'Pontos Ate4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'faturamento_pontos1' => [
            'label' => 'Faturamento Pontos1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_de1' => [
            'label' => 'Valor Faturamento De1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_ate1' => [
            'label' => 'Valor Faturamento Ate1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'faturamento_pontos2' => [
            'label' => 'Faturamento Pontos2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_de2' => [
            'label' => 'Valor Faturamento De2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_ate2' => [
            'label' => 'Valor Faturamento Ate2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'faturamento_pontos3' => [
            'label' => 'Faturamento Pontos3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_de3' => [
            'label' => 'Valor Faturamento De3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_ate3' => [
            'label' => 'Valor Faturamento Ate3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'faturamento_pontos4' => [
            'label' => 'Faturamento Pontos4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_de4' => [
            'label' => 'Valor Faturamento De4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_ate4' => [
            'label' => 'Valor Faturamento Ate4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'faturamento_pontos5' => [
            'label' => 'Faturamento Pontos5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_de5' => [
            'label' => 'Valor Faturamento De5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'valor_faturamento_ate5' => [
            'label' => 'Valor Faturamento Ate5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_pontos1' => [
            'label' => 'Frequencia Pontos1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_de1' => [
            'label' => 'Frequencia De1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_ate1' => [
            'label' => 'Frequencia Ate1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_pontos2' => [
            'label' => 'Frequencia Pontos2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_de2' => [
            'label' => 'Frequencia De2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_ate2' => [
            'label' => 'Frequencia Ate2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_pontos3' => [
            'label' => 'Frequencia Pontos3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_de3' => [
            'label' => 'Frequencia De3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_ate3' => [
            'label' => 'Frequencia Ate3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_pontos4' => [
            'label' => 'Frequencia Pontos4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_de4' => [
            'label' => 'Frequencia De4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_ate4' => [
            'label' => 'Frequencia Ate4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_pontos5' => [
            'label' => 'Frequencia Pontos5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_de5' => [
            'label' => 'Frequencia De5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'frequencia_ate5' => [
            'label' => 'Frequencia Ate5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_pontos1' => [
            'label' => 'Permanencia Pontos1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_de1' => [
            'label' => 'Permanencia De1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_ate1' => [
            'label' => 'Permanencia Ate1',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_pontos2' => [
            'label' => 'Permanencia Pontos2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_de2' => [
            'label' => 'Permanencia De2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_ate2' => [
            'label' => 'Permanencia Ate2',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_pontos3' => [
            'label' => 'Permanencia Pontos3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_de3' => [
            'label' => 'Permanencia De3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_ate3' => [
            'label' => 'Permanencia Ate3',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_pontos4' => [
            'label' => 'Permanencia Pontos4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_de4' => [
            'label' => 'Permanencia De4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_ate4' => [
            'label' => 'Permanencia Ate4',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_pontos5' => [
            'label' => 'Permanencia Pontos5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_de5' => [
            'label' => 'Permanencia De5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'permanencia_ate5' => [
            'label' => 'Permanencia Ate5',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'created_at' => [
            'label' => 'Created At',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'updated_at' => [
            'label' => 'Updated At',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'criado_em' => [
            'label' => 'Criado Em',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'editado_em' => [
            'label' => 'Editado Em',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
    ];
    protected $validationMessages  = [];
    protected $skipValidation      = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setAuditoriaCriacao'];
    protected $afterInsert    = [];
    protected $beforeUpdate = ['setAuditoriaEdicao'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /**
     * Busca um único registro no banco de dados com base em condições.
     *
     * @param array $conditions Um array associativo de condições (coluna => valor).
     * Ex: ['id' => 1], ['email' => 'teste@email.com'], ['nome' => 'Marin', 'sn_ativo' => 'Sim']
     * @return object|null Retorna o objeto da Entidade (se encontrado) ou null (se não encontrado).
     */
    public function getOne(array $conditions = []): ?object
    {
        if (empty($conditions)) {
            return null;
        }

        return $this->where($conditions)->first();
    }

    /**
     * Busca o valor de um campo específico de um único registro no banco de dados com base em condições.
     *
     * @param string $fieldName O nome do campo cujo valor você deseja retornar.
     * @param array $conditions Um array associativo de condições (coluna => valor).
     * Ex: ['id' => 1], ['email' => 'teste@email.com'], ['chave' => 'nome_da_configuracao']
     * @return mixed|null Retorna o valor do campo (se encontrado) ou null (se não encontrado ou campo não existir).
     */
    public function getCampo(string $fieldName, array $conditions = [])
    {
        if (empty($conditions) || empty($fieldName)) {
            return null;
        }

        $result = $this->select($fieldName)
            ->where($conditions)
            ->first();

        if ($result) {
            return $result->$fieldName;
        }

        return null;
    }

    /**
     * Busca múltiplos registros no banco de dados com base em condições, limite e offset.
     *
     * @param array $conditions Um array associativo de condições (coluna => valor).
     * @param int $limit O número máximo de registros a retornar (0 para sem limite).
     * @param int $offset O offset inicial para a busca (útil para paginação).
     * @return array Retorna um array de objetos de Entidade (se encontrados) ou um array vazio.
     */
    public function getMany(array $conditions = [], int $limit = 0, int $offset = 0): array
    {
        $query = $this->where($conditions);

        if ($limit > 0) {
            $query->limit($limit, $offset);
        }

        return $query->findAll();
    }

    /**
     * Conta o número de registros no banco de dados com base em condições.
     *
     * @param array $conditions Um array associativo de condições (coluna => valor).
     * @return int Retorna o número total de registros que correspondem às condições.
     */
    public function countRecords(array $conditions = []): int
    {
        return $this->where($conditions)->countAllResults();
    }

    /**
     * Verifica se um ou mais registros existem com base em condições fornecidas.
     *
     * @param array $conditions Um array associativo de condições (coluna => valor).
     * @return bool Retorna true se pelo menos um registro for encontrado, false caso contrário.
     */
    public function exists(array $conditions = []): bool
    {
        if (empty($conditions)) {
            return false; // Não faz sentido verificar existência sem condições
        }
        // Usa select('1') para otimizar, pois só precisamos saber se há algum resultado, não os dados.
        return $this->where($conditions)->select('1')->limit(1)->countAllResults() > 0;
    }

    /**
     * Retorna um array de opções para dropdowns (chave => valor) com base em campos e condições.
     *
     * @param string $valueField O nome do campo que será o 'valor' (ex: 'id').
     * @param string $labelField O nome do campo que será o 'rótulo' visível (ex: 'nome').
     * @param array $conditions Um array associativo de condições para filtrar os resultados.
     * @param string $orderBy O campo para ordenar os resultados.
     * @param string $orderDirection A direção da ordenação ('ASC' ou 'DESC').
     * @return array Um array associativo (valueField => labelField) para uso em dropdowns.
     */
    public function getDropdown(string $valueField, string $labelField, array $conditions = [], string $orderBy = '', string $orderDirection = 'ASC'): array
    {
        $query = $this->select("{$valueField}, {$labelField}")
            ->where($conditions);

        if (!empty($orderBy)) {
            $query->orderBy($orderBy, $orderDirection);
        } else {
            // Ordena pelo labelField por padrão se nenhum orderBy for fornecido
            $query->orderBy($labelField, $orderDirection);
        }

        $results = $query->findAll();
        $options = [];
        foreach ($results as $row) {
            $options[$row->$valueField] = $row->$labelField;
        }
        return $options;
    }
}
