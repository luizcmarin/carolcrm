<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="mb-0 text-primary-emphasis"><?= $titulo ?></h5>
  </div>

  <?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        <?php foreach (session('errors') as $error) : ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <?php if (session()->has('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 text-primary-emphasis">Editar</h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('cursos/' . $registros->id) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="form-floating mb-3 position-relative input-with-copy">
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= old('nome', esc($registros->nome ?? '')) ?>" required>
          <label for="nome">Nome</label>
          <button class="btn btn-sm btn-light copy-button-textarea" type="button"
            data-clipboard-target="#nome"
            title="Copiar">
            <i class="bi bi-clipboard"></i>
          </button>
          <span class="copy-feedback-message-external"></span>
          <?php if (session('errors.nome')) : ?>
            <div class="invalid-feedback d-block">
              <?= session('errors.nome') ?>
            </div>
          <?php endif ?>
        </div>
        <div class="form-floating mb-3 position-relative input-with-copy">
          <div class="form-group mb-3">
            <label for="texto">Texto</label>
            <textarea class="form-control" id="texto" name="texto" rows="10" placeholder="Digite seu texto aqui..." required><?= old('texto', esc($registros->texto ?? '')) ?></textarea>
          </div>
          <label for="texto">Texto</label>
          <button class="btn btn-sm btn-light copy-button-textarea" type="button"
            data-clipboard-target="#texto"
            title="Copiar">
            <i class="bi bi-clipboard"></i>
          </button>
          <span class="copy-feedback-message-external"></span>
          <?php if (session('errors.texto')) : ?>
            <div class="invalid-feedback d-block">
              <?= session('errors.texto') ?>
            </div>
          <?php endif ?>
        </div>
        <div class="d-flex justify-content-start mt-3">
          <?php if (service('Carol')->pode('CURSOS.EDITAR')) : ?>
            <button type="submit" class="btn btn-primary ms-1">
              <span class="icon text-white-50">
                <i class="bi bi-save"></i>
              </span>
              <span class="text">Atualizar</span>
            </button>
          <?php endif; ?>
          <a href="/cursos" class="btn btn-secondary ms-1">
            <span class="icon text-white-50">
              <i class="bi bi-arrow-left"></i>
            </span>
            <span class="text">Voltar</span>
          </a>
        </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary texto-pequeno">
      <p class="mb-0">Criado em: <?= $registros->criado_em ?></p>
      <p class="mb-0">Editado em: <?= $registros->editado_em ?></p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>