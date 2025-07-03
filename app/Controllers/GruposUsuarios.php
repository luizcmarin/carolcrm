<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GrupoUsuarioModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GruposUsuarios extends BaseController
{
  protected $grupoUsuarioModel;

  public function __construct()
  {
    $this->grupoUsuarioModel = new GrupoUsuarioModel();
  }

  // Listar todos os grupos
  public function index()
  {
    $perPageLimit = 10; // Mantenha o mesmo limite de itens por página usado no paginate()

    // Aplica a paginação e obtém os resultados
    $grupos = $this->grupoUsuarioModel->orderBy('nome', 'asc')->paginate($perPageLimit);

    $pager = $this->grupoUsuarioModel->pager; // Pega a instância do Pager

    $totalRecords = 0;
    $currentPage = 1;
    $perPage = $perPageLimit; // Valor padrão, caso não consiga do pager

    // Tenta obter as informações usando os métodos públicos do Pager
    // Isso deve funcionar no Controller, onde o objeto Pager é manipulado pelo modelo
    if ($pager) {
      try {
        $totalRecords = $pager->getTotal();
        $currentPage  = $pager->getCurrentPage();
        $perPage      = $pager->getPerPage();
      } catch (\Exception $e) {
        // Se por algum motivo os métodos getTotal/getCurrentPage/getPerPage não existirem ou falharem aqui,
        // você pode inspecionar o log para entender o que aconteceu.
        // Isso seria um cenário muito incomum para um CI4 padrão.
        log_message('error', 'Erro ao acessar métodos do Pager no Controller: ' . $e->getMessage());
        // Fallback para valores padrão caso a leitura do pager falhe
        $totalRecords = count($grupos); // Uma estimativa se o total real não puder ser obtido
      }
    }

    // Calcula o primeiro e último item exibido na página atual
    $firstItem = ($currentPage - 1) * $perPage + 1;
    $lastItem = min($currentPage * $perPage, $totalRecords);

    $data = [
      'titulo'  => 'Gerenciar Grupos de Usuários',
      'grupos' => $this->grupoUsuarioModel->orderBy('nome', 'asc')->paginate(10),
      'pager'  => $this->grupoUsuarioModel->pager,
      // Passa as informações de paginação calculadas diretamente para a view
      'totalRecords' => $totalRecords,
      'firstItem'    => $firstItem,
      'lastItem'     => $lastItem,

    ];

    return view('grupos_usuarios/index', $data);
  }

  // Exibir formulário para incluir novo grupo
  public function incluir()
  {
    $data = [
      'titulo' => 'Adicionar Novo Grupo',
    ];

    return view('grupos_usuarios/incluir', $data);
  }

  // Processar a criação de um novo grupo
  public function criar()
  {
    $rules = [
      'nome' => [
        'label'  => 'Nome',
        'rules'  => "required|min_length[3]|max_length[100]|is_unique[tbl_grupos_usuarios.nome]",
        'errors' => [
          'required'   => 'O campo {field} é obrigatório.',
          'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres.',
          'max_length' => 'O campo {field} deve ter no máximo 100 caracteres.',
          'is_unique'  => 'Este {field} de grupo já existe.',
        ],
      ],
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
      'nome' => $this->request->getPost('nome'),
    ];

    $this->grupoUsuarioModel->insert($data);
    return redirect()->to(site_url('gruposusuarios'))->with('sucesso', 'Grupo adicionado com sucesso!');
  }

  // Exibir detalhes de um grupo (somente leitura)
  public function ver($id = null)
  {
    if ($id === null || !$grupo = $this->grupoUsuarioModel->find($id)) {
      throw new PageNotFoundException('Grupo de usuário não encontrado.');
    }

    $data = [
      'titulo' => 'Detalhes do Grupo',
      'grupo'  => $grupo,
    ];

    return view('grupos_usuarios/ver', $data);
  }

  // Exibir formulário para editar um grupo existente
  public function editar($id = null)
  {
    if ($id === null || !$grupo = $this->grupoUsuarioModel->find($id)) {
      throw new PageNotFoundException('Grupo de usuário não encontrado.');
    }

    $data = [
      'titulo' => 'Editar Grupo de Usuário',
      'grupo'  => $grupo,
    ];

    return view('grupos_usuarios/editar', $data);
  }

  // Processar a atualização de um grupo
  public function atualizar($id = null)
  {
    if ($id === null || !$this->grupoUsuarioModel->find($id)) {
      throw new PageNotFoundException('Grupo de usuário não encontrado para atualização.');
    }

    $rules = [
      'nome' => [
        'label'  => 'Nome',
        'rules'  => "required|min_length[3]|max_length[100]|is_unique[tbl_grupos_usuarios.nome,id,{$id}]",
        'errors' => [
          'required'   => 'O campo {field} é obrigatório.',
          'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres.',
          'max_length' => 'O campo {field} deve ter no máximo 100 caracteres.',
          'is_unique'  => 'Este {field} de grupo já existe.',
        ],
      ],
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
      'nome' => $this->request->getPost('nome'),
    ];

    $this->grupoUsuarioModel->update($id, $data);
    return redirect()->to(site_url('gruposusuarios'))->with('sucesso', 'Grupo atualizado com sucesso!');
  }

  // Excluir um grupo
  public function excluir($id = null)
  {
    if ($id === null || !$this->grupoUsuarioModel->find($id)) {
      throw new PageNotFoundException('Grupo de usuário não encontrado para exclusão.');
    }

    // --- ATENÇÃO: VERIFICAÇÃO DE CHAVE ESTRANGEIRA NECESSÁRIA AQUI ---
    // Conforme discutido anteriormente, com ON DELETE RESTRICT, você PRECISA verificar
    // se há usuários associados a este grupo antes de tentar excluí-lo.
    // Se houver, a exclusão falhará no banco de dados.
    // Ex:
    // $usuarioModel = new \App\Models\UsuarioModel(); // Ajuste o namespace quando criar
    // if ($usuarioModel->where('grupo_usuario_id', $id)->countAllResults() > 0) {
    //     return redirect()->to(site_url('gruposusuarios'))->with('erro', 'Não é possível excluir o grupo: existem usuários associados a ele.');
    // }

    $this->grupoUsuarioModel->delete($id);
    return redirect()->to(site_url('gruposusuarios'))->with('sucesso', 'Grupo excluído com sucesso!');
  }
}
