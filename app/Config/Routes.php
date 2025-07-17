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


  $routes->resource('avisos');
  $routes->resource('bancos');
  $routes->resource('cargos');
  $routes->resource('cidades');
  $routes->resource('nacionalidades');
  $routes->resource('configuracoes');
  $routes->resource('paises');
  $routes->resource('permissoes');
  $routes->resource('profissoes');
  $routes->resource('UsuarioGrupos');
  $routes->resource('usuarios');

  // Rotas para upload de arquivos
  $routes->post('arquivos/upload', 'Arquivos::upload');
  $routes->post('arquivos/removeUserImage', 'Arquivos::removeUserImage');
  $routes->post('arquivos/deleteTemporaryImage', 'Arquivos::deleteTemporaryImage');
  $routes->get('arquivos/download/(:num)', 'Arquivos::download/$1');
  $routes->get('arquivos/thumbnail/(:num)', 'Arquivos::serveThumbnail/$1');
  $routes->get('arquivos/delete/(:num)', 'Arquivos::delete/$1');
  $routes->resource('arquivos');
}
