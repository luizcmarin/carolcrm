<form action="<?= site_url('install'); ?>" method="post" accept-charset="utf-8">
  <?= csrf_field(); ?>
  <input type="hidden" name="step" value="4">
  <?php
  // Hidden fields for database credentials
  // These are passed from step 3 to step 4, and then back to the controller for performInstallation
  if (isset($db_credentials)) {
    echo '<input type="hidden" name="hostname" value="' . esc($db_credentials['hostname']) . '">';
    echo '<input type="hidden" name="username" value="' . esc($db_credentials['username']) . '">';
    echo '<input type="hidden" name="password" value="' . esc($db_credentials['password']) . '">';
    echo '<input type="hidden" name="database" value="' . esc($db_credentials['database']) . '">';
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <h4 class="fw-bold mb-0">Admin Login & Settings</h4>
      <p class="text-muted">
        Enter your base URL and administrator account details.
      </p>
      <hr />
      <?php if (isset($admin_error) && $admin_error === true) { ?>
        <div class="alert alert-danger" role="alert">
          <?= isset($admin_error_msg) ? $admin_error_msg : 'An error occurred. Please check the form and try again.'; ?>
        </div>
      <?php } ?>
      <div class="mb-3">
        <label for="base_url" class="form-label">Base URL (e.g. http://yourdomain.com/crm/)</label>
        <input type="url" class="form-control" name="base_url" id="base_url"
          value="<?= set_value('base_url', $base_url); ?>">
      </div>
      <div class="mb-3">
        <label for="timezone" class="form-label">Default Timezone</label>
        <select name="timezone" id="timezone" class="form-control">
          <?php
          $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
          foreach ($timezones as $tz) {
            echo '<option value="' . esc($tz) . '"' . (set_select('timezone', $tz, (isset($timezone) && $timezone === $tz))) . '>' . esc($tz) . '</option>';
          }
          ?>
        </select>
      </div>
      <hr />
      <div class="mb-3">
        <label for="firstname" class="form-label">Administrator First Name</label>
        <input type="text" class="form-control" name="firstname" id="firstname"
          value="<?= set_value('firstname'); ?>">
      </div>
      <div class="mb-3">
        <label for="lastname" class="form-label">Administrator Last Name</label>
        <input type="text" class="form-control" name="lastname" id="lastname"
          value="<?= set_value('lastname'); ?>">
      </div>
      <div class="mb-3">
        <label for="admin_email" class="form-label">Administrator Email</label>
        <input type="email" class="form-control" name="admin_email" id="admin_email"
          value="<?= set_value('admin_email'); ?>">
      </div>
      <div class="mb-3">
        <label for="admin_password" class="form-label">Administrator Password</label>
        <input type="password" class="form-control" name="admin_password" id="admin_password"
          value="<?= set_value('admin_password'); ?>">
      </div>
      <div class="mb-3">
        <label for="admin_passwordr" class="form-label">Administrator Password Repeat</label>
        <input type="password" class="form-control" name="admin_passwordr" id="admin_passwordr"
          value="<?= set_value('admin_passwordr'); ?>">
      </div>
      <hr />
      <div class="text-end">
        <button type="submit" class="btn btn-primary">Install</button>
      </div>
    </div>
  </div>
</form>