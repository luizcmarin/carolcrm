<?php

namespace App\Controllers;

use Config\Services;
use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

abstract class BaseController extends Controller
{
    protected $Carol;
    protected $request;
    protected $helpers = ['form', 'url', 'html', 'pager', 'filesystem', 'download'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->Carol = Services::Carol();






        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }
}
