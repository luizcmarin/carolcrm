<?php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CarolCRM :: Instalação Concluída</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('icons/bootstrap-icons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('css/install.css'); ?>" rel="stylesheet">
 </head>

<body>
  <div class="card-custom">
    <i class="bi bi-check-circle-fill icon-success"></i>
    <h2>Instalação Concluída!</h2>
    <p>Parece que o sistema já está configurado e <br>pronto para ser usado.</p>
    <p>
      <a href="<?= base_url(); ?>" class="btn btn-primary btn-go-app">
        Acessar o Sistema
      </a>
    </p>
    <p class="warning-text">
      <strong>Atenção:</strong> Se você precisa reinstalar o sistema, por favor, **exclua o arquivo do banco de dados**
      manualmente e execute a instalação novamente.
    </p>
  </div>
</body>

</html>