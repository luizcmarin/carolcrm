<p align="center">

</p>

<h1 align="center">CarolCRM: Sistema de CRM para Gerenciamento de Clientes</h1>

<p align="center">
  <img alt="Status do CI/CD - Análise de Qualidade (Psalm, ComposerRequireChecker)" src="https://github.com/luizcmarin/CarolCRM/actions/workflows/quality_checks.yml/badge.svg?branch=main">
</p>

<p align="center">
  Um sistema de Customer Relationship Management (CRM) completo e intuitivo, desenvolvido com CodeIgniter 4, para auxiliar pequenas e médias empresas a gerenciar seus clientes, interações, vendas e pipelines de forma eficiente.
</p>

<p align="center">
  Construído com foco em modularidade, performance e facilidade de uso, o CarolCRM é a ferramenta ideal para otimizar seus processos de relacionamento com o cliente.
</p>


**CarolCRM** é um software de Gerenciamento de Relacionamento com o Cliente (CRM) auto-hospedado, perfeito para quase todas as empresas, freelancers e diversas outras utilizações. Com seu design limpo e moderno, **CarolCRM** pode ajudar você a parecer mais profissional para seus clientes e, ao mesmo tempo, melhorar o desempenho do seu negócio.

Gerenciar clientes é crucial, e **CarolCRM** auxilia de várias maneiras:

* **Gerenciamento de Projetos:** Gerencie e fature projetos com o poderoso recurso de gerenciamento de projetos.
* **Organização de Tarefas:** Vincule tarefas a diversas funcionalidades do **CarolCRM** para se manter organizado.
* **Orçamentos e Faturas Profissionais:** Crie orçamentos e faturas com uma ótima aparência e profissionalismo.
* **Sistema de Suporte Robusto:** Sistema de suporte poderoso com capacidade de importação automática de tickets.
* **Rastreamento de Tempo:** Acompanhe o tempo gasto em tarefas e fature seus clientes. Capacidade de atribuir múltiplos membros da equipe a uma tarefa e rastrear o tempo por cada membro.
* **Seguidores de Tarefas:** Adicione seguidores a tarefas, mesmo que o membro da equipe não seja parte do projeto. O membro da equipe poderá acompanhar o progresso da tarefa sem acessar o projeto.
* **Gestão de Leads Centralizada:** Mantenha o controle de leads em um só lugar e acompanhe facilmente seu progresso. Capacidade de importar leads automaticamente de e-mail, adicionar notas, criar propostas. Organize seus leads em etapas e mude as etapas facilmente com arrastar e soltar (drag and drop).
* **Propostas Atraentes:** Crie propostas atraentes para leads ou clientes e aumente suas vendas.
* **Registro de Despesas:** Registre as despesas da sua empresa/projeto com a capacidade de faturá-las aos seus clientes e converter automaticamente em fatura.
* **CRM Poderoso:** Saiba mais sobre seus clientes com um CRM robusto.
* **Retenção de Clientes:** Aumente a retenção de clientes por meio de Pesquisas (Surveys) integradas.
* **Rastreamento de Metas:** Utilize o recurso de Rastreamento de Metas para manter os objetivos de vendas em mente.
* **Comunicados Internos e Externos:** Crie comunicados para seus funcionários e clientes.
* **Gerenciamento de Contratos:** Utilize o recurso de Contratos para garantir vendas atuais e futuras.
* **Campos Personalizados:** Campos personalizados podem armazenar informações extras para clientes, leads e muito mais.
* **Pagamentos Integrados:** Receba pagamentos via PayPal e Stripe em diferentes moedas.
* **Opções Configuráveis:** Toneladas de opções configuráveis.
* **Personalização de Marca:** Estilize o CRM com a identidade visual da sua empresa usando o poderoso recurso de personalização de tema.
* **Pasta de Mídia Separada:** Pasta de mídia separada para que membros da equipe que não são administradores possam trabalhar dentro do CRM e organizar seus uploads e arquivos.
* **Calendário Integrado:** Ótimo calendário para cada membro da equipe, baseado nas permissões de cada um.
* **Funcionalidades Adicionais:** Acompanhamentos, relatórios, notas, arquivos e muitos outros recursos.

CRMs precisam focar nos clientes, e **CarolCRM** faz exatamente isso com um **poderoso sistema de suporte** que ajuda você a rastrear e resolver problemas rapidamente através do sistema de tickets integrado e lembretes para clientes. Atribua lembretes a si mesmo, a um ou vários membros da equipe, e com um clique, os lembretes podem ser enviados por e-mail e no sistema de notificação interno do aplicativo. Esses recursos e muito mais podem levar a satisfação do cliente ao próximo nível.

**CarolCRM** possui muitos recursos projetados para se adequar a diversas aplicações. Leia mais sobre os recursos abaixo e experimente a demonstração para ver como **CarolCRM** pode ajudar você a ter sucesso.

## Requisitos

- PHP 8.4 ou superior.

## Instalação

Para configurar **CarolCRM** em sua máquina, siga os passos abaixo:

1.  **Obtenha o Código-Fonte:**
    Você tem duas opções para obter o código do projeto:

      * **Via Git (Recomendado):** Se você tem o Git instalado, abra seu terminal ou prompt de comando e clone o repositório:
        ```shell
        git clone https://github.com/luizcmarin/CarolCRM.git
        ```
      * **Via Download Direto:** Se preferir, você pode baixar o código-fonte compactado diretamente do GitHub:
        1.  Acesse a página do repositório no GitHub: [https://github.com/luizcmarin/CarolCRM](https://github.com/luizcmarin/CarolCRM)
        2.  Clique no botão verde **"Code"** (Código) e depois em **"Download ZIP"** (Baixar ZIP).
        3.  Após o download, descompacte o arquivo `.zip` em um diretório de sua escolha (ex: `C:\CarolCRM`).

2.  **Acesse o Diretório do Projeto:**
    Não importa como você obteve o código, entre na pasta principal do **CarolCRM** (o diretório que contém arquivos como `composer.json` e a pasta `app`).

    ```shell
    cd CarolCRM
    ```

3.  **Instale as Dependências do Composer:**
    **CarolCRM** utiliza o [Composer](https://getcomposer.org) para gerenciar suas bibliotecas e dependências. Se você ainda não tem o Composer instalado, siga as instruções em [getcomposer.org/download](https://getcomposer.org/download/).

    No diretório do projeto (`CarolCRM`), execute o comando para instalar todas as dependências:

    ```shell
    composer install
    ```

Após esses passos, **CarolCRM** estará pronto para as configurações iniciais.

## Configuração Inicial

Depois de obter o código-fonte e instalar as dependências do Composer, **CarolCRM** precisa de alguns ajustes e da execução do seu instalador. Siga estes passos com calma:

### 1. Ative o Spark (Servidor de Desenvolvimento CodeIgniter)

Para facilitar o desenvolvimento e a execução do instalador no seu computador, você pode usar o servidor de desenvolvimento embutido do CodeIgniter, chamado **Spark**.

  * **Abra seu Terminal ou Prompt de Comando:** Navegue até a pasta principal do seu projeto **CarolCRM** (o mesmo diretório onde você executou `composer install` e onde está o arquivo `spark`).

    ```shell
    cd CarolCRM
    ```

  * **Inicie o Servidor:** Execute o seguinte comando:

    ```shell
    php spark serve
    ```

    Você verá uma mensagem no terminal indicando que o servidor foi iniciado, algo como: `CodeIgniter development server started on http://localhost:8080` (o número da porta pode variar).

    **Mantenha este terminal aberto** enquanto estiver usando **CarolCRM** localmente, pois ele mantém o servidor funcionando.

    **Importante:** Se você for hospedar **CarolCRM** em um servidor de internet (como um provedor de hospedagem), **não precisará usar o comando `php spark serve`**. O servidor web (Apache, Nginx, etc.) do seu provedor já fará esse trabalho de exibir o site. Nesse caso, você pularia este passo e iria direto para o próximo.

### 2. Execute o Instalador do CarolCRM

Agora é a hora de finalizar a instalação! **CarolCRM** tem um instalador que configurará as informações básicas no seu arquivo `.env` e criará as tabelas do banco de dados para você.

  * Abra seu navegador (Chrome, Firefox, Edge, etc.).

  * **Se você estiver usando o Spark (no seu computador):**
    Na barra de endereço, digite o endereço que o comando `php spark serve` mostrou, adicionando `/install` ao final.

    **Exemplo (usando a porta padrão 8080):**
    `http://localhost:8080/install`

  * **Se você estiver em um servidor de internet (hospedagem):**
    Use o endereço do seu domínio, adicionando `/install` ao final.

    **Exemplo:**
    `https://seusite.com.br/install`

  * Pressione `Enter`. Siga as instruções na tela. O instalador fará automaticamente a configuração e criará o banco de dados com todas as tabelas necessárias. Se tudo estiver correto, você verá uma mensagem informando que a instalação foi concluída com sucesso!

### 3. Acessar o Sistema

Depois que o instalador terminar, você pode clicar no botão "Acessar o Sistema" ou simplesmente navegar para a URL principal do seu site no seu navegador.

  * **Exemplo (com Spark):** Se o seu Spark está rodando em `http://localhost:8080`, você acessará o sistema em `http://localhost:8080`.
  * **Exemplo (em hospedagem):** Se seu site está em `https://seusite.com.br/`, você acessará o sistema em `https://seusite.com.br/`.
 
Pronto! Agora **CarolCRM** deve estar funcionando. Se tiver qualquer dúvida ou encontrar algum erro, veja a documentação.

## Documentação

Se você precisar de ajuda ou tiver alguma pergunta, visitar o [forum de discussões](https://github.com/luizcmarin/CarolCRM/discussions) é um bom lugar para isso. Você também pode checar nossa [wiki](https://github.com/luizcmarin/CarolCRM/wiki).

## Apoie o Projeto

**CarolCRM** é um software livre e de código aberto, desenvolvido com paixão e mantido pela comunidade. Seu apoio é fundamental para garantir a continuidade e evolução do projeto. Veja como você pode contribuir:

* **Contribuindo com Código:** Sua experiência é valiosa! Envie pull requests para corrigir bugs, implementar novos recursos ou otimizar o código existente. Consulte nossas [diretrizes de contribuição](https://github.com/luizcmarin/CONTRIBUTING.md) para mais detalhes.
* **Melhorando a Documentação:** Ajude-nos a tornar **CarolCRM** mais acessível. Você pode aprimorar este `README.md`, criar tutoriais, exemplos de uso ou melhorar a documentação técnica.
* **Reportando Bugs e Sugerindo Funcionalidades:** Se encontrar algum problema ou tiver uma ideia para um novo recurso, abra uma [issue em nosso repositório do GitHub](https://github.com/luizcmarin/CarolCRM/issues). Seu feedback é crucial!
* **Divulgando o Projeto:** Compartilhe **CarolCRM** com seus colegas, amigos ou em suas redes sociais. Quanto mais pessoas conhecerem e usarem o projeto, mais forte nossa comunidade se tornará.

### Apoie ainda mais o Projeto

Manter um projeto de código aberto exige tempo e recursos. Se **CarolCRM** for útil para você ou sua empresa, considere apoiar financeiramente o desenvolvimento. Sua contribuição nos ajudará a cobrir custos de infraestrutura e dedicar mais tempo às melhorias.

Você pode contribuir via:

**PIX: 10761120998** (Chave PIX válida para transferências no Brasil.)

Se você reside fora do Brasil ou prefere outras formas de doação, por favor, entre em contato através do meu perfil do GitHub ou abra uma Issue no repositório para que possamos explorar alternativas.

**Agradecemos sinceramente a qualquer forma de apoio!**

## Fique atualizado

Consulte regularmente o site [CarolCRM](https://github.com/luizcmarin/CarolCRM) para **verificar as últimas atualizações, correções de bugs e novas funcionalidades**.

## Licença

**CarolCRM** é um software livre. Ele é distribuído sob os termos da GNU General Public License v3.0.
Por favor, veja [`LICENSE`](https://github.com/luizcmarin/CarolCRM/blob/main/LICENSE) para mais informações.
