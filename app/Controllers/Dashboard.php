<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
  public function index()
  {
    // Dados que você pode passar para a view
    $data = [
      'title' => 'Dashboard do Sistema',
      'page_title' => 'Visão Geral',
      // 'alerts' => '<div class="alert alert-success">Bem-vindo ao CarolCRM!</div>' // Exemplo de alerta
    ];

    // Carrega a view principal de layout
    // A view 'dashboard/index' será renderizada dentro da seção 'content' de 'layout/main'
    return view('dashboard/index', $data);
  }
}
