<?php

namespace App\Controllers;

use App\Entities\Usuario;
use App\Models\CargosModel;
use App\Models\CidadesModel;
use App\Models\UsuariosModel;
use App\Models\ProfissoesModel;
use App\Models\LogAtividadesModel;
use App\Models\UsuarioGruposModel;
use App\Controllers\BaseController;
use App\Models\NacionalidadesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DataException;

class Usuarios extends BaseController
{
  protected $titulo;
  protected $model;
  protected $logAtividadesModel;
  protected $nacionalidadesModel;
  protected $profissoesModel;
  protected $cargosModel;
  protected $cidadesModel;
  protected $usuarioGruposModel;
  protected $searchableFields = [
    'nome',
  ];

  public function __construct()
  {
    $this->titulo = 'Tabela->Usuários';
    $this->model = new UsuariosModel();
    $this->logAtividadesModel = new LogAtividadesModel();
    $this->nacionalidadesModel = new NacionalidadesModel();
    $this->profissoesModel = new ProfissoesModel();
    $this->cargosModel = new CargosModel();
    $this->cidadesModel = new CidadesModel();
    $this->usuarioGruposModel = new UsuarioGruposModel();
  }

  /**
   * Exibe a lista de todos os registros.
   *
   * @return string|ResponseInterface
   */
  public function index(): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.INDEX')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $search = $this->request->getVar('search');

    $query = $this->model;

    if (!empty($search)) {
      $query->groupStart();
      foreach ($this->searchableFields as $field) {
        $query->orLike($field, $search);
      }
      $query->groupEnd();
    }

    $query->orderBy('nome', 'ASC');

    $perPage = 10;

    $registros = $query->paginate($perPage);
    $pager = $this->model->pager;

    $currentPage = $pager->getCurrentPage();
    $totalRecords = $pager->getTotal();

    $firstItem = (($currentPage - 1) * $perPage) + 1;
    $lastItem = min($currentPage * $perPage, $totalRecords);

    $data = [
      'titulo'       => $this->titulo,
      'registros'    => $registros,
      'search'       => $search,
      'pager'        => $pager,
      'firstItem'    => $firstItem,
      'lastItem'     => $lastItem,
      'totalRecords' => $totalRecords,
    ];

    return view('usuarios/index', $data);
  }

  /**
   * Exibe o formulário para criação.
   *
   * @return string|ResponseInterface
   */
  public function new(): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.NOVO')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $data = [
      'titulo' => $this->titulo,
    ];

    $data['nacionalidade_options'] = $this->nacionalidadesModel->getDropdown('id', 'nome', [], 'nome', 'ASC');
    $data['profissao_options'] = $this->profissoesModel->getDropdown('id', 'nome', [], 'nome', 'ASC');
    $data['cargo_options'] = $this->cargosModel->getDropdown('id', 'nome', [], 'nome', 'ASC');
    $data['cidade_options'] = $this->cidadesModel->getDropdown('id', 'nome', [], 'nome', 'ASC');
    $data['usuario_grupo_options'] = $this->usuarioGruposModel->getDropdown('id', 'nome', [], 'nome', 'ASC');
    $data['genero_options'] = ['Masculino' => 'Masculino', 'Feminino' => 'Feminino', 'Outro' => 'Outro'];

    return view('usuarios/new', $data);
  }

  /**
   * Salva um novo registro.
   *
   * @return string|ResponseInterface
   */
  public function create(): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.NOVO')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $postData = $this->request->getPost();

    $registro = new Usuario();

    $registro->fill($postData);

    if ($this->model->save($registro)) {
      $insertedId = $this->model->insertID();
      if (is_array($registro)) {
        $registro['id'] = $insertedId;
      } else {
        $registro->id = $insertedId;
      }

      $this->logAtividadesModel->addLog('Usuários: novo registro [' . $registro->id . ' - ' . $registro->nome . ']');
      return redirect()->to('/usuarios')->with('success', 'Registro criado com sucesso!');
    } else {
      return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }
  }

  /**
   * Exibe o formulário para edição.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  public function edit(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registros = $this->model->find($id);

    if (!$registros) {
      return redirect()->to('/usuarios')->with('error', 'Registro não encontrado.');
    }

    $data = [
      'titulo' => $this->titulo,
      'registros' => $registros,
    ];

    // carrega dados relacionados
    // $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

    return view('usuarios/edit', $data);
  }

  /**
   * Atualiza um registro existente no banco de dados.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  public function update(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registros = $this->model->find($id);
    if (!$registros) {
      return redirect()->to('/usuarios')->with('error', 'Registro não encontrado.');
    }

    $postData = $this->request->getPost();
    $registros->fill($postData);

    try {
      if ($this->model->save($registros)) {
        $this->logAtividadesModel->addLog('Usuários: registro atualizado [' . $id . '-' . $registros->nome . ']');
        return redirect()->to('/usuarios')->with('success', 'Registro atualizado com sucesso!');
      } else {
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
      }
    } catch (DataException $e) {
      return redirect()->to('/usuarios')->with('info', 'Nenhuma alteração detectada para o registro.');
    } catch (\Exception $e) {
      log_message('error', 'Erro inesperado ao atualizar registro: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Ocorreu um erro inesperado ao atualizar o registro: ' . $e->getMessage());
    }
  }

  /**
   * Exibe os detalhes de um registro específico.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  public function show(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.VER')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registros = $this->model->find($id);

    if (!$registros) {
      return redirect()->to('/usuarios')->with('error', 'Registro não encontrado.');
    }

    $data = [
      'titulo' => $this->titulo,
      'registros' => $registros,
    ];

    return view('usuarios/show', $data);
  }

  /**
   * Exclui um registro do banco de dados.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  /**
   * Exclui um registro de usuário e sua imagem de perfil associada,
   * se a imagem não estiver sendo referenciada por outros.
   *
   * @param int $id O ID do usuário a ser excluído.
   * @return string|ResponseInterface
   */
  public function delete(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('USUARIOS.EXCLUIR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    // 2. Obtém o nome do usuário para o log antes da exclusão
    $nome = $this->model->getCampo('nome', ['id' => $id]);

    // 3. Chama o método do modelo que lida com a exclusão do usuário E da imagem
    if ($this->model->deleteUserAndAssociatedImage($id)) {
      $this->logAtividadesModel->addLog('Usuários: registro excluído [' . $id . '-' . $nome . ']');
      return redirect()->to('/usuarios')->with('success', 'Registro excluído com sucesso!');
    } else {
      $message = session()->getFlashdata('error') ?? 'Erro ao excluir o registro. Verifique os logs.';
      return redirect()->back()->with('error', $message);
    }
  }
}
