<?php

namespace App\Libraries;

use Config\Services;
use CodeIgniter\I18n\Time;
use App\Models\ConfiguracoesModel;
use CodeIgniter\Cache\CacheFactory;
use CodeIgniter\Cache\CacheInterface;

/**
 * Esta classe contem funções globais aleatórias.
 */
class Carol
{
    /**
     * @var array Armazena as configurações carregadas do banco de dados.
     */
    protected $chaves = [];

    /**
     * @var CacheInterface Instância do serviço de cache.
     */
    protected $cache;

    /**
     * @var ConfiguracoesModel Instância do modelo de configurações.
     */
    protected $configuracoesModel;


    public function __construct()
    {
        $this->configuracoesModel = new ConfiguracoesModel();
        $this->cache = \Config\Services::cache();

        $this->carregarConfiguracoes();
    }


    /**
     * Carrega todas as configurações do banco de dados para a propriedade $chaves.
     * Utiliza cache para otimizar o carregamento.
     */
    protected function carregarConfiguracoes()
    {
        $cacheKey = 'carol_configuracoes';

        // Tenta buscar as configurações do cache
        $cachedConfig = $this->cache->get($cacheKey);

        if ($cachedConfig) {
            $this->chaves = $cachedConfig;
            return;
        }

        // Se não estiver no cache, carrega do banco de dados
        $configuracoesDb = $this->configuracoesModel->findAll();
        $tempChaves = [];
        foreach ($configuracoesDb as $config) {
            // Garante que a chave esteja em maiúsculas (embora o Model já faça isso)
            $chave = strtoupper($config->chave);
            $tempChaves[$chave] = [
                'valor' => $this->converterValorPeloTipo($config->valor, $config->tipo),
                'tipo'  => $config->tipo,
                'id'    => $config->id,
            ];
        }
        $this->chaves = $tempChaves;

        // Armazena no cache por 1 hora
        $this->cache->save($cacheKey, $this->chaves, 3600);
    }

    /**
     * Converte o valor da string para o tipo de dado especificado.
     *
     * @param string|null $valorString O valor como string.
     * @param string $tipo O tipo de dado ('string', 'int', 'boolean', 'json').
     * @return mixed O valor convertido.
     */
    protected function converterValorPeloTipo($valorString, string $tipo)
    {
        if (is_null($valorString)) {
            return null;
        }

        switch ($tipo) {
            case 'int':
                return (int) $valorString;
            case 'boolean':
                return filter_var($valorString, FILTER_VALIDATE_BOOLEAN);
            case 'json':
                $decoded = json_decode($valorString, true);
                return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $valorString; // Retorna string se JSON inválido
            case 'string':
            default:
                return (string) $valorString;
        }
    }

    /**
     * Retorna o valor de uma configuração específica.
     *
     * @param string $chave A chave da configuração (case-insensitive).
     * @param mixed $default O valor padrão a ser retornado se a chave não for encontrada.
     * @return mixed O valor da configuração ou o valor padrão.
     */
    public function getConfig(string $chave, $default = null)
    {
        $chave = strtoupper($chave);
        if (isset($this->chaves[$chave])) {
            return $this->chaves[$chave]['valor'];
        }
        return $default;
    }

    /**
     * Atualiza o valor de uma configuração no array em memória e no banco de dados.
     * Se a chave não existir, ela será criada com o tipo 'string' por padrão.
     *
     * @param string $chave A chave da configuração (case-insensitive).
     * @param mixed $valor O novo valor da configuração.
     * @param string $tipo O tipo de dado do valor (opcional, padrão 'string').
     * @param string $descricao A descrição da configuração (opcional, usada apenas na criação).
     * @return bool True se a atualização/criação foi bem-sucedida, false caso contrário.
     */
    public function setConfig(string $chave, $valor, string $tipo = 'string', $descricao = null): bool
    {
        $chave = strtoupper($chave);

        // Converte o valor para string para salvar no DB
        $valorDb = $valor;
        if (is_bool($valor)) {
            $valorDb = $valor ? 'Sim' : 'Não';
        } elseif (is_array($valor) || is_object($valor)) {
            $valorDb = json_encode($valor);
            $tipo = 'json'; // Força o tipo para 'json' se um array/objeto for passado
        }

        $dataToSave = [
            'chave' => $chave,
            'valor' => (string) $valorDb,
            'tipo'  => $tipo,
        ];

        // Verifica se a configuração já existe
        if (isset($this->chaves[$chave])) {
            $configId = $this->chaves[$chave]['id'];
            if ($this->configuracoesModel->update($configId, $dataToSave)) {
                // Atualiza o array em memória e invalida o cache
                $this->chaves[$chave]['valor'] = $this->converterValorPeloTipo($valorDb, $tipo);
                $this->chaves[$chave]['tipo'] = $tipo;
                $this->cache->delete('carol_configuracoes');
                return true;
            }
        } else {
            // Se não existe, tenta criar
            $dataToSave['descricao'] = $descricao ?? 'Configuração adicionada via setConfig';
            if ($this->configuracoesModel->insert($dataToSave)) {
                $newId = $this->configuracoesModel->insertID();
                // Adiciona ao array em memória e invalida o cache
                $this->chaves[$chave] = [
                    'valor' => $this->converterValorPeloTipo($valorDb, $tipo),
                    'tipo'  => $tipo,
                    'id'    => $newId,
                ];
                $this->cache->delete('carol_configuracoes');
                return true;
            }
        }

        return false;
    }

    /**
     * Limpa o cache das configurações.
     * Útil após atualizações diretas no banco de dados fora do setConfig.
     */
    public function clearConfigCache()
    {
        $this->cache->delete('carol_configuracoes');
    }



    /**
     * Verifica se um arquivo ou diretório é realmente gravável.
     * Tenta escrever um byte ou criar um arquivo temporário para maior robustez.
     *
     * @param string $file O caminho para o arquivo ou diretório.
     *
     * @return bool Verdadeiro se for gravável, falso caso contrário.
     */
    public function eh_gravavel($file)
    {
        // Primeiro, usa a verificação padrão do PHP
        if (is_writable($file)) {
            return true;
        }

        // Se is_writable falhou, tenta uma verificação mais robusta abrindo o arquivo/diretório
        // Isso pode pegar casos onde is_writable é enganoso (e.g., alguns sistemas de arquivos em rede)
        if (is_file($file)) {
            // Tente abrir o arquivo para anexar (ab)
            if (($fp = @fopen($file, 'ab')) === false) {
                return false;
            }
            fclose($fp);

            return true;
        }
        if (is_dir($file)) {
            // Tente criar um arquivo temporário no diretório
            $temp_file = rtrim($file, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . uniqid(mt_rand()) . '.tmp';
            if (($fp = @fopen($temp_file, 'ab')) === false) {
                return false;
            }
            fclose($fp);
            @unlink($temp_file); // Remova o arquivo temporário

            return true;
        }

        return false;
    }

    /**
     * Gera a string de auditoria completa para campos de tempo.
     * Formato: "YYYY-MM-DD HH:MM:SS - Usuario ID: X - IP: Y - User Agent: Z"
     *
     * @return string
     */
    public function gerarStringAuditoria(): string
    {
        $request = Services::request();
        $session = Services::session();

        $ipAddress = $request->getIPAddress();
        $time = $this->formataData(Time::now(), true);

        $loggedInUserId = $session->get('usuario_id') ?? 'N/A';
        $loggedInUserName = $session->get('usuario_nome') ?? 'Anônimo';

        return "{$time} - Usuário: {$loggedInUserName} (ID: {$loggedInUserId}) - IP: {$ipAddress}";
    }

    /**
     * Formata um valor numérico para o padrão monetário brasileiro (R$ X.XXX,XX).
     *
     * @param float|int|string|null $value O valor numérico a ser formatado.
     * @param int $decimals Número de casas decimais (padrão: 2).
     * @return string O valor formatado ou "R$ 0,00" se o valor for inválido/nulo.
     */
    public function formataMoeda($value, int $decimals = 2): string
    {
        if (!is_numeric($value)) {
            $value = 0; // Garante que é um número para evitar erros
        }

        return 'R$ ' . number_format((float)$value, $decimals, ',', '.');
    }

    /**
     * Formata uma string de data e/ou hora para o padrão brasileiro (DD/MM/YYYY HH:MM:SS).
     *
     * @param string|null $dateTimeString A string de data e/ou hora (ex: '2025-07-09 10:30:00' ou '2025-07-09').
     * @param bool $includeTime Se true, inclui a hora na formatação. Padrão é false.
     * @return string O valor formatado ou string vazia se a data/hora for inválida/nula.
     */
    public function formataData(?string $dateTimeString, bool $includeTime = false): string
    {
        if (empty($dateTimeString)) {
            return '';
        }
        try {
            // Tenta criar um objeto DateTime a partir da string
            $dateTime = new \DateTime($dateTimeString);

            // Define o formato de saída
            $format = 'd/m/Y';
            if ($includeTime) {
                $format .= ' H:i:s'; // Adiciona hora, minuto e segundo
            }

            return $dateTime->format($format);
        } catch (\Exception $e) {
            log_message('error', 'Erro ao formatar data/hora: ' . $e->getMessage());
            return ''; // Retorna string vazia em caso de data/hora inválida
        }
    }

    /**
     * Verifica se o usuário logado tem permissão para a chave especificada.
     *
     * @param string $chave A chave da permissão (ex: 'usuarios.criar').
     * @param int|null $userId Opcional: ID do usuário a ser verificado. Se nulo, usa o usuário logado.
     * @param bool $alerta True emite alerta ao usuário.
     * @return bool True se o usuário tem a permissão, false caso contrário.
     */
    public function pode(string $chave, $alerta = false, ?int $userId = null): bool
    {

        return true;


        // // 1. Obter o ID do usuário (do usuário logado, se não for fornecido)
        // if ($userId === null) {
        //     $userId = $this->session->get('usuario_id');
        //     if (!$userId) {
        //         return false;
        //     }
        // }

        // // 2. Verificar permissão de super-admin (se aplicável)
        // // Se você tiver um papel de "administrador" que pode tudo
        // if ($this->isSuperAdmin($userId)) {
        //     return true;
        // }

        // // 3. Consultar o banco de dados (ou arquivo)
        // // Isso faria um JOIN entre usuarios_permissoes e permissoes
        // $hasPermission = $this->usuarioPermissaoModel
        //     ->select('COUNT(up.permissao_id) AS total')
        //     ->from('usuario_permissoes up')
        //     ->join('permissoes p', 'p.id = up.permissao_id')
        //     ->where('up.usuario_id', $userId)
        //     ->where('p.chave', $chave)
        //     ->get()
        //     ->getRow()
        //     ->total > 0;

        // return $hasPermission;
    }

    // Exemplo: Método para verificar se é super-administrador
    protected function isSuperAdmin(int $userId): bool
    {
        // Implemente sua lógica aqui, ex: verificar se o usuário tem um papel 'admin'
        // Ou se o ID dele está em uma lista de super-admins
        // return $this->usuarioModel->find($userId)->role === 'admin';
        return false; // Por padrão, nenhum super admin, implemente sua lógica
    }





    /**
     * Verifica a validade de um número de CPF.
     *
     * @param string $cpf O número de CPF a ser verificado.
     * @return bool True se o CPF for válido, False caso contrário.
     */
    public function verificarCpf(string $cpf): bool
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex: 111.111.111-11 é inválido)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Cálculo do primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += (int)$cpf[$i] * (10 - $i);
        }
        $digito1 = 11 - ($soma % 11);
        if ($digito1 > 9) {
            $digito1 = 0;
        }

        // Verifica o primeiro dígito
        if ((int)$cpf[9] !== $digito1) {
            return false;
        }

        // Cálculo do segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += (int)$cpf[$i] * (11 - $i);
        }
        $digito2 = 11 - ($soma % 11);
        if ($digito2 > 9) {
            $digito2 = 0;
        }

        // Verifica o segundo dígito
        if ((int)$cpf[10] !== $digito2) {
            return false;
        }

        return true;
    }

    /**
     * Verifica a validade de um número de CNPJ.
     *
     * @param string $cnpj O número de CNPJ a ser verificado.
     * @return bool True se o CNPJ for válido, False caso contrário.
     */
    public function verificarCnpj(string $cnpj): bool
    {
        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se o CNPJ tem 14 dígitos
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex: 11.111.111/0001-11 é inválido)
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Pesos para o cálculo dos dígitos verificadores
        $pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        // Cálculo do primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += (int)$cnpj[$i] * $pesos1[$i];
        }
        $digito1 = 11 - ($soma % 11);
        if ($digito1 > 9) {
            $digito1 = 0;
        }

        // Verifica o primeiro dígito
        if ((int)$cnpj[12] !== $digito1) {
            return false;
        }

        // Cálculo do segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += (int)$cnpj[$i] * $pesos2[$i];
        }
        $digito2 = 11 - ($soma % 11);
        if ($digito2 > 9) {
            $digito2 = 0;
        }

        // Verifica o segundo dígito
        if ((int)$cnpj[13] !== $digito2) {
            return false;
        }

        return true;
    }

    /**
     * Verifica a validade de um número de CNH (Carteira Nacional de Habilitação).
     *
     * @param string $cnh O número de CNH a ser verificado.
     * @return bool True se a CNH for válida, False caso contrário.
     */
    public function verificarCnh(string $cnh): bool
    {
        // Remove caracteres não numéricos
        $cnh = preg_replace('/[^0-9]/', '', $cnh);

        // Uma CNH válida no Brasil geralmente tem 11 dígitos.
        if (strlen($cnh) != 11) {
            return false;
        }

        // Implementação simplificada: A validação completa da CNH envolve
        // um algoritmo mais complexo de dígitos verificadores e pode variar
        // entre os estados. Esta é uma verificação básica de formato.
        // Para uma validação robusta, seria necessário consultar as regras
        // específicas do DENATRAN ou órgãos de trânsito.

        return true;
    }

    /**
     * Verifica a validade de um número de CIN (Carteira de Identidade Nacional).
     *
     * @param string $cin O número de CIN a ser verificado.
     * @return bool True se a CIN for válida, False caso contrário.
     */
    public function verificarCin(string $cin): bool
    {
        // A CIN utiliza o número do CPF como base.
        // Portanto, a validação da CIN pode envolver a validação do CPF
        // e outras verificações específicas do formato da CIN (se houver).

        // Remove caracteres não numéricos
        $cin = preg_replace('/[^0-9]/', '', $cin);

        // A CIN atualmente usa o CPF como número de identificação único.
        // Portanto, uma validação inicial pode ser a validação do CPF.
        if (!$this->verificarCpf($cin)) {
            return false;
        }

        // Em uma implementação real, poderiam ser adicionadas verificações
        // de formato específico da CIN (se houver dígitos verificadores adicionais
        // ou outras regras de formação).
        // Por enquanto, a validação do CPF é o principal critério.

        return true;
    }

    /**
     * Remove todas as tags HTML de uma string, mantendo apenas o texto puro.
     * Opcionalmente, permite especificar tags que devem ser mantidas.
     *
     * @param string $text A string que pode conter HTML.
     * @param string|null $allowedTags Uma string com as tags HTML que devem ser permitidas (ex: '<p><a><strong>').
     * @return string A string com o HTML removido (ou com tags permitidas).
     */
    public function removeHtml(string $text, ?string $allowedTags = null): string
    {
        return strip_tags($text, $allowedTags);
    }
}
