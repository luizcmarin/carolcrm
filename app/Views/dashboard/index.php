<?= $this->extend('layout/principal') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <h1>Olá, Marin! Bem-vindo ao CarolCRM.</h1>
    <p>Esta é a área de conteúdo do seu dashboard. Tudo que você vê aqui vem de `app/Views/dashboard/index.php`.</p>
    <p>Seu layout (cabeçalho, barra lateral, navbar, rodapé) está sendo carregado por `app/Views/layout/main.php`.</p>
    <div class="alert alert-info mt-4" role="alert">
      <i class="fa-solid fa-info-circle me-2"></i>
      Experimente clicar no botão "Toggle Sidebar" na navbar para ver a barra lateral se recolher!
    </div>
    <div class="card mt-4">
      <div class="card-body">
        <h5 class="card-title">Exemplo de Card</h5>
        <p class="card-text">Aqui você pode adicionar widgets, gráficos, ou qualquer outro elemento do seu dashboard.</p>
        <a href="#" class="btn btn-primary">Ver Detalhes</a>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  console.log('Scripts específicos do dashboard foram carregados.');
</script>
<?= $this->endSection() ?>