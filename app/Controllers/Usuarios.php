<?php

namespace App\Controllers;

use App\Entities\Usuario;
use App\Models\GrupoModel;
use App\Models\UsuarioModel;
use App\Entities\GrupoUsuario;
use App\Models\GrupoUsuarioModel;
use App\Controllers\BaseController;

class Usuarios extends BaseController
{
  protected $usuarioModel;
  protected $grupoModel;

  public function __construct()
  {
    $this->usuarioModel = new UsuarioModel();
    $this->grupoModel = new GrupoUsuarioModel();

    // Carrega o helper Pager para uso nas views
    helper(['form', 'url', 'html', 'pager']);
  }

  /**
   * Exibe a listagem de usuários. (index.php)
   */
  public function index()
  {
    $perPage = 10;
    $usuarios = $this->usuarioModel->getUsuariosComGrupo($perPage);

    $currentPage = $this->request->getVar('page') ?? 1;
    $firstItem = (($currentPage - 1) * $perPage) + 1;
    $lastItem = min($currentPage * $perPage, $this->usuarioModel->pager->getTotal());

    $data = [
      'titulo'       => 'Lista de Usuários',
      'usuarios'     => $usuarios,
      'pager'        => $this->usuarioModel->pager,
      'firstItem'    => $firstItem,
      'lastItem'     => $lastItem,
      'totalRecords' => $this->usuarioModel->pager->getTotal(),
    ];

    return view('usuarios/index', $data);
  }

  /**
   * Exibe o formulário para criar um novo usuário. (incluir.php)
   */
  public function new()
  {
    $data = [
      'titulo'       => 'Novo Usuário',
      'usuario'      => new Usuario(), // Nova entidade vazia
      'opcoesStatus' => ['Ativo', 'Inativo', 'Bloqueado'],
    ];
    return view('usuarios/incluir', $data); // Aponta para incluir.php
  }

  /**
   * Salva um novo usuário.
   */
  public function create() // Método de criação
  {
    // --- 1. Preparação dos dados do POST ---
    $data = $this->request->getPost();

    // Adiciona o valor 'Não' se o switch 'ativo' não foi enviado (está desligado)
    if (!isset($data['ativo'])) {
      $data['ativo'] = 'Não';
    }

    // --- 2. Criar uma nova Entidade e Preencher ---
    // Cria uma nova instância da Entidade Usuario.
    // Isso é importante porque estamos inserindo um novo registro.
    $novoUsuario = new Usuario(); // Garanta que o namespace esteja correto
    $novoUsuario->fill($data);

    // --- 3. Tentar salvar a Entidade usando o Model ---
    // Para inserções, o save() também valida automaticamente.
    if ($this->usuarioModel->save($novoUsuario)) { // <--- Validação acontece AQUI!
      return redirect()->to('/usuarios')->with('success', 'Usuário criado com sucesso!');
    } else {
      // Se a validação falhou no Model (via save()), os erros estão aqui
      return redirect()->back()->withInput()->with('errors', $this->usuarioModel->errors());
    }
  }

  /**
   * Exibe o formulário para editar um usuário existente. (editar.php)
   */
  public function edit($id = null)
  {
    if ($id === null) {
      return redirect()->to('/usuarios')->with('error', 'ID do usuário não fornecido.');
    }

    $usuario = $this->usuarioModel->getUsuarioComGrupo($id);
    if (!$usuario) {
      return redirect()->to('/usuarios')->with('error', 'Usuário não encontrado.');
    }

    $data = [
      'titulo'       => 'Editar Usuário',
      'usuario'      => $usuario,
      'opcoesStatus' => ['Ativo', 'Inativo', 'Bloqueado'],
    ];
    return view('usuarios/editar', $data); // Aponta para editar.php
  }

  /**
   * Atualiza um usuário existente.
   */
  public function update($id = null)
  {
    // --- 1. Validação de ID e existência do usuário ---
    if ($id === null) {
      return redirect()->to('/usuarios')->with('error', 'ID do usuário não fornecido.');
    }

    $usuario = $this->usuarioModel->find($id);
    if (!$usuario) {
      return redirect()->to('/usuarios')->with('error', 'Usuário não encontrado para atualização.');
    }

    // --- 2. Preparação dos dados do POST ---
    $postData = $this->request->getPost();

    // Lógica para o campo 'ativo'
    if (!isset($postData['ativo'])) {
      $postData['ativo'] = 'Não';
    }

    // --- 3. Preenchimento da Entidade ANTES de TENTAR salvar ---
    // Isso é importante para que o Model tenha todos os dados que precisa,
    // incluindo o 'id' para a regra is_unique no contexto de update.
    $usuario->fill($postData);

    // --- 4. Tentar salvar a Entidade usando o Model ---
    // O método save() do Model, quando recebe uma Entidade (como $usuario),
    // tenta validar automaticamente usando as regras definidas no Model.
    // Ele usará o grupo de validação padrão (se não for passado outro)
    // ou o grupo que você especificou.
    // Para updates, ele reconhece o ID da entidade para a regra is_unique.
    if ($this->usuarioModel->save($usuario)) { // <--- Validação acontece AQUI!
      return redirect()->to('/usuarios')->with('success', 'Usuário atualizado com sucesso!');
    } else {
      // Se a validação falhou no Model (via save()), os erros estão aqui
      return redirect()->back()->withInput()->with('errors', $this->usuarioModel->errors());
    }
  }

  /**
   * Exibe os detalhes de um usuário. (ver.php)
   */
  public function show($id = null)
  {
    if ($id === null) {
      return redirect()->to('/usuarios')->with('error', 'ID do usuário não fornecido.');
    }

    $usuario = $this->usuarioModel->getUsuarioComGrupo($id);
    if (!$usuario) {
      return redirect()->to('/usuarios')->with('error', 'Usuário não encontrado.');
    }

    $data = [
      'titulo'  => 'Detalhes do Usuário',
      'usuario' => $usuario,
    ];
    return view('usuarios/ver', $data); // Aponta para ver.php
  }


  /**
   * Exclui (soft delete) um usuário.
   */
  public function delete($id = null)
  {
    if ($id === null) {
      return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'ID do usuário não fornecido.']);
    }

    if ($this->usuarioModel->delete($id)) {
      return redirect()->to('/usuarios')->with('success', 'Usuário excluído com sucesso!');
    } else {
      return redirect()->to('/usuarios')->with('error', 'Erro ao excluir usuário.');
    }
  }

  // --- Métodos para Modais de Grupo (AJAX) ---
  /**
   * Busca grupos para o modal de seleção com paginação.
   */
  public function buscarGrupoModal()
  {
    if (!$this->request->isAJAX()) {
      return $this->response->setStatusCode(403)->setBody('Acesso negado.');
    }

    $search = $this->request->getGet('search');

    $gruposQuery = $this->grupoModel->orderBy('nome', 'ASC');

    if (!empty($search)) {
      $gruposQuery->like('nome', $search);
    }

    // Aplica o soft delete
    $gruposQuery->where('deletado_em IS NULL');

    // Remove a paginação: simplesmente pega todos os resultados
    $grupos = $gruposQuery->findAll();

    // Não precisamos mais do $page, $perPage, $pager, $currentPage
    // Mas ainda passamos $search para a view, caso você queira manter o termo de busca lá.
    $data = [
      'grupos'      => $grupos,
      'search'      => $search,
    ];

    // Retorna a view parcial do modal
    return view('usuarios/_grupo_selecao_modal_content', $data);
  }

  public function salvarNovoGrupoAjax()
  {
    if (!$this->request->isAJAX()) {
      return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Acesso negado.']);
    }

    $rules = [
      'nome'      => 'required|min_length[3]|max_length[100]|is_unique[tbl_grupos_usuarios.nome]',
    ];

    if (!$this->validate($rules, $this->grupoModel->validationMessages)) {
      return $this->response->setStatusCode(400)->setJSON([
        'status' => 'error',
        'message' => 'Erro de validação',
        'errors' => $this->validator->getErrors()
      ]);
    }

    $grupo = new GrupoUsuario($this->request->getPost());

    if ($this->grupoModel->save($grupo)) {
      return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Grupo criado com sucesso!',
        'grupo' => [
          'id'   => $grupo->id,
          'nome' => $grupo->nome
        ]
      ]);
    } else {
      return $this->response->setStatusCode(500)->setJSON([
        'status' => 'error',
        'message' => 'Não foi possível salvar o grupo.',
        'errors' => $this->grupoModel->errors()
      ]);
    }
  }


  /**
   * Exclui (soft delete) um grupo via AJAX.
   */
  public function excluirGrupoAjax($id = null)
  {
    if (!$this->request->isAJAX()) {
      return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Acesso negado.']);
    }

    if ($id === null) {
      return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'ID do grupo não fornecido.']);
    }

    $grupo = $this->grupoModel->find($id);

    if (!$grupo) {
      return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Grupo não encontrado.']);
    }

    // Verifica se o grupo está associado a algum usuário ativo
    $usuariosAtivosComGrupo = $this->usuarioModel->where('grupo_usuario_id', $id)
      ->where('ativo', 'Sim')
      ->where('deletado_em IS NULL') // Considera apenas usuários não deletados
      ->countAllResults();

    if ($usuariosAtivosComGrupo > 0) {
      return $this->response->setStatusCode(409)->setJSON([
        'status' => 'error',
        'message' => 'Não é possível excluir este grupo, pois existem usuários ativos associados a ele.'
      ]);
    }

    if ($this->grupoModel->delete($id)) {
      return $this->response->setJSON(['status' => 'success', 'message' => 'Grupo excluído com sucesso!']);
    } else {
      return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Erro ao excluir o grupo.']);
    }
  }
}
