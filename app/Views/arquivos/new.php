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
            <form action="<?= base_url('arquivos') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-4 position-relative">
                    <div class="card rounded-3 shadow-sm">
                        <div class="card-header bg-primary text-white rounded-top-3">
                            <h5 class="mb-0">Upload de arquivos</h5>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <div id="dropArea" class="drop-area w-100 mb-4">
                                <p class="mb-2">Arraste e solte seus arquivos aqui</p>
                                <p class="mb-0">ou</p>
                                <input type="file" id="imageInput" accept="image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/plain" class="hidden-file-input">
                                <label for="imageInput" class="btn btn-primary mt-2">
                                    Selecionar Arquivo
                                </label>
                            </div>
                            <img id="imagePreview" class="image-preview img-fluid" src="#" alt="Pré-visualização do Arquivo">
                            <div id="message" class="mt-4 text-center small w-100"></div>
                            <div class="d-flex justify-content-center mt-4">
                                <button id="uploadButton" class="btn btn-success me-2" disabled>
                                    Fazer Upload
                                </button>
                                <button id="clearButton" class="btn btn-warning me-2" disabled>
                                    Limpar Seleção
                                </button>
                                <button id="removeCurrentImageButton" class="btn btn-danger" disabled>
                                    Remover Arquivo Atual
                                </button>
                                <button id="cancelNewFileUploadButton" class="btn btn-secondary ms-2" disabled>
                                    Cancelar Inclusão (Excluir Upload Temporário)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">
                        Descrição
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="<?= old('descricao', esc($registro->descricao ?? '')) ?>">
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
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="sn_visivel_cliente" value="Não">

                            <input class="form-check-input" type="checkbox" role="switch"
                                id="sn_visivel_cliente"
                                name="sn_visivel_cliente"
                                value="Sim"
                                <?php
                                $currentValue = old('sn_visivel_cliente', esc($registro->sn_visivel_cliente ?? ''));
                                if ($currentValue === 'Sim') {
                                    echo 'checked';
                                }
                                ?>>
                            <label class="form-check-label" for="sn_visivel_cliente">Visível para o cliente</label>

                            <?php if (session('errors.sn_visivel_cliente')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.sn_visivel_cliente') ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-3">
                    <?php if (service('Carol')->pode('ARQUIVOS.NOVO')) : ?>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="icon text-white-50">
                                <i class="bi bi-save"></i>
                            </span>
                            <span class="text">Salvar</span>
                        </button>
                    <?php endif; ?>
                    <a href="/arquivos" class="btn btn-secondary ms-1">
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
<script src="<?= base_url('js/arquivos.js') ?>"></script>
<?= $this->endSection() ?>