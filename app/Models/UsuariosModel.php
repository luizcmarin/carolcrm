<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PermissoesModel;
use App\Models\Traits\AuditoriaTrait;
use App\Models\UsuarioPermissoesModel;

class UsuariosModel extends Model
{
    use AuditoriaTrait;

    protected $table           = 'usuarios';
    protected $primaryKey      = 'id';
    protected $useAutoIncrement = true;
    protected $returnType      = 'App\Entities\Usuario';
    protected $useSoftDeletes  = false;
    protected $protectFields   = true;
    protected $allowedFields   = ['nome', 'usuario_grupo_id', 'celular', 'telefone', 'email', 'imagem_id', 'sobre', 'endereco', 'bairro', 'cidade_id', 'cep', 'complemento', 'redes_sociais', 'genero', 'cpf', 'documentos', 'cargo_id', 'profissao_id', 'nacionalidade_id', 'assinatura_email', 'nome_usuario', 'senha', 'ultimo_ip', 'data_ultimo_login', 'sn_administrador', 'sn_ativo', 'created_at', 'updated_at', 'criado_em', 'editado_em'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [
        'nome' => [
            'label' => 'Nome',
            'rules' => 'required',
            'errors' => 'O campo {field} é obrigatório.',
        ],
        'usuario_grupo_id' => [
            'label' => 'Usuario Grupo Id',
            'rules' => 'required|integer',
            'errors' => 'O campo {field} é obrigatório.|O campo {field} deve ser um número inteiro.',
        ],
        'celular' => [
            'label' => 'Celular',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'telefone' => [
            'label' => 'Telefone',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => 'O campo {field} é obrigatório.|O campo {field} deve conter um endereço de e-mail válido.',
        ],
        'imagem_id' => [
            'label' => 'Imagem Perfil',
            'rules' => 'permit_empty|integer',
            'errors' => '',
        ],
        'sobre' => [
            'label' => 'Sobre',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'endereco' => [
            'label' => 'Endereco',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'bairro' => [
            'label' => 'Bairro',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'cidade_id' => [
            'label' => 'Cidade Id',
            'rules' => 'required|integer',
            'errors' => 'O campo {field} é obrigatório.|O campo {field} deve ser um número inteiro.',
        ],
        'cep' => [
            'label' => 'Cep',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'complemento' => [
            'label' => 'Complemento',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'redes_sociais' => [
            'label' => 'Redes Sociais',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'genero' => [
            'label' => 'Genero',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'cpf' => [
            'label' => 'Cpf',
            'rules' => 'permit_empty|valid_cpf',
            'errors' => 'O campo {field} é inválido.',
            'valid_cpf' => 'O CPF informado não é válido.',
        ],
        'documentos' => [
            'label' => 'Documentos',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'cargo_id' => [
            'label' => 'Cargo Id',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'profissao_id' => [
            'label' => 'Profissao Id',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'nacionalidade_id' => [
            'label' => 'Nacionalidade Id',
            'rules' => 'permit_empty|integer',
            'errors' => 'O campo {field} deve ser um número inteiro.',
        ],
        'assinatura_email' => [
            'label' => 'Assinatura Email',
            'rules' => 'permit_empty|valid_email',
            'errors' => 'O campo {field} deve conter um endereço de e-mail válido.',
        ],
        'nome_usuario' => [
            'label' => 'Nome e usuário',
            'rules' => 'required',
            'errors' => 'O campo {field} é obrigatório.',
        ],
        'senha' => [
            'label' => 'Senha',
            'rules' => 'min_length[8]',
            'errors' => 'O campo {field} é inválido.',
        ],
        'sn_administrador' => [
            'label' => 'Sn Administrador',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
        'sn_ativo' => [
            'label' => 'Sn Ativo',
            'rules' => 'permit_empty',
            'errors' => '',
        ],
    ];
    protected $validationMessages  = [];
    protected $skipValidation      = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setAuditoriaCriacao', 'hashPassword'];
    protected $afterInsert    = ['adicionarPermissoesPadraoAoNovoUsuario'];
    protected $beforeUpdate   = ['setAuditoriaEdicao', 'hashPassword'];
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

    /**
     * Hashes a senha antes de salvar no banco de dados.
     * Este método é chamado pelos callbacks beforeInsert e beforeUpdate.
     *
     * @param array $data O array de dados que será inserido/atualizado.
     * @return array O array de dados modificado com a senha hasheada.
     */
    protected function hashPassword(array $data)
    {
        // Verifica se o campo 'senha' existe e não está vazio
        if (isset($data['data']['senha']) && !empty($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        } else {
            // Se a senha estiver vazia (no caso de update onde não foi alterada),
            // remove a chave 'senha' para não sobrescrever com vazio/nulo.
            // Isso é um fallback, pois o controller já deveria lidar com isso.
            unset($data['data']['senha']);
        }

        return $data;
    }

    /**
     * Associa um ID de arquivo a um usuário específico.
     * Se $imagemId for null, desvincula a imagem (usa a imagem padrão).
     *
     * @param int $userId O ID do usuário.
     * @param int|null $imagemId O ID do arquivo na tabela 'arquivos', ou null para remover.
     * @return bool
     */
    public function setImagemPerfil(int $userId, ?int $imagemId): bool
    {
        return $this->update($userId, ['imagem_id' => $imagemId]);
    }

    /**
     * Verifica se um determinado ID de arquivo está sendo referenciado por algum usuário.
     *
     * @param int $arquivoId O ID do arquivo a ser verificado na tabela 'arquivos'.
     * @return bool True se houver referências, False caso contrário.
     */
    public function isArquivoReferenciado(int $arquivoId): bool
    {
        // Verifica se algum usuário tem este arquivo como imagem de perfil
        return $this->where('imagem_id', $arquivoId)->countAllResults() > 0;

        // TODO: Se você tiver outras tabelas que referenciam 'arquivos', precisaria verificar aqui também
        // Ex: $imoveisModel = new ImoveisModel();
        // return $this->where('imagem_id', $arquivoId)->countAllResults() > 0 || $imoveisModel->where('foto_principal_id', $arquivoId)->countAllResults() > 0;
    }

    /**
     * Exclui um usuário e, se houver, sua imagem de perfil associada,
     * desde que a imagem não esteja sendo referenciada por outros usuários.
     *
     * @param int $userId O ID do usuário a ser excluído.
     * @return bool True em caso de sucesso, False em caso de falha.
     */
    public function deleteUserAndAssociatedImage(int $userId): bool
    {
        $this->db->transBegin();

        try {
            $user = $this->find($userId);
            if (!$user) {
                throw new \Exception('Usuário não encontrado.');
            }

            $imageId = $user['imagem_id'];

            // 1. Exclui o registro do usuário
            if (!$this->delete($userId)) {
                throw new \Exception('Falha ao excluir o registro do usuário.');
            }

            // 2. Se o usuário tinha uma imagem associada, tenta excluí-la
            if ($imageId) {
                // Instancia o Arquivos Controller para usar sua lógica de exclusão de arquivo.
                // É importante usar o método interno que verifica referências.
                $ArquivosController = new \App\Controllers\Arquivos();
                $ArquivosController->deleteArquivoAndRecord($imageId);
                // deleteArquivoAndRecord vai internamente verificar se o arquivo ainda é referenciado
                // por outros usuários ou entidades. Se não for, ele será excluído fisicamente.
                // Se for, ele simplesmente não será excluído fisicamente, que é o comportamento desejado.
            }

            $this->db->transCommit();
            return true;
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Erro ao excluir usuário e imagem: ' . $e->getMessage());
            session()->setFlashdata('error', 'Erro ao excluir usuário: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Callback executado após a inserção de um novo usuário.
     * Adiciona todas as permissões existentes à tabela 'usuario_permissoes' para o novo usuário.
     *
     * @param array $data O array de dados do usuário recém-inserido.
     * @return array O array de dados original.
     */
    protected function adicionarPermissoesPadraoAoNovoUsuario(array $data)
    {
        // Verifica se a inserção do usuário foi bem-sucedida e se há um ID de usuário
        if (!empty($data['id'])) {
            $novoUsuarioId = $data['id'];

            $permissaoModel = new PermissoesModel();
            $usuarioPermissaoModel = new UsuarioPermissoesModel();

            // Busca todas as permissões existentes na tabela 'permissoes'
            $permissoesExistentes = $permissaoModel->findAll();

            if (!empty($permissoesExistentes)) {
                $batchInsertData = [];
                foreach ($permissoesExistentes as $permissao) {
                    $batchInsertData[] = [
                        'usuario_id' => $novoUsuarioId,
                        'categoria'  => $permissao->categoria,
                        'chave'      => $permissao->chave,
                        'sn_ativo'   => 'Não',
                    ];
                }

                if (!empty($batchInsertData)) {
                    try {
                        $usuarioPermissaoModel->insertBatch($batchInsertData);
                    } catch (\Throwable $e) {
                        log_message('error', 'Erro ao adicionar permissões padrão ao novo usuário ID ' . $novoUsuarioId . ': ' . $e->getMessage());
                    }
                }
            } else {
                log_message('info', 'Nenhuma permissão existente encontrada para adicionar ao novo usuário ID: ' . $novoUsuarioId);
            }
        }
        return $data;
    }
}
