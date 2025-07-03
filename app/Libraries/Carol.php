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
     * @param int|null $userId
     * @return string
     */
    public function gerarStringAuditoria(?int $userId = null): string
    {
        $request = Services::request();
        $ipAddress = $request->getIPAddress();
        $userAgent = $request->getUserAgent()->getAgentString();
        $time = Time::now()->toDateTimeString(); // YYYY-MM-DD HH:MM:SS

        /** 
         * TODO 
         * 
         * Tenta obter o ID do usuário logado se disponível
         * Isso depende de como sua autenticação está configurada para obter o ID do usuário logado.
         * Se 'user_id' é armazenado na sessão ou em um serviço de autenticação.
         */
        // $loggedInUserId = $userId ?? session()->get('user_id') ?? 'N/A'; // Adapte conforme sua sessão/autenticação

        return "{$time} - Usuario ID: {this->app['usuario_nome']} - IP: {$ipAddress} - User Agent: {$userAgent}";
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
}
