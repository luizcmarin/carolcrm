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
            <form action="<?= base_url('usuarios') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card mb-3">
                    <div class="card-header fw-bold">
                        Principal
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= old('nome') ?>" required>
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
                        <div class="form-floating mb-3 position-relative">
                            <select class="form-select choices-select" id="usuario_grupo_id" name="usuario_grupo_id" required>
                                <option value="" disabled selected><?= esc("Selecione um grupo") ?></option>
                                <?php
                                $selectedValue = old('usuario_grupo_id', $usuarios->usuario_grupo_id ?? '');
                                if (isset($usuario_grupo_options) && is_array($usuario_grupo_options)) {
                                    foreach ($usuario_grupo_options as $optionValue => $optionLabel) {
                                        $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                        echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="usuario_grupo_id" class="form-label choices-label"><?= esc('Grupo') ?></label>
                            <?php if (session('errors.usuario_grupo_id')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.usuario_grupo_id') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="<?= old('celular') ?>">
                            <label for="celular">Celular</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#celular"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.celular')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.celular') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?= old('telefone') ?>">
                            <label for="telefone">Telefone</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#telefone"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.telefone')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.telefone') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="email" name="email" placeholder="seu.email@example.com" value="<?= old('email') ?>" required>
                            <label for="email">Email</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#email"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <div class="invalid-feedback">
                                Por favor, insira um endereço de email válido.
                            </div>
                            <div class="valid-feedback">
                                Email válido!
                            </div>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.email')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">
                        Endereço
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereco" value="<?= old('endereco') ?>">
                            <label for="endereco">Endereço</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#endereco"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.endereco')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.endereco') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= old('bairro') ?>">
                            <label for="bairro">Bairro</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#bairro"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.bairro')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.bairro') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <select class="form-select choices-select" id="cidade_id" name="cidade_id" required>
                                <option value="" disabled selected><?= esc("Selecione a cidade") ?></option>
                                <?php
                                $selectedValue = old('cidade_id', $usuarios->cidade_id ?? '');
                                if (isset($cidade_options) && is_array($cidade_options)) {
                                    foreach ($cidade_options as $optionValue => $optionLabel) {
                                        $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                        echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="cidade_id" class="form-label choices-label"><?= esc('Cidade') ?></label>
                            <?php if (session('errors.cidade_id')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.cidade_id') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" maxlength="9" value="<?= old('cep') ?>">
                            <label for="cep">CEP</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#cep"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.cep')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.cep') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="<?= old('complemento') ?>">
                            <label for="complemento">Complemento</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#complemento"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.complemento')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.complemento') ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header fw-bold">
                        Dados pessoais
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <label for="redes_sociais" class="choices-label">Redes Sociais</label>
                            <textarea id="redes_sociais" name="redes_sociais" class="form-control" style="height: 150px;" placeholder="Redes Sociais"><?= old('redes_sociais') ?></textarea>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#redes_sociais"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.redes_sociais')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.redes_sociais') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <select class="form-select choices-select" id="genero" name="genero" required>
                                <option value="" disabled selected><?= esc("Selecione o gênero") ?></option>
                                <?php
                                $selectedValue = old('genero', $usuarios->genero ?? '');
                                if (isset($genero_options) && is_array($genero_options)) {
                                    foreach ($genero_options as $optionValue => $optionLabel) {
                                        $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                        echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="genero" class="form-label choices-label"><?= esc('Gênero') ?></label>
                            <?php if (session('errors.genero')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.genero') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00"
                                maxlength="14" value="<?= old('cpf', esc($registros->cpf ?? '')) ?>">
                            <label for="cpf">CPF</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#cpf"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <div id="cpf-feedback" class="feedback-invalid"></div>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.cpf')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.cpf') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative input-with-copy">
                            <input type="text" class="form-control" id="documentos" name="documentos" placeholder="Documentos" value="<?= old('documentos') ?>">
                            <label for="documentos">Documentos</label>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#documentos"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.documentos')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.documentos') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <select class="form-select choices-select" id="cargo_id" name="cargo_id">
                                <option value="" disabled selected><?= esc("Selecione o cargo") ?></option>
                                <?php
                                $selectedValue = old('cargo_id', $usuarios->cargo_id ?? '');
                                if (isset($cargo_options) && is_array($cargo_options)) {
                                    foreach ($cargo_options as $optionValue => $optionLabel) {
                                        $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                        echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="cargo_id" class="form-label choices-label"><?= esc('Cargo') ?></label>
                            <?php if (session('errors.cargo_id')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.cargo_id') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <select class="form-select choices-select" id="profissao_id" name="profissao_id">
                                <option value="" disabled selected><?= esc("Selecione a profissão") ?></option>
                                <?php
                                $selectedValue = old('profissao_id', $usuarios->profissao_id ?? '');
                                if (isset($profissao_options) && is_array($profissao_options)) {
                                    foreach ($profissao_options as $optionValue => $optionLabel) {
                                        $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                        echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="profissao_id" class="form-label choices-label"><?= esc('Profissão') ?></label>
                            <?php if (session('errors.profissao_id')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.profissao_id') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <select class="form-select choices-select" id="nacionalidade_id" name="nacionalidade_id">
                                <option value="" disabled selected><?= esc("Selecione a nacionalidade") ?></option>
                                <?php
                                $selectedValue = old('nacionalidade_id', $usuarios->nacionalidade_id ?? '');
                                if (isset($nacionalidade_options) && is_array($nacionalidade_options)) {
                                    foreach ($nacionalidade_options as $optionValue => $optionLabel) {
                                        $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                        echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="nacionalidade_id" class="form-label choices-label"><?= esc('Nacionalidade') ?></label>
                            <?php if (session('errors.nacionalidade_id')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.nacionalidade_id') ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">
                        Sobre você
                    </div>
                    <div class="card-body">
                        <div class="mb-3 position-relative input-with-copy">
                            <label for="sobre" class="form-labels">Fale sobre você para exibir no seu perfil</label>
                            <textarea id="sobre" name="sobre" class="form-control" style="height: 300px;"><?= old('sobre') ?></textarea>
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#sobre"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.sobre')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.sobre') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="mb-3 position-relative input-with-copy">
                            <label for="assinatura_email" class="form-labels">Assinatura Email (aparecerá no rodapé dos emails e documentos)</label>
                            <input type="text" class="form-control" id="assinatura_email" name="assinatura_email" placeholder="Assinatura Email" value="<?= old('assinatura_email') ?>">
                            <button class="btn btn-sm btn-light copy-button-textarea" type="button"
                                data-clipboard-target="#assinatura_email"
                                title="Copiar">
                                <i class="bi bi-clipboard"></i>
                            </button>
                            <span class="copy-feedback-message-external"></span>
                            <?php if (session('errors.assinatura_email')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.assinatura_email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">
                        Configurações de usuário
                    </div>
                    <div class="card-body">
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="sn_administrador" value="Não">
                            <input class="form-check-input" type="checkbox" role="switch" id="sn_administrador" name="sn_administrador" value="Não">
                            <label class="form-check-label" for="sn_administrador">É Administrador</label>
                            <?php if (session('errors.sn_administrador')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.sn_administrador') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input type="hidden" name="sn_ativo" value="Não">
                            <input class="form-check-input" type="checkbox" role="switch" id="sn_ativo" name="sn_ativo" value="Não">
                            <label class="form-check-label" for="sn_ativo">Ativo</label>
                            <?php if (session('errors.sn_ativo')) : ?>
                                <div class="invalid-feedback d-block">
                                    <?= session('errors.sn_ativo') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="input-group position-relative mb-3">
                            <span class="input-group-text">Usuário</span>
                            <input type="text" id="nome_usuario" name="nome_usuario" class="form-control" placeholder="Nome de usuário"
                                value="<?= old('nome_usuario') ?>"
                                required
                                aria-label="Nome de Usuário"
                                aria-describedby="nome-usuario">
                            <button class="btn btn-outline-secondary fw-bold"
                                type="button"
                                id="gerar_nome_usuario_btn"
                                tabindex="-1">
                                Gerar nome
                            </button>
                        </div>
                        <div class="input-group position-relative mb-3">
                            <span class="input-group-text">Senha</span>
                            <input
                                type="text"
                                id="senha"
                                name="senha"
                                required
                                class="form-control"
                                placeholder="Senha"
                                aria-label="Senha"
                                aria-describedby="senha">
                            <button
                                class="btn btn-outline-secondary fw-bold"
                                type="button"
                                id="gerar_senha_btn"
                                tabindex="-1">
                                Gerar senha
                            </button>
                        </div>
                        <div class="input-group position-relative mb-3">
                            <button
                                class="btn btn-outline-secondary rounded-end-3 fw-bold"
                                type="button"
                                id="copy_credentials_btn"
                                title="Copiar Nome de Usuário e Senha"
                                tabindex="-1">
                                <i class="bi bi-clipboard"></i> Copiar as credenciais
                            </button>
                        </div>
                        <span class="copy-feedback-message-external"></span>
                        <?php if (session('errors.nome_usuario')) : ?>
                            <div class="invalid-feedback d-block mt-1">
                                <?= session('errors.nome_usuario') ?>
                            </div>
                        <?php endif ?>
                        <?php if (session('errors.senha')) : ?>
                            <div class="invalid-feedback d-block mt-1">
                                <?= session('errors.senha') ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php if (service('Carol')->pode('USUARIOS.UPLOAD')) : ?>
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header fw-bold rounded-top-3">
                            Foto do perfil
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <div id="dropArea" class="drop-area w-100 mb-4">
                                <p class="mb-2">Arraste e solte sua imagem aqui</p>
                                <p class="mb-0">ou</p>
                                <input type="file" id="imageInput" accept="image/*" class="hidden-file-input">
                                <label for="imageInput" class="btn btn-primary mt-2">
                                    Selecionar Arquivo
                                </label>
                            </div>
                            <img id="imagePreview" class="image-preview img-fluid" src="#" alt="Pré-visualização do Arquivo">
                            <div id="message" class="mt-4 text-center small w-100"></div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" id="uploadButton" class="btn btn-success me-2" disabled>
                                    Fazer Upload
                                </button>
                                <button type="button" id="clearButton" class="btn btn-warning me-2" disabled>
                                    Limpar Seleção
                                </button>
                                <button type="button" id="removeCurrentImageButton" class="btn btn-danger" disabled>
                                    Remover Imagem Atual
                                </button>
                                <button type="button" id="cancelNewUserUploadButton" class="btn btn-secondary ms-2" disabled>
                                    Cancelar Inclusão (Excluir Upload Temporário)
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="d-flex justify-content-start mt-3">
                    <?php if (service('Carol')->pode('USUARIOS.NOVO')) : ?>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="icon text-white-50">
                                <i class="bi bi-save"></i>
                            </span>
                            <span class="text">Salvar</span>
                        </button>
                    <?php endif; ?>
                    <a href="/usuarios" class="btn btn-secondary ms-1">
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
<script>
    const USER_ID = <?= json_encode($userData['id'] ?? null) ?>;
    const CURRENT_IMAGE_ID = <?= json_encode($userData['imagem_id'] ?? null) ?>;
    const CURRENT_IMAGE_URL = '<?= ($currentImage['url_publica'] ?? false) ? $currentImage['url_publica'] : SEM_IMAGEM ?>';
</script>
<script src="<?= base_url('js/usuarios.js') ?>"></script>
<?= $this->endSection() ?>