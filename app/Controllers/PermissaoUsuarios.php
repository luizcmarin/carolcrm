<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissaoUsuariosModel;
use App\Entities\PermissaoUsuario;

class PermissaoUsuarios extends BaseController
{
    protected $permissaousuariosModel;   
    protected $searchableFields = [
        'nome',
    ];

    public function __construct()
    {
        $this->permissaousuariosModel = new PermissaoUsuariosModel();
    }

    /**
     * Exibe a lista de todos os permissaousuarios.
     *
     * @return string
     */
    public function index(): string
    { 
        $search = $this->request->getVar('search');

        $query = $this->permissaousuariosModel;

        if (!empty($search)) {
            $query->groupStart();
            foreach ($this->searchableFields as $field) {
                $query->orLike($field, $search);
            }
            $query->groupEnd();
        }

      $perPage = 10;

      $permissaousuarios = $query->paginate($perPage);
      $pager = $this->permissaousuariosModel->pager;

      $currentPage = $pager->getCurrentPage();
      $totalRecords = $pager->getTotal();

      $firstItem = (($currentPage - 1) * $perPage) + 1;
      $lastItem = min($currentPage * $perPage, $totalRecords);

      $data = [
          'titulo' => 'Lista de permissaousuarios',
          'permissaousuarios' => $permissaousuarios,
          'search'       => $search,
          'pager'  => $pager,
          'firstItem'    => $firstItem,
          'lastItem'     => $lastItem,
          'totalRecords' => $totalRecords,
      ];

      return view('permissaousuarios/index', $data);
    }

    /**
     * Exibe o formulário para criar um novo permissaousuarios.
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

        return view('permissaousuarios/new', $data);
    }

    /**
     * Salva um novo permissaousuarios no banco de dados.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $postData = $this->request->getPost();

        $permissaousuarios = new PermissaoUsuario();
        $permissaousuarios->fill($postData);

        if ($this->permissaousuariosModel->save($permissaousuarios)) {
            return redirect()->to('/permissaousuarios')->with('success', 'Registro criado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->permissaousuariosModel->errors());
        }
    }

    /**
     * Exibe o formulário para editar um permissaousuarios existente.
     *
     * @param int $id O ID do permissaousuarios.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit(int $id)
    {
        $permissaousuarios = $this->permissaousuariosModel->find($id); // Usar find para consistência

        if (!$permissaousuarios) {
            return redirect()->to('/permissaousuarios')->with('error', 'Registro não encontrado.');
        }

        $data = [
            'titulo' => 'Editar',
            'permissaousuarios' => $permissaousuarios,
        ];
        
        // carrega dados relacionados
        $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('permissaousuarios/edit', $data);
    }

    /**
     * Atualiza um permissaousuarios existente no banco de dados.
     *
     * @param int $id O ID do permissaousuarios.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $permissaousuarios = $this->permissaousuariosModel->find($id);
        if (!$permissaousuarios) {
            return redirect()->to('/permissaousuarios')->with('error', 'Registro não encontrado para atualização.');
        }

        $postData = $this->request->getPost();

        // Lógica para campos booleanos (ex: 'ativo')
        // if (!isset($postData['ativo'])) {
        //   $postData['ativo'] = 'Não';
        // }

        $permissaousuarios->fill($postData);

        if ($this->permissaousuariosModel->save($permissaousuarios)) {
            return redirect()->to('/permissaousuarios')->with('success', 'Registro atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->permissaousuariosModel->errors());
        }
    }

    /**
     * Exibe os detalhes de um permissaousuarios específico.
     *
     * @param int $id O ID do permissaousuarios.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function show(int $id)
    {
        $permissaousuarios = $this->permissaousuariosModel->find($id); // Usar find para consistência

        if (!$permissaousuarios) {
            return redirect()->to('/permissaousuarios')->with('error', 'permissaousuarios não encontrado.');
        }
    
        $data = [
            'titulo' => 'Detalhes',
            'permissaousuarios' => $permissaousuarios,
        ];
        return view('permissaousuarios/show', $data);
    }

    /**
     * Exclui um permissaousuarios do banco de dados.
     *
     * @param int $id O ID do permissaousuarios.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->permissaousuariosModel->delete($id)) {
            return redirect()->to('/permissaousuarios')->with('success', 'Registro excluído com sucesso!');
        } else {
            // Em caso de soft delete, errors() pode não retornar nada.
            // Considere uma mensagem padrão de erro de exclusão.
            $errors = $this->permissaousuariosModel->errors();
            $message = !empty($errors) ? implode('<br>', $errors) : 'Erro ao excluir o registro. Verifique os logs.';
            return redirect()->back()->with('error', $message);
        }
    }
  }