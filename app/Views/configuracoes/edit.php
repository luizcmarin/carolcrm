<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<?php
// Obtém o valor antigo ou o valor do registro, se existir
$selectedTipo = old('tipo', esc($registros->tipo ?? ''));
?>

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
            <form action="<?= base_url('configuracoes/' . $registros->id) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="chave" name="chave" placeholder="Chave" value="<?= old('chave', esc($registros->chave ?? '')) ?>" required>
                    <label for="chave">Chave</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#chave"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.chave')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.chave') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" value="<?= old('categoria', esc($registros->categoria ?? '')) ?>">
                    <label for="categoria">Categoria</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#categoria"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.categoria')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.categoria') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="<?= old('valor', esc($registros->valor ?? '')) ?>">
                    <label for="valor">Valor</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#valor"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.valor')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.valor') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="<?= old('descricao', esc($registros->descricao ?? '')) ?>">
                    <label for="descricao">Descrição</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#descricao"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.descricao')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.descricao') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <select class="form-select" id="tipo" name="tipo" aria-label="Tipo de Campo">
                        <option value="">Selecione um Tipo</option>
                        <?php foreach ($tipos as $value => $label) : ?>
                            <option value="<?= esc($value) ?>" <?= ($selectedTipo === $value) ? 'selected' : '' ?>>
                                <?= esc($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="tipo">Tipo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#tipo"
                        title="Copiar Valor Selecionado">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.tipo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.tipo') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="hidden" name="sn_sistema" value="Não">

                    <input class="form-check-input" type="checkbox" role="switch"
                        id="sn_sistema"
                        name="sn_sistema"
                        value="Sim"
                        <?php
                        $currentValue = old('sn_sistema', esc($registros->sn_sistema ?? ''));
                        if ($currentValue === 'Sim') {
                            echo 'checked';
                        }
                        ?>>
                    <label class="form-check-label" for="sn_sistema">Sistema</label>

                    <?php if (session('errors.sn_sistema')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.sn_sistema') ?>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (session('errors.sn_sistema')) : ?>
                    <div class="invalid-feedback d-block">
                        <?= session('errors.sn_sistema') ?>
                    </div>
                <?php endif ?>
                <div class="d-flex justify-content-start mt-3">
                    <?php if (service('Carol')->pode('CONFIGURACOES.EDITAR')) : ?>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="icon text-white-50">
                                <i class="bi bi-save"></i>
                            </span>
                            <span class="text">Atualizar</span>
                        </button>
                    <?php endif; ?>
                    <a href="/configuracoes" class="btn btn-secondary ms-1">
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