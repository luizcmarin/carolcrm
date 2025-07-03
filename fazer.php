<?php

/**
 * fazer.php
 *
 * Gerador de Código para o Projeto CarolCRM (CodeIgniter 4)
 *
 * Este script autônomo gera componentes de um CRUD (Migration, Model, Controller, Views e Rotas)
 * para o projeto CarolCRM, inspecionando a estrutura de tabelas no banco de dados SQLite fixo.
 *
 * Uso:
 * php fazer.php <tipo_componente_ou_all> <nome_entidade_ou_todas> [opções]
 *
 * Exemplos:
 * php fazer.php crud Produto
 * php fazer.php model all
 * php fazer.php migration User
 * php fazer.php seed all
 * php fazer.php helper MeuNovoHelper
 *
 * @author Gemini (com suas instruções!)
 * @version 1.1.0
 */

// --- Configurações Fixas do Projeto CarolCRM ---

// Caminho absoluto para a raiz do seu projeto CodeIgniter 4 (CarolCRM).
// AJUSTE ESTE CAMINHO PARA O LOCAL CORRETO DO SEU PROJETO CI4.
define('CI4_BASE_PATH', '.');

// Caminho absoluto para o arquivo do banco de dados SQLite do CarolCRM.
// ESTE CAMINHO ESTÁ FIXO CONFORME SUA REQUISIÇÃO.
define('SQLITE_DB_PATH', CI4_BASE_PATH . '/writable/database/carolcrm.db');

// Tabelas consideradas "pequenas" para habilitar a opção de "Novo Registro" no modal de seleção de FK.
// Adicione os nomes das tabelas (no singular, snake_case) que você deseja habilitar a criação rápida.
define('SMALL_TABLES_FOR_QUICK_CREATE', ['categoria', 'status', 'tipo_documento']); // Exemplo: categoria_id, status_id

const IGNORED_TABLES = [];

// --- Validação Inicial dos Caminhos ---
if (!is_dir(CI4_BASE_PATH . '/app/')) {
  echo "Erro: O caminho base do CodeIgniter 4 ('" . CI4_BASE_PATH . "') não parece ser válido.\n";
  echo "Por favor, ajuste a constante 'CI4_BASE_PATH' no script 'fazer.php'.\n";
  exit(1);
}

if (!file_exists(SQLITE_DB_PATH)) {
  echo "Erro: O arquivo do banco de dados SQLite não foi encontrado em '" . SQLITE_DB_PATH . "'.\n";
  echo "Por favor, verifique o caminho da constante 'SQLITE_DB_PATH' no script 'fazer.php'.\n";
  exit(1);
}


// --- Funções Utilitárias para Manipulação de Nomes ---

/**
 * Converte uma string de PascalCase (ou CamelCase) para snake_case.
 * Ex: 'NomeDaEntidade' -> 'nome_da_entidade'
 * Ex: 'ProductID' -> 'product_id'
 *
 * @param string $input A string em PascalCase.
 * @return string A string em snake_case.
 */
function pascal_to_snake_case(string $input): string
{
  return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
}

/**
 * Converte uma string de snake_case para PascalCase.
 * Ex: 'nome_da_entidade' -> 'NomeDaEntidade'
 * Ex: 'product_id' -> 'ProductId'
 *
 * @param string $input A string em snake_case.
 * @return string A string em PascalCase.
 */
function snake_to_pascal_case(string $input): string
{
  return str_replace(' ', '', ucwords(str_replace('_', ' ', $input)));
}

/**
 * Converte uma string de snake_case para CamelCase (primeira letra minúscula).
 * Ex: 'nome_da_entidade' -> 'nomeDaEntidade'
 *
 * @param string $input A string em snake_case.
 * @return string A string em CamelCase.
 */
function snake_to_camel_case(string $input): string
{
  return lcfirst(snake_to_pascal_case($input));
}


/**
 * Tenta pluralizar uma palavra singular em inglês.
 * Esta função é simplificada e pode não funcionar para todas as palavras irregulares.
 * Para uma pluralização mais robusta, uma biblioteca de terceiros seria ideal.
 * Ex: 'product' -> 'products'
 * Ex: 'category' -> 'categories'
 *
 * @param string $singular A palavra singular (preferencialmente em snake_case).
 * @return string A palavra pluralizada.
 */
function pluralize(string $singular): string
{
  // Regras de pluralização básicas
  if (preg_match('/(s|x|z|ch|sh)$/i', $singular)) {
    return $singular . 'es';
  } elseif (preg_match('/[^aeiou]y$/i', $singular)) {
    return substr($singular, 0, -1) . 'ies';
  } elseif (preg_match('/(fe|f)$/i', $singular)) {
    return preg_replace('/(fe|f)$/i', 'ves', $singular);
  } else {
    return $singular . 's';
  }
}

/**
 * Tenta singularizar uma palavra plural em inglês.
 * Esta função é simplificada e pode não funcionar para todas as palavras irregulares.
 * Complementar a pluralize().
 * Ex: 'products' -> 'product'
 * Ex: 'categories' -> 'category'
 *
 * @param string $plural A palavra plural (preferencialmente em snake_case).
 * @return string A palavra singularizada.
 */
function singularize(string $plural): string
{
  if (preg_match('/ies$/i', $plural) && !preg_match('/(a|e|i|o|u)ies$/i', $plural)) {
    return substr($plural, 0, -3) . 'y';
  } elseif (preg_match('/(sses|xes|zzes|ches|shes)$/i', $plural)) {
    return substr($plural, 0, -2);
  } elseif (preg_match('/s$/i', $plural) && !preg_match('/(ss)$/i', $plural)) {
    return substr($plural, 0, -1);
  }
  return $plural;
}


// --- Funções para Processamento de Argumentos ---

/**
 * Analisa os argumentos da linha de comando e extrai valores e opções.
 *
 * @param array $argv O array $argv global.
 * @return array Um array associativo com 'type', 'entity_name', 'options'.
 */
function parse_arguments(array $argv): array
{
  $args = [
    'type' => null,
    'entity_name' => null, // Pode ser 'all' ou um nome de entidade/helper
    'options' => [],
  ];

  // Remove o nome do script (fazer.php)
  array_shift($argv);

  if (empty($argv)) {
    display_help();
    exit(1); // Sai com erro
  }

  // O primeiro argumento agora é diretamente o tipo de componente ou "all"
  $args['type'] = array_shift($argv);

  // Validação do tipo de componente
  $allowed_types = ['all', 'crud', 'migration', 'model', 'controller', 'view', 'route', 'helper', 'seed']; // Adicionado 'seed'
  if (!in_array($args['type'], $allowed_types)) {
    echo "Erro: Tipo de componente inválido: '{$args['type']}'.\n";
    display_help();
    exit(1);
  }

  // Para 'helper', o nome da entidade é o nome do helper. Para outros, é o nome da entidade/tabela.
  // 'all' não precisa de nome de entidade subsequente, pois opera em todas as tabelas.
  if ($args['type'] !== 'all' && $args['type'] !== 'helper' && empty($argv)) {
    echo "Erro: Nome da entidade/tabela ausente para o tipo '{$args['type']}'.\n";
    display_help();
    exit(1);
  }

  // Pega o nome da entidade/tabela/helper, se houver
  if (!empty($argv) && (in_array($args['type'], ['crud', 'migration', 'model', 'controller', 'view', 'route', 'seed']) || $args['type'] === 'helper')) {
    $args['entity_name'] = array_shift($argv);
  } else if ($args['type'] === 'all' && !empty($argv)) {
    // Se 'all' foi usado, mas há argumentos extras que não são opções, isso é um erro.
    if (strpos($argv[0], '--') !== 0) { // Não é uma opção, é um argumento inesperado
      echo "Erro: Argumento inesperado após 'all': '{$argv[0]}'.\n";
      display_help();
      exit(1);
    }
  }


  // Processa opções (flags com --)
  foreach ($argv as $arg) {
    if (strpos($arg, '--') === 0) {
      $parts = explode('=', substr($arg, 2), 2); // Remove '--' e divide em chave/valor
      $key = $parts[0];
      $value = $parts[1] ?? true; // Se não houver valor, assume true (ex: --overwrite)
      $args['options'][$key] = $value;
    } else {
      echo "Erro: Argumento inesperado: '{$arg}'. Verifique a sintaxe.\n";
      display_help();
      exit(1);
    }
  }

  // Se o tipo é 'helper' e não foi fornecido um nome, exibe ajuda e sai.
  if ($args['type'] === 'helper' && empty($args['entity_name'])) {
    echo "Erro: Nome do Helper ausente para o tipo 'helper'.\n";
    display_help();
    exit(1);
  }

  // Se o tipo NÃO É 'helper' nem 'all', e o nome da entidade está faltando, é um erro.
  if (!in_array($args['type'], ['all', 'helper']) && empty($args['entity_name'])) {
    echo "Erro: Nome da entidade ausente para o tipo '{$args['type']}'.\n";
    display_help();
    exit(1);
  }


  return $args;
}

/**
 * Exibe a mensagem de ajuda e uso do script.
 */
function display_help(): void
{
  echo "\n--- Gerador de Código para CarolCRM (fazer.php) ---\n";
  echo "Uso:\n";
  echo "  php fazer.php <tipo_componente_ou_all> <nome_entidade_ou_todas> [--overwrite]\n\n";
  echo "Tipos de Componentes e Ações:\n";
  echo "  crud <NomeDaEntidade>       : Gera Migration, Model, Controller, Views e Rotas para uma entidade/tabela.\n";
  echo "  all                         : Gera CRUD completo para TODAS as tabelas do banco de dados.\n";
  echo "  migration <NomeDaEntidade>  : Gera apenas a Migração para uma entidade/tabela.\n";
  echo "  migration all               : Gera Migrações para TODAS as tabelas.\n";
  echo "  model <NomeDaEntidade>      : Gera apenas o Model para uma entidade/tabela.\n";
  echo "  model all                   : Gera Models para TODAS as tabelas.\n";
  echo "  controller <NomeDaEntidade> : Gera apenas o Controller para uma entidade/tabela.\n";
  echo "  controller all              : Gera Controllers para TODAS as tabelas.\n";
  echo "  view <NomeDaEntidade>       : Gera apenas as Views para uma entidade/tabela.\n";
  echo "  view all                    : Gera Views para TODAS as tabelas.\n";
  echo "  route <NomeDaEntidade>      : Imprime as rotas sugeridas para uma entidade.\n";
  echo "  route all                   : Imprime as rotas sugeridas para TODAS as tabelas.\n";
  echo "  helper <NomeDoHelper>       : Gera a estrutura básica de um Helper.\n";
  echo "  seed <NomeDaEntidade>       : Gera o Seeder com dados existentes para uma entidade/tabela.\n"; // Adicionado 'seed'
  echo "  seed all                    : Gera Seeds com dados existentes para TODAS as tabelas.\n\n";       // Adicionado 'seed all'
  echo "Opções:\n";
  echo "  --overwrite                       : Sobrescreve arquivos existentes sem pedir confirmação.\n";
  echo "\n";
  echo "As configurações de caminho do CI4 e do banco de dados SQLite são fixas no script.\n";
  echo "Verifique 'CI4_BASE_PATH' e 'SQLITE_DB_PATH' dentro do 'fazer.php'.\n";
}


// --- Funções de Utilitário de Arquivo ---

/**
 * Escreve conteúdo em um arquivo, criando diretórios se necessário.
 * Pede confirmação antes de sobrescrever, a menos que --overwrite esteja definido.
 *
 * @param string $path O caminho completo do arquivo a ser escrito.
 * @param string $content O conteúdo a ser gravado no arquivo.
 * @param bool $overwrite Se true, sobrescreve sem perguntar.
 * @return bool True em caso de sucesso, false caso contrário.
 */
function write_file(string $path, string $content, bool $overwrite = false): bool
{
  $dir = dirname($path);
  if (!is_dir($dir)) {
    if (!mkdir($dir, 0777, true)) {
      echo "Erro: Não foi possível criar o diretório: {$dir}\n";
      return false;
    }
  }

  if (file_exists($path) && !$overwrite) {
    echo "Atenção: O arquivo '{$path}' já existe.\n";
    echo "Deseja sobrescrevê-lo? (s/N): ";
    $handle = fopen("php://stdin", "r");
    $line = trim(fgets($handle));
    fclose($handle);
    if (strtolower($line) !== 's') {
      echo "Operação de escrita cancelada para '{$path}'.\n";
      return false;
    }
  }

  if (file_put_contents($path, $content) === false) {
    echo "Erro: Não foi possível escrever no arquivo: {$path}\n";
    return false;
  }

  echo "Arquivo gerado com sucesso: {$path}\n";
  return true;
}


// --- Funções de Geração de Componentes ---

/**
 * Gera o conteúdo PHP para um arquivo de Migração do CodeIgniter 4.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @param array $columns Detalhes das colunas obtidos do PRAGMA table_info.
 * @param array $foreign_keys Detalhes das chaves estrangeiras obtidos do PRAGMA foreign_key_list.
 * @return string O conteúdo PHP da migração.
 */
function generate_migration_content(string $entity_name_pascal, string $table_name, array $columns, array $foreign_keys): string
{
  $className = 'Create' . $entity_name_pascal; // Nome da classe da migração
  $fields = [];
  $primaryKey = '';
  $hasTimestamps = false;
  $hasSoftDeletes = false;

  // Constrói o array de campos para o $this->forge->addField()
  foreach ($columns as $column) {
    $fieldName = $column['name'];
    $fieldType = map_sqlite_type_to_ci4_forge_type($column['type']);
    $isNullable = (bool) $column['notnull'] === false; // Se notnull é 0, então é null
    $isPrimaryKey = (bool) $column['pk'];
    $defaultValue = $column['dflt_value'];

    // Ignora campos de timestamp e soft delete para adicioná-los explicitamente depois
    if (in_array($fieldName, ['created_at', 'updated_at'])) {
      $hasTimestamps = true;
      continue;
    }
    if ($fieldName === 'deleted_at') {
      $hasSoftDeletes = true;
      continue;
    }

    $fieldDef = "'{$fieldName}' => [";
    $fieldDef .= "\n            'type' => '{$fieldType}',";

    // Adiciona constraint para VARCHAR
    if ($fieldType === 'VARCHAR') {
      // Tenta inferir um tamanho padrão, SQLite não tem comprimento fixo para VARCHAR
      // ou você pode adicionar um parâmetro para isso. Por agora, um valor comum.
      $fieldDef .= "\n            'constraint' => '255',";
    }
    // Adiciona constraint para DECIMAL
    if ($fieldType === 'DECIMAL') {
      // Assumindo 10,2 como padrão para DECIMAL se não for fornecido um length
      $fieldDef .= "\n            'constraint' => '10,2',";
    }

    if ($isNullable) {
      $fieldDef .= "\n            'null' => true,";
    } else {
      $fieldDef .= "\n            'null' => false,";
    }

    if ($isPrimaryKey) {
      $primaryKey = $fieldName;
      // SQLite usa INTEGER PRIMARY KEY para auto-increment.
      // Para CI4 Forge, precisamos 'unsigned' e 'auto_increment'
      if (strtoupper($column['type']) === 'INTEGER' && $isPrimaryKey && $defaultValue === null) { // Heuristic for auto-increment in SQLite
        $fieldDef .= "\n            'unsigned' => true,";
        $fieldDef .= "\n            'auto_increment' => true,";
      }
    }

    // Adiciona default value se existir e não for null
    if ($defaultValue !== null) {
      // Remove as aspas do valor padrão, ex: "'2023-01-01'" -> "2023-01-01"
      $cleanDefaultValue = trim($defaultValue, "'\"");
      $fieldDef .= "\n            'default' => " . var_export($cleanDefaultValue, true) . ",";
    }


    $fieldDef .= "\n        ],";
    $fields[] = $fieldDef;
  }

  // Adiciona created_at, updated_at, deleted_at se não existirem na tabela original
  // Isso garante que os Models CI4 funcionem com timestamps e soft deletes
  if (!$hasTimestamps) {
    $fields[] = <<<PHP
        'created_at datetime default current_timestamp',
        'updated_at datetime default current_timestamp on update current_timestamp',
        PHP;
  }
  if (!$hasSoftDeletes) {
    $fields[] = "'deleted_at datetime null',";
  }

  $fields_string = implode("\n            ", $fields);
  $primary_key_string = $primaryKey ? "\$this->forge->addPrimaryKey('{$primaryKey}');" : '';
  if (empty($primaryKey)) {
    // Se não encontrou PK, pode ser um problema. Imprime um aviso ou assume 'id'
    echo "Atenção: Nenhuma chave primária encontrada para a tabela '{$table_name}'. Assumindo 'id'.\n";
    $primary_key_string = "\$this->forge->addPrimaryKey('id');";
  }

  $foreign_key_statements = [];
  foreach ($foreign_keys as $fk) {
    $from_column = $fk['from'];
    $to_table = $fk['table'];
    $to_column = $fk['to'];
    $on_delete = $fk['on_delete'];
    $on_update = $fk['on_update'];
    $foreign_key_statements[] = "\$this->forge->addForeignKey('{$from_column}', '{$to_table}', '{$to_column}', '{$on_update}', '{$on_delete}');";
  }
  $foreign_key_string = implode("\n        ", $foreign_key_statements);


  $migrationContent = <<<PHP
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class {$className} extends Migration
{
    public function up()
    {
        \$this->forge->addField([
            {$fields_string}
        ]);
        {$primary_key_string}
        {$foreign_key_string}
        \$this->forge->createTable('{$table_name}');
    }

    public function down()
    {
        \$this->forge->dropTable('{$table_name}');
    }
}
PHP;

  return $migrationContent;
}

/**
 * Gera o conteúdo PHP para um arquivo de Model do CodeIgniter 4.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @param array $columns Detalhes das colunas obtidos do PRAGMA table_info.
 * @return string O conteúdo PHP do Model.
 */
function generate_model_content(string $entity_name_pascal, string $table_name, array $columns): string
{
  $modelClassName = $entity_name_pascal . 'Model';
  $primaryKey = 'id'; // Default
  $allowedFields = [];
  $validationRules = [];
  $validationMessages = [];
  $useSoftDeletes = false;
  $useTimestamps = false;
  $useAutoIncrement = false;

  foreach ($columns as $column) {
    $fieldName = $column['name'];
    $isPrimaryKey = (bool) $column['pk'];
    $isNullable = (bool) $column['notnull'] === false;
    $columnType = strtoupper($column['type']);

    if ($isPrimaryKey) {
      $primaryKey = $fieldName;
      if ($columnType === 'INTEGER' && $column['dflt_value'] === null) {
        $useAutoIncrement = true;
      }
      continue; // Chave primária não vai para allowedFields
    }

    if ($fieldName === 'created_at' || $fieldName === 'updated_at') {
      $useTimestamps = true;
      continue; // Timestamps são tratados por CI4
    }
    if ($fieldName === 'deleted_at') {
      $useSoftDeletes = true;
      continue; // Soft delete é tratado por CI4
    }

    $allowedFields[] = "'{$fieldName}'";

    // Adiciona regras de validação básicas
    if (!$isNullable) {
      $validationRules[] = "'{$fieldName}' => 'required'";
      $validationMessages[] = "'{$fieldName}' => ['required' => 'O campo {field} é obrigatório.']";
    }
    if (strpos($columnType, 'CHAR') !== false || strpos($columnType, 'TEXT') !== false) {
      // SQLite doesn't directly expose length for VARCHAR in PRAGMA,
      // so we'll add a generic max_length or omit it for simplicity here.
      // For more precision, you'd need a more advanced DB schema analysis.
      // For now, let's assume a reasonable default or skip if no length info.
      // Let's add a max_length if it's a string type and not already added.
      if (!empty($validationRules) && str_contains(end($validationRules), $fieldName) && !str_contains(end($validationRules), 'max_length')) {
        // If the last rule was 'required', append 'max_length'
        $validationRules[count($validationRules) - 1] .= '|max_length[255]'; // Default for VARCHAR
        $validationMessages[count($validationMessages) - 1]["max_length"] = "O campo {field} não pode exceder 255 caracteres.";
      } else {
        $validationRules[] = "'{$fieldName}' => 'max_length[255]'";
        $validationMessages[] = "'{$fieldName}' => ['max_length' => 'O campo {field} não pode exceder 255 caracteres.']";
      }
    }
  }

  $allowedFieldsString = !empty($allowedFields) ? implode(",\n        ", $allowedFields) : '';
  $validationRulesString = !empty($validationRules) ? implode(",\n        ", $validationRules) : '';
  $validationMessagesString = !empty($validationMessages) ? implode(",\n        ", $validationMessages) : '';

  $modelContent = <<<PHP
<?php

namespace App\Models;

use CodeIgniter\Model;

class {$modelClassName} extends Model
{
    protected \$table            = '{$table_name}';
    protected \$primaryKey       = '{$primaryKey}';
    protected \$useAutoIncrement = {$useAutoIncrement} ? 'true' : 'false';
    protected \$returnType       = 'object'; // 'array' ou 'object'
    protected \$useSoftDeletes   = {$useSoftDeletes} ? 'true' : 'false';
    protected \$protectFields    = true;
    protected \$allowedFields    = [
        {$allowedFieldsString}
    ];

    // Dates
    protected \$useTimestamps = {$useTimestamps} ? 'true' : 'false';
    protected \$dateFormat    = 'datetime';
    protected \$createdField  = 'created_at';
    protected \$updatedField  = 'updated_at';
    protected \$deletedField  = 'deleted_at';

    // Validation
    protected \$validationRules = [
        {$validationRulesString}
    ];
    protected \$validationMessages = [
        {$validationMessagesString}
    ];
    protected \$skipValidation       = false;
    protected \$cleanValidationRules = true;

    // Callbacks
    protected \$allowCallbacks = true;
    protected \$beforeInsert   = [];
    protected \$afterInsert    = [];
    protected \$beforeUpdate   = [];
    protected \$afterUpdate    = [];
    protected \$beforeFind     = [];
    protected \$afterFind      = [];
    protected \$beforeDelete   = [];
    protected \$afterDelete    = [];
}
PHP;

  return $modelContent;
}

/**
 * Gera o conteúdo PHP para um arquivo de Controller CRUD do CodeIgniter 4.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @return string O conteúdo PHP do Controller.
 */
function generate_controller_content(string $entity_name_pascal, string $table_name): string
{
  $controllerClassName = $entity_name_pascal . 'Controller';
  $modelClassName = $entity_name_pascal . 'Model';
  $entity_name_singular_lower = strtolower($entity_name_pascal);
  $entity_name_plural_lower = strtolower(pluralize($entity_name_pascal));

  // Assume 'id' como chave primária para rotas e operações.
  $primaryKey = 'id';
  foreach (inspect_table(connect_db(), $table_name)['columns'] as $column) {
    if ((bool)$column['pk']) {
      $primaryKey = $column['name'];
      break;
    }
  }


  $controllerContent = <<<PHP
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\\{$modelClassName};
use CodeIgniter\API\ResponseTrait;

class {$controllerClassName} extends BaseController
{
    use ResponseTrait;

    protected \${$entity_name_singular_lower}Model;

    public function __construct()
    {
        \$this->{$entity_name_singular_lower}Model = new {$modelClassName}();
    }

    /**
     * Exibe a lista de {$entity_name_plural_lower}.
     *
     * @return string
     */
    public function index(): string
    {
        \$data = [
            '{$entity_name_plural_lower}' => \$this->{$entity_name_singular_lower}Model->findAll()
        ];
        return view('{$entity_name_plural_lower}/index', \$data);
    }

    /**
     * Exibe o formulário para criar um novo {$entity_name_singular_lower}.
     *
     * @return string
     */
    public function new(): string
    {
        // Se a requisição for AJAX, retorna apenas a view sem o layout completo
        if (\$this->request->isAJAX()) {
            return view('{$entity_name_plural_lower}/new');
        }
        return view('{$entity_name_plural_lower}/new');
    }

    /**
     * Salva um novo {$entity_name_singular_lower} no banco de dados.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        \$rules = \$this->{$entity_name_singular_lower}Model->getValidationRules();
        \$messages = \$this->{$entity_name_singular_lower}Model->getValidationMessages();

        if (! \$this->validate(\$rules, \$messages)) {
            return redirect()->back()->withInput()->with('errors', \$this->validator->getErrors());
        }

        \$data = \$this->request->getPost();

        if (\$this->{$entity_name_singular_lower}Model->insert(\$data)) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('success', '{$entity_name_pascal} criado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', \$this->{$entity_name_singular_lower}Model->errors());
        }
    }

    /**
     * Exibe os detalhes de um {$entity_name_singular_lower} específico.
     *
     * @param int \$id O ID do {$entity_name_singular_lower}.
     * @return string
     */
    public function show(int \$id): string
    {
        \$data = [
            '{$entity_name_singular_lower}' => \$this->{$entity_name_singular_lower}Model->find(\$id)
        ];

        if (empty(\$data['{$entity_name_singular_lower}'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Se a requisição for AJAX, retorna apenas a view sem o layout completo
        if (\$this->request->isAJAX()) {
            return view('{$entity_name_plural_lower}/show', \$data);
        }

        return view('{$entity_name_plural_lower}/show', \$data);
    }

    /**
     * Exibe o formulário para editar um {$entity_name_singular_lower} existente.
     *
     * @param int \$id O ID do {$entity_name_singular_lower}.
     * @return string
     */
    public function edit(int \$id): string
    {
        \$data = [
            '{$entity_name_singular_lower}' => \$this->{$entity_name_singular_lower}Model->find(\$id)
        ];

        if (empty(\$data['{$entity_name_singular_lower}'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Se a requisição for AJAX, retorna apenas a view sem o layout completo
        if (\$this->request->isAJAX()) {
            return view('{$entity_name_plural_lower}/edit', \$data);
        }

        return view('{$entity_name_plural_lower}/edit', \$data);
    }

    /**
     * Atualiza um {$entity_name_singular_lower} existente no banco de dados.
     *
     * @param int \$id O ID do {$entity_name_singular_lower}.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update(int \$id): \CodeIgniter\HTTP\RedirectResponse
    {
        \$rules = \$this->{$entity_name_singular_lower}Model->getValidationRules();
        \$messages = \$this->{$entity_name_singular_lower}Model->getValidationMessages();

        if (! \$this->validate(\$rules, \$messages)) {
            return redirect()->back()->withInput()->with('errors', \$this->validator->getErrors());
        }

        \$data = \$this->request->getPost();

        if (\$this->{$entity_name_singular_lower}Model->update(\$id, \$data)) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('success', '{$entity_name_pascal} atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', \$this->{$entity_name_singular_lower}Model->errors());
        }
    }

    /**
     * Exclui um {$entity_name_singular_lower} do banco de dados.
     *
     * @param int \$id O ID do {$entity_name_singular_lower}.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete(int \$id): \CodeIgniter\HTTP\RedirectResponse
    {
        if (\$this->{$entity_name_singular_lower}Model->delete(\$id)) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('success', '{$entity_name_pascal} excluído com sucesso!');
        } else {
            return redirect()->back()->with('errors', \$this->{$entity_name_singular_lower}Model->errors());
        }
    }
}
PHP;
  return $controllerContent;
}

/**
 * Gera o conteúdo HTML para as Views do CodeIgniter 4 (index, new, edit, show).
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @param array $columns Detalhes das colunas obtidos do PRAGMA table_info.
 * @return array Um array associativo com os nomes dos arquivos e seus conteúdos.
 */
function generate_view_contents(string $entity_name_pascal, string $table_name, array $columns): array
{
  $entity_name_singular_lower = strtolower($entity_name_pascal);
  $entity_name_plural_lower = strtolower(pluralize($entity_name_pascal));
  $primaryKey = 'id';
  $displayFields = []; // Campos a serem exibidos na tabela e nos detalhes/formulários
  $fkFields = []; // Campos que são chaves estrangeiras

  foreach ($columns as $column) {
    if ((bool)$column['pk']) {
      $primaryKey = $column['name'];
    }
    // Adiciona todos os campos exceto timestamps e soft delete para exibição
    if (!in_array($column['name'], ['created_at', 'updated_at', 'deleted_at'])) {
      $displayFields[] = $column['name'];
    }
    // Verifica se é uma chave estrangeira pela convenção tabela_id
    if (preg_match('/^(.*)_id$/', $column['name'], $matches)) {
      $related_singular_snake = $matches[1]; // Ex: 'usuario' de 'usuario_id'
      $related_plural_snake = pluralize($related_singular_snake); // Ex: 'usuarios'
      $related_pascal = snake_to_pascal_case($related_singular_snake); // Ex: 'Usuario'

      $fkFields[$column['name']] = [
        'related_table_singular_snake' => $related_singular_snake,
        'related_table_plural_snake' => $related_plural_snake,
        'related_pascal' => $related_pascal,
        'is_quick_creatable' => in_array($related_singular_snake, SMALL_TABLES_FOR_QUICK_CREATE),
      ];
    }
  }

  // --- View: index.php (Lista) ---
  $headers = array_map(fn($field) => '<th>' . ucwords(str_replace('_', ' ', $field)) . '</th>', $displayFields);
  $rows = array_map(fn($field) => '<td><?= $' . $entity_name_singular_lower . '->' . $field . ' ?></td>', $displayFields);

  $indexViewContent = <<<HTML
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<div class="container mt-4">
    <h2>Lista de {$entity_name_plural_lower}</h2>

    <?= session()->getFlashdata('success') ? '<div class="alert alert-success">' . session()->getFlashdata('success') . '</div>' : '' ?>
    <?= session()->getFlashdata('errors') ? '<div class="alert alert-danger">' . implode('<br>', session()->getFlashdata('errors')) . '</div>' : '' ?>

    <a href="/{$entity_name_plural_lower}/new" class="btn btn-primary mb-3">Novo {$entity_name_pascal}</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <?= implode("\n                ", \$headers) ?>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty(\${$entity_name_plural_lower})): ?>
                <?php foreach (\${$entity_name_plural_lower} as \${$entity_name_singular_lower}): ?>
                    <tr>
                        <?= implode("\n                        ", \$rows) ?>
                        <td>
                            <a href="/{$entity_name_plural_lower}/show/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="/{$entity_name_plural_lower}/edit/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" class="btn btn-warning btn-sm">Editar</a>
                            <form action="/{$entity_name_plural_lower}/delete/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= count(\$displayFields) + 1 ?>" class="text-center">Nenhum {$entity_name_singular_lower} encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= \$this->endSection() ?>
HTML;

  // --- View: new.php (Formulário de Criação) ---
  $formFieldsNew = '';
  foreach ($displayFields as $field) {
    $column = array_values(array_filter($columns, fn($col) => $col['name'] === $field))[0]; // Get the specific column data
    if ($column['pk'] && $column['dflt_value'] === null && strtoupper($column['type']) === 'INTEGER') {
      // If it's an auto-incrementing primary key (INTEGER, PK, and no default value), skip it in the create form
      continue;
    }

    $label = ucwords(str_replace('_', ' ', $field));
    $type = 'text'; // Default
    $inputName = $field;

    if (isset($fkFields[$field])) { // É um campo de chave estrangeira
      $fkInfo = $fkFields[$field];
      $formFieldsNew .= <<<HTML
    <div class="form-group mb-3">
        <label for="{$inputName}">{$label}</label>
        <div class="input-group">
            <input type="hidden" class="form-control" id="{$inputName}" name="{$inputName}" value="<?= old('{$inputName}') ?>">
            <input type="text" class="form-control" id="{$inputName}_name" value="" disabled>
            <button type="button" class="btn btn-outline-secondary select-fk-btn"
                    data-model="{$fkInfo['related_pascal']}"
                    data-target-id="{$inputName}"
                    data-target-name="{$inputName}_name"
                    data-title="Selecionar {$fkInfo['related_pascal']}">
                Selecionar
            </button>
        </div>
    </div>
HTML;
    } else { // Não é uma chave estrangeira
      // Tenta mapear tipos para inputs HTML
      $ci4Type = map_sqlite_type_to_ci4_forge_type($column['type']);
      if ($ci4Type === 'INT' || $ci4Type === 'DOUBLE' || $ci4Type === 'DECIMAL') {
        $type = 'number';
      } elseif ($ci4Type === 'DATETIME') {
        $type = 'datetime-local';
      } elseif (strpos(strtoupper($column['type']), 'TEXT') !== false) {
        $formFieldsNew .= <<<HTML
    <div class="form-group mb-3">
        <label for="{$inputName}">{$label}</label>
        <textarea class="form-control" id="{$inputName}" name="{$inputName}"><?= old('{$inputName}') ?></textarea>
    </div>
HTML;
        continue; // Pula para o próximo campo do loop principal
      }
      $formFieldsNew .= <<<HTML
    <div class="form-group mb-3">
        <label for="{$inputName}">{$label}</label>
        <input type="{$type}" class="form-control" id="{$inputName}" name="{$inputName}" value="<?= old('{$inputName}') ?>">
    </div>
HTML;
    }
  }

  $newViewContent = <<<HTML
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<div class="container mt-4">
    <h2>Criar Novo {$entity_name_pascal}</h2>

    <?= \Config\Services::validation()->listErrors() ?>
    <?= session()->getFlashdata('errors') ? '<div class="alert alert-danger">' . implode('<br>', session()->getFlashdata('errors')) . '</div>' : '' ?>

    <form action="/{$entity_name_plural_lower}/create" method="post">
        <?= csrf_field() ?>
        {$formFieldsNew}
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="/{$entity_name_plural_lower}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= \$this->include('modals/generic_select_modal') ?>

<?= \$this->endSection() ?>
HTML;

  // --- View: edit.php (Formulário de Edição) ---
  $formFieldsEdit = '';
  foreach ($displayFields as $field) {
    $label = ucwords(str_replace('_', ' ', $field));
    $type = 'text'; // Default
    $inputName = $field;
    $value = "<?= old('{$inputName}', \${$entity_name_singular_lower}->{$field}) ?>";

    if (isset($fkFields[$field])) { // É um campo de chave estrangeira
      $fkInfo = $fkFields[$field];
      $formFieldsEdit .= <<<HTML
    <div class="form-group mb-3">
        <label for="{$inputName}">{$label}</label>
        <div class="input-group">
            <input type="hidden" class="form-control" id="{$inputName}" name="{$inputName}" value="<?= old('{$inputName}', \${$entity_name_singular_lower}->{$field}) ?>">
            <input type="text" class="form-control" id="{$inputName}_name" value="" disabled> <button type="button" class="btn btn-outline-secondary select-fk-btn"
                    data-model="{$fkInfo['related_pascal']}"
                    data-target-id="{$inputName}"
                    data-target-name="{$inputName}_name"
                    data-title="Selecionar {$fkInfo['related_pascal']}">
                Selecionar
            </button>
        </div>
    </div>
HTML;
    } else { // Não é uma chave estrangeira
      // Tenta mapear tipos para inputs HTML
      foreach ($columns as $col) {
        if ($col['name'] === $field) {
          $ci4Type = map_sqlite_type_to_ci4_forge_type($col['type']);
          if ($ci4Type === 'INT' || $ci4Type === 'DOUBLE' || $ci4Type === 'DECIMAL') {
            $type = 'number';
          } elseif ($ci4Type === 'DATETIME') {
            $type = 'datetime-local';
            // Formata a data para o input datetime-local
            $value = "<?= old('{$inputName}', \${$entity_name_singular_lower}->{$field} ? date('Y-m-d\TH:i', strtotime(\${$entity_name_singular_lower}->{$field})) : '') ?>";
          } elseif (strpos(strtoupper($col['type']), 'TEXT') !== false) {
            $formFieldsEdit .= <<<HTML
    <div class="form-group mb-3">
        <label for="{$inputName}">{$label}</label>
        <textarea class="form-control" id="{$inputName}" name="{$inputName}">{$value}</textarea>
    </div>
HTML;
            continue 2;
          }
          break;
        }
      }
      $formFieldsEdit .= <<<HTML
    <div class="form-group mb-3">
        <label for="{$inputName}">{$label}</label>
        <input type="{$type}" class="form-control" id="{$inputName}" name="{$inputName}" value="{$value}">
    </div>
HTML;
    }
  }

  $editViewContent = <<<HTML
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<div class="container mt-4">
    <h2>Editar {$entity_name_pascal}</h2>

    <?= \Config\Services::validation()->listErrors() ?>
    <?= session()->getFlashdata('errors') ? '<div class="alert alert-danger">' . implode('<br>', session()->getFlashdata('errors')) . '</div>' : '' ?>

    <form action="/{$entity_name_plural_lower}/update/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> {$formFieldsEdit}
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="/{$entity_name_plural_lower}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= \$this->include('modals/generic_select_modal') ?>

<?= \$this->endSection() ?>
HTML;

  // --- View: show.php (Detalhes) ---
  $detailsList = '';
  foreach ($displayFields as $field) {
    $label = ucwords(str_replace('_', ' ', $field));
    $detailsList .= <<<HTML
    <p><strong>{$label}:</strong> <?= \${$entity_name_singular_lower}->{$field} ?></p>
HTML;
  }

  $showViewContent = <<<HTML
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<div class="container mt-4">
    <h2>Detalhes do {$entity_name_pascal}</h2>

    <a href="/{$entity_name_plural_lower}" class="btn btn-secondary mb-3">Voltar</a>
    <a href="/{$entity_name_plural_lower}/edit/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" class="btn btn-warning mb-3">Editar</a>
    <form action="/{$entity_name_plural_lower}/delete/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" method="post" class="d-inline">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</button>
    </form>

    <div class="card card-body">
        {$detailsList}
    </div>
</div>

<?= \$this->endSection() ?>
HTML;

  // --- View: layouts/main.php (Layout Básico) ---
  // Este layout é um exemplo. Se você já tem um layout, não o sobrescreva.
  // Ele será gerado uma única vez na primeira execução de geração de views.
  $layoutMainContent = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarolCRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">CarolCRM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/produtos">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/usuarios">Usuários</a>
                    </li>
                    </ul>
            </div>
        </div>
    </nav>

    <main role="main" class="flex-shrink-0">
        <?= \$this->renderSection('content') ?>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">CarolCRM &copy; <?= date('Y') ?></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/js/fk_selector.js"></script>
</body>
</html>
HTML;

  // --- View: modals/generic_select_modal.php (Modal Genérico de Seleção de FK) ---
  $genericSelectModalContent = <<<HTML
<div class="modal fade" id="genericSelectModal" tabindex="-1" aria-labelledby="genericSelectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="genericSelectModalLabel">Selecionar Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" id="fkSearchInput" placeholder="Filtrar...">
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="fkResultsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome/Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="2" class="text-center">Digite para filtrar...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="fkConfirmSelectionBtn" disabled>Confirmar</button>
                </div>
        </div>
    </div>
</div>
HTML;


  return [
    'index.php' => $indexViewContent,
    'new.php' => $newViewContent,
    'edit.php' => $editViewContent,
    'show.php' => $showViewContent,
    'layouts/main.php' => $layoutMainContent, // Incluído para um layout básico
    'modals/generic_select_modal.php' => $genericSelectModalContent // Novo modal para seleção de FK
  ];
}

/**
 * Imprime sugestões de rotas para um recurso CRUD no CodeIgniter 4.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @return string As sugestões de rotas.
 */
function generate_route_suggestion(string $entity_name_pascal, string $table_name): string
{
  $controllerName = $entity_name_pascal . 'Controller';
  $resourceName = strtolower(pluralize($entity_name_pascal)); // Ex: 'produtos'

  $routeContent = <<<PHP
// Rotas para {$entity_name_pascal}
\$routes->resource('{$resourceName}', ['controller' => '{$controllerName}']);
PHP;

  return $routeContent;
}

/**
 * Gera o conteúdo PHP para um arquivo de Helper básico do CodeIgniter 4.
 *
 * @param string $helper_name_pascal O nome do helper em PascalCase (ex: 'MeuHelper').
 * @return string O conteúdo PHP do Helper.
 */
function generate_helper_content(string $helper_name_pascal): string
{
  $helper_name_snake = pascal_to_snake_case($helper_name_pascal);
  $function_name = "exemplo_{$helper_name_snake}_function";

  $helperContent = <<<PHP
<?php

if (! function_exists('{$function_name}')) {
    /**
     * Exemplo de função para {$helper_name_pascal} Helper.
     *
     * @param string \$text Texto de entrada.
     * @return string Texto processado.
     */
    function {$function_name}(string \$text): string
    {
        return "Processado por {$helper_name_pascal} Helper: " . \$text;
    }
}
// Adicione mais funções aqui conforme necessário
PHP;
  return $helperContent;
}

/**
 * Gera o conteúdo PHP para um arquivo de Seeder do CodeIgniter 4 com dados existentes.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @param PDO $pdo A conexão PDO com o banco de dados.
 * @return string O conteúdo PHP do Seeder.
 */
function generate_seeder_content(string $entity_name_pascal, string $table_name, PDO $pdo): string
{
  $seederClassName = $entity_name_pascal . 'Seeder';

  // Obter todos os registros da tabela
  $stmt = $pdo->prepare("SELECT * FROM `{$table_name}`");
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $data_array_string = [];
  foreach ($records as $record) {
    $record_values = [];
    foreach ($record as $key => $value) {
      // Garante que valores nulos sejam 'null' no PHP e strings sejam aspas simples
      $record_values[] = "'" . $key . "' => " . var_export($value, true);
    }
    $data_array_string[] = "[ " . implode(", ", $record_values) . " ]";
  }

  $insert_data = implode(",\n            ", $data_array_string);

  $seederContent = <<<PHP
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class {$seederClassName} extends Seeder
{
    public function run()
    {
        \$data = [
            {$insert_data}
        ];

        // Usando insertBatch para inserir múltiplos registros
        // Ajuste conforme necessário se a tabela tiver gatilhos ou colunas auto-preenchidas
        \$this->db->table('{$table_name}')->insertBatch(\$data);
        
        // Ou, para inserir um por um (útil se o Model tiver beforeInsert/afterInsert callbacks)
        // \$model = new \App\Models\\{$entity_name_pascal}Model();
        // foreach (\$data as \$row) {
        //     \$model->insert(\$row);
        // }
    }
}
PHP;
  return $seederContent;
}


// --- INÍCIO DA FASE 2: Conexão e Inspeção do Banco de Dados SQLite ---

/**
 * Conecta ao banco de dados SQLite.
 *
 * @return PDO Uma instância de PDO conectada ao banco de dados.
 * @throws PDOException Se a conexão falhar.
 */
function connect_db(): PDO
{
  try {
    $pdo = new PDO('sqlite:' . SQLITE_DB_PATH);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Lança exceções em caso de erros
    return $pdo;
  } catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados SQLite: " . $e->getMessage() . "\n";
    exit(1);
  }
}

/**
 * Obtém a lista de todas as tabelas no banco de dados SQLite.
 *
 * @param PDO $pdo A conexão PDO com o banco de dados.
 * @return array Um array de nomes de tabelas.
 */
function get_all_tables(PDO $pdo): array
{
  $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';");
  return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/**
 * Inspeciona a estrutura de uma tabela e retorna os detalhes das colunas e chaves estrangeiras.
 *
 * @param PDO $pdo A conexão PDO com o banco de dados.
 * @param string $table_name O nome da tabela a ser inspecionada.
 * @return array Um array associativo com 'columns' e 'foreign_keys'.
 * @throws Exception Se a tabela não for encontrada ou não tiver metadados.
 */
function inspect_table(PDO $pdo, string $table_name): array
{
  // --- PASSO 1: Obter informações das colunas (PRAGMA table_info) ---
  // Concatene o nome da tabela, garantindo aspas simples.
  $stmt_columns = $pdo->prepare("PRAGMA table_info('{$table_name}')");
  $stmt_columns->execute(); // Remova o parâmetro aqui!
  $columns = $stmt_columns->fetchAll(PDO::FETCH_ASSOC);

  // Se não há colunas, a tabela não foi encontrada ou não possui metadados acessíveis
  if (empty($columns)) {
    throw new Exception("Tabela '{$table_name}' não retornou informações de coluna (PRAGMA table_info vazia).");
  }

  // --- PASSO 2: Obter informações das chaves estrangeiras (PRAGMA foreign_key_list) ---
  // Usando query direta com nome de tabela aspas simples para compatibilidade com SQLite
  $stmt_fks = $pdo->query("PRAGMA foreign_key_list('{$table_name}')");
  $foreign_keys = $stmt_fks->fetchAll(PDO::FETCH_ASSOC);

  return [
    'columns' => $columns,
    'foreign_keys' => $foreign_keys,
  ];
}

/**
 * Mapeia os tipos de dados do SQLite para os tipos do CodeIgniter 4 Forge.
 *
 * @param string $sqlite_type O tipo de dado do SQLite.
 * @return string O tipo de dado correspondente para o CI4 Forge.
 */
function map_sqlite_type_to_ci4_forge_type(string $sqlite_type): string
{
  $sqlite_type = strtoupper($sqlite_type); // Normaliza para maiúsculas

  if (strpos($sqlite_type, 'INT') !== false) {
    return 'INT';
  }
  if (strpos($sqlite_type, 'CHAR') !== false || strpos($sqlite_type, 'TEXT') !== false) {
    return 'VARCHAR'; // VARCHAR para strings, TEXT para textos longos sem constraint
  }
  if (strpos($sqlite_type, 'REAL') !== false || strpos($sqlite_type, 'FLOA') !== false || strpos($sqlite_type, 'DOUB') !== false) {
    return 'DOUBLE';
  }
  if (strpos($sqlite_type, 'DEC') !== false || strpos($sqlite_type, 'NUM') !== false) {
    return 'DECIMAL';
  }
  if (strpos($sqlite_type, 'BLOB') !== false) {
    return 'BLOB';
  }
  if (strpos($sqlite_type, 'DATE') !== false || strpos($sqlite_type, 'TIME') !== false) {
    return 'DATETIME'; // Ou 'DATE', 'TIME' dependendo da especificidade
  }
  // Caso padrão, tenta manter o tipo original se não mapeado explicitamente
  return $sqlite_type;
}


// --- Lógica de Ação Principal (Switch/Case para as fases) ---

// Analisa os argumentos da linha de comando
$arguments = parse_arguments($argv);

try {
  $pdo = null; // Inicializa PDO como nulo
  // Ações que precisam de conexão com o banco de dados
  if (in_array($arguments['type'], ['all', 'crud', 'migration', 'model', 'controller', 'view', 'route', 'seed'])) { // helper não precisa de DB
    echo "Conectando ao banco de dados SQLite em: " . SQLITE_DB_PATH . "\n";
    $pdo = connect_db();
    echo "Conexão com o banco de dados bem-sucedida.\n\n";
  }

  switch ($arguments['type']) { // Agora o switch é direto no tipo
    case 'all':
      $tables = get_all_tables($pdo);
      echo "Gerando CRUD para todas as tabelas: " . implode(', ', $tables) . "\n";
      foreach ($tables as $table_name) {
        $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
        echo "--- Processando tabela: {$table_name} (Entidade: {$entity_name_pascal}) ---\n";
        $table_info = inspect_table($pdo, $table_name);
        $columns = $table_info['columns'];
        $foreign_keys = $table_info['foreign_keys'];

        // Geração da Migração
        $migration_content = generate_migration_content($entity_name_pascal, $table_name, $columns, $foreign_keys);
        $timestamp = date('Y-m-d-His');
        $migration_file_name = "{$timestamp}_Create{$entity_name_pascal}.php";
        $migration_path = CI4_BASE_PATH . "/app/Database/Migrations/{$migration_file_name}";
        write_file($migration_path, $migration_content, $arguments['options']['overwrite'] ?? false);

        // Geração do Model
        $model_content = generate_model_content($entity_name_pascal, $table_name, $columns);
        $model_file_name = "{$entity_name_pascal}Model.php";
        $model_path = CI4_BASE_PATH . "/app/Models/{$model_file_name}";
        write_file($model_path, $model_content, $arguments['options']['overwrite'] ?? false);

        // Geração do Controller
        $controller_content = generate_controller_content($entity_name_pascal, $table_name);
        $controller_file_name = "{$entity_name_pascal}Controller.php";
        $controller_path = CI4_BASE_PATH . "/app/Controllers/{$controller_file_name}";
        write_file($controller_path, $controller_content, $arguments['options']['overwrite'] ?? false);

        // Geração das Views e Modais de seleção (HTML para botões de FK e template do modal)
        $view_contents = generate_view_contents($entity_name_pascal, $table_name, $columns);
        $entity_name_plural_lower = strtolower(pluralize($entity_name_pascal));
        foreach ($view_contents as $view_file => $content) {
          $view_dir_path = CI4_BASE_PATH . "/app/Views/{$entity_name_plural_lower}/";
          // Casos especiais para diretórios de views
          if (str_starts_with($view_file, 'layouts/')) {
            $view_dir_path = CI4_BASE_PATH . "/app/Views/layouts/";
            $view_file = str_replace('layouts/', '', $view_file); // Remove 'layouts/' do nome do arquivo
          } elseif (str_starts_with($view_file, 'modals/')) {
            $view_dir_path = CI4_BASE_PATH . "/app/Views/modals/";
            $view_file = str_replace('modals/', '', $view_file); // Remove 'modals/' do nome do arquivo
          }
          $view_path = $view_dir_path . $view_file;
          // Para o layout principal e modais, só sobrescreve se for explicitamente pedido ou se não existir
          $overwrite_special = (str_starts_with($view_file, 'layouts/') || str_starts_with($view_file, 'modals/')) ? ($arguments['options']['overwrite'] ?? false) : ($arguments['options']['overwrite'] ?? false);
          write_file($view_path, $content, $overwrite_special);
        }

        // Impressão da Sugestão de Rotas
        echo "\n--- Sugestão de Rotas para '{$entity_name_pascal}' (Cole em app/Config/Routes.php) ---\n";
        echo generate_route_suggestion($entity_name_pascal, $table_name) . "\n\n";

        // Geração do Seeder
        $seeder_content = generate_seeder_content($entity_name_pascal, $table_name, $pdo);
        $seeder_file_name = "{$entity_name_pascal}Seeder.php";
        $seeder_path = CI4_BASE_PATH . "/app/Database/Seeds/{$seeder_file_name}";
        write_file($seeder_path, $seeder_content, $arguments['options']['overwrite'] ?? false);
      }
      break;
    case 'crud':
      $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
      echo "Gerando CRUD completo para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**)\n";
      $table_info = inspect_table($pdo, $table_name);
      $columns = $table_info['columns'];
      $foreign_keys = $table_info['foreign_keys'];

      // Geração da Migração
      $migration_content = generate_migration_content($arguments['entity_name'], $table_name, $columns, $foreign_keys);
      $timestamp = date('Y-m-d-His');
      $migration_file_name = "{$timestamp}_Create{$arguments['entity_name']}.php";
      $migration_path = CI4_BASE_PATH . "/app/Database/Migrations/{$migration_file_name}";
      write_file($migration_path, $migration_content, $arguments['options']['overwrite'] ?? false);

      // Geração do Model
      $model_content = generate_model_content($arguments['entity_name'], $table_name, $columns);
      $model_file_name = "{$arguments['entity_name']}Model.php";
      $model_path = CI4_BASE_PATH . "/app/Models/{$model_file_name}";
      write_file($model_path, $model_content, $arguments['options']['overwrite'] ?? false);

      // Geração do Controller
      $controller_content = generate_controller_content($arguments['entity_name'], $table_name);
      $controller_file_name = "{$arguments['entity_name']}Controller.php";
      $controller_path = CI4_BASE_PATH . "/app/Controllers/{$controller_file_name}";
      write_file($controller_path, $controller_content, $arguments['options']['overwrite'] ?? false);

      // Geração das Views e Modais de seleção (HTML para botões de FK e template do modal)
      $view_contents = generate_view_contents($arguments['entity_name'], $table_name, $columns);
      $entity_name_plural_lower = strtolower(pluralize($arguments['entity_name']));
      foreach ($view_contents as $view_file => $content) {
        $view_dir_path = CI4_BASE_PATH . "/app/Views/{$entity_name_plural_lower}/";
        if (str_starts_with($view_file, 'layouts/')) {
          $view_dir_path = CI4_BASE_PATH . "/app/Views/layouts/";
          $view_file = str_replace('layouts/', '', $view_file);
        } elseif (str_starts_with($view_file, 'modals/')) {
          $view_dir_path = CI4_BASE_PATH . "/app/Views/modals/";
          $view_file = str_replace('modals/', '', $view_file);
        }
        $view_path = $view_dir_path . $view_file;
        $overwrite_special = (str_starts_with($view_file, 'layouts/') || str_starts_with($view_file, 'modals/')) ? ($arguments['options']['overwrite'] ?? false) : ($arguments['options']['overwrite'] ?? false);
        write_file($view_path, $content, $overwrite_special);
      }

      // Impressão da Sugestão de Rotas
      echo "\n--- Sugestão de Rotas para '{$arguments['entity_name']}' (Cole em app/Config/Routes.php) ---\n";
      echo generate_route_suggestion($arguments['entity_name'], $table_name) . "\n\n";

      // Geração do Seeder
      $seeder_content = generate_seeder_content($arguments['entity_name'], $table_name, $pdo);
      $seeder_file_name = "{$arguments['entity_name']}Seeder.php";
      $seeder_path = CI4_BASE_PATH . "/app/Database/Seeds/{$seeder_file_name}";
      write_file($seeder_path, $seeder_content, $arguments['options']['overwrite'] ?? false);
      break;
    case 'migration':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Migrações para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          $table_info = inspect_table($pdo, $table_name);
          $columns = $table_info['columns'];
          $foreign_keys = $table_info['foreign_keys'];
          $migration_content = generate_migration_content($entity_name_pascal, $table_name, $columns, $foreign_keys);
          $timestamp = date('Y-m-d-His');
          $migration_file_name = "{$timestamp}_Create{$entity_name_pascal}.php";
          $migration_path = CI4_BASE_PATH . "/app/Database/Migrations/{$migration_file_name}";
          write_file($migration_path, $migration_content, $arguments['options']['overwrite'] ?? false);
        }
      } else {
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        echo "Gerando Migração para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**)\n";
        $table_info = inspect_table($pdo, $table_name);
        $columns = $table_info['columns'];
        $foreign_keys = $table_info['foreign_keys'];
        $migration_content = generate_migration_content($arguments['entity_name'], $table_name, $columns, $foreign_keys);
        $timestamp = date('Y-m-d-His');
        $migration_file_name = "{$timestamp}_Create{$arguments['entity_name']}.php";
        $migration_path = CI4_BASE_PATH . "/app/Database/Migrations/{$migration_file_name}";
        write_file($migration_path, $migration_content, $arguments['options']['overwrite'] ?? false);
      }
      break;

    case 'seed': // <-- Adicione este novo case
      if ($arguments['entity_name'] === 'all') {
        echo "Gerando seeds para todas as tabelas...\n";
        $table_names = get_table_names($pdo);
        foreach ($table_names as $table) {
          if (in_array($table, IGNORED_TABLES)) {
            echo "Ignorando tabela de seed: " . $table . "\n";
            continue;
          }
          echo "Gerando seed para a tabela: " . $table . "\n";
          try {
            $seed_content = generate_seed_content($pdo, $table);
            $file_name = 'Create' . str_replace(' ', '', ucwords(str_replace('_', ' ', $table))) . 'Seeder.php';
            file_put_contents(CI4_BASE_PATH . '/app/Database/Seeds/' . $file_name, $seed_content);
            echo "Seed '{$file_name}' gerado com sucesso para '{$table}'.\n";
          } catch (Exception $e) {
            echo "Erro ao gerar seed para '{$table}': " . $e->getMessage() . "\n";
          }
        }
        echo "Geração de seeds concluída.\n";
      } elseif ($arguments['entity_name']) {
        echo "Gerando seed para a tabela específica: " . $arguments['entity_name'] . "\n";
        if (in_array($arguments['entity_name'], IGNORED_TABLES)) {
          echo "Tabela '{$arguments['entity_name']}' está na lista de ignorados para seeds.\n";
        } else {
          try {
            $seed_content = generate_seed_content($pdo, $arguments['entity_name']);
            $file_name = 'Create' . str_replace(' ', '', ucwords(str_replace('_', ' ', $arguments['entity_name']))) . 'Seeder.php';
            file_put_contents(CI4_BASE_PATH . '/app/Database/Seeds/' . $file_name, $seed_content);
            echo "Seed '{$file_name}' gerado com sucesso para '{$arguments['entity_name']}'.\n";
          } catch (Exception $e) {
            echo "Erro ao gerar seed para '{$arguments['entity_name']}': " . $e->getMessage() . "\n";
          }
        }
      } else {
        echo "Uso: php fazer.php seed [all | <nome_da_tabela>]\n";
      }
      break;
    case 'model':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Models para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          $table_info = inspect_table($pdo, $table_name);
          $columns = $table_info['columns'];
          $model_content = generate_model_content($entity_name_pascal, $table_name, $columns);
          $model_file_name = "{$entity_name_pascal}Model.php";
          $model_path = CI4_BASE_PATH . "/app/Models/{$model_file_name}";
          write_file($model_path, $model_content, $arguments['options']['overwrite'] ?? false);
        }
      } else {
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        echo "Gerando Model para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**)\n";
        $table_info = inspect_table($pdo, $table_name);
        $columns = $table_info['columns'];
        $model_content = generate_model_content($arguments['entity_name'], $table_name, $columns);
        $model_file_name = "{$arguments['entity_name']}Model.php";
        $model_path = CI4_BASE_PATH . "/app/Models/{$model_file_name}";
        write_file($model_path, $model_content, $arguments['options']['overwrite'] ?? false);
      }
      break;
    case 'controller':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Controllers para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          $controller_content = generate_controller_content($entity_name_pascal, $table_name);
          $controller_file_name = "{$entity_name_pascal}Controller.php";
          $controller_path = CI4_BASE_PATH . "/app/Controllers/{$controller_file_name}";
          write_file($controller_path, $controller_content, $arguments['options']['overwrite'] ?? false);
        }
      } else {
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        echo "Gerando Controller para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**)\n";
        $controller_content = generate_controller_content($arguments['entity_name'], $table_name);
        $controller_file_name = "{$arguments['entity_name']}Controller.php";
        $controller_path = CI4_BASE_PATH . "/app/Controllers/{$controller_file_name}";
        write_file($controller_path, $controller_content, $arguments['options']['overwrite'] ?? false);
      }
      break;
    case 'view':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Views para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          $table_info = inspect_table($pdo, $table_name);
          $columns = $table_info['columns'];
          $view_contents = generate_view_contents($entity_name_pascal, $table_name, $columns);
          $entity_name_plural_lower = strtolower(pluralize($entity_name_pascal));
          foreach ($view_contents as $view_file => $content) {
            $view_dir_path = CI4_BASE_PATH . "/app/Views/{$entity_name_plural_lower}/";
            if (str_starts_with($view_file, 'layouts/')) {
              $view_dir_path = CI4_BASE_PATH . "/app/Views/layouts/";
              $view_file = str_replace('layouts/', '', $view_file);
            } elseif (str_starts_with($view_file, 'modals/')) {
              $view_dir_path = CI4_BASE_PATH . "/app/Views/modals/";
              $view_file = str_replace('modals/', '', $view_file);
            }
            $view_path = $view_dir_path . $view_file;
            $overwrite_special = (str_starts_with($view_file, 'layouts/') || str_starts_with($view_file, 'modals/')) ? ($arguments['options']['overwrite'] ?? false) : ($arguments['options']['overwrite'] ?? false);
            write_file($view_path, $content, $overwrite_special);
          }
        }
      } else {
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        echo "Gerando Views para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**)\n";
        $table_info = inspect_table($pdo, $table_name);
        $columns = $table_info['columns'];
        $view_contents = generate_view_contents($arguments['entity_name'], $table_name, $columns);
        $entity_name_plural_lower = strtolower(pluralize($arguments['entity_name']));
        foreach ($view_contents as $view_file => $content) {
          $view_dir_path = CI4_BASE_PATH . "/app/Views/{$entity_name_plural_lower}/";
          if (str_starts_with($view_file, 'layouts/')) {
            $view_dir_path = CI4_BASE_PATH . "/app/Views/layouts/";
            $view_file = str_replace('layouts/', '', $view_file);
          } elseif (str_starts_with($view_file, 'modals/')) {
            $view_dir_path = CI4_BASE_PATH . "/app/Views/modals/";
            $view_file = str_replace('modals/', '', $view_file);
          }
          $view_path = $view_dir_path . $view_file;
          $overwrite_special = (str_starts_with($view_file, 'layouts/') || str_starts_with($view_file, 'modals/')) ? ($arguments['options']['overwrite'] ?? false) : ($arguments['options']['overwrite'] ?? false);
          write_file($view_path, $content, $overwrite_special);
        }
      }
      break;
    case 'route':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Imprimindo Rotas para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          echo generate_route_suggestion($entity_name_pascal, $table_name) . "\n";
        }
      } else {
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        echo "Imprimindo Rotas para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**)\n";
        echo generate_route_suggestion($arguments['entity_name'], $table_name) . "\n";
      }
      break;
    case 'helper':
      echo "Gerando Helper: **{$arguments['entity_name']}**\n";
      $helper_content = generate_helper_content($arguments['entity_name']);
      $helper_file_name = pascal_to_snake_case($arguments['entity_name']) . '_helper.php';
      $helper_path = CI4_BASE_PATH . "/app/Helpers/{$helper_file_name}";
      write_file($helper_path, $helper_content, $arguments['options']['overwrite'] ?? false);
      break;
    case 'seed': // Novo caso para gerar Seeds
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Seeds para todas as tabelas com dados existentes: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          $seeder_content = generate_seeder_content($entity_name_pascal, $table_name, $pdo);
          $seeder_file_name = "{$entity_name_pascal}Seeder.php";
          $seeder_path = CI4_BASE_PATH . "/app/Database/Seeds/{$seeder_file_name}";
          write_file($seeder_path, $seeder_content, $arguments['options']['overwrite'] ?? false);
        }
      } else {
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        echo "Gerando Seeder para a entidade: **{$arguments['entity_name']}** (Tabela: **{$table_name}**) com dados existentes.\n";
        $seeder_content = generate_seeder_content($arguments['entity_name'], $table_name, $pdo);
        $seeder_file_name = "{$arguments['entity_name']}Seeder.php";
        $seeder_path = CI4_BASE_PATH . "/app/Database/Seeds/{$seeder_file_name}";
        write_file($seeder_path, $seeder_content, $arguments['options']['overwrite'] ?? false);
      }
      break;
    default:
      // Este caso não deve ser alcançado devido à validação em parse_arguments,
      // mas é um fallback seguro.
      echo "Erro: Tipo de componente inválido ou não implementado.\n";
      display_help();
      exit(1);
  }
} catch (Exception $e) {
  echo "Erro inesperado: " . $e->getMessage() . "\n";
  exit(1);
}

/**
 * Gera o conteúdo de um arquivo de seed para uma tabela específica.
 *
 * @param PDO $pdo A conexão PDO com o banco de dados.
 * @param string $table_name O nome da tabela.
 * @return string O conteúdo PHP do arquivo de seed.
 * @throws Exception Se ocorrer um erro ao buscar os dados da tabela.
 */
function generate_seed_content(PDO $pdo, string $table_name): string
{
  $class_name = 'Create' . str_replace(' ', '', ucwords(str_replace('_', ' ', $table_name))) . 'Seeder';

  try {
    // Seleciona todos os dados da tabela
    $stmt = $pdo->query("SELECT * FROM `{$table_name}`");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    error_log("ERRO PDO ao buscar dados para seed da tabela '{$table_name}': " . $e->getMessage());
    throw new Exception("Erro de banco de dados ao buscar dados para seed de '{$table_name}': " . $e->getMessage());
  }

  if (empty($rows)) {
    // Se a tabela estiver vazia, podemos retornar um seed básico sem dados
    // ou lançar uma exceção se você preferir não criar seeds para tabelas vazias.
    // Por simplicidade, vamos gerar um seed vazio.
    echo "AVISO: Tabela '{$table_name}' está vazia. Gerando seed sem dados.\n";
    $data_php = "[]"; // Array vazio
  } else {
    // Formata os dados em uma string PHP para o array $data
    $data_php_parts = [];
    foreach ($rows as $row) {
      $row_parts = [];
      foreach ($row as $col_name => $col_value) {
        // Escapar valores para PHP. NULL vira 'NULL', strings com aspas, etc.
        if (is_null($col_value)) {
          $row_parts[] = "'{$col_name}' => null";
        } elseif (is_int($col_value) || is_float($col_value)) {
          $row_parts[] = "'{$col_name}' => {$col_value}";
        } else {
          // Escapar aspas simples dentro da string
          $escaped_value = str_replace("'", "\\'", $col_value);
          $row_parts[] = "'{$col_name}' => '{$escaped_value}'";
        }
      }
      $data_php_parts[] = "[" . implode(",\n            ", $row_parts) . "]";
    }
    $data_php = "[\n            " . implode(",\n            ", $data_php_parts) . "\n        ]";
  }


  $template = <<<EOT
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class {$class_name} extends Seeder
{
    public function run()
    {
        \$data = {$data_php};

        // Inserir os dados na tabela
        // Certifique-se de que a tabela esteja limpa antes de inserir se for um seed de teste
        // \$this->db->table('{$table_name}')->truncate(); // Descomente para limpar antes de inserir
        if (!empty(\$data)) {
            \$this->db->table('{$table_name}')->insertBatch(\$data);
        } else {
            // Se o array de dados estiver vazio, você pode optar por não fazer nada
            // ou logar uma mensagem.
            // \$this->call('OutroSeederCasoVazio'); // Exemplo: chamar outro seeder
            \$this->db->table('{$table_name}')->where('id IS NOT NULL')->delete(); // Exemplo: limpar a tabela se o seed for vazio
        }
    }
}
EOT;

  return $template;
}

/**
 * Retorna uma lista de todas as tabelas no banco de dados SQLite.
 *
 * @param PDO $pdo A conexão PDO com o banco de dados.
 * @return array Uma lista de nomes de tabelas.
 */
function get_table_names(PDO $pdo): array
{
  // A query para obter nomes de tabelas no SQLite é específica:
  // sqlite_master é uma tabela interna do SQLite que contém metadados sobre o banco de dados.
  // type = 'table' filtra apenas por tabelas.
  // name NOT LIKE 'sqlite_%' exclui tabelas internas do SQLite como sqlite_sequence, sqlite_master, etc.
  // name != 'migrations' exclui a tabela de migrações do CodeIgniter, se você não quiser depender da IGNORED_TABLES para isso.
  $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name != 'migrations'");
  $tables = $stmt->fetchAll(PDO::FETCH_COLUMN); // PDO::FETCH_COLUMN retorna apenas os valores da primeira coluna

  return $tables;
}

echo "\nProcesso concluído.\n";

// Finaliza o script com sucesso
exit(0);
