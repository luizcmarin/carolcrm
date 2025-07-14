<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Traits\AuditoriaTrait;

class UsuarioPermissoesModel extends Model
{
    use AuditoriaTrait;

    protected $table           = 'usuario_permissoes';
    protected $primaryKey      = 'id';
    protected $useAutoIncrement = true;
    protected $returnType      = 'App\Entities\UsuarioPermissao';
    protected $useSoftDeletes  = false;
    protected $protectFields   = true;
    protected $allowedFields   = ['usuario_id', 'categoria', 'chave', 'sn_ativo', 'created_at', 'updated_at', 'criado_em', 'editado_em'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [
        'usuario_id' => [
            'label' => 'Usuario Id',
            'rules' => 'required|integer',
            'errors' => 'O campo {field} é obrigatório.|O campo {field} deve ser um número inteiro.',
        ],
        'categoria' => [
            'label' => 'Categoria',
            'rules' => 'required',
            'errors' => 'O campo {field} é obrigatório.',
        ],
        'chave' => [
            'label' => 'Chave',
            'rules' => 'required',
            'errors' => 'O campo {field} é obrigatório.',
        ],
        'sn_ativo' => [
            'label' => 'Sn Ativo',
            'rules' => 'permit_empty',
            'errors' => '',
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
