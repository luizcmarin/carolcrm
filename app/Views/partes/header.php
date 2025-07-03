<header class="bg-dark text-white py-2">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <a class="text-white text-decoration-none" href="http://localhost:8080/dashboard">
        <span class="h5 mb-0">CarolCRM - Gestão Inteligente</span>
      </a>
    </div>

    <div class="d-flex align-items-center">

      <div class="nav-item dropdown me-3">
        <a class="nav-link text-white p-0 position-relative" href="#" id="navbarDropdownNotifications" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-bell-fill text-white" style="font-size: 1.5rem; line-height: 1;"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            3 <span class="visually-hidden">notificações não lidas</span>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownNotifications">
          <li><a class="dropdown-item" href="#">Nova mensagem de cliente</a></li>
          <li><a class="dropdown-item" href="#">Projeto "X" com prazo vencido</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Ver todas as notificações</a></li>
        </ul>
      </div>

      <div class="dropdown me-3">
        <button class="btn btn-link text-white dropdown-toggle d-flex align-items-center p-0"
          id="bd-theme"
          type="button"
          aria-expanded="false"
          data-bs-toggle="dropdown"
          data-bs-display="static">
          <i class="theme-icon-active" style="font-size: 1.5rem; line-height: 1;"></i>
          <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem;">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
              <i class="bi bi-sun-fill me-2"></i> Light
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
              <i class="bi bi-moon-fill me-2"></i> Dark
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto">
              <i class="bi bi-circle-half me-2"></i> Auto
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
        </ul>
      </div>

      <button class="btn btn-primary" id="sidebarToggle" type="button">
        <i class="bi bi-list text-white" style="font-size: 1.5rem; line-height: 1;"></i>
      </button>
    </div>
  </div>
</header>