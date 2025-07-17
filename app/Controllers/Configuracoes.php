<?php

namespace App\Controllers;

use App\Entities\Configuracao;
use App\Models\ConfiguracoesModel;
use App\Models\LogAtividadesModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DataException;

class Configuracoes extends BaseController
{
  protected $titulo;
  protected $logAtividadesModel;
  protected $model;
  protected $searchableFields = [
    'nome',
  ];

  public function __construct()
  {
    $this->titulo = 'Tabela->Configurações';
    $this->model = new ConfiguracoesModel();
    $this->logAtividadesModel = new LogAtividadesModel();
  }

  /**
   * Exibe a lista de todos os registros.
   *
   * @return string|ResponseInterface
   */
  public function index(): string|ResponseInterface
  {
    if (!$this->Carol->pode('CONFIGURACOES.INDEX')) {
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

    $query->orderBy('categoria', 'ASC');
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

    return view('configuracoes/index', $data);
  }

  /**
   * Exibe o formulário para criação.
   *
   * @return string|ResponseInterface
   */
  public function new(): string|ResponseInterface
  {
    if (!$this->Carol->pode('CONFIGURACOES.NOVO')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $data = [
      'titulo' => 'Tabela->Configuracoes',
      'tipos' => [
        'string'   => 'Texto Curto (STRING)',
        'integer'  => 'Número Inteiro (INTEGER)',
        'decimal'  => 'Número Decimal (DECIMAL/FLOAT)',
        'boolean'  => 'Verdadeiro/Falso (BOOLEAN)',
        'date'     => 'Data (DATE)',
        'datetime' => 'Data e Hora (DATETIME)',
        'time'     => 'Hora (TIME)',
        'email'    => 'E-mail (EMAIL)',
        'url'      => 'URL (URL)',
        'password' => 'Senha (PASSWORD)',
        'color'    => 'Cor (COLOR)',
        'string'   => 'Imagem (STRING)',
        'enum'     => 'Lista de Opções (ENUM)',
        'textarea' => 'Texto Longo (TEXTAREA)',
      ]
    ];

    // carrega dados relacionados
    // $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

    return view('configuracoes/new', $data);
  }

  /**
   * Salva um novo registro.
   *
   * @return string|ResponseInterface
   */
  public function create(): string|ResponseInterface
  {
    if (!$this->Carol->pode('CONFIGURACOES.NOVO')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $postData = $this->request->getPost();

    $registro = new Configuracao();
    $registro->fill($postData);

    if ($this->model->save($registro)) {
      $insertedId = $this->model->insertID();
      if (is_array($registro)) {
        $registro['id'] = $insertedId;
      } else {
        $registro->id = $insertedId;
      }
      $this->logAtividadesModel->addLog('Configurações: novo registro [' . $registro->id . ' - ' . $registro->chave . ']');
      return redirect()->to('/configuracoes')->with('success', 'Registro criado com sucesso!');
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
    if (!$this->Carol->pode('CONFIGURACOES.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registros = $this->model->find($id);

    if (!$registros) {
      return redirect()->to('/configuracoes')->with('error', 'Registro não encontrado.');
    }

    $data = [
      'titulo' => $this->titulo,
      'registros' => $registros,
      'tipos' => [
        'string'   => 'Texto Curto (STRING)',
        'integer'  => 'Número Inteiro (INTEGER)',
        'decimal'  => 'Número Decimal (DECIMAL/FLOAT)',
        'boolean'  => 'Sim/Não (BOOLEAN)',
        'date'     => 'Data (DATE)',
        'datetime' => 'Data e Hora (DATETIME)',
        'time'     => 'Hora (TIME)',
        'email'    => 'E-mail (EMAIL)',
        'url'      => 'URL (URL)',
        'password' => 'Senha (PASSWORD)',
        'color'    => 'Cor (COLOR)',
        'string'   => 'Imagem (STRING)',
        'enum'     => 'Lista de Opções (ENUM)',
        'textarea' => 'Texto Longo (TEXTAREA)',
      ]
    ];

    return view('configuracoes/edit', $data);
  }

  /**
   * Atualiza um registro existente no banco de dados.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  public function update(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('CONFIGURACOES.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registros = $this->model->find($id);
    if (!$registros) {
      return redirect()->to('/configuracoes')->with('error', 'Registro não encontrado.');
    }

    $postData = $this->request->getPost();
    $registros->fill($postData);

    try {
      if ($this->model->save($registros)) {
        $this->logAtividadesModel->addLog('Configurações: registro atualizado [' . $id . '-' . $registros->chave . ']');
        return redirect()->to('/configuracoes')->with('success', 'Registro atualizado com sucesso!');
      } else {
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
      }
    } catch (DataException $e) {
      return redirect()->to('/configuracoes')->with('info', 'Nenhuma alteração detectada para o registro.');
    } catch (\Exception $e) {
      log_message('error', 'Erro inesperado ao atualizar registro de banco: ' . $e->getMessage());
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
    if (!$this->Carol->pode('CONFIGURACOES.VER')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registros = $this->model->find($id);

    if (!$registros) {
      return redirect()->to('/configuracoes')->with('error', 'Registro não encontrado.');
    }

    $data = [
      'titulo' => $this->titulo,
      'registros' => $registros,
    ];
    return view('configuracoes/show', $data);
  }

  /**
   * Exclui um registro do banco de dados.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  public function delete(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('CONFIGURACOES.EXCLUIR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $nome = $this->model->getCampo('chave', ['id' => $id]);

    if ($this->model->delete($id)) {
      $this->logAtividadesModel->addLog('Configurações: registro excluído [' . $id . '-' . $nome . ']');
      return redirect()->to('/configuracoes')->with('success', 'Registro excluído com sucesso!');
    } else {
      $errors = $this->model->errors();
      $message = !empty($errors) ? implode('<br>', $errors) : 'Erro ao excluir o registro. Verifique os logs.';
      return redirect()->back()->with('error', $message);
    }
  }
}
