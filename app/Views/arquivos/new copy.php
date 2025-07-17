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
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="nome_arquivo" name="nome_arquivo" placeholder="Nome Arquivo" value="<?= old('nome_arquivo') ?>" required>
                    <label for="nome_arquivo">Nome Arquivo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#nome_arquivo"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nome_arquivo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nome_arquivo') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="nome_original" name="nome_original" placeholder="Nome Original" value="<?= old('nome_original') ?>">
                    <label for="nome_original">Nome Original</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#nome_original"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nome_original')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nome_original') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="tipo_arquivo" name="tipo_arquivo" placeholder="Tipo Arquivo" value="<?= old('tipo_arquivo') ?>">
                    <label for="tipo_arquivo">Tipo Arquivo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#tipo_arquivo"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.tipo_arquivo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.tipo_arquivo') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group input-with-copy">
                        <input type="number" class="form-control text-center" id="tamanho_bytes" name="tamanho_bytes"
                            placeholder="Tamanho Bytes" value=""
                            min="0" step="1"> <label for="tamanho_bytes">Tamanho Bytes</label>
                        <button class="btn btn-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.tamanho_bytes')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.tamanho_bytes') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="caminho_servidor" name="caminho_servidor" placeholder="Caminho Servidor" value="<?= old('caminho_servidor') ?>" required>
                    <label for="caminho_servidor">Caminho Servidor</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#caminho_servidor"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.caminho_servidor')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.caminho_servidor') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="url_publica" name="url_publica" placeholder="Url Publica" value="<?= old('url_publica') ?>">
                    <label for="url_publica">Url Publica</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#url_publica"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.url_publica')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.url_publica') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="<?= old('descricao') ?>">
                    <label for="descricao">Descricao</label>
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
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="entidade_tipo" name="entidade_tipo" placeholder="Entidade Tipo" value="<?= old('entidade_tipo') ?>">
                    <label for="entidade_tipo">Entidade Tipo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                        data-clipboard-target="#entidade_tipo"
                        title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.entidade_tipo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.entidade_tipo') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <select class="form-select choices-select" id="entidade_id" name="entidade_id">
                        <option value="" disabled selected><?= esc("Selecione um Entidade Id") ?></option>
                        <?php
                        $selectedValue = old('entidade_id', $arquivos->entidade_id ?? '');
                        if (isset($entidade_options) && is_array($entidade_options)) {
                            foreach ($entidade_options as $optionValue => $optionLabel) {
                                $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="entidade_id" class="form-label choices-label"><?= esc('Entidade Id') ?></label>
                    <?php if (session('errors.entidade_id')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.entidade_id') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="hidden" name="sn_visivel_cliente" value="Não">

                    <input class="form-check-input" type="checkbox" role="switch"
                        id="sn_visivel_cliente"
                        name="sn_visivel_cliente"
                        value="Não">
                    <label class="form-check-label" for="sn_visivel_cliente">Sn Visivel Cliente</label>

                    <?php if (session('errors.sn_visivel_cliente')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.sn_visivel_cliente') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em') ?>">
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
                </div>
                <div class="form-floating mb-3 position-relative input-with-copy">
                    <input type="text" class="form-control" id="editado_em" name="editado_em" placeholder="Editado Em" value="<?= old('editado_em') ?>">
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
<?= $this->endSection() ?>