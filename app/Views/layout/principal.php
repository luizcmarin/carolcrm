<?php

declare(strict_types=1); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= (isset($title) ? $title . ' - ' : '') ?>CarolCRM</title>
  <link rel="icon" href="<?= base_url('img/favicon.ico') ?>" type="image/x-icon">


  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('icons/bootstrap-icons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('css/choices.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('css/air-datepicker.css'); ?>" rel="stylesheet">


  <link rel="stylesheet" href="<?= base_url('css/carolcrm.css') ?>">

  <?= $this->renderSection('styles') ?>
</head>

<body class="layout-boxed" data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="10">
  <div id="load_screen">
    <div class="loader">
      <div class="loader-content">
        <div class="d-flex justify-content-between mx-5 mt-3 mb-5">
          <div class="spinner-border text-success align-self-center loader-lg"></div>
          <div class="spinner-border text-danger align-self-center"></div>
          <div class="spinner-border text-warning align-self-center loader-sm"></div>
        </div>
      </div>
    </div>
  </div>

  <header>
    <?= $this->include('partes/header') ?>
  </header>

  <div class="main-container" id="main-container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <?= $this->include('partes/sidebar') ?>

    <div id="content" class="main-content">
      <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
          <div class="container-fluid mt-4 mb-5">
            <?= $this->renderSection('breadcrumb') ?>

            <?php if (isset($alerts)) : ?>
              <?= $alerts ?>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $this->include('partes/footer') ?>

  <script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('js/sweetalert2.min.js') ?>"></script>
  <script src="<?= base_url('js/choices.js') ?>"></script>
  <script src="<?= base_url('js/air-datepicker.js'); ?>"></script>
  <script src="<?= base_url('js/locales/air-datepicker-pt-BR.js'); ?>"></script>
  <script src="<?= base_url('js/carolcrm.js') ?>"></script>
  <?= $this->renderSection('scripts') ?>
</body>

</html>