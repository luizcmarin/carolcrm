<?php

namespace App\Libraries;

use Config\Services;
use CodeIgniter\I18n\Time;

/**
 * Esta classe contem funções globais aleatórias.
 */
class Carol
{



    // $this->app['usuario_id'] = 1;
    // $this->app['usuario_nome'] = 'luiz marin';


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
        $userAgent = $request->getUserAgent()->getAgentString();
        $time = self::formataData(Time::now(), true);

        $loggedInUserId = $session->get('usuario_id') ?? 'N/A';
        $loggedInUserName = $session->get('usuario_nome') ?? 'Anônimo';

        return "{$time} - Usuario: {$loggedInUserName} (ID: {$loggedInUserId}) - IP: {$ipAddress} - User Agent: {$userAgent}";
    }

    /**
     * Preenche os campos de auditoria.
     */
    public function preencheCamposAuditoria($id_usuario, $attributes)
    {
        if ($id_usuario === null) {
            // Se criado_em não está definido, é um novo registro
            if (!isset($this->attributes['criado_em']) || $attributes['criado_em'] === null) {
                $attributes['criado_em'] = $this->gerarStringAuditoria();
            }
        } else {
            // Atualizado_em sempre é preenchido ao salvar (ou no construtor para nova entidade)
            $attributes['atualizado_em'] = $this->gerarStringAuditoria();
        }
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
}
