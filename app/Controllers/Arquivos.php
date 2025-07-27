<?php

namespace App\Controllers;

use App\Entities\Arquivo;
use App\Models\ArquivosModel;
use App\Models\UsuariosModel;
use CodeIgniter\Images\Image;
use App\Models\LogAtividadesModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Database\Exceptions\DataException;

class Arquivos extends BaseController
{
  use ResponseTrait;

  protected $titulo;
  protected $logAtividadesModel;
  protected $usuariosModel;
  protected $model;
  protected $db;
  protected $searchableFields = [
    'nome',
    'descricao',
  ];

  public function __construct()
  {
    $this->titulo = 'Tabela->Arquivos';
    $this->model = new ArquivosModel();
    $this->logAtividadesModel = new LogAtividadesModel();
    $this->usuariosModel = new UsuariosModel();

    $this->db = \Config\Database::connect();
  }

  /**
   * Exibe a lista de todos os registros.
   *
   * @return string|ResponseInterface
   */
  public function index(): string|ResponseInterface
  {
    if (!$this->Carol->pode('ARQUIVOS.INDEX')) {
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

    $query->orderBy('nome_arquivo', 'ASC');

    $perPage = 12;

    $registros = $query->paginate($perPage);
    $pager = $this->model->pager;

    $currentPage = $pager->getCurrentPage();
    $totalRecords = $pager->getTotal();

    $firstItem = (($currentPage - 1) * $perPage) + 1;
    $lastItem = min($currentPage * $perPage, $totalRecords);

    foreach ($registros as $registro) {
      $filePath = WRITEPATH . $registro->caminho_servidor;
      $thumbPath = WRITEPATH . 'uploads/thumbs/thumb_' . $registro->nome_arquivo;

      // Adiciona uma propriedade para indicar se o arquivo original existe
      $registro->file_exists = file_exists($filePath);

      // Adiciona uma propriedade para indicar se a miniatura existe (e se é uma imagem)
      $registro->thumbnail_exists = str_starts_with($registro->tipo_arquivo, 'image/') && file_exists($thumbPath);
    }

    $data = [
      'titulo'       => $this->titulo,
      'registros'    => $registros,
      'search'       => $search,
      'pager'        => $pager,
      'firstItem'    => $firstItem,
      'lastItem'     => $lastItem,
      'totalRecords' => $totalRecords,
    ];

    return view('arquivos/index', $data);
  }

  /**
   * Exibe o formulário para criação.
   *
   * @return string|ResponseInterface
   */
  public function new(): string|ResponseInterface
  {
    if (!$this->Carol->pode('ARQUIVOS.NOVO')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $data = [
      'titulo' => $this->titulo,
    ];

    return view('arquivos/new', $data);
  }

  /**
   * Salva um novo registro.
   *
   * @return string|ResponseInterface
   */
  public function create(): string|ResponseInterface
  {
    if (!$this->Carol->pode('ARQUIVOS.NOVO')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $postData = $this->request->getPost();

    $registro = new Arquivo();
    $registro->fill($postData);

    if ($this->model->save($registro)) {
      $insertedId = $this->model->insertID();
      if (is_array($registro)) {
        $registro['id'] = $insertedId;
      } else {
        $registro->id = $insertedId;
      }
      $this->logAtividadesModel->addLog('Arquivos: novo registro [' . $registro->id . ' - ' . $registro->nome . ']');
      return redirect()->to('/arquivos')->with('success', 'Registro criado com sucesso!');
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
    if (!$this->Carol->pode('ARQUIVOS.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registro = $this->model->find($id);

    if (!$registro) {
      return redirect()->to('/arquivos')->with('error', 'Registro não encontrado.');
    }

    $data = [
      'titulo' => $this->titulo,
      'registro' => $registro,
    ];

    return view('arquivos/edit', $data);
  }

  /**
   * Atualiza um registro existente no banco de dados.
   *
   * @param int $id O ID do registro.
   * @return string|ResponseInterface
   */
  public function update(int $id): string|ResponseInterface
  {
    if (!$this->Carol->pode('ARQUIVOS.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registro = $this->model->find($id);
    if (!$registro) {
      return redirect()->to('/arquivos')->with('error', 'Registro não encontrado.');
    }

    $postData = $this->request->getPost();
    $registro->fill($postData);

    try {
      if ($this->model->save($registro)) {
        $this->logAtividadesModel->addLog('Arquivos: registro atualizado [' . $id . '-' . $registro->nome . ']');
        return redirect()->to('/arquivos')->with('success', 'Registro atualizado com sucesso!');
      } else {
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
      }
    } catch (DataException $e) {
      return redirect()->to('/arquivos')->with('info', 'Nenhuma alteração detectada para o registro.');
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
    if (!$this->Carol->pode('ARQUIVOS.VER')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $registro = $this->model->find($id);

    $filePath = WRITEPATH . $registro->caminho_servidor;
    $thumbPath = WRITEPATH . 'uploads/thumbs/thumb_' . $registro->nome_arquivo;

    // Adiciona uma propriedade para indicar se o arquivo original existe
    $registro->file_exists = file_exists($filePath);

    // Adiciona uma propriedade para indicar se a miniatura existe (e se é uma imagem)
    $registro->thumbnail_exists = str_starts_with($registro->tipo_arquivo, 'image/') && file_exists($thumbPath);

    if (!$registro) {
      return redirect()->to('/arquivos')->with('error', 'Registro não encontrado.');
    }

    $data = [
      'titulo' => $this->titulo,
      'registro' => $registro,
    ];
    return view('arquivos/show', $data);
  }

  /**
   * Lida com o upload de arquivos via AJAX.
   * Recebe o arquivo via POST, valida, move para writable/uploads/,
   * e salva os metadados na tabela 'arquivos'.
   * Também gera miniatura para imagens.
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function upload()
  {
    if (!$this->Carol->pode('ARQUIVOS.UPLOAD')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $validationRule = [
      'image' => [ // Nome do campo 'name' do input file no HTML/JS
        'label' => 'Arquivo',
        'rules' => 'uploaded[image]|max_size[image,2048]',
        'errors' => [
          'uploaded' => 'Por favor, selecione um arquivo para upload.',
          'max_size' => 'O arquivo é muito grande (máx. MB).',
        ],
      ],
    ];

    // Valida o request. Se falhar, retorna JSON de erro.
    if (!$this->validate($validationRule)) {
      return $this->failValidationErrors($this->validator->getErrors());
    }

    $file = $this->request->getFile('image');

    if (!$file || !$file->isValid()) {
      return $this->fail('Nenhum arquivo enviado ou arquivo inválido. Código de erro: ' . $file->getErrorString(), 400);
    }

    // --- sanitização do nome do arquivo original
    $originalName = $file->getClientName();
    $originalName = strip_tags($originalName);
    $originalName = preg_replace('/[\x00-\x1F\x7F]/u', '', $originalName);
    $originalName = substr($originalName, 0, 255);
    $newName = $file->getRandomName();
    $uploadPath = WRITEPATH . 'uploads/arquivos/';
    $thumbPath = WRITEPATH . 'uploads/thumbs/';

    $this->db->transBegin();

    try {
      // Cria os diretórios se não existirem
      if (!is_dir($uploadPath)) {
        if (!mkdir($uploadPath, 0777, true)) {
          throw new \Exception('Não foi possível criar o diretório de upload de arquivos.');
        }
      }
      if (!is_dir($thumbPath)) {
        if (!mkdir($thumbPath, 0777, true)) {
          throw new \Exception('Não foi possível criar o diretório de miniaturas.');
        }
      }

      // Move o arquivo para o diretório de destino
      if (!$file->move($uploadPath, $newName)) {
        throw new \Exception('Falha ao mover o arquivo. Verifique as permissões do diretório /uploads/arquivos/.');
      }

      // Validação do tipo mime
      $movedFilePath = $uploadPath . $newName;
      $mimeType = mime_content_type($movedFilePath);

      $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/plain'
      ];

      if (!in_array($mimeType, $allowedMimeTypes)) {
        // Exclui o arquivo inválido imediatamente e retorna erro json
        if (file_exists($movedFilePath)) {
          unlink($movedFilePath);
        }
        $this->db->transRollback();
        return $this->fail('Formato de arquivo não permitido: ' . $mimeType, 400);
      }


      $data = [
        'nome_original'    => $originalName,
        'nome_arquivo'     => $newName,
        'tipo_arquivo'     => $mimeType,
        'tamanho_bytes'    => $file->getSize(),
        'caminho_servidor' => 'uploads/arquivos/' . $newName,
        'url_publica'      => '',
        'descricao'        => $this->request->getPost('descricao') ?? null,
        'entidade_tipo'    => $this->request->getPost('entidade_tipo') ?? null,
        'entidade_id'      => $this->request->getPost('entidade_id') ?? null,
        'sn_visivel_cliente' => 'Não',
      ];

      $this->model->insert($data);
      $insertedId = $this->model->getInsertID();

      $publicUrl = base_url('arquivos/download/' . $insertedId);
      $this->model->update($insertedId, ['url_publica' => $publicUrl]);

      // Geração de miniatura para imagens (baseado no tipo MIME verificado)
      if (str_starts_with($mimeType, 'image/')) {
        try {
          service('image')
            ->withFile($movedFilePath)
            ->fit(100, 100, 'center')
            ->save($thumbPath . 'thumb_' . $newName);
        } catch (\Throwable $e) {
          // Mantido log_message para erros de geração de miniatura, pois não impedem o upload principal.
          // Isso é útil para depuração de problemas específicos de imagem.
          log_message('error', 'Erro ao gerar miniatura para ' . $newName . ': ' . $e->getMessage());
        }
      }

      $this->db->transCommit();

      return $this->respondCreated([
        'status' => 201,
        'message' => 'Arquivo enviado e registrado com sucesso!',
        'data' => array_merge($data, ['id' => $insertedId, 'url_publica' => $publicUrl])
      ]);
    } catch (\Exception $e) {
      $this->db->transRollback();
      // Tenta remover o arquivo original e a miniatura se foram criados antes do erro
      if (file_exists($uploadPath . $newName)) {
        unlink($uploadPath . $newName);
      }
      if (file_exists($thumbPath . 'thumb_' . $newName)) {
        unlink($thumbPath . 'thumb_' . $newName);
      }
      // log_message para erros críticos de upload que levam ao rollback.
      log_message('error', 'Erro no upload (exceção): ' . $e->getMessage());
      return $this->failServerError($e->getMessage());
    }
  }

  /**
   * Endpoint AJAX para remover a imagem de perfil de um usuário.
   * Desvincula a imagem do usuário e, se for a última referência, exclui o arquivo.
   *
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function removeUserImage()
  {
    if (!$this->Carol->pode('ARQUIVOS.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $userId = $this->request->getPost('user_id');
    $imageId = $this->request->getPost('image_id');

    if (empty($userId) || empty($imageId)) {
      return $this->fail('ID do usuário ou da imagem não fornecido.', 400);
    }

    $this->db->transBegin();

    try {
      // 1. Desvincular a imagem do usuário (setar imagem_id para NULL)
      if (!$this->usuariosModel->setImagemPerfil($userId, null)) {
        throw new \Exception('Falha ao desvincular a imagem do usuário.');
      }

      // 2. Tentar excluir o arquivo físico e o registro na tabela 'arquivos'
      // A lógica de 'deleteArquivoAndRecord' já verifica se o arquivo está referenciado por outros usuários/entidades.
      $fileDeleted = $this->deleteArquivoAndRecord($imageId);

      $this->db->transCommit();
      return $this->respond([
        'status' => 200,
        'message' => 'Imagem de perfil removida com sucesso.',
        'file_deleted' => $fileDeleted // Indica se o arquivo físico foi realmente excluído
      ]);
    } catch (\Exception $e) {
      $this->db->transRollback();
      return $this->failServerError($e->getMessage());
    }
  }

  /**
   * Exclui um arquivo temporário que foi carregado mas não associado a uma entidade.
   * Usado para cenários de cancelamento de inclusão de registro.
   *
   * @return \CodeIgniter\HTTP\ResponseInterface
   */
  public function deleteTemporaryImage()
  {
    if (!$this->Carol->pode('ARQUIVOS.EDITAR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    $imageId = $this->request->getPost('image_id');

    if (empty($imageId)) {
      return $this->fail('ID da imagem temporária não fornecido.', 400);
    }

    $this->db->transBegin();

    try {
      // Primeiro, garantir que esta imagem NÃO ESTÁ referenciada por NINGUÉM
      // (especialmente por usuários ou outras entidades).
      // Se estiver, significa que não é mais "temporária" ou houve um erro.
      if ($this->usuariosModel->isArquivoReferenciado($imageId)) {
        $this->db->transRollback();
        return $this->fail('Não é possível excluir a imagem: ela já está sendo referenciada por um usuário.', 400);
      }
      // TODO: Adicione verificações para outras tabelas que possam referenciar 'arquivos' aqui.

      // Se não houver referências, procede com a exclusão física e do registro
      $fileDeleted = $this->deleteArquivoAndRecord($imageId);

      $this->db->transCommit();
      return $this->respond([
        'status' => 200,
        'message' => 'Imagem temporária excluída com sucesso.',
        'file_deleted' => $fileDeleted
      ]);
    } catch (\Exception $e) {
      $this->db->transRollback();
      return $this->failServerError($e->getMessage());
    }
  }

  /**
   * Método auxiliar para encapsular a lógica de exclusão de arquivo e registro.
   * Este método agora desvincula a imagem de *todos* os usuários que a referenciam
   * antes de decidir se o arquivo físico e seu registro devem ser excluídos.
   *
   * @param int $id O ID do arquivo na tabela 'arquivos'.
   * @return bool True se o arquivo foi excluído fisicamente e do registro, False se ainda referenciado e não excluído.
   * @throws \Exception Em caso de erro na exclusão física.
   */
  public function deleteArquivoAndRecord($id): bool
  {
    $file = $this->model->find($id);

    if (!$file) {
      // Se o registro não existe, consideramos que o arquivo já não está lá
      return false;
    }

    $filePath = WRITEPATH . $file->caminho_servidor;
    $thumbFilePath = WRITEPATH . 'uploads/thumbs/thumb_' . $file->nome_arquivo;

    $this->db->transBegin();

    try {
      // 1. DESVINCULAR IMAGEM DE TODOS OS USUÁRIOS QUE A REFERENCIAM
      // Isso garante que, se alguém excluir um arquivo diretamente, os usuários não fiquem com imagem_id inválido.
      $usersToUnlink = $this->usuariosModel->where('imagem_id', $id)->findAll();
      foreach ($usersToUnlink as $user) {
        $this->usuariosModel->setImagemPerfil($user['id'], null); // Seta imagem_id para NULL
      }

      // 2. VERIFICAÇÃO DE REFERÊNCIAS:
      // Agora, verifica se o arquivo ainda está referenciado por *qualquer* entidade
      // (após desvincular dos usuários).
      if ($this->usuariosModel->isArquivoReferenciado($id)) {
        // Se ainda houver referências (de outros usuários que talvez não foram desvinculados,
        // ou de outras tabelas que referenciam 'arquivos'), não exclua o arquivo físico nem o registro.
        $this->db->transRollback(); // Reverte a desvinculação se o arquivo não for excluído
        return false; // Arquivo ainda referenciado, não será excluído fisicamente
      }
      // TODO: Adicione verificações para outras tabelas que possam referenciar 'arquivos' aqui.


      // 3. Tenta remover o arquivo físico
      if (file_exists($filePath)) {
        if (!unlink($filePath)) {
          throw new \Exception('Erro ao excluir o arquivo físico.');
        }
      }

      // 4. Tenta remover a miniatura, se existir
      if (file_exists($thumbFilePath)) {
        if (!unlink($thumbFilePath)) {
          log_message('error', 'Erro ao excluir a miniatura para ' .  $file->nome_arquivo);
        }
      }

      // 5. Remove o registro do banco de dados
      $this->model->delete($id);

      $this->db->transCommit();

      return true; // Arquivo físico e registro excluídos

    } catch (\Exception $e) {
      $this->db->transRollback();
      // Se ocorreu um erro na exclusão física, garante que o arquivo não foi removido do DB
      log_message('error', 'Erro em deleteArquivoAndRecord: ' . $e->getMessage());
      throw $e; // Relança a exceção para o chamador
    }
  }

  /**
   * Permite o download de um arquivo.
   * @param int $id O ID do arquivo no banco de dados.
   * @return \CodeIgniter\HTTP\DownloadResponse
   */
  public function download(int $id)
  {
    if (!$this->Carol->pode('ARQUIVOS.DOWNLOAD')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    try {
      $arquivo = $this->model->find($id);

      if (is_null($arquivo)) {
        return $this->response->setStatusCode(404)->setBody('Arquivo não encontrado.');
      }

      $filePath = WRITEPATH . $arquivo->caminho_servidor;

      if (!file_exists($filePath)) {
        return $this->response->setStatusCode(404)->setBody('Arquivo não encontrado no sistema de arquivos.');
      }

      // Força o download do arquivo
      return $this->response->download($filePath, null, true)->setFileName($arquivo->nome_original);
    } catch (\Throwable $e) {
      return $this->response->setStatusCode(500)->setBody('Erro interno ao processar download.');
    }
  }

  /**
   * Serve a miniatura de um arquivo de imagem pelo seu ID.
   * @param int $id O ID do arquivo na tabela 'arquivos'.
   * @return \CodeIgniter\HTTP\ResponseInterface|\CodeIgniter\HTTP\RedirectResponse
   */
  public function serveThumbnail($id)
  {
    if (!$this->Carol->pode('ARQUIVOS.VER')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    try {
      $arquivo = $this->model->find($id);

      if (is_null($arquivo)) {
        return $this->response->setStatusCode(404)
          ->setContentType('image/gif')
          ->setBody(SEM_IMAGEM);
      }

      // Garante que o tipo de arquivo é uma imagem antes de tentar servir como miniatura
      if (!str_starts_with($arquivo->tipo_arquivo, 'image/')) {
        return $this->response->setStatusCode(400)->setBody('Este arquivo não é uma imagem.');
      }

      $thumbPath = WRITEPATH . 'uploads/thumbs/thumb_' . $arquivo->nome_arquivo;

      if (!file_exists($thumbPath)) {
        return $this->response->setStatusCode(404)
          ->setContentType('image/gif')
          ->setBody(SEM_IMAGEM);
      }

      return $this->response->setContentType($arquivo->tipo_arquivo)
        ->setBody(file_get_contents($thumbPath));
    } catch (\Throwable $e) {
      return $this->response->setStatusCode(500)
        ->setContentType('image/gif')
        ->setBody(SEM_IMAGEM);
    }
  }

  /**
   * Endpoint para exclusão de arquivo via GET (usado na listagem de arquivos).
   * Este método agora chama o método auxiliar `deleteArquivoAndRecord`.
   *
   * @param int $id O ID do arquivo na tabela 'arquivos'.
   * @return \CodeIgniter\HTTP\RedirectResponse
   */
  public function delete($id)
  {
    if (!$this->Carol->pode('ARQUIVOS.EXCLUIR')) {
      return redirect()->to(site_url())->with('error', 'Acesso negado.');
    }

    try {
      $deleted = $this->deleteArquivoAndRecord($id);
      if ($deleted) {
        return redirect()->to(base_url('arquivos'))->with('success', 'Arquivo e registro excluídos com sucesso!');
      } else {
        return redirect()->to(base_url('arquivos'))->with('error', 'Arquivo ainda referenciado e não pôde ser excluído fisicamente.');
      }
    } catch (\Exception $e) {
      return redirect()->to(base_url('arquivos'))->with('error', $e->getMessage());
    }
  }
}
