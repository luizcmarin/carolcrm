<?php

declare(strict_types=1); ?>

<aside id="menu" class="sidebar bg-dark text-white">
  <div class="dropdown sidebar-user-profile py-4 px-3 border-bottom border-secondary">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="https://perfexcrm.com/demo/uploads/staff_profile_images/1/small_1.png" class="img-fluid rounded-circle staff-profile-image-small me-3" alt="Avatar">
      <div>
        <span class="d-block fw-bold text-truncate custom-name-width">Gino Schaefer</span>
        <span class="d-block text-sm text-muted text-truncate custom-email-width">admin@test.com</span>
      </div>
    </a>
    <ul class="dropdown-menu w-100 mt-2">
      <li><a class="dropdown-item" href="https://perfexcrm.com/demo/admin/profile">Meu Perfil</a></li>
      <li><a class="dropdown-item" href="https://perfexcrm.com/demo/admin/staff/timesheets">Minhas Horas</a></li>
      <li><a class="dropdown-item" href="https://perfexcrm.com/demo/admin/staff/edit_profile">Editar Perfil</a></li>
      <li class="dropdown-submenu dropend">
        <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Idioma</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item active" href="https://perfexcrm.com/demo/admin/staff/change_language">Padrão do Sistema</a></li>
          <li><a class="dropdown-item" href="https://perfexcrm.com/demo/admin/staff/change_language/norwegian">Norueguês</a></li>
          <li><a class="dropdown-item" href="https://perfexcrm.com/demo/admin/staff/change_language/portuguese_br">Português (BR)</a></li>
        </ul>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="#" onclick="logout(); return false;">Sair</a></li>
    </ul>
  </div>

  <ul class="nav flex-column py-3" id="side-menu">
    <li class="nav-item active">
      <a class="nav-link text-white" href="<?= base_url('dashboard') ?>">
        <i class="bi bi-grid-1x2-fill menu-icon me-2"></i> <!-- Ícone de Dashboard -->
        <span class="menu-text">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="<?= base_url('clientes') ?>">
        <i class="bi bi-person-fill menu-icon me-2"></i> <!-- Ícone de Clientes -->
        <span class="menu-text">Clientes</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-bs-toggle="collapse" href="#sales-submenu" role="button" aria-expanded="false" aria-controls="sales-submenu">
        <i class="bi bi-lightning-fill menu-icon me-2"></i> <!-- Ícone de Vendas -->
        <span class="menu-text">Vendas</span>
        <i class="bi bi-chevron-down float-end menu-arrow"></i> <!-- Ícone de seta para baixo -->
      </a>
      <div class="collapse" id="sales-submenu" data-bs-parent="#side-menu">
        <ul class="nav flex-column ps-4 pt-1">
          <li><a class="nav-link text-white-50" href="<?= base_url('propostas') ?>">Propostas</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('orcamentos') ?>">Orçamentos</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('faturas') ?>">Faturas</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('pagamentos') ?>">Pagamentos</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('notas-credito') ?>">Notas de Crédito</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('itens-fatura') ?>">Itens</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="<?= base_url('assinaturas') ?>">
        <i class="bi bi-arrow-repeat menu-icon me-2"></i> <!-- Ícone de Assinaturas -->
        <span class="menu-text">Assinaturas</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-bs-toggle="collapse" href="#cadastros-submenu" role="button" aria-expanded="false" aria-controls="sales-submenu">
        <i class="bi bi-journal-text menu-icon me-2"></i> <!-- Ícone de Cadastros (alterado para algo mais genérico) -->
        <span class="menu-text">Cadastros</span>
        <i class="bi bi-chevron-down float-end menu-arrow"></i> <!-- Ícone de seta para baixo -->
      </a>
      <div class="collapse" id="cadastros-submenu" data-bs-parent="#side-menu">
        <ul class="nav flex-column ps-4 pt-1">
          <li><a class="nav-link text-white-50" href="<?= base_url('bancos') ?>">Bancos</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('cargos') ?>">Cargos</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('cidades') ?>">Cidades</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('nacionalidades') ?>">Nacionalidades</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('paises') ?>">Países</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('profissoes') ?>">Profissões</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-bs-toggle="collapse" href="#configuracoes-submenu" role="button" aria-expanded="false" aria-controls="sales-submenu">
        <i class="bi bi-gear-fill menu-icon me-2"></i> <!-- Ícone de Administração/Configurações -->
        <span class="menu-text">Administração</span>
        <i class="bi bi-chevron-down float-end menu-arrow"></i> <!-- Ícone de seta para baixo -->
      </a>
      <div class="collapse" id="configuracoes-submenu" data-bs-parent="#side-menu">
        <ul class="nav flex-column ps-4 pt-1">
          <li><a class="nav-link text-white-50" href="<?= base_url('avisos') ?>">Avisos</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('configuracoes') ?>">Configurações</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('usuarios') ?>">Usuários</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('usuario_grupos') ?>">Grupos de Usuários</a></li>
          <li><a class="nav-link text-white-50" href="<?= base_url('permissoes') ?>">Permissões</a></li>
        </ul>
      </div>
    </li>
  </ul>

  <div class="pinned-section p-3 border-top border-secondary">
    <div class="pinned-separator pb-2 mb-2"></div>
    <div class="pinned_project">
      <a href="https://perfexcrm.com/demo/admin/projects/view/2" data-bs-toggle="tooltip" data-bs-placement="right" title="Projeto Fixado" class="text-white text-decoration-none">
        Otimização de SEO<br>
        <small class="text-muted">Gusikowski, Weimann e Koepp</small>
      </a>
      <div class="mt-2">
        <div class="progress" style="height: 8px;">
          <div class="progress-bar bg-info" role="progressbar" style="width: 46.67%;" aria-valuenow="46.67" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</aside>