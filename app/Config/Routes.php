<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Verifica se o arquivo do banco de dados NÃO existe.
// Se não existir, significa que a aplicação AINDA NÃO ESTÁ instalada,
// então permitimos o acesso à rota de instalação e bloqueamos o resto.
if (! file_exists(CAROL_DB)) {
  // Redireciona todas as requisições (exceto assets) para o instalador
  $routes->get('/', 'Install::index'); // Sua rota principal do instalador
  $routes->get('install', 'Install::index');
  $routes->post('/install', 'Install::index'); // Para lidar com submissões de formulário

  // Bloqueia todas as outras rotas da aplicação para evitar acesso antes da instalação
  $routes->addPlaceholder('segment', '([a-zA-Z0-9_-]+)'); // Adiciona placeholder para reuso

  $routes->group('/', static function ($routes) {
    $routes->setDefaultController('Install'); // Garante que qualquer rota não definida vá para o instalador
    $routes->addRedirect('/', 'Install::index'); // Redireciona a raiz
    $routes->addRedirect('{segment}', 'Install::index'); // Redireciona qualquer segmento
    $routes->addRedirect('{segment}/{segment}', 'Install::index'); // Redireciona múltiplos segmentos
  });
} else {
  // Se o banco de dados EXISTE, a aplicação está instalada.
  // Define as rotas normais da aplicação e bloqueia as rotas de instalação.

  // Isso garante que a rota '/install' seja anulada ou redirecionada
  $routes->get('install', static function () {
    return redirect()->to(base_url()); // Redireciona para a raiz do site
  });

  // dashboard
  $routes->get('/', 'Dashboard::index');
  $routes->get('/dashboard', 'Dashboard::index');



  $routes->group('usuarios', function ($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('new', 'Usuarios::new');
    $routes->post('create', 'Usuarios::create');
    $routes->get('edit/(:num)', 'Usuarios::edit/$1');
    $routes->put('update/(:num)', 'Usuarios::update/$1');
    $routes->get('show/(:num)', 'Usuarios::show/$1');
    $routes->delete('delete/(:num)', 'Usuarios::delete/$1');
  });
} 

// TODO
// /**
//  * Dashboard clean route
//  */
// // Rota para a área administrativa
// $routes->get('admin', 'Admin\Dashboard::index');

// /**
//  * Misc controller routes
//  */
// $routes->get('admin/access_denied', 'Admin\Misc::access_denied');
// $routes->get('admin/not_found', 'Admin\Misc::not_found');

// /**
//  * Staff Routes
//  */
// $routes->get('admin/profile', 'Admin\Staff::profile');
// $routes->get('admin/profile/(:num)', 'Admin\Staff::profile/$1');
// // A rota 'admin/tasks/view/(:any)' no CI3 mapeava para 'admin/tasks/index/$1'.
// // Se 'index' é o método padrão ou uma função específica para visualização de tarefas.
// // Se 'index' é para listar e 'view' para ver detalhes, o segundo é mais adequado.
// $routes->get('admin/tasks/view/(:any)', 'Admin\Tasks::index/$1');

// /**
//  * Items search rewrite
//  */
// $routes->get('admin/items/search', 'Admin\InvoiceItems::search');
 
// $routes->get('viewinvoice/(:num)/(:any)', 'Invoice::index/$1/$2');
// $routes->get('invoice/(:num)/(:any)', 'Invoice::index/$1/$2');

// $routes->get('viewestimate/(:num)/(:any)', 'Estimate::index/$1/$2');
// $routes->get('estimate/(:num)/(:any)', 'Estimate::index/$1/$2');

// $routes->get('subscription/(:any)', 'Subscription::index/$1');

// $routes->get('viewproposal/(:num)/(:any)', 'Proposal::index/$1/$2');
// $routes->get('proposal/(:num)/(:any)', 'Proposal::index/$1/$2');

// $routes->get('contract/(:num)/(:any)', 'Contract::index/$1/$2');
 
// $routes->get('knowledge-base', 'KnowledgeBase::index');
// $routes->get('knowledge-base/search', 'KnowledgeBase::search');
// // Estes podem ser redundantes se a rota com (:any) abaixo já cobrir.
// // Dependendo da lógica, pode ser 'index' ou 'article' para a base.
// $routes->get('knowledge-base/article', 'KnowledgeBase::index');
// $routes->get('knowledge-base/article/(:any)', 'KnowledgeBase::article/$1');
// $routes->get('knowledge-base/category', 'KnowledgeBase::index');
// $routes->get('knowledge-base/category/(:any)', 'KnowledgeBase::category/$1');
 
// $routes->get('knowledge-base/(:any)', 'KnowledgeBase::article/$1');
// $routes->get('knowledge_base/(:any)', 'KnowledgeBase::article/$1');
// $routes->get('clients/knowledge_base/(:any)', 'KnowledgeBase::article/$1');
// $routes->get('clients/knowledge-base/(:any)', 'KnowledgeBase::article/$1');
 
// $routes->get('clients/reset_password', 'Authentication::reset_password');
// $routes->get('clients/forgot_password', 'Authentication::forgot_password');
// $routes->get('clients/logout', 'Authentication::logout');
// $routes->get('clients/register', 'Authentication::register');
// $routes->get('clients/login', 'Authentication::login');
 
// $routes->get('reset_password', 'Authentication::reset_password');
// $routes->get('forgot_password', 'Authentication::forgot_password');
// $routes->get('login', 'Authentication::login');
// $routes->get('logout', 'Authentication::logout');
// $routes->get('register', 'Authentication::register');

// /**
//  * Terms and conditions and Privacy Policy routes
//  */
// $routes->get('terms-and-conditions', 'Terms_and_conditions::index');
// $routes->get('privacy-policy', 'Privacy_policy::index');

// /**
//  * @since 2.3.0
//  * Rotas para admin/modules
//  * Assumindo que 'Admin\Mods' é o controlador correto.
//  * Cuidado com `$1` e `$2` no segundo e terceiro caso: no CI4, se você usar `$1` no controlador,
//  * ele se refere ao primeiro segmento após o prefixo da rota. Se a ideia é mapear para
//  * métodos dinâmicos ou IDs, a rota `(:any)` e o `$1` ou `$2` no destino estão corretos.
//  */
// $routes->get('admin/modules', 'Admin\Mods::index');
// $routes->get('admin/modules/(:any)', 'Admin\Mods::$1'); // Mapeia para um método com o nome do segmento
// $routes->get('admin/modules/(:any)/(:any)', 'Admin\Mods::$1/$2'); // Mapeia para um método e passa um parâmetro

// // Public single ticket route
// $routes->get('forms/tickets/(:any)', 'Forms::public_ticket/$1');

// /**
//  * @since 2.3.0
//  * Rota para autenticação/definição de senha de clientes/staff.
//  * Mapeado para Admin\Authentication assumindo que o controlador está lá.
//  */
// $routes->get('authentication/set_password/(:num)/(:num)/(:any)', 'Admin\Authentication::set_password/$1/$2/$3');

// // Para compatibilidade regressiva de pesquisas
// $routes->get('survey/(:num)/(:any)', 'Surveys\Participate::index/$1/$2');
