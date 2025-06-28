<?php
?>
<form action="<?= url_to('Install::index'); ?>" method="post" accept-charset="utf-8">
  <?= csrf_field(); ?>
  <input type="hidden" name="step" value="1">
  <div class="row">
    <div class="col-md-12">
      <h4 class="fw-bold mb-0">Requerimentos da Aplicação</h4>
      <p class="text-muted">
        Please make sure that all requirements are passed on your server.
        <br />
        If any requirements fail, please contact your hosting provider for assistance.
      </p>
      <hr />
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Version >= 8.1
          <span class="ms-auto">
            <?= $requirement1; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          MySQLi PHP Extension
          <span class="ms-auto">
            <?= $requirement2; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PDO PHP Extension
          <span class="ms-auto">
            <?= $requirement3; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          cURL PHP Extension
          <span class="ms-auto">
            <?= $requirement4; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          OpenSSL PHP Extension
          <span class="ms-auto">
            <?= $requirement5; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          MBString PHP Extension
          <span class="ms-auto">
            <?= $requirement6; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          iconv PHP Extension
          <span class="ms-auto">
            <?= $requirement7; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          IMAP PHP Extension
          <span class="ms-auto">
            <?= $requirement8; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          GD PHP Extension
          <span class="ms-auto">
            <?= $requirement9; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Zip PHP Extension
          <span class="ms-auto">
            <?= $requirement10; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          allow_url_fopen
          <span class="ms-auto">
            <?= $requirement11; ?>
          </span>
        </li>
      </ul>
      <hr />
      <div class="text-end">
        <?php if ($error === true) { ?>
          <a class="btn btn-primary opacity-50" disabled>Next</a>
        <?php } else { ?>
          <button type="submit" class="btn btn-primary">Next</button>
        <?php } ?>
      </div>
    </div>
  </div>
</form>