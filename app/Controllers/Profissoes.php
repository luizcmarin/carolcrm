<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogAtividadesModel;
use App\Models\ProfissoesModel;
use App\Entities\Profissao;
use CodeIgniter\HTTP\ResponseInterface;

class Profissoes extends BaseController
{
    protected $titulo; 
    protected $logAtividadesModel;
    protected $model;   
    protected $searchableFields = [
        'nome',
    ];

    public function __construct()
    {
        $this->titulo = 'Tabela->Profissoes';
        $this->model = new ProfissoesModel();
        $this->logAtividadesModel = new LogAtividadesModel();
    }

    /**
     * Exibe a lista de todos os registros.
     *
     * @return string|ResponseInterface
     */
    public function index(): string|ResponseInterface
    { 
      if (!$this->Carol->pode('PROFISSOES.INDEX')) {
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

      return view('profissoes/index', $data);
    }

    /**
     * Exibe o formulário para criação.
     *
     * @return string|ResponseInterface
     */
    public function new(): string|ResponseInterface
    {
      if (!$this->Carol->pode('PROFISSOES.NOVO')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        $data = [
            'titulo' => 'Tabela->Profissoes',
        ];

        // carrega dados relacionados
        // $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('profissoes/new', $data);
    }

    /**
     * Salva um novo registro.
     *
     * @return string|ResponseInterface
     */
    public function create(): string|ResponseInterface
    {
      if (!$this->Carol->pode('PROFISSOES.NOVO')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        $postData = $this->request->getPost();

        $registro = new Profissao();
        $registro->fill($postData);

        if ($this->model->save($registro)) {
            $this->logAtividadesModel->addLog('Profissoes: novo registro [' . $registro->id . ' - ' . $registro->nome . ']');
            return redirect()->to('/profissoes')->with('success', 'Registro criado com sucesso!');
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
      if (!$this->Carol->pode('PROFISSOES.EDITAR')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        $registros = $this->model->find($id);

        if (!$registros) {
            return redirect()->to('/profissoes')->with('error', 'Registro não encontrado.');
        }

        $data = [
            'titulo' => $this->titulo,
            'registros' => $registros,
        ];
        
        // carrega dados relacionados
        // $data['tabela_options'] = $this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('profissoes/edit', $data);
    }

    /**
     * Atualiza um registro existente no banco de dados.
     *
     * @param int $id O ID do registro.
     * @return string|ResponseInterface
     */
    public function update(int $id): string|ResponseInterface
    {
      if (!$this->Carol->pode('PROFISSOES.EDITAR')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        $registros = $this->model->find($id);
        if (!$registros) {
            return redirect()->to('/profissoes')->with('error', 'Registro não encontrado.');
        }

        $postData = $this->request->getPost();

        // Lógica para campos 'sn_'
        if (!isset($postData['sn_ativo'])) {
          $postData['sn_ativo'] = 'Não';
        }

        $registros->fill($postData);

        if ($this->model->save($registros)) {
            $this->logAtividadesModel->addLog('Profissoes: registro atualizado [' . $id . '-' . $registro->nome . ']');
            return redirect()->to('/profissoes')->with('success', 'Registro atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
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
      if (!$this->Carol->pode('PROFISSOES.VER')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        $registros = $this->model->find($id);

        if (!$registros) {
            return redirect()->to('/profissoes')->with('error', 'Registro não encontrado.');
        }
    
        $data = [
            'titulo' => $this->titulo,
            'registros' => $registros,
        ];
        return view('profissoes/show', $data);
    }

    /**
     * Exclui um registro do banco de dados.
     *
     * @param int $id O ID do registro.
     * @return string|ResponseInterface
     */
    public function delete(int $id): string|ResponseInterface
    {
      if (!$this->Carol->pode('PROFISSOES.EXCLUIR')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

      $nome = $this->model->getCampo('nome', ['id' => $id]);

        if ($this->model->delete($id)) {
            $this->logAtividadesModel->addLog('Profissoes: registro excluído [' . $id . '-' . $nome . ']');
            return redirect()->to('/profissoes')->with('success', 'Registro excluído com sucesso!');
        } else {
            $errors = $this->model->errors();
            $message = !empty($errors) ? implode('<br>', $errors) : 'Erro ao excluir o registro. Verifique os logs.';
            return redirect()->back()->with('error', $message);
        }
    }
  }