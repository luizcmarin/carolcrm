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
            <form action="<?= base_url('arquivos/' . $registro->id) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-5 position-relative">
                    <p>
                        <?php if (str_starts_with($registro->tipo_arquivo, 'image/')) : ?>
                            <img src="<?= base_url('arquivos/thumbnail/' . $registro->id) ?>"
                                alt="<?= esc($registro->nome_original) ?>" style="max-width: 100px; max-height: 100px; object-fit: contain;"
                                onerror="this.onerror=null;this.src='/img/sem-imagem.png';">
                        <?php else : ?>
                            <!-- Ícone para outros tipos de arquivo -->
                            <i class="bi bi-file-earmark-text" style="font-size: 50px;"></i>
                        <?php endif; ?>
                    </p>
                    <p><strong>Nome do arquivo:</strong> <?= $registro->nome_arquivo ?></p>
                    <p><strong>Nome original:</strong> <?= $registro->nome_original ?></p>
                    <p><strong>Tipo:</strong> <?= $registro->tipo_arquivo ?></p>
                    <p><strong>Tamanho:</strong> <?= number_format($registro->tamanho_bytes / 1024, 2) ?> KB</p>
                    <p><strong>Caminho do servidor:</strong> <?= $registro->caminho_servidor ?></p>
                    <p><strong>Url pública:</strong> <?= $registro->url_publica ?></p>
                    <p><strong>Entidade:</strong> <?= $registro->entidade_tipo . ' (' . ($registro->entidade_nome ?? 'N/A') . ')' ?></p>
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
                    <?php if (service('Carol')->pode('ARQUIVOS.EDITAR')) : ?>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="icon text-white-50">
                                <i class="bi bi-save"></i>
                            </span>
                            <span class="text">Atualizar</span>
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
            <p class="mb-0">Criado em: <?= $registro->criado_em ?></p>
            <p class="mb-0">Editado em: <?= $registro->editado_em ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>