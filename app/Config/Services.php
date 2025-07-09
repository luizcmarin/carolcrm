<?php

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{

    /*
     * Classe Carol disponivel em toda a aplicação, inclusive nas views.
     */
    public static function Carol($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('Carol');
        }

        return new \App\Libraries\Carol();
    }
}
