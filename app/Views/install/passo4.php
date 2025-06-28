<form action="<?= base_url('install'); ?>" method="post" accept-charset="utf-8">
  <?= csrf_field(); ?>
  <input type="hidden" name="step" value="4">
  <?php
  if (isset($db_credentials)) {
    echo '<input type="hidden" name="hostname" value="' . esc($db_credentials['hostname']) . '">';
    echo '<input type="hidden" name="username" value="' . esc($db_credentials['username']) . '">';
    echo '<input type="hidden" name="password" value="' . esc($db_credentials['password']) . '">';
    echo '<input type="hidden" name="database" value="' . esc($db_credentials['database']) . '">';
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <h4 class="fw-bold mb-0">Login e Configurações do Administrador</h4>
      <p class="text-muted">
        Insira a URL base da sua aplicação e os detalhes da conta de administrador.
      </p>
      <hr />
      <?php if (isset($admin_error) && $admin_error === true) { ?>
        <div class="alert alert-danger" role="alert">
          <?= isset($admin_error_msg) ? $admin_error_msg : 'Ocorreu um erro. Por favor, verifique o formulário e tente novamente.'; ?>
        </div>
      <?php } ?>
      <div class="mb-3">
        <label for="base_url" class="form-label">URL Base (ex: http://seudominio.com/carolcrm/)</label>
        <input type="url" class="form-control" name="base_url" id="base_url"
          value="<?= set_value('base_url', $base_url); ?>">
      </div>
      <div class="mb-3">
        <label for="timezone" class="form-label">Fuso Horário Padrão</label>
        <select name="timezone" id="timezone" class="form-control">
          <?php
          $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
          foreach ($timezones as $tz) {
            echo '<option value="' . esc($tz) . '"' . (set_select('timezone', $tz, (isset($timezone) && $timezone === $tz))) . '>' . esc($tz) . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="firstname" class="form-label">Nome do Administrador</label>
        <input type="text" class="form-control" name="firstname" id="firstname"
          value="<?= set_value('firstname'); ?>">
      </div>
      <div class="mb-3">
        <label for="lastname" class="form-label">Sobrenome do Administrador</label>
        <input type="text" class="form-control" name="lastname" id="lastname"
          value="<?= set_value('lastname'); ?>">
      </div>
      <div class="mb-3">
        <label for="admin_email" class="form-label">E-mail do Administrador</label>
        <input type="email" class="form-control" name="admin_email" id="admin_email"
          value="<?= set_value('admin_email'); ?>">
      </div>
      <div class="mb-3">
        <label for="admin_password" class="form-label">Senha do Administrador</label>
        <input type="password" class="form-control" name="admin_password" id="admin_password"
          value="<?= set_value('admin_password'); ?>">
      </div>
      <div class="mb-3">
        <label for="admin_passwordr" class="form-label">Repetir Senha do Administrador</label>
        <input type="password" class="form-control" name="admin_passwordr" id="admin_passwordr"
          value="<?= set_value('admin_passwordr'); ?>">
      </div>
      <hr />
      <div class="text-end">
        <button type="submit" class="btn btn-primary" id="installButton">Iniciar a instalação</button>
        <span class="spinner-border spinner-border-sm text-primary ms-2" role="status" aria-hidden="true" id="loadingSpinner" style="display: none;"></span>
      </div>
    </div>
  </div>
</form>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const installButton = document.getElementById('installButton');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const installForm = installButton.closest('form'); // Encontra o formulário pai do botão

    if (installForm && installButton && loadingSpinner) {
      installForm.addEventListener('submit', function() {
        // Desabilita o botão para evitar cliques múltiplos
        installButton.disabled = true;
        // Altera o texto do botão
        installButton.innerHTML = 'Instalando...';
        // Mostra o spinner
        loadingSpinner.style.display = 'inline-block';
      });
    }
  });
</script>