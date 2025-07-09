<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GrupoUsuariosModel;
use App\Entities\GrupoUsuario;

class GrupoUsuarios extends BaseController
{
    protected $grupousuariosModel;   
    protected $searchableFields = [
        'nome',
    ];

    public function __construct()
    {
        $this->grupousuariosModel = new GrupoUsuariosModel();
    }

    /**
     * Exibe a lista de todos os grupousuarios.
     *
     * @return string
     */
    public function index(): string
    { 
        $search = $this->request->getVar('search');

        $query = $this->grupousuariosModel;

        if (!empty($search)) {
            $query->groupStart();
            foreach ($this->searchableFields as $field) {
                $query->orLike($field, $search);
            }
            $query->groupEnd();
        }

      $perPage = 10;

      $grupousuarios = $query->paginate($perPage);
      $pager = $this->grupousuariosModel->pager;

      $currentPage = $pager->getCurrentPage();
      $totalRecords = $pager->getTotal();

      $firstItem = (($currentPage - 1) * $perPage) + 1;
      $lastItem = min($currentPage * $perPage, $totalRecords);

      $data = [
          'titulo' => 'Lista de grupousuarios',
          'grupousuarios' => $grupousuarios,
          'search'       => $search,
          'pager'  => $pager,
          'firstItem'    => $firstItem,
          'lastItem'     => $lastItem,
          'totalRecords' => $totalRecords,
      ];

      return view('grupousuarios/index', $data);
    }

    /**
     * Exibe o formulário para criar um novo grupousuarios.
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

        return view('grupousuarios/new', $data);
    }

    /**
     * Salva um novo grupousuarios no banco de dados.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $postData = $this->request->getPost();

        $grupousuarios = new GrupoUsuario();
        $grupousuarios->fill($postData);

        if ($this->grupousuariosModel->save($grupousuarios)) {
            return redirect()->to('/grupousuarios')->with('success', 'Registro criado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->grupousuariosModel->errors());
        }
    }

    /**
     * Exibe o formulário para editar um grupousuarios existente.
     *
     * @param int $id O ID do grupousuarios.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit(int $id)
    {
        $grupousuarios = $this->grupousuariosModel->find($id); // Usar find para consistência

        if (!$grupousuarios) {
            return redirect()->to('/grupousuarios')->with('error', 'Registro não encontrado.');
        }

        $data = [
            'titulo' => 'Editar',
            'grupousuarios' => $grupousuarios,
        ];
        
        // carrega dados relacionados
        $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('grupousuarios/edit', $data);
    }

    /**
     * Atualiza um grupousuarios existente no banco de dados.
     *
     * @param int $id O ID do grupousuarios.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $grupousuarios = $this->grupousuariosModel->find($id);
        if (!$grupousuarios) {
            return redirect()->to('/grupousuarios')->with('error', 'Registro não encontrado para atualização.');
        }

        $postData = $this->request->getPost();

        // Lógica para campos booleanos (ex: 'ativo')
        // if (!isset($postData['ativo'])) {
        //   $postData['ativo'] = 'Não';
        // }

        $grupousuarios->fill($postData);

        if ($this->grupousuariosModel->save($grupousuarios)) {
            return redirect()->to('/grupousuarios')->with('success', 'Registro atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->grupousuariosModel->errors());
        }
    }

    /**
     * Exibe os detalhes de um grupousuarios específico.
     *
     * @param int $id O ID do grupousuarios.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function show(int $id)
    {
        $grupousuarios = $this->grupousuariosModel->find($id); // Usar find para consistência

        if (!$grupousuarios) {
            return redirect()->to('/grupousuarios')->with('error', 'grupousuarios não encontrado.');
        }
    
        $data = [
            'titulo' => 'Detalhes',
            'grupousuarios' => $grupousuarios,
        ];
        return view('grupousuarios/show', $data);
    }

    /**
     * Exclui um grupousuarios do banco de dados.
     *
     * @param int $id O ID do grupousuarios.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->grupousuariosModel->delete($id)) {
            return redirect()->to('/grupousuarios')->with('success', 'Registro excluído com sucesso!');
        } else {
            // Em caso de soft delete, errors() pode não retornar nada.
            // Considere uma mensagem padrão de erro de exclusão.
            $errors = $this->grupousuariosModel->errors();
            $message = !empty($errors) ? implode('<br>', $errors) : 'Erro ao excluir o registro. Verifique os logs.';
            return redirect()->back()->with('error', $message);
        }
    }
  }