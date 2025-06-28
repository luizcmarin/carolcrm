<?php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CarolCRM - Instalação Concluída</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('icons/bootstrap-icons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('css/carolcrm.css'); ?>" rel="stylesheet">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    .card-custom {
      max-width: 500px;
      width: 90%;
      padding: 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
      text-align: center;
      background-color: #ffffff;
    }

    .card-custom h2 {
      color: #28a745;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }

    .card-custom p {
      color: #6c757d;
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    .btn-go-app {
      border-color: #007bff;
      padding: 0.75rem 2rem;
      font-size: 1.1rem;
      margin-top: 1.5rem;
      transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-go-app:hover {
      background-color: #0056b3;
      border-color: #004085;
    }

    .warning-text {
      font-size: 0.9rem;
      color: #dc3545;
      margin-top: 2rem;
      border-top: 1px solid #e9ecef;
      padding-top: 1.5rem;
    }

    .warning-text code {
      color: #dc3545;
      background-color: #f8d7da;
      padding: 0.2em 0.4em;
      border-radius: 0.25rem;
    }

    .icon-success {
      font-size: 4rem;
      color: #28a745;
      margin-bottom: 1.5rem;
    }
  </style>
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