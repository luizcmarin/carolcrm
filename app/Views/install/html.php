<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfex CRM Installation</title>

  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('icons/bootstrap-icons.min.css'); ?>" rel="stylesheet">

  <link href="<?= base_url('css/carolcrm.css'); ?>" rel="stylesheet">

  <style type="text/css">
    body {
      background: #fdfdfd;
    }

    .install_wrapper {
      background: #fff;
      box-shadow: 0px 0px 3px 0px #e2e2e2;
      border-radius: 3px;
      padding: 20px;
      margin-top: 20px;
      margin-bottom: 50px;
    }

    .logo {
      width: 100%;
      text-align: center;
      margin-top: 50px;
    }

    /* Caminho da imagem de logo atualizado aqui */
    .logo img {
      width: 180px;
      /* Ou ajuste para o tamanho da sua imagem */
    }

    .form-control {
      border-radius: 0px;
    }

    .btn {
      border-radius: 0px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="logo">
          <img src="<?= base_url('img/carolcrm/carol.png'); ?>">
        </div>
        <div class="install_wrapper" id="installWrapper">
          <?php if (isset($steps)) { ?>
            <?= $this->include('install/steps'); ?>
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