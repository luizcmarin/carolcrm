<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoUsuariosModel extends Model
{
    protected $table           = 'grupo_usuarios';
    protected $primaryKey      = 'id';
    protected $useAutoIncrement = true;
    protected $returnType      = 'App\Entities\GrupoUsuario';
    protected $useSoftDeletes  = true;
    protected $protectFields   = true;
    protected $allowedFields   = ['nome', 'criado_em', 'atualizado_em', 'deletado_em'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at'; 
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; 

    // Validation
    protected $validationRules = [
            'nome' => [
                'label' => 'Nome',
                'rules' => 'required',    
                'errors' => 'O campo {field} é obrigatório.',
            ],
            'criado_em' => [
                'label' => 'Criado Em',
                'rules' => 'permit_empty|max_length[255]',    
                'errors' => 'O campo {field} deve ter no máximo 255 caracteres.',
            ],
            'atualizado_em' => [
                'label' => 'Atualizado Em',
                'rules' => 'permit_empty|max_length[255]',    
                'errors' => 'O campo {field} deve ter no máximo 255 caracteres.',
            ],
            'deletado_em' => [
                'label' => 'Deletado Em',
                'rules' => 'permit_empty|max_length[255]',    
                'errors' => 'O campo {field} deve ter no máximo 255 caracteres.',
            ],
    ];
    protected $validationMessages  = [
    ];
    protected $skipValidation      = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    
   /**
    * Busca um único registro no banco de dados com base em condições.
    *
    * @param array $conditions Um array associativo de condições (coluna => valor).
    * Ex: ['id' => 1], ['email' => 'teste@email.com'], ['nome' => 'Marin', 'ativo' => 'Sim']
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
           $query->limit($limit,$offset);
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
    * Busca todos os registros que foram soft-deleted (marcados como deletados).
    * Funciona apenas se $useSoftDeletes estiver definido como true no Model.
    *
    * @return array Retorna um array de objetos de Entidade de registros deletados.
    */
   public function findDeleted(): array
   {
       if ($this->useSoftDeletes) {
           return $this->onlyDeleted()->findAll();
       }
       return [];
   }

   /**
    * Exclui permanentemente um registro do banco de dados, ignorando o soft delete.
    *
    * @param int $id O ID da chave primária do registro a ser excluído permanentemente.
    * @return bool Retorna true em caso de sucesso, false caso contrário.
    */
   public function forceDelete(int $id): bool
   {
       return $this->delete($id, true);
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