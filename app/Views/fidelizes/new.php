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
      <h6 class="m-0 text-primary-emphasis">Novo</h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('fidelizes') ?>" method="post">
          <?= csrf_field() ?>
                            <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="nivel_fidelidade1" name="nivel_fidelidade1" placeholder="Nivel Fidelidade1" value="<?= old('nivel_fidelidade1') ?>" >
                  <label for="nivel_fidelidade1">Nivel Fidelidade1</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#nivel_fidelidade1" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nivel_fidelidade1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nivel_fidelidade1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_de1" name="pontos_de1" 
                              placeholder="Pontos De1" value="" 
                              min="0" step="1" > <label for="pontos_de1">Pontos De1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_de1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_de1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_ate1" name="pontos_ate1" 
                              placeholder="Pontos Ate1" value="" 
                              min="0" step="1" > <label for="pontos_ate1">Pontos Ate1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_ate1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_ate1') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="nivel_fidelidade2" name="nivel_fidelidade2" placeholder="Nivel Fidelidade2" value="<?= old('nivel_fidelidade2') ?>" >
                  <label for="nivel_fidelidade2">Nivel Fidelidade2</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#nivel_fidelidade2" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nivel_fidelidade2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nivel_fidelidade2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_de2" name="pontos_de2" 
                              placeholder="Pontos De2" value="" 
                              min="0" step="1" > <label for="pontos_de2">Pontos De2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_de2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_de2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_ate2" name="pontos_ate2" 
                              placeholder="Pontos Ate2" value="" 
                              min="0" step="1" > <label for="pontos_ate2">Pontos Ate2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_ate2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_ate2') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="nivel_fidelidade3" name="nivel_fidelidade3" placeholder="Nivel Fidelidade3" value="<?= old('nivel_fidelidade3') ?>" >
                  <label for="nivel_fidelidade3">Nivel Fidelidade3</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#nivel_fidelidade3" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nivel_fidelidade3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nivel_fidelidade3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_de3" name="pontos_de3" 
                              placeholder="Pontos De3" value="" 
                              min="0" step="1" > <label for="pontos_de3">Pontos De3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_de3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_de3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_ate3" name="pontos_ate3" 
                              placeholder="Pontos Ate3" value="" 
                              min="0" step="1" > <label for="pontos_ate3">Pontos Ate3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_ate3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_ate3') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="nivel_fidelidade4" name="nivel_fidelidade4" placeholder="Nivel Fidelidade4" value="<?= old('nivel_fidelidade4') ?>" >
                  <label for="nivel_fidelidade4">Nivel Fidelidade4</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#nivel_fidelidade4" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nivel_fidelidade4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nivel_fidelidade4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_de4" name="pontos_de4" 
                              placeholder="Pontos De4" value="" 
                              min="0" step="1" > <label for="pontos_de4">Pontos De4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_de4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_de4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="pontos_ate4" name="pontos_ate4" 
                              placeholder="Pontos Ate4" value="" 
                              min="0" step="1" > <label for="pontos_ate4">Pontos Ate4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.pontos_ate4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.pontos_ate4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="faturamento_pontos1" name="faturamento_pontos1" 
                              placeholder="Faturamento Pontos1" value="" 
                              min="0" step="1" > <label for="faturamento_pontos1">Faturamento Pontos1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.faturamento_pontos1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.faturamento_pontos1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_de1" name="valor_faturamento_de1" 
                              placeholder="Valor Faturamento De1" value="" 
                              min="0" step="1" > <label for="valor_faturamento_de1">Valor Faturamento De1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_de1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_de1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_ate1" name="valor_faturamento_ate1" 
                              placeholder="Valor Faturamento Ate1" value="" 
                              min="0" step="1" > <label for="valor_faturamento_ate1">Valor Faturamento Ate1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_ate1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_ate1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="faturamento_pontos2" name="faturamento_pontos2" 
                              placeholder="Faturamento Pontos2" value="" 
                              min="0" step="1" > <label for="faturamento_pontos2">Faturamento Pontos2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.faturamento_pontos2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.faturamento_pontos2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_de2" name="valor_faturamento_de2" 
                              placeholder="Valor Faturamento De2" value="" 
                              min="0" step="1" > <label for="valor_faturamento_de2">Valor Faturamento De2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_de2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_de2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_ate2" name="valor_faturamento_ate2" 
                              placeholder="Valor Faturamento Ate2" value="" 
                              min="0" step="1" > <label for="valor_faturamento_ate2">Valor Faturamento Ate2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_ate2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_ate2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="faturamento_pontos3" name="faturamento_pontos3" 
                              placeholder="Faturamento Pontos3" value="" 
                              min="0" step="1" > <label for="faturamento_pontos3">Faturamento Pontos3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.faturamento_pontos3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.faturamento_pontos3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_de3" name="valor_faturamento_de3" 
                              placeholder="Valor Faturamento De3" value="" 
                              min="0" step="1" > <label for="valor_faturamento_de3">Valor Faturamento De3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_de3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_de3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_ate3" name="valor_faturamento_ate3" 
                              placeholder="Valor Faturamento Ate3" value="" 
                              min="0" step="1" > <label for="valor_faturamento_ate3">Valor Faturamento Ate3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_ate3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_ate3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="faturamento_pontos4" name="faturamento_pontos4" 
                              placeholder="Faturamento Pontos4" value="" 
                              min="0" step="1" > <label for="faturamento_pontos4">Faturamento Pontos4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.faturamento_pontos4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.faturamento_pontos4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_de4" name="valor_faturamento_de4" 
                              placeholder="Valor Faturamento De4" value="" 
                              min="0" step="1" > <label for="valor_faturamento_de4">Valor Faturamento De4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_de4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_de4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_ate4" name="valor_faturamento_ate4" 
                              placeholder="Valor Faturamento Ate4" value="" 
                              min="0" step="1" > <label for="valor_faturamento_ate4">Valor Faturamento Ate4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_ate4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_ate4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="faturamento_pontos5" name="faturamento_pontos5" 
                              placeholder="Faturamento Pontos5" value="" 
                              min="0" step="1" > <label for="faturamento_pontos5">Faturamento Pontos5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.faturamento_pontos5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.faturamento_pontos5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_de5" name="valor_faturamento_de5" 
                              placeholder="Valor Faturamento De5" value="" 
                              min="0" step="1" > <label for="valor_faturamento_de5">Valor Faturamento De5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_de5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_de5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="valor_faturamento_ate5" name="valor_faturamento_ate5" 
                              placeholder="Valor Faturamento Ate5" value="" 
                              min="0" step="1" > <label for="valor_faturamento_ate5">Valor Faturamento Ate5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.valor_faturamento_ate5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor_faturamento_ate5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_pontos1" name="frequencia_pontos1" 
                              placeholder="Frequencia Pontos1" value="" 
                              min="0" step="1" > <label for="frequencia_pontos1">Frequencia Pontos1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_pontos1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_pontos1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_de1" name="frequencia_de1" 
                              placeholder="Frequencia De1" value="" 
                              min="0" step="1" > <label for="frequencia_de1">Frequencia De1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_de1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_de1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_ate1" name="frequencia_ate1" 
                              placeholder="Frequencia Ate1" value="" 
                              min="0" step="1" > <label for="frequencia_ate1">Frequencia Ate1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_ate1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_ate1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_pontos2" name="frequencia_pontos2" 
                              placeholder="Frequencia Pontos2" value="" 
                              min="0" step="1" > <label for="frequencia_pontos2">Frequencia Pontos2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_pontos2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_pontos2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_de2" name="frequencia_de2" 
                              placeholder="Frequencia De2" value="" 
                              min="0" step="1" > <label for="frequencia_de2">Frequencia De2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_de2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_de2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_ate2" name="frequencia_ate2" 
                              placeholder="Frequencia Ate2" value="" 
                              min="0" step="1" > <label for="frequencia_ate2">Frequencia Ate2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_ate2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_ate2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_pontos3" name="frequencia_pontos3" 
                              placeholder="Frequencia Pontos3" value="" 
                              min="0" step="1" > <label for="frequencia_pontos3">Frequencia Pontos3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_pontos3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_pontos3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_de3" name="frequencia_de3" 
                              placeholder="Frequencia De3" value="" 
                              min="0" step="1" > <label for="frequencia_de3">Frequencia De3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_de3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_de3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_ate3" name="frequencia_ate3" 
                              placeholder="Frequencia Ate3" value="" 
                              min="0" step="1" > <label for="frequencia_ate3">Frequencia Ate3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_ate3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_ate3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_pontos4" name="frequencia_pontos4" 
                              placeholder="Frequencia Pontos4" value="" 
                              min="0" step="1" > <label for="frequencia_pontos4">Frequencia Pontos4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_pontos4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_pontos4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_de4" name="frequencia_de4" 
                              placeholder="Frequencia De4" value="" 
                              min="0" step="1" > <label for="frequencia_de4">Frequencia De4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_de4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_de4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_ate4" name="frequencia_ate4" 
                              placeholder="Frequencia Ate4" value="" 
                              min="0" step="1" > <label for="frequencia_ate4">Frequencia Ate4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_ate4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_ate4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_pontos5" name="frequencia_pontos5" 
                              placeholder="Frequencia Pontos5" value="" 
                              min="0" step="1" > <label for="frequencia_pontos5">Frequencia Pontos5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_pontos5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_pontos5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_de5" name="frequencia_de5" 
                              placeholder="Frequencia De5" value="" 
                              min="0" step="1" > <label for="frequencia_de5">Frequencia De5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_de5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_de5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="frequencia_ate5" name="frequencia_ate5" 
                              placeholder="Frequencia Ate5" value="" 
                              min="0" step="1" > <label for="frequencia_ate5">Frequencia Ate5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.frequencia_ate5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.frequencia_ate5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_pontos1" name="permanencia_pontos1" 
                              placeholder="Permanencia Pontos1" value="" 
                              min="0" step="1" > <label for="permanencia_pontos1">Permanencia Pontos1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_pontos1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_pontos1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_de1" name="permanencia_de1" 
                              placeholder="Permanencia De1" value="" 
                              min="0" step="1" > <label for="permanencia_de1">Permanencia De1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_de1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_de1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_ate1" name="permanencia_ate1" 
                              placeholder="Permanencia Ate1" value="" 
                              min="0" step="1" > <label for="permanencia_ate1">Permanencia Ate1</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_ate1')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_ate1') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_pontos2" name="permanencia_pontos2" 
                              placeholder="Permanencia Pontos2" value="" 
                              min="0" step="1" > <label for="permanencia_pontos2">Permanencia Pontos2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_pontos2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_pontos2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_de2" name="permanencia_de2" 
                              placeholder="Permanencia De2" value="" 
                              min="0" step="1" > <label for="permanencia_de2">Permanencia De2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_de2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_de2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_ate2" name="permanencia_ate2" 
                              placeholder="Permanencia Ate2" value="" 
                              min="0" step="1" > <label for="permanencia_ate2">Permanencia Ate2</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_ate2')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_ate2') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_pontos3" name="permanencia_pontos3" 
                              placeholder="Permanencia Pontos3" value="" 
                              min="0" step="1" > <label for="permanencia_pontos3">Permanencia Pontos3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_pontos3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_pontos3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_de3" name="permanencia_de3" 
                              placeholder="Permanencia De3" value="" 
                              min="0" step="1" > <label for="permanencia_de3">Permanencia De3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_de3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_de3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_ate3" name="permanencia_ate3" 
                              placeholder="Permanencia Ate3" value="" 
                              min="0" step="1" > <label for="permanencia_ate3">Permanencia Ate3</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_ate3')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_ate3') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_pontos4" name="permanencia_pontos4" 
                              placeholder="Permanencia Pontos4" value="" 
                              min="0" step="1" > <label for="permanencia_pontos4">Permanencia Pontos4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_pontos4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_pontos4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_de4" name="permanencia_de4" 
                              placeholder="Permanencia De4" value="" 
                              min="0" step="1" > <label for="permanencia_de4">Permanencia De4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_de4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_de4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_ate4" name="permanencia_ate4" 
                              placeholder="Permanencia Ate4" value="" 
                              min="0" step="1" > <label for="permanencia_ate4">Permanencia Ate4</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_ate4')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_ate4') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_pontos5" name="permanencia_pontos5" 
                              placeholder="Permanencia Pontos5" value="" 
                              min="0" step="1" > <label for="permanencia_pontos5">Permanencia Pontos5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_pontos5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_pontos5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_de5" name="permanencia_de5" 
                              placeholder="Permanencia De5" value="" 
                              min="0" step="1" > <label for="permanencia_de5">Permanencia De5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_de5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_de5') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="permanencia_ate5" name="permanencia_ate5" 
                              placeholder="Permanencia Ate5" value="" 
                              min="0" step="1" > <label for="permanencia_ate5">Permanencia Ate5</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.permanencia_ate5')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permanencia_ate5') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em') ?>" >
                  <label for="criado_em">Criado Em</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#criado_em" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.criado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.criado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="editado_em" name="editado_em" placeholder="Editado Em" value="<?= old('editado_em') ?>" >
                  <label for="editado_em">Editado Em</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#editado_em" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.editado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.editado_em') ?>
                        </div>
                    <?php endif ?>
                </div>
          <div class="d-flex justify-content-start mt-3">
              <?php if (service('Carol')->pode('FIDELIZES.NOVO')) : ?>
              <button type="submit" class="btn btn-primary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-save"></i>
                  </span>
                  <span class="text">Salvar</span>
              </button>
              <?php endif; ?>
              <a href="/fidelizes" class="btn btn-secondary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary texto-pequeno">
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>