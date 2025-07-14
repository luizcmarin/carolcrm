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
      <form action="<?= base_url('usuarios/' . $registros->id) ?>" method="post">
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
                </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="usuario_grupo_id" name="usuario_grupo_id" required>
                              <option value="" disabled selected><?= esc("Selecione um Usuario Grupo Id") ?></option>
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
                          <label for="usuario_grupo_id" class="form-label choices-label"><?= esc('Usuario Grupo Id') ?></label>
                          <?php if (session('errors.usuario_grupo_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.usuario_grupo_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="<?= old('celular', esc($registros->celular ?? '')) ?>" >
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?= old('telefone', esc($registros->telefone ?? '')) ?>" >
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= old('email', esc($registros->email ?? '')) ?>" required>
                  <label for="email">Email</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#email" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.email')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.email') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="imagem_perfil" name="imagem_perfil" placeholder="Imagem Perfil" value="<?= old('imagem_perfil', esc($registros->imagem_perfil ?? '')) ?>" >
                  <label for="imagem_perfil">Imagem Perfil</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#imagem_perfil" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.imagem_perfil')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.imagem_perfil') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="sobre" name="sobre" placeholder="Sobre" value="<?= old('sobre', esc($registros->sobre ?? '')) ?>" >
                  <label for="sobre">Sobre</label>
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereco" value="<?= old('endereco', esc($registros->endereco ?? '')) ?>" >
                  <label for="endereco">Endereco</label>
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= old('bairro', esc($registros->bairro ?? '')) ?>" >
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
                </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="cidade_id" name="cidade_id" required>
                              <option value="" disabled selected><?= esc("Selecione um Cidade Id") ?></option>
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
                          <label for="cidade_id" class="form-label choices-label"><?= esc('Cidade Id') ?></label>
                          <?php if (session('errors.cidade_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.cidade_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="cep" name="cep" placeholder="Cep" value="<?= old('cep', esc($registros->cep ?? '')) ?>" >
                  <label for="cep">Cep</label>
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="<?= old('complemento', esc($registros->complemento ?? '')) ?>" >
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="redes_sociais" name="redes_sociais" placeholder="Redes Sociais" value="<?= old('redes_sociais', esc($registros->redes_sociais ?? '')) ?>" >
                  <label for="redes_sociais">Redes Sociais</label>
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="genero" name="genero" placeholder="Genero" value="<?= old('genero', esc($registros->genero ?? '')) ?>" >
                  <label for="genero">Genero</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#genero" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.genero')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.genero') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Cpf" value="<?= old('cpf', esc($registros->cpf ?? '')) ?>" >
                  <label for="cpf">Cpf</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#cpf" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.cpf')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.cpf') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="documentos" name="documentos" placeholder="Documentos" value="<?= old('documentos', esc($registros->documentos ?? '')) ?>" >
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
                </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="cargo_id" name="cargo_id" >
                              <option value="" disabled selected><?= esc("Selecione um Cargo Id") ?></option>
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
                          <label for="cargo_id" class="form-label choices-label"><?= esc('Cargo Id') ?></label>
                          <?php if (session('errors.cargo_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.cargo_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="profissao_id" name="profissao_id" >
                              <option value="" disabled selected><?= esc("Selecione um Profissao Id") ?></option>
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
                          <label for="profissao_id" class="form-label choices-label"><?= esc('Profissao Id') ?></label>
                          <?php if (session('errors.profissao_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.profissao_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="nacionalidade_id" name="nacionalidade_id" >
                              <option value="" disabled selected><?= esc("Selecione um Nacionalidade Id") ?></option>
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
                          <label for="nacionalidade_id" class="form-label choices-label"><?= esc('Nacionalidade Id') ?></label>
                          <?php if (session('errors.nacionalidade_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.nacionalidade_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="assinatura_email" name="assinatura_email" placeholder="Assinatura Email" value="<?= old('assinatura_email', esc($registros->assinatura_email ?? '')) ?>" >
                  <label for="assinatura_email">Assinatura Email</label>
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
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?= old('senha', esc($registros->senha ?? '')) ?>" required>
                  <label for="senha">Senha</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#senha" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.senha')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.senha') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="ultimo_ip" name="ultimo_ip" placeholder="Ultimo Ip" value="<?= old('ultimo_ip', esc($registros->ultimo_ip ?? '')) ?>" >
                  <label for="ultimo_ip">Ultimo Ip</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#ultimo_ip" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.ultimo_ip')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.ultimo_ip') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3 input-with-copy">
                    <input type="date" class="form-control datepicker-input" id="data_ultimo_login" name="data_ultimo_login" placeholder="Data Ultimo Login" 
                        value="<?= old('data_ultimo_login', esc($registros->data_ultimo_login ?? '')) ?>" 
                        >
                    <label for="data_ultimo_login">Data Ultimo Login</label>
                <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                        data-clipboard-target="#data_ultimo_login" 
                        title="Copiar">
                    <i class="bi bi-clipboard"></i>
                </button>
                <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.data_ultimo_login')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.data_ultimo_login') ?>
                        </div>
                    <?php endif ?>
                </div>       <div class="mb-3 form-check form-switch">
                    <input type="hidden" name="sn_administrador" value="Não"> 
                    
                    <input class="form-check-input" type="checkbox" role="switch" 
                           id="sn_administrador" 
                           name="sn_administrador" 
                           value="Sim" 
                           <?php 
                               $currentValue = old('sn_administrador', esc($registros->sn_administrador ?? ''));
                               if ($currentValue === 'Sim') {
                                   echo 'checked';
                               }
                           ?> >
                    <label class="form-check-label" for="sn_administrador">Sn Administrador</label>
                    
                    <?php if (session('errors.sn_administrador')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.sn_administrador') ?>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (session('errors.sn_administrador')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.sn_administrador') ?>
                </div>
            <?php endif ?>
        </div>       <div class="mb-3 form-check form-switch">
                    <input type="hidden" name="sn_ativo" value="Não"> 
                    
                    <input class="form-check-input" type="checkbox" role="switch" 
                           id="sn_ativo" 
                           name="sn_ativo" 
                           value="Sim" 
                           <?php 
                               $currentValue = old('sn_ativo', esc($registros->sn_ativo ?? ''));
                               if ($currentValue === 'Sim') {
                                   echo 'checked';
                               }
                           ?> >
                    <label class="form-check-label" for="sn_ativo">Sn Ativo</label>
                    
                    <?php if (session('errors.sn_ativo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.sn_ativo') ?>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (session('errors.sn_ativo')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.sn_ativo') ?>
                </div>
            <?php endif ?>
        </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em', esc($registros->criado_em ?? '')) ?>" >
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
                  <input type="text" class="form-control" id="editado_em" name="editado_em" placeholder="Editado Em" value="<?= old('editado_em', esc($registros->editado_em ?? '')) ?>" >
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
              <?php if (service('Carol')->pode('USUARIOS.EDITAR')) : ?>
              <button type="submit" class="btn btn-primary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-save"></i>
                  </span>
                  <span class="text">Atualizar</span>
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
      <p class="mb-0">Criado em: <?= $registros->criado_em ?></p>
      <p class="mb-0">Editado em: <?= $registros->editado_em ?></p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>