<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CarolCRM :: Instalação</title>

  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('icons/bootstrap-icons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('css/install.css'); ?>" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="logo">
          <p align="center">
          <h1 align="center">CarolCRM</h1>
          </p>

          <img src="<?= base_url('img/carolcrm/carol.png'); ?>">
        </div>
        <div class="install_wrapper" id="installWrapper">
          <?php if (isset($steps)) { ?>
            <?= $this->include('install/passos'); ?>
          <?php } ?>
          <?php
          if (isset($page) && !empty($page)) {
            echo $this->include('install/' . $page);
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>

</body>

</html>