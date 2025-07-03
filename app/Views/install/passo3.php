<form action="<?= base_url('install'); ?>" method="post" accept-charset="utf-8">
  <?= csrf_field(); ?>
  <input type="hidden" name="step" value="3">
  <div class="row">
    <div class="col-md-12">
      <div class="text-center">
        <h4 class="fw-bold mb-4">
          <p>O Banco de Dados CarolCRM</p>
          <img class="logo mt-0" src="img/carolcrm/sqlite370_banner.svg" alt="SQLite" border="0" style="width: 130px;">
        </h4>
      </div>
      <div class="text-justify">
        <p>
          <strong>CarolCRM</strong> utiliza <strong>SQLite3</strong>, uma escolha inteligente para sistemas portáteis.
          Sendo um <strong>banco de dados leve e totalmente baseado em arquivo</strong>,
          ele se destaca de soluções mais complexas como MySQL ou PostgreSQL,
          eliminando a necessidade de um servidor de banco de dados dedicado externo.
        </p>
        <p>
          Esta abordagem oferece <strong>vantagens essenciais</strong>:
        </p>
        <ul>
          <li><strong>Instalação Simplificada</strong>: Comece a usar <strong>CarolCRM</strong> rapidamente, sem se preocupar com configurações complexas de servidor ou credenciais de banco de dados.</li>
          <li><strong>Portabilidade Otimizada</strong>: Com o banco de dados contido em um único arquivo, backups, migrações e movimentações do sistema entre ambientes se tornam incrivelmente fáceis.</li>
          <li><strong>Eficiência e Desempenho</strong>: Para a maioria das operações de CRM, o SQLite oferece performance ágil e confiável, garantindo que <strong>CarolCRM</strong> seja responsivo e eficiente.</li>
          <li><strong>Manutenção Reduzida</strong>: Desfrute de um sistema com menor complexidade de gerenciamento, permitindo que você foque mais nas suas tarefas e menos na infraestrutura.</li>
          <li><strong>Pronto para Usar</strong>: Ideal para quem busca uma solução rápida para organizar clientes e projetos, o SQLite possibilita que você esteja operacional em minutos.</li>
        </ul>
        <p>
          O arquivo do banco de dados e seu esquema serão configurados e gerenciados automaticamente pelo sistema na próxima etapa, garantindo uma experiência de uso fluida desde o início.
        </p>
      </div>
      <hr />
      <div class="text-end"> <button type="submit" class="btn btn-primary">Próximo</button>
      </div>
    </div>
  </div>
</form>