<?php

namespace App\Controllers;

use PDO;
use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use App\Libraries\SqlScriptParser;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Database\Config as DatabaseConfig;
use CodeIgniter\HTTP\ResponseInterface;

class Install extends Controller
{
  /**
   * @var array
   */
  protected $data = [];

  /**
   * @var string Caminho para o arquivo SQL do banco de dados.
   */
  protected $databaseFile = APPPATH . 'Database/Install/CarolCRM.sql';

  /**
   * @var string Caminho para o arquivo de configuração principal da aplicação.
   */
  // protected $configFile = APPPATH . 'Config/app-config.php';

  /**
   * Define a estrutura dos passos do instalador para a barra de progresso.
   */
  protected $steps = [
    1 => ['id' => 1, 'name' => 'Server Requirements', 'status' => 'upcoming'],
    2 => ['id' => 2, 'name' => 'File Permissions', 'status' => 'upcoming'],
    3 => ['id' => 3, 'name' => 'Database Setup', 'status' => 'upcoming'],
    4 => ['id' => 4, 'name' => 'Admin Login & Settings', 'status' => 'upcoming'],
    5 => ['id' => 5, 'name' => 'Finish', 'status' => 'upcoming'],
  ];

  /**
   * Construtor do Controller.
   * Realiza verificações iniciais e carrega helpers.
   */
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);

    helper('form'); // Carrega o helper de formulário para set_value() e set_select()

    // Verifica se a aplicação já foi instalada (se o arquivo de configuração existe)
    // if (file_exists($this->configFile)) {
    //   // Em vez de 'echo view', idealmente redirecionar para a URL base do site.
    //   // Para o instalador, um view simples indicando que já está instalado é suficiente.
    //   echo view('install/already_installed');
    //   exit();
    // }


    // --- INICIALIZAÇÃO GARANTIDA DE DADOS ESSENCIAIS ---
    $this->data['current_step'] = (int) $this->request->getPost('step') ?: 1;
    $this->data['page'] = $this->getPageNameForStep($this->data['current_step']); // Garante que 'page' sempre existe
    $this->data['base_url'] = $this->guess_base_url();
    $this->data['steps'] = $this->steps;
    // --- FIM DA INICIALIZAÇÃO GARANTIDA ---
    // Inicializa o array de passos para a view. Será atualizado na lógica principal.
    $this->data['steps'] = $this->steps;
  }

  /**
   * Lida com o processo de instalação passo a passo.
   * Esta é a função principal que controla o fluxo.
   */
  public function index()
  {
    $action = $this->request->getPost('action'); // Pega o valor do input 'action' se existir, senão é null

    $currentStepData = []; // Para armazenar resultados da etapa processada

    // Verifica se a requisição é um POST (envio de formulário de alguma etapa)
    if ($this->request->getMethod() === 'POST') {
      $postedStep = (int) $this->request->getPost('step');
      log_message('debug', 'Processing POST for step: ' . $postedStep);

      switch ($postedStep) {
        case 1: // Requisitos do Servidor - Se passou, vá para permissões de arquivo
          $serverRequirementsResult = $this->checkRequirements();
          if ($serverRequirementsResult['error'] === false) {
            $this->data['current_step'] = 2; // Avanca para a próxima etapa
            $this->data['page'] = 'file_permissions';
            // IMPORTANTE: Agora que estamos na etapa 2, precisamos obter os dados para a etapa 2!
            $currentStepData = $this->checkFilePermissions(); // CHAMA A FUNÇÃO CORRETA AQUI!
          } else {
            // Permanece na etapa 1 se os requisitos do servidor não foram atendidos
            $this->data['current_step'] = 1;
            $this->data['page'] = 'requirements';
            $currentStepData = $this->checkRequirements(); // Obtém os dados da etapa 1 novamente
          }
          log_message('debug', 'After POST case 1 - Next Step: ' . $this->data['current_step'] . ', Next Page: ' . $this->data['page']);
          break;


        // print_r(($this->data));
        // print_r($this->request->getMethod());
        // // print_r($this->request->getMethod() === 'post');
        // print_r($this->request->getMethod() === 'POST');
        // exit(); 

        // Lógica para processar o formulário POST (avançar etapa)

        case 2: // Permissões de Arquivo - Se passou, vá para configuração do banco de dados
          $filePermissionsResult = $this->checkFilePermissions();
          if ($filePermissionsResult['error'] === false) {
            $this->data['current_step'] = 3;
            $this->data['page'] = 'database_setup';
            $currentStepData = []; // Não há dados iniciais complexos para Database Setup
          } else {
            $this->data['current_step'] = 2;
            $this->data['page'] = 'file_permissions';
            $currentStepData = $this->checkFilePermissions(); // Obtém os dados da etapa 2 novamente
          }
          log_message('debug', 'After POST case 2 - Next Step: ' . $this->data['current_step'] . ', Next Page: ' . $this->data['page']);
          break;


        case 3: // Configuração do Banco de Dados (POST: apenas avança)
          $this->data['current_step'] = 4;
          $this->data['page'] = 'install';
          $currentStepData['timezone'] = 'America/Sao_Paulo';

          break;


        case 4: // Formulário da Etapa 4 (Admin Login) foi enviado
          // Passa todos os dados necessários para o performInstallation
          $selectedTimezone = $this->request->getPost('timezone') ?? 'America/Sao_Paulo';

          $currentStepData = $this->performInstallation(
            $this->request->getPost('firstname'),
            $this->request->getPost('lastname'),
            $this->request->getPost('admin_email'),
            $this->request->getPost('admin_password'),
            $this->request->getPost('admin_passwordr'), // Para checar a repetição da senha
            $this->request->getPost('base_url'),
            $this->request->getPost('timezone'),
            $selectedTimezone // Usa o timezone selecionado
          );

          // Se a página for carregada pela primeira vez (GET) ou se não houver um valor submetido
          if ($this->request->getMethod() === 'get' || !$this->request->getPost('timezone')) {
            // Define America/Sao_Paulo como padrão
            $this->data['timezone'] = 'America/Sao_Paulo';
          } else {
            // Se o formulário foi submetido, use o valor postado
            $this->data['timezone'] = $this->request->getPost('timezone');
          }

          if ($currentStepData['success'] === true) {
            // Instalação finalizada, avança para a tela de sucesso
            $this->data['current_step'] = 5;
            $this->data['page'] = 'finish';
          } else {
            // Erro na instalação final, permanece nesta etapa
            $this->data['current_step'] = 4;
            $this->data['page'] = 'install';
            $this->data['admin_error'] = true;
            $this->data['admin_error_msg'] = $currentStepData['error_msg'];
            // Repopula o formulário para o usuário não perder os dados digitados
            $this->data['db_credentials'] = [
              'hostname' => $this->request->getPost('hostname'),
              'username' => $this->request->getPost('username'),
              'password' => $this->request->getPost('password'),
              'database' => $this->request->getPost('database'),
            ];
            // Certifique-se que o timezone selecionado anteriormente é repopulado
            $currentStepData['timezone'] = $selectedTimezone; // Mantém o valor que o usuário digitou/selecionou
          }
          break;

        // Não deveria haver um POST para a etapa 5 (Finish), mas por segurança
        case 5:
          // Se já na etapa final e tentar POST, apenas permanece
          $this->data['current_step'] = 5;
          $this->data['page'] = 'finish';
          break;

        default:
          // Caso de segurança, retorna para a primeira etapa
          $this->data['current_step'] = 1;
          $this->data['page'] = 'requirements';
          break;
      }
    } else {
      // Requisição GET (primeiro carregamento da página ou recarga sem POST)
      // Garante que sempre comece na primeira etapa e pré-carrega os requisitos
      $this->data['current_step'] = 1;
      $this->data['page'] = 'requirements';
      // Chama a função da primeira etapa para preencher os dados iniciais dos requisitos
      $currentStepData = $this->checkRequirements();
    }

    // Mescla os dados retornados pelo método da etapa com os dados do controller
    // Isso garante que as variáveis como 'error', 'requirement1', etc., estejam disponíveis na view
    $this->data = array_merge($this->data, $currentStepData);

    // Atualiza o status dos passos para a barra de progresso com base no current_step atual
    $this->updateStepStatuses();

    log_message('debug', 'Final Current Step: ' . $this->data['current_step']);
    log_message('debug', 'Final Page: ' . $this->data['page']);
    log_message('debug', 'Rendering view install/html');

    // Renderiza a view principal (html.php) com todos os dados preparados
    echo view('install/html', $this->data);
  }

  /**
   * Retorna o nome da página (view) correspondente a um determinado passo.
   * @param int $stepId
   * @return string
   */
  protected function getPageNameForStep(int $stepId): string
  {
    switch ($stepId) {
      case 1:
        return 'requirements';
      case 2:
        return 'file_permissions';
      case 3:
        return 'database';
      case 4:
        return 'install'; // 'install' é a view para o admin login/config
      case 5:
        return 'finish';
      default:
        return 'requirements'; // Padrão
    }
  }

  /**
   * Método auxiliar para atualizar os status dos passos (complete, current, upcoming)
   * para a barra de progresso.
   */
  protected function updateStepStatuses()
  {
    $updatedSteps = [];
    foreach ($this->steps as $key => $step) {
      if ($key < $this->data['current_step']) {
        $step['status'] = 'complete';
      } elseif ($key === $this->data['current_step']) {
        $step['status'] = 'current';
      } else {
        $step['status'] = 'upcoming';
      }
      $updatedSteps[$key] = $step;
    }
    $this->data['steps'] = $updatedSteps;
  }

  /**
   * Step 1: Check server requirements.
   * Retorna um array com o status de erro e os dados para a view.
   */
  protected function checkRequirements(): array
  {
    $error = false;
    $result = [];

    $result['requirement1'] = (version_compare(PHP_VERSION, '8.1') >= 0)
      ? "<span class='badge bg-success'>v." . PHP_VERSION . '</span>'
      : ($error = true) && "<span class='badge bg-danger'>Your PHP version is " . PHP_VERSION . '</span>';

    $extensions = [
      'mysqli'   => 'MySQLi PHP Extension',
      'pdo'      => 'PDO PHP Extension',
      'curl'     => 'cURL PHP Extension',
      'openssl'  => 'OpenSSL PHP Extension',
      'mbstring' => 'MBString PHP Extension',
      'iconv'    => 'iconv PHP Extension',
      'imap'     => 'IMAP PHP Extension',
      'gd'       => 'GD PHP Extension',
      'zip'      => 'Zip PHP Extension',
    ];

    foreach ($extensions as $ext => $name) {
      $status = extension_loaded($ext);
      if ($ext === 'iconv' && ! $status && ! function_exists('iconv')) {
        $status = false;
      }
      $reqName = 'requirement' . (array_search($ext, array_keys($extensions)) + 2);
      $result[$reqName] = $status
        ? "<span class='badge bg-success'>Enabled</span>"
        : ($error = true) && "<span class='badge bg-danger'>Not enabled</span>";
    }

    $urlFopen = ini_get('allow_url_fopen');
    $result['requirement11'] = ($urlFopen === '1' || strcasecmp($urlFopen, 'On') === 0 || strcasecmp($urlFopen, 'true') === 0 || strcasecmp($urlFopen, 'yes') === 0)
      ? "<span class='badge bg-success'>Enabled</span>"
      : ($error = true) && "<span class='badge bg-danger'>Allow_url_fopen is not enabled!</span>";

    $result['error'] = $error;
    return $result;
  }

  /**
   * Step 2: Check file and folder permissions.
   * Verifica se os diretórios/arquivos existem, se não, tenta criá-los,
   * e então verifica/garante que sejam graváveis.
   * Retorna um array com o status de erro e os dados para a view.
   */
  protected function checkFilePermissions(): array
  {
    $error = false;
    $result = [];

    // --- DEFINIÇÃO E VERIFICAÇÃO DE PERMISSÕES ---
    // A chave é o nome da variável que a view espera.
    // O valor é o caminho RELATIVO que será verificado.
    $checks = [
      'requirement_estimates'             => ['path' => 'uploads/estimates', 'type' => 'dir'],
      'requirement_proposals'             => ['path' => 'uploads/proposals', 'type' => 'dir'],
      'ticket_attachments'                => ['path' => 'uploads/ticket_attachments', 'type' => 'dir'],
      'tasks'                             => ['path' => 'uploads/tasks', 'type' => 'dir'],
      'staff_profile_images'              => ['path' => 'uploads/staff_profile_images', 'type' => 'dir'],
      'projects'                          => ['path' => 'uploads/projects', 'type' => 'dir'],
      'newsfeed'                          => ['path' => 'uploads/newsfeed', 'type' => 'dir'],
      'leads'                             => ['path' => 'uploads/leads', 'type' => 'dir'],
      'invoices'                          => ['path' => 'uploads/invoices', 'type' => 'dir'],
      'expenses'                          => ['path' => 'uploads/expenses', 'type' => 'dir'],
      'discussions'                       => ['path' => 'uploads/discussions', 'type' => 'dir'],
      'contracts'                         => ['path' => 'uploads/contracts', 'type' => 'dir'],
      'company'                           => ['path' => 'uploads/company', 'type' => 'dir'],
      'clients'                           => ['path' => 'uploads/clients', 'type' => 'dir'],
      'client_profile_images'             => ['path' => 'uploads/client_profile_images', 'type' => 'dir'],
      'temp_folder_writable'              => ['path' => 'temp', 'type' => 'dir'],

      // Para pastas e arquivos dentro de 'app/Config' (antigo 'application/config')
      // 'config_folder_writable'            => ['path' => 'app/Config', 'type' => 'dir'],
      // 'config_file_writable'              => ['path' => 'app/Config/config.php', 'type' => 'file'],
      // 'app_config_sample_writable'        => ['path' => 'app/Config/app-config-sample.php', 'type' => 'file'],

      // Para a pasta de logs dentro de 'writable/'
      'log_folder_writable'               => ['path' => 'writable/logs', 'type' => 'dir'],
    ];

    foreach ($checks as $varName => $item) {
      $relativePath = $item['path'];
      $type = $item['type'];
      $fullPath = '';
      $permissionMode = ''; // Permissão numérica (e.g., 0755, 0644)
      $statusOk = true; // Assumimos OK, e alteramos se houver problema

      // --- Lógica para determinar o caminho absoluto e a permissão padrão ---
      if (str_starts_with($relativePath, 'uploads/') || $relativePath === 'temp') {
        $fullPath = ROOTPATH . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $permissionMode = '0755';
      } elseif (str_starts_with($relativePath, 'app/Config')) {
        $cleanPath = str_replace('app/', '', $relativePath);
        $fullPath = APPPATH . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);
        $permissionMode = ($type === 'file') ? '0644' : '0755';
      } elseif (str_starts_with($relativePath, 'writable/')) {
        $cleanPath = str_replace('writable/', '', $relativePath);
        $fullPath = WRITEPATH . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);
        $permissionMode = '0755';
      } else {
        log_message('error', 'Caminho de permissão não mapeado: ' . $relativePath);
        $fullPath = ROOTPATH . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $permissionMode = '0755'; // Fallback genérico
      }
      // --- FIM DA LÓGICA DE CAMINHO ABSOLUTO ---

      // 1. Verificar existência e tentar criar se for diretório
      if ($type === 'dir' && !is_dir($fullPath)) {
        log_message('info', 'Tentando criar diretório: ' . $fullPath);
        // Permissão 0755 ou 0777 dependendo do seu ambiente e segurança
        // 0755 é um bom padrão, 0777 é mais permissivo (cuidado)
        if (!mkdir($fullPath, 0755, true)) { // true para recursivo
          $statusOk = false;
          $message = "No (Could not create directory: " . $relativePath . ") - Permissions " . $permissionMode;
          log_message('error', 'Falha ao criar diretório: ' . $fullPath);
        }
      } elseif ($type === 'file' && !file_exists($fullPath)) {
        // Para arquivos, apenas verificamos, não criamos automaticamente a menos que haja um conteúdo padrão
        // Se o arquivo não existe, consideramos um erro de permissão por não poder criar/escrever nele depois
        $statusOk = false;
        $message = "No (File does not exist: " . $relativePath . ") - Permissions " . $permissionMode;
        log_message('error', 'Arquivo não existe: ' . $fullPath);
      }

      // 2. Verificar se é gravável e tentar corrigir permissões (se for Unix/Linux)
      if ($statusOk && !$this->is_really_writable($fullPath)) {
        log_message('info', 'Diretório/Arquivo não gravável, tentando chmod: ' . $fullPath . ' para ' . $permissionMode);
        // Tenta aplicar as permissões. fileperms() retorna int, então 0xxx precisa ser octal.
        if (@chmod($fullPath, octdec($permissionMode))) {
          // Re-verifica se realmente se tornou gravável após o chmod
          if (!$this->is_really_writable($fullPath)) {
            $statusOk = false;
            $message = "No (Not writable after chmod " . $permissionMode . ": " . $relativePath . ") - Permissions " . $permissionMode;
            log_message('error', 'Falha ao tornar gravável após chmod: ' . $fullPath);
          }
        } else {
          $statusOk = false;
          $message = "No (Not writable and chmod failed: " . $relativePath . ") - Permissions " . $permissionMode;
          log_message('error', 'Chmod falhou para: ' . $fullPath);
        }
      }

      // 3. Status final (após criação e tentativa de chmod)
      if ($statusOk && $this->is_really_writable($fullPath)) { // Verifica uma última vez se está realmente gravável
        $result[$varName] = "<span class='badge bg-success'>Ok</span>";
      } else {
        $error = true;
        // Se $statusOk já foi false e $message já foi definido, use-o.
        // Caso contrário (e.g., já existia mas não era gravável e chmod falhou), defina a mensagem.
        if (!isset($message)) {
          $message = "No (Not writable: " . $relativePath . ") - Permissions " . $permissionMode;
        }
        $result[$varName] = "<span class='badge bg-danger'>" . $message . "</span>";
      }
    }

    $result['error'] = $error;
    return $result;
  }

  /**
   * Step 3: Setup database connection.
   * Agora recebe os dados do POST como parâmetros e retorna um array.
   */
  protected function setupDatabase(string $hostname, string $username, string $password, string $database): array
  {
    $result = ['success' => false, 'error_msg' => ''];

    try {
      $db = \Config\Database::connect([
        'hostname' => $hostname,
        'username' => $username,
        'password' => $password,
        'database' => $database,
        'DBDriver' => 'MySQLi',
      ]);
      // Tentativa de conexão bem-sucedida
      $db->close();
      $result['success'] = true;
    } catch (\Exception $e) {
      $result['error_msg'] = 'Error connecting to database: ' . $e->getMessage();
    }

    return $result;
  }

  /**
   * Step 4: Performs the actual installation: DB setup, user creation, config file.
   * Agora recebe os dados como parâmetros e retorna um array.
   */
  protected function performInstallation(
    string $firstname,
    string $lastname,
    string $admin_email,
    string $admin_password,
    string $admin_passwordr, // Confirmação de senha
    string $base_url,
    string $timezone
  ): array {
    // --- 1. Validações adicionais ---
    if (empty($admin_email)) {
      return ['success' => false, 'error_msg' => 'Endereço de e-mail do administrador é obrigatório.'];
    }
    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
      return ['success' => false, 'error_msg' => 'Endereço de e-mail do administrador inválido.'];
    }
    if (empty($admin_password)) {
      return ['success' => false, 'error_msg' => 'Senha do administrador é obrigatória.'];
    }
    if ($admin_password !== $admin_passwordr) {
      return ['success' => false, 'error_msg' => 'As senhas não coincidem.'];
    }
    if (empty($base_url)) {
      return ['success' => false, 'error_msg' => 'A URL base é obrigatória.'];
    }

    $db = null; // Inicializa a conexão DB
    $dbPath = WRITEPATH . 'database' . DIRECTORY_SEPARATOR . 'CarolCRM.db';

    try {
      // --- 2. Garantir o arquivo SQLite existe e que o diretório é gravável ---
      $dbDir = dirname($dbPath);
      if (!is_dir($dbDir)) {
        if (!mkdir($dbDir, 0755, true)) {
          throw new \Exception("Não foi possível criar o diretório do banco de dados: {$dbDir}. Verifique as permissões.");
        }
      }
      // Se o arquivo não existe, o PDO o cria ao tentar conectar
      if (!file_exists($dbPath)) {
        // Tentar criar o arquivo vazio para garantir a permissão antes da conexão real
        file_put_contents($dbPath, '');
        if (!is_writable($dbPath)) {
          throw new \Exception("Arquivo do banco de dados não é gravável: {$dbPath}. Verifique as permissões.");
        }
        log_message('info', 'Arquivo SQLite CarolCRM.db criado em: ' . $dbPath);
      } elseif (!is_writable($dbPath)) {
        throw new \Exception("Arquivo do banco de dados não é gravável: {$dbPath}. Verifique as permissões.");
      }

      // --- 3. Conectar ao banco de dados SQLite ---
      // Use a configuração padrão, mas force o driver e o caminho
      $db = \Config\Database::connect([
        'DBDriver' => 'SQLite3',
        'database' => $dbPath, // Caminho completo para o arquivo DB
        'foreignKeys' => true, // Importante para SQLite
      ]);

      // Testar a conexão
      $db->simpleQuery('SELECT 1');

      // --- 4. Carregar e executar o script SQL ---

      if (!file_exists($this->databaseFile)) {
        throw new \Exception("Arquivo SQL de instalação não encontrado: " . $this->databaseFile);
      }

      // Certifique-se que esta linha está lendo o conteúdo do arquivo
      $sqlContent = file_get_contents($this->databaseFile);

      $parser = new SqlScriptParser();
      // E esta linha passa o CONTEÚDO para o parser
      $sqlStatements = $parser->parse($sqlContent);

      foreach ($sqlStatements as $statement) {
        $distilled = $parser->removeComments($statement);
        if (!empty($distilled)) {
          // Executa a query diretamente com a conexão do CI4
          $db->query($distilled);
        }
      }
      log_message('info', 'Esquema do banco de dados SQL executado com sucesso.');

      // --- 5. Criar usuário administrador ---
      $hashedPassword = password_hash($admin_password, PASSWORD_DEFAULT);

      // Escapar valores para evitar SQL Injection (mesmo com SQLite)
      $email = $db->escape($admin_email);
      $fname = $db->escape($firstname);
      $lname = $db->escape($lastname);
      $now  = date('Y-m-d H:i:s');

      // Ajuste a query para inserir na tblstaff, preenchendo todas as colunas
      // com os valores dinâmicos e 'NULL' para os campos que não são definidos pelo instalador.
      $insertSql = "INSERT INTO `tblstaff` VALUES (" .
        "1, " .                           // staffid: Usamos 1, pois é o primeiro admin
        "{$email}, " .            // email: Do formulário do admin
        "{$fname}, " .            // firstname: Do formulário do admin
        "{$lname}, " .            // lastname: Do formulário do admin
        "NULL, " .                       // (provavelmente 'direction')
        "NULL, " .                       // (provavelmente 'media_path_slug')
        "NULL, " .                       // (provavelmente 'media_path_id')
        "NULL, " .                       // (provavelmente 'staff_identi')
        "'{$hashedPassword}', " .        // password: Senha do admin (já hashed)
        "'{$now}', " .                   // datecreated: Data e hora atual da instalação
        "NULL, " .                       // (provavelmente 'role')
        "NULL, " .                       // (provavelmente 'last_ip') - não é o caso de IP local
        "NULL, " .                       // (provavelmente 'last_login')
        "NULL, " .                       // (provavelmente 'last_activity')
        "NULL, " .                       // (provavelmente 'last_password_change')
        "NULL, " .                       // (provavelmente 'last_password_change_force')
        "NULL, " .                       // (provavelmente 'last_password_change_ip')
        "1, " .                          // admin: É um admin (1)
        "NULL, " .                       // (provavelmente 'two_factor_auth_enabled')
        "1, " .                          // active: Usuário ativo (1)
        "NULL, " .                       // (provavelmente 'default_language')
        "NULL, " .                       // (provavelmente 'direction_rtl')
        "NULL, " .                       // (provavelmente 'is_file_sharing_allowed')
        "0, " .                          // is_not_staff: Não é 'not staff' (ou seja, É staff - 0)
        "0.0, " .                        // (provavelmente 'hourly_rate')
        "0, " .                          // (provavelmente 'color')
        "NULL, " .                       // (provavelmente 'twitter')
        "NULL, " .                       // (provavelmente 'facebook')
        "NULL, " .                       // (provavelmente 'linkedin')
        "NULL " .                        // (provavelmente 'phonenumber')
        ")";

      $db->query($insertSql);
      log_message('info', 'Usuário administrador criado com sucesso.');


      // --- 6. Atualizar o arquivo .env (base_url e timezone) ---
      // Note: Este é um método auxiliar que você precisaria implementar.
      // Ele lê o .env, modifica a linha e salva.
      $this->updateDotEnv('app.baseURL', $base_url);
      $this->updateDotEnv('app.appTimezone', $timezone); // Supondo que você tenha uma config app.appTimezone

      // --- 7. Criar/Atualizar .htaccess na pasta public ---
      $htaccessContent = 'RewriteEngine On' . PHP_EOL .
        'RewriteCond %{REQUEST_FILENAME} !-f' . PHP_EOL .
        'RewriteCond %{REQUEST_FILENAME} !-d' . PHP_EOL .
        'RewriteRule ^(.*)$ index.php/$1 [L]' . PHP_EOL .
        'AddDefaultCharset utf-8';

      $publicHtaccessPath = FCPATH . '.htaccess';
      if ($this->is_really_writable(FCPATH)) { // Verifica se a pasta public é gravável
        if (!file_exists($publicHtaccessPath) || is_writable($publicHtaccessPath)) {
          file_put_contents($publicHtaccessPath, $htaccessContent);
          log_message('info', '.htaccess criado/atualizado em public/.htaccess');
        } else {
          log_message('warning', 'Não foi possível escrever ou criar .htaccess em ' . $publicHtaccessPath . '. Permissões insuficientes.');
        }
      } else {
        log_message('warning', 'Diretório ' . FCPATH . ' não é gravável para criar .htaccess.');
      }

      return ['success' => true];
    } catch (\Throwable $th) {
      log_message('error', 'Installation error: ' . $th->getMessage());
      return ['success' => false, 'error_msg' => 'Ocorreu um erro durante a instalação: ' . $th->getMessage()];
    } finally {
      if ($db) {
        $db->close();
      }
    }
  }


  /**
   * Step 5: Finish installation.
   * Não precisa de lógica complexa, apenas define a view.
   */
  protected function finishInstallation()
  {
    // Nada específico para fazer aqui, a view 'finish.php' já lida com a exibição
    // Retorna um array vazio ou com uma flag de sucesso se desejar
    return ['success' => true];
  }

  /**
   * Helper para `is_really_writable`, movido para o Controller.
   * Para uso em produção, considere mover para um helper de filesystem.
   */
  private function is_really_writable($file)
  {
    // Definições de constantes que deveriam vir do CI3 original ou ser definidas
    // define('FILE_READ_MODE', 0644);
    // define('FILE_WRITE_MODE', 0666);
    // define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // Ou 'w' dependendo do caso

    // Se estamos em um sistema tipo Unix e temos funções Posix, use-as para diretórios
    if (DIRECTORY_SEPARATOR === '/' && function_exists('posix_getpwuid') && function_exists('fileowner')) {
      $owner = posix_getpwuid(fileowner($file));
      if ($owner && $owner['name'] === get_current_user()) {
        return is_writable($file);
      }
    }

    // Para sistemas não-Posix, ou se o proprietário não corresponder, ou para arquivos
    if (is_file($file)) {
      // VFS ou outros sistemas de arquivos não-padrão podem precisar de uma verificação de arquivo temporário
      if (($fp = @fopen($file, 'ab')) === false) {
        return false;
      }
      fclose($fp);
      return true;
    } elseif (is_dir($file)) {
      $temp_file = rtrim($file, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . uniqid(mt_rand()) . '.tmp';
      if (($fp = @fopen($temp_file, 'ab')) === false) {
        return false;
      }
      fclose($fp);
      @unlink($temp_file);
      return true;
    }

    return false;
  }

  /**
   * Helper para adivinhar a URL base.
   */
  protected function guess_base_url()
  {
    $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    if (isset($_SERVER['REQUEST_URI'])) {
      // Remover o segmento do instalador da URL
      $uri = $_SERVER['REQUEST_URI'];
      // Tenta encontrar e remover o '/install' ou '/install/index.php'
      $base_url_segment = preg_replace('/(\/)?install(\/index.php)?(\/.*)?$/', '', $uri);
      $base_url .= $base_url_segment;
    }
    return rtrim($base_url, '/') . '/';
  }


  /**
   * Helper para atualizar uma chave no arquivo .env
   * @param string $key A chave a ser atualizada (ex: 'app.baseURL')
   * @param string $value O novo valor
   * @return bool True se atualizado, false caso contrário
   */
  protected function updateDotEnv(string $key, string $value): bool
  {
    $envPath = ROOTPATH . '.env'; // Assume que .env está na raiz do projeto
    if (!file_exists($envPath) || !is_writable($envPath)) {
      log_message('error', 'Arquivo .env não encontrado ou não gravável: ' . $envPath);
      return false;
    }

    $contents = file_get_contents($envPath);
    $keyParts = explode('.', $key);
    $envKey = strtoupper(implode('.', $keyParts)); // Converte para maiúsculas e pontos

    $newLine = $envKey . ' = ' . $value;

    // Tenta substituir uma linha existente
    $pattern = '/^' . preg_quote($envKey, '/') . ' = .*$/m';
    if (preg_match($pattern, $contents)) {
      $contents = preg_replace($pattern, $newLine, $contents);
    } else {
      // Adiciona a linha se não existir
      $contents .= PHP_EOL . $newLine;
    }

    if (file_put_contents($envPath, $contents) === false) {
      log_message('error', 'Falha ao escrever no arquivo .env: ' . $envPath);
      return false;
    }
    return true;
  }
}
