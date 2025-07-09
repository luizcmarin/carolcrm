<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Entities\Usuario;

class Usuarios extends BaseController
{
    protected $usuariosModel;
    protected $searchableFields = [
        'nome',
    ];

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
    }

    /**
     * Exibe a lista de todos os usuarios.
     *
     * @return string
     */
    public function index(): string
    {
        $search = $this->request->getVar('search');

        $query = $this->usuariosModel;

        if (!empty($search)) {
            $query->groupStart();
            foreach ($this->searchableFields as $field) {
                $query->orLike($field, $search);
            }
            $query->groupEnd();
        }

        $perPage = 10;

        $usuarios = $query->paginate($perPage);
        $pager = $this->usuariosModel->pager;

        $currentPage = $pager->getCurrentPage();
        $totalRecords = $pager->getTotal();

        $firstItem = (($currentPage - 1) * $perPage) + 1;
        $lastItem = min($currentPage * $perPage, $totalRecords);

        $data = [
            'titulo' => 'Lista de usuarios',
            'usuarios' => $usuarios,
            'search'       => $search,
            'pager'  => $pager,
            'firstItem'    => $firstItem,
            'lastItem'     => $lastItem,
            'totalRecords' => $totalRecords,
        ];

        return view('usuarios/index', $data);
    }

    /**
     * Exibe o formulário para criar um novo usuarios.
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

        return view('usuarios/new', $data);
    }

    /**
     * Salva um novo usuarios no banco de dados.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $postData = $this->request->getPost();

        $usuarios = new Usuario();
        $usuarios->fill($postData);

        if ($this->usuariosModel->save($usuarios)) {
            return redirect()->to('/usuarios')->with('success', 'Registro criado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->usuariosModel->errors());
        }
    }

    /**
     * Exibe o formulário para editar um usuarios existente.
     *
     * @param int $id O ID do usuarios.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit(int $id)
    {
        $usuarios = $this->usuariosModel->find($id); // Usar find para consistência

        if (!$usuarios) {
            return redirect()->to('/usuarios')->with('error', 'Registro não encontrado.');
        }

        $data = [
            'titulo' => 'Editar',
            'usuarios' => $usuarios,
        ];

        // carrega dados relacionados
        $data['tabela_options'] = '';

        return view('usuarios/edit', $data);
    }

    /**
     * Atualiza um usuarios existente no banco de dados.
     *
     * @param int $id O ID do usuarios.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $usuarios = $this->usuariosModel->find($id);
        if (!$usuarios) {
            return redirect()->to('/usuarios')->with('error', 'Registro não encontrado para atualização.');
        }

        $postData = $this->request->getPost();

        // Lógica para campos booleanos (ex: 'ativo')
        // if (!isset($postData['ativo'])) {
        //   $postData['ativo'] = 'Não';
        // }

        $usuarios->fill($postData);

        if ($this->usuariosModel->save($usuarios)) {
            return redirect()->to('/usuarios')->with('success', 'Registro atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->usuariosModel->errors());
        }
    }

    /**
     * Exibe os detalhes de um usuarios específico.
     *
     * @param int $id O ID do usuarios.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function show(int $id)
    {
        $usuarios = $this->usuariosModel->find($id); // Usar find para consistência

        if (!$usuarios) {
            return redirect()->to('/usuarios')->with('error', 'usuarios não encontrado.');
        }

        $data = [
            'titulo' => 'Detalhes',
            'usuarios' => $usuarios,
        ];
        return view('usuarios/show', $data);
    }

    /**
     * Exclui um usuarios do banco de dados.
     *
     * @param int $id O ID do usuarios.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($this->usuariosModel->delete($id)) {
            return redirect()->to('/usuarios')->with('success', 'Registro excluído com sucesso!');
        } else {
            // Em caso de soft delete, errors() pode não retornar nada.
            // Considere uma mensagem padrão de erro de exclusão.
            $errors = $this->usuariosModel->errors();
            $message = !empty($errors) ? implode('<br>', $errors) : 'Erro ao excluir o registro. Verifique os logs.';
            return redirect()->back()->with('error', $message);
        }
    }
}
