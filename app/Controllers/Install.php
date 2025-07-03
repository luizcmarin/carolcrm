<?php

namespace App\Controllers;

use App\Libraries\SqlScriptParser;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Exception;
use Psr\Log\LoggerInterface;
use Throwable;

class Install extends BaseController
{
    protected $data  = [];
    protected $steps = [
        1 => ['id' => 1, 'name' => 'Requisitos da Aplicação', 'status' => 'upcoming'],
        2 => ['id' => 2, 'name' => 'Permissões da Aplicação', 'status' => 'upcoming'],
        3 => ['id' => 3, 'name' => 'O Banco de Dados', 'status' => 'upcoming'],
        4 => ['id' => 4, 'name' => 'Administração', 'status' => 'upcoming'],
        5 => ['id' => 5, 'name' => 'Sucesso', 'status' => 'upcoming'],
    ];

    /**
     * Construtor do Controller.
     * Realiza verificações iniciais e carrega helpers.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        helper('form');

        // Verifica se a aplicação já foi instalada (se o banco de dados existe)
        // Se o banco de dados existir, significa que a aplicação já está instalada.
        // Você será redirecionado para a página inicial da aplicação.
        if (file_exists(CAROL_DB)) {
            echo view('install/aplicacao_instalada');

            exit();
        }

        $this->data['current_step'] = (int) $this->request->getPost('step') ?: 1;
        $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
        $this->data['base_url']     = base_url();
        $this->data['steps']        = $this->steps;
    }

    /**
     * Lida com o processo de instalação passo a passo.
     * Esta é a função principal que controla o fluxo de instalação.
     */
    public function index()
    {
        $currentStepData = []; // Para armazenar resultados da etapa processada

        // Verifica se a requisição é um POST (envio de formulário de alguma etapa)
        if ($this->request->getMethod() === 'POST') {
            $postedStep = (int) $this->request->getPost('step');

            switch ($postedStep) {
                case 1: // Requisitos da Aplicação - Se passou, vá para o passo 2
                    $serverRequirementsResult = $this->VerificaRequisitos();
                    if ($serverRequirementsResult['error'] === false) {
                        $this->data['current_step'] = 2; // Avanca para passo2
                        $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                        $currentStepData            = $this->VerificaPermissoes(); // Obtém os dados do passo2
                    } else {
                        // Permanece nessa etapa se o passo1 não foi atendido
                        $this->data['current_step'] = 1;
                        $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                        $currentStepData            = $this->VerificaRequisitos(); // Obtém os dados do passo1 novamente
                    }
                    break;

                case 2: // Permissões da Aplicação - Se passou, vá para o passo3
                    $filePermissionsResult = $this->VerificaPermissoes();
                    if ($filePermissionsResult['error'] === false) {
                        $this->data['current_step'] = 3;
                        $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                        $currentStepData            = []; // Não há dados iniciais para o passo3
                    } else {
                        $this->data['current_step'] = 2;
                        $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                        $currentStepData            = $this->VerificaPermissoes(); // Obtém os dados da etapa 2 novamente
                    }

                    break;

                case 3: // O Banco de Dados
                    $this->data['current_step']  = 4;
                    $this->data['page']          = $this->getPageNameForStep($this->data['current_step']);
                    $currentStepData['timezone'] = 'America/Sao_Paulo';

                    break;

                case 4: // Administração
                    // Passa todos os dados necessários para a função performInstallation
                    $selectedTimezone = $this->request->getPost('timezone') ?? 'America/Sao_Paulo';

                    $currentStepData = $this->performInstallation(
                        $this->request->getPost('firstname'),
                        $this->request->getPost('lastname'),
                        $this->request->getPost('admin_email'),
                        $this->request->getPost('admin_password'),
                        $this->request->getPost('admin_passwordr'), // Para checar a repetição da senha
                        $this->request->getPost('base_url'),
                        $this->request->getPost('timezone'),
                        $selectedTimezone, // Usa o timezone selecionado
                    );

                    // Se a página for carregada pela primeira vez (GET) ou se não houver um valor submetido
                    if ($this->request->getMethod() === 'get' || ! $this->request->getPost('timezone')) {
                        // Define America/Sao_Paulo como padrão
                        $this->data['timezone'] = 'America/Sao_Paulo';
                    } else {
                        // Se o formulário foi submetido, use o valor postado
                        $this->data['timezone'] = $this->request->getPost('timezone');
                    }

                    if ($currentStepData['success'] === true) {
                        $this->data['current_step'] = 5;
                        $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                    } else {
                        // Erro no passo4, permanece nesta etapa
                        $this->data['current_step']    = 4;
                        $this->data['page']            = $this->getPageNameForStep($this->data['current_step']);
                        $this->data['admin_error']     = true;
                        $this->data['admin_error_msg'] = $currentStepData['error_msg'];
                        // Repopula o formulário para o usuário não perder os dados digitados
                        $this->data['db_credentials'] = [
                            'hostname' => $this->request->getPost('hostname'),
                            'username' => $this->request->getPost('username'),
                            'password' => $this->request->getPost('password'),
                            'database' => $this->request->getPost('database'),
                        ];
                        $currentStepData['timezone'] = $selectedTimezone;
                    }
                    break;

                    // Não deveria haver um POST para a etapa 5 (Finish), mas por segurança...
                case 5:
                    // Se já na etapa final e tentar POST, apenas permanece
                    $this->data['current_step'] = 5;
                    $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                    break;

                default:
                    // Caso de segurança, retorna para a primeira etapa
                    $this->data['current_step'] = 1;
                    $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
                    break;
            }
        } else {
            // Garante que sempre comece na primeira etapa e pré-carrega os requisitos
            $this->data['current_step'] = 1;
            $this->data['page']         = $this->getPageNameForStep($this->data['current_step']);
            // Chama a função da primeira etapa para preencher os dados iniciais dos requisitos
            $currentStepData = $this->VerificaRequisitos();
        }

        // Mescla os dados retornados pelo método da etapa com os dados do controller
        // Isso garante que as variáveis como 'error', 'requirement1', etc., estejam disponíveis na view
        $this->data = array_merge($this->data, $currentStepData);

        // Atualiza o status dos passos para a barra de progresso com base no current_step atual
        $this->updateStepStatuses();

        // Renderiza a view principal (passo0.php) com todos os dados preparados
        echo view('install/passo0', $this->data);
    }

    /**
     * Retorna o nome da página (view) correspondente a um determinado passo.
     */
    protected function getPageNameForStep(int $stepId): string
    {
        switch ($stepId) {
            case 1:
                return 'passo1'; // Requisitos da Aplicação

            case 2:
                return 'passo2'; // Permissões da Aplicação

            case 3:
                return 'passo3'; // O Banco de Dados

            case 4:
                return 'passo4'; // Administração, instalação

            case 5:
                return 'passo5'; // Sucesso

            default:
                return 'passo1'; // Padrão
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
     * Passo 1: Verifica os requisitos.
     * Retorna um array com o status de erro e os dados para a view.
     */
    protected function VerificaRequisitos(): array
    {
        $error  = false;
        $result = [];

        $result['requirement1'] = (version_compare(PHP_VERSION, '8.1') >= 0)
          ? "<span class='badge bg-success'>Sua versão do PHP é " . PHP_VERSION . '</span>'
          : ($error = true) && "<span class='badge bg-danger'>Sua versão do PHP é " . PHP_VERSION . '</span>';

        $extensions = [
            'pdo_sqlite' => 'Extensão PHP PDO SQLite',
            'curl'       => 'Extensão PHP cURL',
            'openssl'    => 'Extensão PHP OpenSSL',
            'mbstring'   => 'Extensão PHP MBString',
            'iconv'      => 'Extensão PHP iconv',
            'imap'       => 'Extensão PHP IMAP',
            'gd'         => 'Extensão PHP GD',
            'zip'        => 'Extensão PHP Zip',
        ];

        foreach ($extensions as $ext => $name) {
            $status = extension_loaded($ext);
            if ($ext === 'iconv' && ! $status && ! function_exists('iconv')) {
                $status = false;
            }
            $reqName          = 'requirement' . (array_search($ext, array_keys($extensions), true) + 2);
            $result[$reqName] = $status
              ? "<span class='badge bg-success'>Habilitada</span>"
              : ($error = true) && "<span class='badge bg-danger'>Não habilitada</span>";
        }

        $urlFopen                = ini_get('allow_url_fopen');
        $result['requirement10'] = ($urlFopen === '1' || strcasecmp($urlFopen, 'On') === 0 || strcasecmp($urlFopen, 'true') === 0 || strcasecmp($urlFopen, 'yes') === 0)
          ? "<span class='badge bg-success'>Habilitada</span>"
          : ($error = true) && "<span class='badge bg-danger'>Allow_url_fopen não habilitada!</span>";

        $result['error'] = $error;

        return $result;
    }

    /**
     * Passo 2: Verifica as permissões.
     * Verifica se os diretórios/arquivos existem, se não, tenta criá-los,
     * e então verifica/garante que sejam graváveis.
     * Retorna um array com o status de erro e os dados para a view.
     */
    protected function VerificaPermissoes(): array
    {
        $error  = false;
        $result = [];

        $checks = [
            'requirement_estimates' => ['path' => 'uploads/estimates', 'type' => 'dir'],
            'requirement_proposals' => ['path' => 'uploads/proposals', 'type' => 'dir'],
            'ticket_attachments'    => ['path' => 'uploads/ticket_attachments', 'type' => 'dir'],
            'tasks'                 => ['path' => 'uploads/tasks', 'type' => 'dir'],
            'staff_profile_images'  => ['path' => 'uploads/staff_profile_images', 'type' => 'dir'],
            'projects'              => ['path' => 'uploads/projects', 'type' => 'dir'],
            'newsfeed'              => ['path' => 'uploads/newsfeed', 'type' => 'dir'],
            'leads'                 => ['path' => 'uploads/leads', 'type' => 'dir'],
            'invoices'              => ['path' => 'uploads/invoices', 'type' => 'dir'],
            'expenses'              => ['path' => 'uploads/expenses', 'type' => 'dir'],
            'discussions'           => ['path' => 'uploads/discussions', 'type' => 'dir'],
            'contracts'             => ['path' => 'uploads/contracts', 'type' => 'dir'],
            'company'               => ['path' => 'uploads/company', 'type' => 'dir'],
            'clients'               => ['path' => 'uploads/clients', 'type' => 'dir'],
            'client_profile_images' => ['path' => 'uploads/client_profile_images', 'type' => 'dir'],
            'temp_folder_writable'  => ['path' => 'temp', 'type' => 'dir'],
            'log_folder_writable'   => ['path' => 'writable/logs', 'type' => 'dir'], // Pasta de logs dentro de 'writable/'
        ];

        foreach ($checks as $varName => $item) {
            $relativePath   = $item['path'];
            $type           = $item['type'];
            $fullPath       = '';
            $permissionMode = ''; // Permissão numérica (e.g., 0755, 0644)
            $statusOk       = true; // Assumimos OK, e alteramos se houver problema

            // --- Lógica para determinar o caminho absoluto e a permissão padrão
            if (str_starts_with($relativePath, 'uploads/') || $relativePath === 'temp') {
                $fullPath       = ROOTPATH . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
                $permissionMode = '0755';
            } elseif (str_starts_with($relativePath, 'writable/')) {
                $cleanPath      = str_replace('writable/', '', $relativePath);
                $fullPath       = WRITEPATH . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);
                $permissionMode = '0755';
            } else {
                $fullPath       = ROOTPATH . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
                $permissionMode = '0755';
            }

            // 1. Verificar existência e tentar criar se for diretório
            if ($type === 'dir' && ! is_dir($fullPath)) {
                // Permissão 0755 ou 0777 dependendo do seu ambiente e segurança
                // 0755 é um bom padrão, 0777 é mais permissivo (cuidado)
                if (! mkdir($fullPath, 0755, true)) { // true para recursivo
                    $statusOk = false;
                    $message  = 'Não foi possível criar a pasta: ' . $relativePath . ' - Permissões ' . $permissionMode;
                }
            } elseif ($type === 'file' && ! file_exists($fullPath)) {
                // Para arquivos, apenas verificamos, não criamos automaticamente a menos que haja um conteúdo padrão
                // Se o arquivo não existe, consideramos um erro de permissão por não poder criar/escrever nele depois
                $statusOk = false;
                $message  = 'O arquivo não existe: ' . $relativePath . ' - Permissões ' . $permissionMode;
            }

            // 2. Verificar se é gravável e tentar corrigir permissões (se for Unix/Linux)
            if ($statusOk && ! $this->carol->eh_gravavel($fullPath)) {
                // Tenta aplicar as permissões. fileperms() retorna int, então 0xxx precisa ser octal.
                if (@chmod($fullPath, octdec($permissionMode))) {
                    // Re-verifica se realmente se tornou gravável após o chmod
                    if (! $this->carol->eh_gravavel($fullPath)) {
                        $statusOk = false;
                        $message  = 'Sem permissão de escrita após chmod ' . $permissionMode . ': ' . $relativePath . ' - Permissões ' . $permissionMode;
                    }
                } else {
                    $statusOk = false;
                    $message  = 'Sem permissão de escrita e chmod falhou: ' . $relativePath . ' - Permissões ' . $permissionMode;
                }
            }

            // 3. Status final (após criação e tentativa de chmod)
            if ($statusOk && $this->carol->eh_gravavel($fullPath)) { // Verifica uma última vez se está realmente gravável
                $result[$varName] = "<span class='badge bg-success'>Ok</span>";
            } else {
                $error = true;
                // Se $statusOk já foi false e $message já foi definido, use-o.
                // Caso contrário (e.g., já existia mas não era gravável e chmod falhou), defina a mensagem.
                if (! isset($message)) {
                    $message = 'Sem permissão de escrita: ' . $relativePath . ' - Permissões ' . $permissionMode;
                }
                $result[$varName] = "<span class='badge bg-danger'>" . $message . '</span>';
            }
        }

        $result['error'] = $error;

        return $result;
    }

    /**
     * Passo 4: Administração.
     * Agora recebe os dados como parâmetros e retorna um array.
     */
    protected function performInstallation(
        string $firstname,
        string $lastname,
        string $admin_email,
        string $admin_password,
        string $admin_passwordr, // Confirmação de senha
        string $base_url,
        string $timezone,
    ): array {
        // 1. Validações adicionais
        if (empty($admin_email)) {
            return ['success' => false, 'error_msg' => 'Endereço de e-mail do administrador é obrigatório.'];
        }
        if (! filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
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

        try {
            // 2. Garantir o arquivo SQLite existe e que o diretório é gravável
            $dbDir = dirname(CAROL_DB);
            if (! is_dir($dbDir)) {
                if (! mkdir($dbDir, 0755, true)) {
                    throw new Exception("Não foi possível criar o diretório do banco de dados: {$dbDir}. Verifique as permissões.");
                }
            }
            // Se o arquivo não existe, o PDO o cria ao tentar conectar
            if (! file_exists(CAROL_DB)) {
                // Tentar criar o arquivo vazio para garantir a permissão antes da conexão real
                file_put_contents(CAROL_DB, '');
                if (! is_writable(CAROL_DB)) {
                    throw new Exception('Arquivo do banco de dados não é gravável: {CAROL_DB}. Verifique as permissões.');
                }
            } elseif (! is_writable(CAROL_DB)) {
                throw new Exception('Arquivo do banco de dados não é gravável: {CAROL_DB}. Verifique as permissões.');
            }

            // 3. Conectar ao banco de dados SQLite
            // Use a configuração padrão, mas force o driver e o caminho
            $db = Database::connect([
                'DBDriver'    => 'SQLite3',
                'database'    => CAROL_DB, // Caminho completo para o arquivo DB
                'foreignKeys' => true, // Importante para SQLite
            ]);

            // Testar a conexão
            $db->simpleQuery('SELECT 1');

            // 4. Carregar e executar o script SQL
            $databaseSQLFile = APPPATH . 'Database/Install/CarolCRM.sql';
            if (! file_exists($databaseSQLFile)) {
                throw new Exception('Arquivo SQL de instalação não encontrado: ' . $databaseSQLFile);
            }

            $sqlContent    = file_get_contents($databaseSQLFile);
            $parser        = new SqlScriptParser();
            $sqlStatements = $parser->parse($sqlContent);

            foreach ($sqlStatements as $statement) {
                $distilled = $parser->removeComments($statement);
                if (! empty($distilled)) {
                    $db->query($distilled);
                }
            }

            // 5. Criar usuário administrador
            $hashedPassword = password_hash($admin_password, PASSWORD_DEFAULT);

            // Escapar valores para evitar SQL Injection (mesmo com SQLite)
            $email = $db->escape($admin_email);
            $fname = $db->escape($firstname);
            $lname = $db->escape($lastname);
            $now   = date('Y-m-d H:i:s');

            // Ajuste a query para inserir na tblstaff, preenchendo todas as colunas
            // com os valores dinâmicos e 'NULL' para os campos que não são definidos pelo instalador.
            $insertSql = 'INSERT INTO `tblstaff` VALUES (' .
              '1, ' .                          // staffid: Usamos 1, pois é o primeiro registro
              "{$email}, " .                   // email: Do formulário do admin
              "{$fname}, " .                   // firstname: Do formulário do admin
              "{$lname}, " .                   // lastname: Do formulário do admin
              'NULL, ' .                       // (provavelmente 'direction')
              'NULL, ' .                       // (provavelmente 'media_path_slug')
              'NULL, ' .                       // (provavelmente 'media_path_id')
              'NULL, ' .                       // (provavelmente 'staff_identi')
              "'{$hashedPassword}', " .        // password: Senha do admin (já hashed)
              "'{$now}', " .                   // datecreated: Data e hora atual da instalação
              'NULL, ' .                       // (provavelmente 'role')
              'NULL, ' .                       // (provavelmente 'last_ip') - não é o caso de IP local
              'NULL, ' .                       // (provavelmente 'last_login')
              'NULL, ' .                       // (provavelmente 'last_activity')
              'NULL, ' .                       // (provavelmente 'last_password_change')
              'NULL, ' .                       // (provavelmente 'last_password_change_force')
              'NULL, ' .                       // (provavelmente 'last_password_change_ip')
              '1, ' .                          // admin: É um admin (1)
              'NULL, ' .                       // (provavelmente 'two_factor_auth_enabled')
              '1, ' .                          // active: Usuário ativo (1)
              'NULL, ' .                       // (provavelmente 'default_language')
              'NULL, ' .                       // (provavelmente 'direction_rtl')
              'NULL, ' .                       // (provavelmente 'is_file_sharing_allowed')
              '0, ' .                          // is_not_staff: Não é 'not staff' (ou seja, É staff - 0)
              '0.0, ' .                        // (provavelmente 'hourly_rate')
              '0, ' .                          // (provavelmente 'color')
              'NULL, ' .                       // (provavelmente 'twitter')
              'NULL, ' .                       // (provavelmente 'facebook')
              'NULL, ' .                       // (provavelmente 'linkedin')
              'NULL ' .                        // (provavelmente 'phonenumber')
              ')';

            $db->query($insertSql);

            // 6. Atualizar o arquivo env (base_url e timezone)
            $this->updateDotEnv('app.baseURL', $base_url);
            $this->updateDotEnv('app.appTimezone', $timezone);

            // 7. Criar/Atualizar .htaccess na pasta public
            $htaccessContent = 'RewriteEngine On' . PHP_EOL .
              'RewriteCond %{REQUEST_FILENAME} !-f' . PHP_EOL .
              'RewriteCond %{REQUEST_FILENAME} !-d' . PHP_EOL .
              'RewriteRule ^(.*)$ index.php/$1 [L]' . PHP_EOL .
              'AddDefaultCharset utf-8';

            $publicHtaccessPath = FCPATH . '.htaccess';
            if ($this->carol->eh_gravavel(FCPATH)) { // Verifica se a pasta public é gravável
                if (! file_exists($publicHtaccessPath) || is_writable($publicHtaccessPath)) {
                    file_put_contents($publicHtaccessPath, $htaccessContent);
                } else {
                    log_message('warning', 'Não foi possível escrever ou criar .htaccess em ' . $publicHtaccessPath . '. Permissões insuficientes.');
                }
            } else {
                log_message('warning', 'Diretório ' . FCPATH . ' não é gravável para criar .htaccess.');
            }

            return ['success' => true];
        } catch (Throwable $th) {
            return ['success' => false, 'error_msg' => 'Ocorreu um erro durante a instalação: ' . $th->getMessage()];
        } finally {
            if ($db) {
                $db->close();
            }
        }
    }

    /**
     * Função para atualizar uma chave no arquivo env
     *
     * @param string $key   A chave a ser atualizada (ex: 'app.baseURL')
     * @param string $value O novo valor
     *
     * @return bool True se atualizado, false caso contrário
     */
    protected function updateDotEnv(string $key, string $value): bool
    {
        $envPath = ROOTPATH . 'env'; // Assume que env está na raiz do projeto
        if (! file_exists($envPath) || ! is_writable($envPath)) {
            log_message('error', 'Arquivo env não encontrado ou não gravável: ' . $envPath);

            return false;
        }

        $contents = file_get_contents($envPath);
        $keyParts = explode('.', $key);
        $envKey   = strtoupper(implode('.', $keyParts)); // Converte para maiúsculas e pontos

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
            log_message('error', 'Falha ao escrever no arquivo env: ' . $envPath);

            return false;
        }

        return true;
    }
}
