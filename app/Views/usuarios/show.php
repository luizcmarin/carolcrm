    <?= $this->extend('layout/principal') ?>
    <?= $this->section('content') ?>

    <div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 text-primary-emphasis"><?= $titulo ?></h5>
      </div>

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 text-primary-emphasis">Detalhes</h6>
        </div>
        <div class="card-body">
              <p><strong>Nome:</strong> <?= $registros->nome ?></p>    <p><strong>Usuario Grupo Id:</strong> <?= $registros->usuario_grupo_nome ?? 'N/A' ?></p>    <p><strong>Celular:</strong> <?= $registros->celular ?></p>    <p><strong>Telefone:</strong> <?= $registros->telefone ?></p>    <p><strong>Email:</strong> <?= $registros->email ?></p>    <p><strong>Imagem Perfil:</strong> <?= $registros->imagem_perfil ?></p>    <p><strong>Sobre:</strong> <?= $registros->sobre ?></p>    <p><strong>Endereco:</strong> <?= $registros->endereco ?></p>    <p><strong>Bairro:</strong> <?= $registros->bairro ?></p>    <p><strong>Cidade Id:</strong> <?= $registros->cidade_nome ?? 'N/A' ?></p>    <p><strong>Cep:</strong> <?= $registros->cep ?></p>    <p><strong>Complemento:</strong> <?= $registros->complemento ?></p>    <p><strong>Redes Sociais:</strong> <?= $registros->redes_sociais ?></p>    <p><strong>Genero:</strong> <?= $registros->genero ?></p>    <p><strong>Cpf:</strong> <?= $registros->cpf ?></p>    <p><strong>Documentos:</strong> <?= $registros->documentos ?></p>    <p><strong>Cargo Id:</strong> <?= $registros->cargo_nome ?? 'N/A' ?></p>    <p><strong>Profissao Id:</strong> <?= $registros->profissao_nome ?? 'N/A' ?></p>    <p><strong>Nacionalidade Id:</strong> <?= $registros->nacionalidade_nome ?? 'N/A' ?></p>    <p><strong>Assinatura Email:</strong> <?= $registros->assinatura_email ?></p>    <p><strong>Senha:</strong> <?= $registros->senha ?></p>    <p><strong>Ultimo Ip:</strong> <?= $registros->ultimo_ip ?></p>    <p><strong>Data Ultimo Login:</strong> <?= $registros->data_ultimo_login ?></p>    <p><strong>Sn Administrador:</strong> <?= $registros->sn_administrador ?></p>    <p><strong>Sn Ativo:</strong> <?= $registros->sn_ativo ?></p>    <p><strong>Criado Em:</strong> <?= $registros->criado_em ?></p>    <p><strong>Editado Em:</strong> <?= $registros->editado_em ?></p>
          <div class="d-flex justify-content-start mt-4">
              <?php if (service('Carol')->pode('USUARIOS.EDITAR')) : ?>
              <a href="/usuarios/<?= $registros->id ?>/edit ?>" class="btn btn-warning ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-pencil"></i>
                  </span>
                  <span class="text">Editar</span>
              </a>
              <?php endif; ?>
              <a href="/usuarios" class="btn btn-secondary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
        </div>
        <div class="card-footer text-body-secondary texto-pequeno">
          <p class="mb-0">Criado em: <?= $registros->criado_em ?></p>
          <p class="mb-0">Editado em: <?= $registros->editado_em ?></p>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>