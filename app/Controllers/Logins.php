<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginsModel;
use App\Entities\Logim;

class Logins extends BaseController
{
    protected $loginsModel;   
    protected $searchableFields = [
        'nome',
    ];

    public function __construct()
    {
        $this->loginsModel = new LoginsModel();
    }

    /**
     * Exibe a lista de todos os logins.
     *
     * @return string
     */
    public function index(): string
    { 
        $search = $this->request->getVar('search');

        $query = $this->loginsModel;

        if (!empty($search)) {
            $query->groupStart();
            foreach ($this->searchableFields as $field) {
                $query->orLike($field, $search);
            }
            $query->groupEnd();
        }

      $perPage = 10;

      $logins = $query->paginate($perPage);
      $pager = $this->loginsModel->pager;

      $currentPage = $pager->getCurrentPage();
      $totalRecords = $pager->getTotal();

      $firstItem = (($currentPage - 1) * $perPage) + 1;
      $lastItem = min($currentPage * $perPage, $totalRecords);

      $data = [
          'titulo' => 'Lista de logins',
          'logins' => $logins,
          'search'       => $search,
          'pager'  => $pager,
          'firstItem'    => $firstItem,
          'lastItem'     => $lastItem,
          'totalRecords' => $totalRecords,
      ];

      return view('logins/index', $data);
    }

    /**
     * Exibe o formulário para criar um novo logins.
     *
     * @return string
     */
    public function new(): string
    {
        $data = [
            'titulo' => 'Novo',
        ];

        // carrega dados relacionados
        $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('logins/new', $data);
    }

    /**
     * Salva um novo logins no banco de dados.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $postData = $this->request->getPost();

        $logins = new Logim();
        $logins->fill($postData);

        if ($this->loginsModel->save($logins)) {
            return redirect()->to('/logins')->with('success', 'Registro criado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->loginsModel->errors());
        }
    }

    /**
     * Exibe o formulário para editar um logins existente.
     *
     * @param int $id O ID do logins.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit(int $id)
    {
        $logins = $this->loginsModel->find($id); // Usar find para consistência

        if (!$logins) {
            return redirect()->to('/logins')->with('error', 'Registro não encontrado.');
        }

        $data = [
            'titulo' => 'Editar',
            'logins' => $logins,
        ];
        
        // carrega dados relacionados
        $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('logins/edit', $data);
    }

    /**
     * Atualiza um logins existente no banco de dados.
     *
     * @param int $id O ID do logins.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $logins = $this->loginsModel->find($id);
        if (!$logins) {
            return redirect()->to('/logins')->with('error', 'Registro não encontrado para atualização.');
        }

        $postData = $this->request->getPost();

        // Lógica para campos booleanos (ex: 'ativo')
        // if (!isset($postData['ativo'])) {
        //   $postData['ativo'] = 'Não';
        // }

        $logins->fill($postData);

        if ($this->loginsModel->save($logins)) {
            return redirect()->to('/logins')->with('success', 'Registro atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->loginsModel->errors());
        }
    }

    /**
     * Exibe os detalhes de um logins específico.
     *
     * @param int $id O ID do logins.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function show(int $id)
    {
        $logins = $this->loginsModel->find($id); // Usar find para consistência

        if (!$logins) {
            return redirect()->to('/logins')->with('error', 'logins não encontrado.');
        }
    
        $data = [
            'titulo' => 'Detalhes',
            'logins' => $logins,
        ];
        return view('logins/show', $data);
    }

    /**
     * Exclui um logins do banco de dados.
     *
     * @param int $id O ID do logins.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->loginsModel->delete($id)) {
            return redirect()->to('/logins')->with('success', 'Registro excluído com sucesso!');
        } else {
            // Em caso de soft delete, errors() pode não retornar nada.
            // Considere uma mensagem padrão de erro de exclusão.
            $errors = $this->loginsModel->errors();
            $message = !empty($errors) ? implode('<br>', $errors) : 'Erro ao excluir o registro. Verifique os logs.';
            return redirect()->back()->with('error', $message);
        }
    }
  }