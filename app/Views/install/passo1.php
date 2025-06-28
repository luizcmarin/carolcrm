<form action="<?= base_url('install'); ?>" method="post" accept-charset="utf-8">
  <?= csrf_field(); ?>
  <input type="hidden" name="step" value="1">
  <div class="row">
    <div class="col-md-12">
      <h4 class="fw-bold mb-2">Requisitos da Aplicação</h4>
      <p class="text-muted">
        Por favor, certifique-se de que todos os requisitos sejam atendidos no seu servidor.<br>
        Se algum requisito não for cumprido, entre em contato com o suporte para obter assistência.
      </p>
      <hr />
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Versão do PHP >= 8.4
          <span class="ms-auto">
            <?= $requirement1; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão PDO SQLite
          <span class="ms-auto">
            <?= $requirement2; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão cURL
          <span class="ms-auto">
            <?= $requirement3; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão OpenSSL
          <span class="ms-auto">
            <?= $requirement4; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão MBString
          <span class="ms-auto">
            <?= $requirement5; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão iconv
          <span class="ms-auto">
            <?= $requirement6; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão IMAP
          <span class="ms-auto">
            <?= $requirement7; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão GD
          <span class="ms-auto">
            <?= $requirement8; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          PHP Extensão Zip
          <span class="ms-auto">
            <?= $requirement9; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          allow_url_fopen
          <span class="ms-auto">
            <?= $requirement10; ?>
          </span>
        </li>
      </ul>
      <hr />
      <div class="text-end">
        <?php if ($error === true) { ?>
          <a class="btn btn-primary opacity-50" disabled>Próximo</a>
        <?php } else { ?>
          <button type="submit" class="btn btn-primary">Próximo</button>
        <?php } ?>
      </div>
    </div>
  </div>
</form>