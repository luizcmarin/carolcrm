<?php

// --- CONSTANTES DE CONFIGURAÇÃO ---
// Caminho para o seu banco de dados SQLite.
// Certifique-se de que este caminho está correto para o seu ambiente.
define('SQLITE_DB_PATH', __DIR__ . '/writable/database/carolcrm.db');

// Caminho base da sua aplicação CodeIgniter 4.
// Ajuste se sua estrutura de diretórios for diferente.
define('CI4_BASE_PATH', __DIR__ . '/ci4_app');

// Tabelas que devem ser ignoradas na geração de Seeds (ex: tabelas de sistema, tabelas de migrações)
const IGNORED_TABLES = ['migrations', 'sqlite_sequence'];

// --- FUNÇÕES DE UTILIDADE GERAIS ---

/**
 * Converte uma string de snake_case para PascalCase.
 * Ex: 'nome_do_campo' -> 'NomeDoCampo'
 */
function snake_to_pascal_case(string $snake_case_string): string
{
  return str_replace('_', '', ucwords($snake_case_string, '_'));
}

/**
 * Converte uma string de PascalCase para snake_case.
 * Ex: 'NomeDoCampo' -> 'nome_do_campo'
 */
function pascal_to_snake_case(string $pascal_case_string): string
{
  return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $pascal_case_string));
}

/**
 * Pluraliza uma palavra em português (simplificado).
 * Esta função tenta cobrir as regras mais comuns de pluralização em português.
 * Para uma pluralização 100% precisa, considere usar uma biblioteca de processamento de linguagem natural.
 *
 * @param string $word A palavra a ser pluralizada (espera-se que esteja no singular).
 * @return string A palavra pluralizada.
 */
function pluralize(string $word): string
{
  return $word;   // tabelas já estão no plural.


  $word = strtolower($word); // Trabalha com a palavra em minúsculas
  $last_char = substr($word, -1);
  $second_last_char = substr($word, -2, 1);

  // Regras mais comuns para o português
  // 1. Termina em Vogal: Adiciona 's'
  if (in_array($last_char, ['a', 'e', 'i', 'o', 'u'])) {
    return $word . 's';
  }

  // 2. Termina em 'r' ou 'z': Adiciona 'es'
  if (in_array($last_char, ['r', 'z'])) {
    return $word . 'es';
  }

  // 3. Termina em 's' (e não é oxítona): Mantém
  // Ex: ônibus, lápis. (Mas se for 'país', vira 'países' - complexo!)
  // Para simplificar, se já termina em 's', assume-se que é invariável ou já plural.
  if ($last_char === 's' && !in_array(substr($word, -2), ['ês', 'is', 'os', 'us'])) { // Evita palavras como "país" ou "flor"
    // Se a palavra já termina em 's' e não é uma exceção de 's' para 'ses', mantém como está.
    // Ex: "lápis", "ônibus".
    return $word;
  }
  // Caso de 's' no final que precisa de 'es' (ex: país -> países)
  if (str_ends_with($word, 'ês') || str_ends_with($word, 'is') || str_ends_with($word, 'us')) {
    // Assume que estas são singulares e precisam de 'es'
    // Ex: país -> países, lápis -> lápises (apesar de lápis ser invariável), ônibus -> ônibus (já invariável)
    // Isso é uma simplificação.
  }


  // 4. Termina em 'ão':
  // - 'ão' -> 'ões' (ex: ação -> ações)
  // - 'ão' -> 'ãos' (ex: mão -> mãos) - Menos comum para nomes de entidades.
  // - 'ão' -> 'ães' (ex: pão -> pães)
  // Para simplificar, priorizamos 'ões' para nomes de entidades.
  if (str_ends_with($word, 'ão')) {
    return substr($word, 0, -2) . 'ões';
  }

  // 5. Termina em 'l':
  // - 'al', 'el', 'ol', 'ul' -> 'is' (ex: animal -> animais)
  // - 'il'
  //   - Oxítonas: 'il' -> 'is' (ex: funil -> funis)
  //   - Paroxítonas: 'il' -> 'eis' (ex: fóssil -> fósseis)
  // Para simplificar, assumimos o caso mais comum 'is' para a maioria.
  if (str_ends_with($word, 'al') || str_ends_with($word, 'el') || str_ends_with($word, 'ol') || str_ends_with($word, 'ul')) {
    return substr($word, 0, -1) . 'is';
  }
  if (str_ends_with($word, 'il')) {
    // Simplificado: para evitar regras de oxítona/paroxítona, podemos padronizar.
    // Se a maioria de seus nomes de tabela com 'il' forem oxítonas, 'is' é bom.
    // Se forem paroxítonas, 'eis' é melhor.
    return substr($word, 0, -2) . 'is'; // Ex: funil -> funis. Pode não ser ideal para fóssil -> fósseis
  }

  // 6. Termina em 'm': 'm' -> 'ns' (ex: homem -> homens)
  if ($last_char === 'm') {
    return substr($word, 0, -1) . 'ns';
  }

  // 7. Termina em 'x': Invariável (ex: tórax, ônix)
  if ($last_char === 'x') {
    return $word;
  }

  // Caso padrão para outras consoantes, adiciona 'es'
  return $word . 'es';
}

/**
 * Singulariza uma palavra em português (simplificado).
 * Esta função tenta cobrir as regras mais comuns de singularização em português.
 * É o inverso de pluralize, mas também com limitações para casos complexos.
 *
 * @param string $word A palavra a ser singularizada (espera-se que esteja no plural).
 * @return string A palavra singularizada.
 */
function singularize(string $word): string
{
  $word = strtolower($word); // Trabalha com a palavra em minúsculas

  // Regras de singularização (inversas do plural)
  // 1. Termina em 'ões': 'ões' -> 'ão'
  if (str_ends_with($word, 'ões')) {
    return substr($word, 0, -3) . 'ão';
  }
  // 2. Termina em 'ães': 'ães' -> 'ão'
  if (str_ends_with($word, 'ães')) {
    return substr($word, 0, -3) . 'ão';
  }
  // 3. Termina em 'is' (quando a singular termina em 'al', 'el', 'ol', 'ul', 'il' oxítona)
  if (str_ends_with($word, 'ais')) {
    return substr($word, 0, -3) . 'al';
  }
  if (str_ends_with($word, 'eis')) { // Pode ser de 'el' ou 'il' paroxítona
    // Para 'eis' pode ser 'el' ou 'il'. Prioriza 'el'.
    // Ex: papéis -> papel, fósseis -> fóssil
    if (strlen($word) > 3 && in_array(substr($word, -4, 1), ['s', 'f', 'v'])) { // Tentativa de diferenciar fósseis/mísseis
      return substr($word, 0, -3) . 'il'; // Mísseis -> míssil
    }
    return substr($word, 0, -3) . 'el'; // Papéis -> papel
  }
  if (str_ends_with($word, 'ois')) {
    return substr($word, 0, -3) . 'ol';
  }
  if (str_ends_with($word, 'uis')) {
    return substr($word, 0, -3) . 'ul';
  }
  if (str_ends_with($word, 'is') && !str_ends_with($word, 'ais') && !str_ends_with($word, 'eis') && !str_ends_with($word, 'ois') && !str_ends_with($word, 'uis')) {
    // Se termina em 'is' mas não é de 'al/el/ol/ul', pode ser de 'il' ou já invariável
    // Para simplificar, assume 'il' se não for um 'is' de vogal + 's'
    if (substr($word, -3, 1) !== 's' && strlen($word) > 2) { // Evita pegar palavras como 'lápis' que são invariáveis
      return substr($word, 0, -2) . 'il'; // Funis -> funil
    }
  }


  // 4. Termina em 'ns': 'ns' -> 'm'
  if (str_ends_with($word, 'ns')) {
    return substr($word, 0, -2) . 'm';
  }

  // 5. Termina em 'es' (se a singular terminar em 'r' ou 'z')
  if (str_ends_with($word, 'es')) {
    $singular_attempt = substr($word, 0, -2);
    // Tenta inferir se a singular era 'r' ou 'z'
    if (str_ends_with($singular_attempt, 'r') || str_ends_with($singular_attempt, 'z')) {
      return $singular_attempt;
    }
    // Casos como "paredes" -> "parede" (se não for "r" ou "z")
    // Aqui está a complexidade, pois "aulas" -> "aula" (só remove 's')
    // Vamos testar se o penúltimo é uma vogal para casos como "cidades" -> "cidade"
    $second_last_plural = substr($word, -2, 1);
    if ($second_last_plural === 'e' && in_array(substr($word, -3, 1), ['d', 't', 'p'])) { // Ex: cidades, paredes
      return substr($word, 0, -1); // Remove só o 's'
    }
  }

  // 6. Termina em 's' (e a singular terminava em vogal)
  if (str_ends_with($word, 's')) {
    // Considera que se terminou em vogal no singular, apenas remove o 's'
    // Ex: 'carros' -> 'carro', 'casas' -> 'casa'
    return substr($word, 0, -1);
  }

  // Se nenhuma regra se aplicar (palavra já era singular ou exceção)
  return $word;
}

/**
 * Analisa os argumentos da linha de comando.
 * Ex: php fazer.php crud Usuario --overwrite
 */
function parse_arguments(array $argv): array
{
  $arguments = [
    'type' => null,
    'entity_name' => null,
    'options' => []
  ];

  if (count($argv) < 2) {
    display_help();
    exit(1);
  }

  $arguments['type'] = $argv[1];

  if (isset($argv[2])) {
    $arguments['entity_name'] = $argv[2];
  }

  // Processa opções como --overwrite
  for ($i = 3; $i < count($argv); $i++) {
    if (str_starts_with($argv[$i], '--')) {
      $option = substr($argv[$i], 2);
      $arguments['options'][$option] = true;
    }
  }

  // Validação básica do tipo
  $valid_types = ['all', 'crud', 'migration', 'model', 'controller', 'view', 'entity', 'seed']; // Adicionado 'entity' e 'seed'
  if (!in_array($arguments['type'], $valid_types)) {
    echo "Erro: Tipo de componente inválido. Tipos permitidos: " . implode(', ', $valid_types) . "\n";
    display_help();
    exit(1);
  }

  // Validação para comandos que precisam de entity_name
  $needs_entity_name = ['crud', 'migration', 'model', 'controller', 'view', 'entity', 'seed'];
  if (in_array($arguments['type'], $needs_entity_name) && $arguments['entity_name'] === null && $arguments['entity_name'] !== 'all') {
    echo "Erro: O comando '{$arguments['type']}' requer um nome de entidade (ou 'all').\n";
    display_help();
    exit(1);
  }

  return $arguments;
}

/**
 * Exibe a mensagem de ajuda.
 */
function display_help(): void
{
  echo "Uso: php fazer.php <tipo> [nome_da_entidade | all] [--overwrite]\n";
  echo "Tipos:\n";
  echo "  all        Gera CRUD completo (Migration, Model, Entity, Controller, Views, Seeder) para TODAS as tabelas.\n";
  echo "  crud       Gera CRUD completo para uma entidade específica.\n";
  echo "  migration  Gera apenas a Migration para uma entidade (ou 'all').\n";
  echo "  model      Gera apenas o Model para uma entidade (ou 'all').\n";
  echo "  entity     Gera apenas a Entity para uma entidade (ou 'all').\n";
  echo "  controller Gera apenas o Controller para uma entidade (ou 'all').\n";
  echo "  view       Gera apenas as Views para uma entidade (ou 'all').\n";
  echo "  seed       Gera o Seeder com dados existentes para uma entidade (ou 'all').\n";
  echo "Opções:\n";
  echo "  --overwrite  Sobrescreve arquivos existentes.\n";
  echo "Exemplos:\n";
  echo "  php fazer.php crud Usuario\n";
  echo "  php fazer.php migration all --overwrite\n";
  echo "  php fazer.php view Produto\n";
  echo "  php fazer.php seed Usuarios\n";
}

/**
 * Escreve o conteúdo em um arquivo, criando diretórios se necessário.
 *
 * @param string $path O caminho completo do arquivo.
 * @param string $content O conteúdo a ser escrito.
 * @param bool $overwrite Se deve sobrescrever arquivos existentes.
 */
function write_file(string $path, string $content, bool $overwrite = false): void
{
  $dir = dirname($path);
  if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
  }

  if (file_exists($path) && !$overwrite) {
    echo "Arquivo já existe e --overwrite não especificado, ignorando: " . basename($path) . "\n";
    return;
  }

  file_put_contents($path, $content);
  echo "Gerado: " . basename($path) . " em " . $dir . "\n";
}

// --- FUNÇÕES DE GERAÇÃO DE CONTEÚDO PARA ARQUIVOS CI4 ---

/**
 * Gera o conteúdo PHP para um arquivo de Migration do CodeIgniter 4.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @param array $columns Detalhes das colunas obtidos do PRAGMA table_info.
 * @param array $foreign_keys Detalhes das chaves estrangeiras obtidos do PRAGMA foreign_key_list.
 * @return string O conteúdo PHP da Migration.
 */
function generate_migration_content(string $entity_name_pascal, string $table_name, array $columns, array $foreign_keys): string
{
  $fields = [];
  $primary_key = '';
  foreach ($columns as $column) {
    $field_name = $column['name'];
    $ci4_type = map_sqlite_type_to_ci4_forge_type($column['type']);
    $constraint = '';

    if ($ci4_type === 'VARCHAR' || $ci4_type === 'TEXT') {
      // Se for VARCHAR, tenta determinar um tamanho razoável se não houver um tipo exato de SQLite.
      // SQLite não tem VARCHAR(N) obrigatório, então isso é uma estimativa.
      $constraint = ($ci4_type === 'VARCHAR') ? ", 'constraint' => 255" : "";
    } elseif ($ci4_type === 'INT') {
      $constraint = ", 'constraint' => 11"; // Tamanho padrão para INT
    } elseif ($ci4_type === 'DOUBLE' || $ci4_type === 'DECIMAL') {
      $constraint = ", 'constraint' => '10,2'"; // Exemplo para DECIMAL
    }

    $nullable = (bool)$column['notnull'] === false ? ", 'null' => true" : "";
    $default = $column['dflt_value'] !== null ? ", 'default' => " . var_export(trim($column['dflt_value'], "'"), true) : ""; // Remove aspas do default do SQLite

    $field_definition = "'type' => '{$ci4_type}'{$constraint}{$nullable}{$default}";

    if ((bool)$column['pk']) {
      $primary_key = $field_name;
      // Para chaves primárias auto-incrementáveis em SQLite (INTEGER PRIMARY KEY),
      // CodeIgniter Forge usa 'auto_increment'
      if (strtoupper($column['type']) === 'INTEGER' && $column['dflt_value'] === null) {
        $field_definition .= ", 'auto_increment' => true";
      }
    }

    $fields[] = "'{$field_name}' => [{$field_definition}]";
  }

  $add_fields_string = implode(",\n            ", $fields);

  $add_keys_string = "";
  if (!empty($primary_key)) {
    $add_keys_string .= "\$this->forge->addPrimaryKey('{$primary_key}');\n";
  }

  foreach ($foreign_keys as $fk) {
    $from_field = $fk['from'];
    $to_table = $fk['table'];
    $to_field = $fk['to'];
    $on_delete = !empty($fk['on_delete']) ? "->onDelete('{$fk['on_delete']}')" : "";
    $on_update = !empty($fk['on_update']) ? "->onUpdate('{$fk['on_update']}')" : "";
    $add_keys_string .= "        \$this->forge->addForeignKey('{$from_field}', '{$to_table}', '{$to_field}'{$on_delete}{$on_update});\n";
  }

  // Adiciona created_at, updated_at e deleted_at
  $timestamps = "";
  if (!in_array('created_at', array_column($columns, 'name'))) {
    $timestamps .= "        \$this->forge->addField([
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);\n";
  }
  if (!in_array('updated_at', array_column($columns, 'name'))) {
    $timestamps .= "        \$this->forge->addField([
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);\n";
  }
  if (!in_array('deleted_at', array_column($columns, 'name'))) {
    $timestamps .= "        \$this->forge->addField([
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);\n";
  }


  $migrationContent = <<<PHP
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create{$entity_name_pascal} extends Migration
{
    public function up()
    {
        \$this->forge->addField([
            {$add_fields_string}
        ]);

        {$add_keys_string}{$timestamps}
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
  $primaryKey = 'id'; // Assumindo 'id' é a PK padrão. Ajuste se sua inspeção de tabela retornar dinamicamente.

  $entity_name_pascalx = snake_to_pascal_case(singularize($table_name));

  $allowedFields = [];
  $validationRules = [];
  $globalValidationMessagesContent = ''; // Conteúdo para o $validationMessages do Model

  // Mensagens padrão para as regras de validação
  $common_messages = [
    'required'          => 'O campo {field} é obrigatório.',
    'cpf'               => 'O campo {field} é inválido.',
    'senha'             => 'O campo {field} é inválido.',
    'integer'           => 'O campo {field} deve ser um número inteiro.',
    'numeric'           => 'O campo {field} deve ser um valor numérico.',
    'valid_date'        => 'O campo {field} deve conter uma data/hora válida.',
    'max_length'        => 'O campo {field} deve ter no máximo {param} caracteres.',
    'valid_email'       => 'O campo {field} deve conter um endereço de e-mail válido.',
    'valid_url'         => 'O campo {field} deve conter uma URL válida.',
    'min_length'        => 'O campo {field} deve ter no mínimo {param} caracteres.',
    'is_unique'         => 'O valor informado para o campo {field} já está em uso.',
    'in_list'           => 'O campo {field} deve ser um dos valores permitidos: {param}.',
    'is_natural_no_zero' => 'O campo {field} deve ser um número natural maior que zero.',
    'permit_empty'      => 'O campo {field} não é obrigatório.', // Mensagem para permit_empty (apenas para documentação)
    'valid_date_format_date' => 'O campo {field} deve ser uma data válida no formato YYYY-MM-DD.',
    'valid_date_format_time' => 'O campo {field} deve ser uma hora válida no formato HH:MM:SS.',
    'valid_date_format_datetime' => 'O campo {field} deve ser uma data e hora válidas no formato YYYY-MM-DD HH:MM:SS.',
  ];

  // --- 1. Popula allowedFields e define regras de validação para cada coluna ---
  foreach ($columns as $column) {
    // Ignora a chave primária e campos de timestamp automáticos
    if ($column['name'] === $primaryKey || in_array(strtolower($column['name']), ['created_at', 'updated_at', 'deleted_at',])) {
      continue;
    }

    // Adiciona o campo ao array de campos permitidos
    $allowedFields[] = "'{$column['name']}'";

    $rules = []; // Array temporário para coletar as regras da coluna atual
    $field_errors = [];
    $column_name_display = ucwords(str_replace('_', ' ', $column['name'])); // Prepara o label
    $column_type = strtolower($column['type']); // Converte para minúsculas

    // --- Regra 'required' ou 'permit_empty' ---
    // Se a coluna é NOT NULL no DB e não tem valor padrão (obrigatória para inserção)
    if ((bool)$column['notnull'] === true && $column['default'] === null) {
      $rules[] = 'required';
      $field_errors['required'] = $common_messages['required'];
    } else {
      // Se pode ser nulo OU tem um valor padrão no DB, permite que seja vazio no formulário.
      // Para campos que são strings e permit_empty, muitas vezes também queremos max_length
      $rules[] = 'permit_empty';
    }

    // --- Regras de Tipo de Dados e Formato ---
    if (str_contains($column_type, 'int')) {
      $rules[] = 'integer';
      $field_errors['integer'] = $common_messages['integer'];
    } elseif (str_contains($column_type, 'real') || str_contains($column_type, 'float') || str_contains($column_type, 'doub') || str_contains($column_type, 'decimal') || str_contains($column_type, 'numeric')) {
      $rules[] = 'numeric';
      $field_errors['numeric'] = $common_messages['numeric'];
    } elseif (str_contains($column_type, 'date')) { // Apenas data (YYYY-MM-DD)
      $rules[] = 'valid_date[Y-m-d]';
      $field_errors['valid_date'] = $common_messages['valid_date_format_date']; // Mensagem específica para data
    } elseif (str_contains($column_type, 'time')) { // Apenas hora (HH:MM:SS)
      $rules[] = 'valid_date[H:i:s]';
      $field_errors['valid_date'] = $common_messages['valid_date_format_time']; // Mensagem específica para hora
    } elseif (str_contains($column_type, 'datetime') || str_contains($column_type, 'timestamp')) { // Data e hora
      $rules[] = 'valid_date[Y-m-d H:i:s]';
      $field_errors['valid_date'] = $common_messages['valid_date_format_datetime']; // Mensagem específica para data e hora
    } elseif (str_contains($column_type, 'char') || str_contains($column_type, 'varchar')) {
      // Adiciona max_length para VARCHAR. Assume 255 se não detectado (comum em SQLite).
      if (isset($column['max_length']) && $column['max_length'] > 0) {
        $rules[] = 'max_length[' . $column['max_length'] . ']';
        $field_errors['max_length'] = str_replace('{param}', $column['max_length'], $common_messages['max_length']);
      } else {
        $defaultMaxLength = 255; // Define o valor padrão para a regra e para a mensagem
        $rules[] = 'max_length[' . $defaultMaxLength . ']';
        $field_errors['max_length'] = str_replace('{param}', $defaultMaxLength, $common_messages['max_length']);
      }
    } elseif (str_contains($column_type, 'text')) {
      // Para TEXT, considere adicionar um max_length se quiser um limite lógico no formulário.
      // $rules[] = 'max_length[5000]';
    } elseif (str_contains($column['name'], 'sn_')) {
      $rules[] = 'in_list';
      $field_errors['in_list'] = $common_messages['in_list'];
    }

    // --- Regras Específicas Baseadas no Nome da Coluna (heurísticas) ---
    if (str_contains($column['name'], 'email')) {
      $rules[] = 'valid_email';
      $field_errors['valid_email'] = $common_messages['valid_email'];
    }
    if (str_contains($column['name'], 'url')) {
      $rules[] = 'valid_url';
      $field_errors['valid_url'] = $common_messages['valid_url'];
    }
    if (str_contains($column['name'], 'cpf') || str_contains($column['name'], 'cnpj')) {
      // Placeholder para regras personalizadas de CPF/CNPJ
      // $rules[] = 'valida_cpf_cnpj';
      $field_errors['cpf'] = $common_messages['cpf'];
    }
    if (str_contains($column['name'], 'senha') || str_contains($column['name'], 'password')) {
      $rules[] = 'min_length[8]'; // Mínimo para senhas
      // $rules[] = 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/]';
      $field_errors['senha'] = $common_messages['senha']; // Senha forte
    }

    // Constrói a string final de regras (ex: "required|integer|max_length[255]")
    $rule_string = implode('|', $rules);
    $field_errorsss = implode('|', $field_errors);

    // Se houver regras, adiciona ao array de validação
    if (!empty($rule_string)) {
      $validationRules[] = <<<RULE
             '{$column['name']}' => [
                 'label' => '{$column_name_display}',
                 'rules' => '{$rule_string}',    
                 'errors' => '{$field_errorsss}',
             ],
 RULE;
    }
  }

  $allowedFieldsString = implode(', ', $allowedFields);
  $validationRulesString = implode("\n", $validationRules);


  $modelContent = <<<PHP
 <?php
 
 namespace App\Models;
 
 use CodeIgniter\Model;
 use App\Models\Traits\AuditoriaTrait;
 
 class {$entity_name_pascal}Model extends Model
 {
     use AuditoriaTrait;

     protected \$table           = '{$table_name}';
     protected \$primaryKey      = '{$primaryKey}';
     protected \$useAutoIncrement = true;
     protected \$returnType      = 'App\\Entities\\{$entity_name_pascalx}';
     protected \$useSoftDeletes  = true;
     protected \$protectFields   = true;
     protected \$allowedFields   = [{$allowedFieldsString}];
 
     // Dates
     protected \$useTimestamps = true;
     protected \$dateFormat    = 'datetime';
     protected \$createdField  = 'created_at'; 
     protected \$updatedField  = 'updated_at';
     protected \$deletedField  = 'deleted_at'; 
 
     // Validation
     protected \$validationRules = [
 {$validationRulesString}
     ];
     protected \$validationMessages  = [
     ];
     protected \$skipValidation      = false;
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

     
    /**
     * Busca um único registro no banco de dados com base em condições.
     *
     * @param array \$conditions Um array associativo de condições (coluna => valor).
     * Ex: ['id' => 1], ['email' => 'teste@email.com'], ['nome' => 'Marin', 'sn_ativo' => 'Sim']
     * @return object|null Retorna o objeto da Entidade (se encontrado) ou null (se não encontrado).
     */
    public function getOne(array \$conditions = []): ?object
    { 
        if (empty(\$conditions)) {
            return null;
        }

        return \$this->where(\$conditions)->first();
    }

    /**
     * Busca múltiplos registros no banco de dados com base em condições, limite e offset.
     *
     * @param array \$conditions Um array associativo de condições (coluna => valor).
     * @param int \$limit O número máximo de registros a retornar (0 para sem limite).
     * @param int \$offset O offset inicial para a busca (útil para paginação).
     * @return array Retorna um array de objetos de Entidade (se encontrados) ou um array vazio.
     */
    public function getMany(array \$conditions = [], int \$limit = 0, int \$offset = 0): array
    {
        \$query = \$this->where(\$conditions);

        if (\$limit > 0) {
            \$query->limit(\$limit,\$offset);
        }

        return \$query->findAll();
    }

    /**
     * Conta o número de registros no banco de dados com base em condições.
     *
     * @param array \$conditions Um array associativo de condições (coluna => valor).
     * @return int Retorna o número total de registros que correspondem às condições.
     */
    public function countRecords(array \$conditions = []): int
    {
        return \$this->where(\$conditions)->countAllResults();
    }

    /**
     * Busca todos os registros que foram soft-deleted (marcados como deletados).
     * Funciona apenas se \$useSoftDeletes estiver definido como true no Model.
     *
     * @return array Retorna um array de objetos de Entidade de registros deletados.
     */
    public function findDeleted(): array
    {
        if (\$this->useSoftDeletes) {
            return \$this->onlyDeleted()->findAll();
        }
        return [];
    }

    /**
     * Exclui permanentemente um registro do banco de dados, ignorando o soft delete.
     *
     * @param int \$id O ID da chave primária do registro a ser excluído permanentemente.
     * @return bool Retorna true em caso de sucesso, false caso contrário.
     */
    public function forceDelete(int \$id): bool
    {
        return \$this->delete(\$id, true);
    }

    /**
     * Verifica se um ou mais registros existem com base em condições fornecidas.
     *
     * @param array \$conditions Um array associativo de condições (coluna => valor).
     * @return bool Retorna true se pelo menos um registro for encontrado, false caso contrário.
     */
    public function exists(array \$conditions = []): bool
    {
        if (empty(\$conditions)) {
            return false; // Não faz sentido verificar existência sem condições
        }
        // Usa select('1') para otimizar, pois só precisamos saber se há algum resultado, não os dados.
        return \$this->where(\$conditions)->select('1')->limit(1)->countAllResults() > 0;
    }

    /**
     * Retorna um array de opções para dropdowns (chave => valor) com base em campos e condições.
     *
     * @param string \$valueField O nome do campo que será o 'valor' (ex: 'id').
     * @param string \$labelField O nome do campo que será o 'rótulo' visível (ex: 'nome').
     * @param array \$conditions Um array associativo de condições para filtrar os resultados.
     * @param string \$orderBy O campo para ordenar os resultados.
     * @param string \$orderDirection A direção da ordenação ('ASC' ou 'DESC').
     * @return array Um array associativo (valueField => labelField) para uso em dropdowns.
     */
    public function getDropdown(string \$valueField, string \$labelField, array \$conditions = [], string \$orderBy = '', string \$orderDirection = 'ASC'): array
    {
        \$query = \$this->select("{\$valueField}, {\$labelField}")
                       ->where(\$conditions);

        if (!empty(\$orderBy)) {
            \$query->orderBy(\$orderBy, \$orderDirection);
        } else {
            // Ordena pelo labelField por padrão se nenhum orderBy for fornecido
            \$query->orderBy(\$labelField, \$orderDirection);
        }

        \$results = \$query->findAll();
        \$options = [];
        foreach (\$results as \$row) {
            \$options[\$row->\$valueField] = \$row->\$labelField;
        }
        return \$options;
    }
  }
 PHP;

  return $modelContent;
}

/**
 * Gera o conteúdo PHP para um arquivo de Controller do CodeIgniter 4.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @return string O conteúdo PHP do Controller.
 */
function generate_controller_content(string $entity_name_pascal, string $table_name): string
{
  $entity_name_singular_lower = strtolower($entity_name_pascal);
  $entity_name_plural_lower = strtolower(pluralize($entity_name_pascal));
  $entity_name_plural_upper = strtoupper(pluralize($entity_name_pascal));

  $entity_name_pascalx = snake_to_pascal_case(singularize($table_name));

  $controllerContent = <<<PHP
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\\{$entity_name_pascal}Model;
use App\Entities\\{$entity_name_pascalx};

class {$entity_name_pascal} extends BaseController
{
    protected \$model;   
    protected \$searchableFields = [
        'nome',
    ];

    public function __construct()
    {
        \$this->model = new {$entity_name_pascal}Model();
    }

    /**
     * Exibe a lista de todos os registros.
     *
     * @return string
     */
    public function index(): string
    { 
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.INDEX')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        \$search = \$this->request->getVar('search');

        \$query = \$this->model;

        if (!empty(\$search)) {
            \$query->groupStart();
            foreach (\$this->searchableFields as \$field) {
                \$query->orLike(\$field, \$search);
            }
            \$query->groupEnd();
        }

      \$perPage = 10;

      \$registros = \$query->paginate(\$perPage);
      \$pager = \$this->model->pager;

      \$currentPage = \$pager->getCurrentPage();
      \$totalRecords = \$pager->getTotal();

      \$firstItem = ((\$currentPage - 1) * \$perPage) + 1;
      \$lastItem = min(\$currentPage * \$perPage, \$totalRecords);

      \$data = [
          'titulo'       => 'Lista de consulta',
          'registros'    => \$registros,
          'search'       => \$search,
          'pager'        => \$pager,
          'firstItem'    => \$firstItem,
          'lastItem'     => \$lastItem,
          'totalRecords' => \$totalRecords,
      ];

      return view('{$entity_name_plural_lower}/index', \$data);
    }

    /**
     * Exibe o formulário para criação.
     *
     * @return string
     */
    public function new(): string
    {
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.NOVO')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        \$data = [
            'titulo' => 'Novo',
        ];

        // carrega dados relacionados
        // \$data['tabela_options'] = \$this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('{$entity_name_plural_lower}/new', \$data);
    }

    /**
     * Salva um novo registro.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.NOVO')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        \$postData = \$this->request->getPost();

        \$registro = new {$entity_name_pascalx}();
        \$registro->fill(\$postData);

        if (\$this->model->save(\$registro)) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('success', 'Registro criado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', \$this->model->errors());
        }
    }

    /**
     * Exibe o formulário para edição.
     *
     * @param int \$id O ID do registro.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit(int \$id)
    {
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.EDITAR')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        \$registros = \$this->model->find(\$id);m

        if (!\$registros) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('error', 'Registro não encontrado.');
        }

        \$data = [
            'titulo' => 'Editar',
            'registros' => \$registros,
        ];
        
        // carrega dados relacionados
        // \$data['tabela_options'] = \$this->tabelaModel->getDropdown('id', 'nome', [], 'nome', 'ASC');

        return view('{$entity_name_plural_lower}/edit', \$data);
    }

    /**
     * Atualiza um registro existente no banco de dados.
     *
     * @param int \$id O ID do registro.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update(int \$id): \CodeIgniter\HTTP\RedirectResponse
    {
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.EDITAR')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        \$registros = \$this->model->find(\$id);
        if (!\$registros) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('error', 'Registro não encontrado.');
        }

        \$postData = \$this->request->getPost();

        // Lógica para campos 'sn_'
        if (!isset(\$postData['sn_ativo'])) {
          \$postData['sn_ativo'] = 'Não';
        }

        \$registros->fill(\$postData);

        if (\$this->model->save(\$registros)) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('success', 'Registro atualizado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', \$this->model->errors());
        }
    }

    /**
     * Exibe os detalhes de um registro específico.
     *
     * @param int \$id O ID do registro.
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function show(int \$id)
    {
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.VER')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        \$registros = \$this->model->find(\$id);

        if (!\$registros) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('error', 'Registro não encontrado.');
        }
    
        \$data = [
            'titulo' => 'Detalhes',
            'registros' => \registros,
        ];
        return view('{$entity_name_plural_lower}/show', \$data);
    }

    /**
     * Exclui um registro do banco de dados.
     *
     * @param int \$id O ID do registro.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete(int \$id): \CodeIgniter\HTTP\RedirectResponse
    {
      if (!\$this->Carol->pode('{$entity_name_plural_upper}.EXCLUIR')) {
        return redirect()->to(site_url())->with('error', 'Acesso negado.');
      }

        if (\$this->model->delete(\$id)) {
            return redirect()->to('/{$entity_name_plural_lower}')->with('success', 'Registro excluído com sucesso!');
        } else {
            \$errors = \$this->model->errors();
            \$message = !empty(\$errors) ? implode('<br>', \$errors) : 'Erro ao excluir o registro. Verifique os logs.';
            return redirect()->back()->with('error', \$message);
        }
    }
  }
PHP;
  return $controllerContent;
}

if (!function_exists('map_sqlite_type_to_ci4_forge_type')) {
  function map_sqlite_type_to_ci4_forge_type(string $sqlite_type): string
  {
    $sqlite_type = strtoupper($sqlite_type);
    switch ($sqlite_type) {
      case 'INTEGER':
      case 'TINYINT':
      case 'SMALLINT':
      case 'MEDIUMINT':
      case 'BIGINT':
        return 'INT';
      case 'REAL':
      case 'DOUBLE':
      case 'FLOAT':
        return 'DOUBLE';
      case 'NUMERIC':
      case 'DECIMAL':
        return 'DECIMAL';
      case 'BOOLEAN':
        return 'BOOLEAN';
      case 'DATE':
        return 'DATE';
      case 'DATETIME':
        return 'DATETIME';
      case 'CLOB':
      case 'TEXT':
        return 'TEXT';
      case 'BLOB':
        return 'BLOB';
      default:
        // Default to VARCHAR if no specific mapping
        return 'VARCHAR';
    }
  }
}

// Esta função write_file é um placeholder. No seu ambiente real,
// você usaria a função 'write_file' do CodeIgniter ou uma função de arquivo PHP.
if (!function_exists('write_file')) {
  function write_file(string $path, string $data, bool $overwrite = false): bool
  {
    $dir = dirname($path);
    if (!is_dir($dir)) {
      mkdir($dir, 0777, true); // Cria diretórios recursivamente
    }
    if (!$overwrite && file_exists($path)) {
      // Log ou aviso que o arquivo não foi sobrescrito
      // echo "Aviso: O arquivo {$path} já existe e não foi sobrescrito.\n";
      return false;
    }
    // return file_put_contents($path, $data) !== false; // Para uso real
    return true; // Simula sucesso para demonstração
  }
}

// Defina CI4_BASE_PATH se ainda não estiver definida
if (!defined('CI4_BASE_PATH')) {
  define('CI4_BASE_PATH', __DIR__ . '/..'); // Ajuste conforme a estrutura real do seu projeto CI4
}

// Adicione esta função auxiliar em seu script fazer.php
if (!function_exists('ensure_directory_exists')) {
  function ensure_directory_exists(string $path): void
  {
    if (!is_dir($path)) {
      if (!mkdir($path, 0777, true)) {
        die("Erro: Não foi possível criar o diretório: {$path}");
      }
    }
  }
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
  $entity_name_plural_upper = strtoupper(pluralize($entity_name_pascal));
  $primaryKey = 'id';
  $displayFields = []; // Campos a serem exibidos na tabela e nos detalhes/formulários
  $fkFields = []; // Campos que são chaves estrangeiras

  foreach ($columns as $column) {
    if ((bool)$column['pk']) {
      $primaryKey = $column['name'];
    }
    // Adiciona todos os campos exceto timestamps e soft delete para exibição
    if (!in_array($column['name'], ['id', 'created_at', 'updated_at', 'deleted_at'])) {
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
      ];
    }
  }

  // --- View: index.php (Lista) ---
  $headers = implode("\n                                    ", array_map(fn($field) => '<th>' . ucwords(str_replace('_', ' ', $field)) . '</th>', $displayFields));
  $rows = implode("\n                                    ", array_map(fn($field) => '<td><?= $registro->' . $field . ' ?></td>', $displayFields));

  $indexViewContent = <<<HTML
<?= \$this->extend('layout/principal') ?>
<?= \$this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= \$titulo ?></h1>
        
        <div class="d-sm-flex align-items-center">
            <div class="col-md-auto me-3"> 
              <form action="<?= current_url() ?>" method="GET" class="d-flex">
                  <div class="input-group">
                      <input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= esc(\$search ?? '') ?>">
                      <button class="btn btn-outline-secondary" type="submit" title="Pesquisar">
                          <i class="bi bi-search"></i>
                      </button>
                      <?php if (!empty(\$search)) : ?>
                          <a href="<?= current_url() ?>" class="btn btn-outline-danger" title="Limpar pesquisa">
                              <i class="bi bi-x-lg"></i>
                          </a>
                      <?php endif; ?>
                  </div>
              </form>
            </div>
            <div class="col-md-auto">
                <?php if (service('Carol')->pode('{$entity_name_plural_upper}.NOVO')) : ?>
                <a href="<?= base_url('{$entity_name_plural_lower}/new') ?>" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg text-white-50"></i> Novo
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
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
            <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {$headers}
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php if (!empty(\$registros)): ?>
                            <?php foreach (\$registros as \$registro): ?>
                                <tr>
                                    {$rows}
                                    <td>
                                        <?php if (service('Carol')->pode('{$entity_name_plural_upper}.VER')) : ?>
                                        <a href="<?= base_url('{$entity_name_plural_lower}/show/' . \$registro->id) ?>" class="btn btn-info btn-sm" title="Detalhes">
                                            <i class="bi bi-eye"></i> 
                                        </a>
                                        <?php endif; ?>
                                        <?php if (service('Carol')->pode('{$entity_name_plural_upper}.EDITAR')) : ?>
                                        <a href="<?= base_url('{$entity_name_plural_lower}/edit/' . \$registro->id) ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i> 
                                        </a>
                                        <?php endif; ?>
                                        <?php if (service('Carol')->pode('{$entity_name_plural_upper}.EXCLUIR')) : ?>
                                        <form action="<?= base_url('{$entity_name_plural_lower}/delete/' . \$registro->id) ?>" method="POST" class="d-inline form-delete">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                                <i class="bi bi-trash"></i> </button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <?= \$this->include('partes/paginacao') ?>
        </div>
        <div class="card-footer text-body-secondary">
        </div>
    </div>
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
    // Adiciona 'required' se a coluna for NOT NULL e não tiver valor padrão, e não for a PK.
    $required_attr = (bool)$column['notnull'] && $column['dflt_value'] === null && $column['name'] !== $primaryKey ? 'required' : '';

    if (isset($fkFields[$field])) { // É um campo de chave estrangeira
      $fkInfo = $fkFields[$field];
      $optionsVarName = $fkInfo['related_table_singular_snake'] . '_options';
      $formFieldsNew .= <<<HTML
      <div class="form-floating mb-3">
        <select class="form-select choices-select" id="{$inputName}" name="{$inputName}" {$required_attr}>
            <option value="" disabled selected><?= esc("Selecione um {$label}") ?></option>
            <?php
            \$selectedValue = old('{$inputName}', \${$entity_name_singular_lower}->{$inputName} ?? '');
            if (isset(\${$optionsVarName}) && is_array(\${$optionsVarName})) {
                foreach (\${$optionsVarName} as \$optionValue => \$optionLabel) {
                    \$selected = (\$optionValue == \$selectedValue) ? 'selected' : '';
                    echo "<option value=\"{\$optionValue}\" {\$selected}>" . esc(\$optionLabel) . "</option>";
                }
            }
            ?>
        </select>
        <label for="{$inputName}" class="form-label choices-label"><?= esc('$label') ?></label>
        <?php if (session('errors.{$inputName}')) : ?>
            <div class="invalid-feedback d-block">
                <?= session('errors.{$inputName}') ?>
            </div>
        <?php endif ?>
    </div>
HTML;
    } else { // Não é uma chave estrangeira
      // Tenta mapear tipos para inputs HTML
      $ci4Type = map_sqlite_type_to_ci4_forge_type($column['type']);
      if ($ci4Type === 'INT' || $ci4Type === 'DOUBLE' || $ci4Type === 'DECIMAL') {
        $type = 'number';
        $formFieldsNew .= <<<HTML
                <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group">
                        <input type="number" class="form-control text-center" id="{$inputName}" name="{$inputName}" 
                              placeholder="{$label}" value="" 
                              min="0" step="1" {$required_attr}> <label for="{$inputName}">{$label}</label>
                        <button class="btn btn-outline-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-outline-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.{$inputName}')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.{$inputName}') ?>
                        </div>
                    <?php endif ?>
                </div>
HTML;
      } elseif (str_contains($inputName, 'sn_')) {
        $type = 'text';
        $formFieldsNew .= <<<HTML
        <div class="mb-3 form-check form-switch">
            <input type="hidden" name="{$inputName}" value="Não"> 
            
            <input class="form-check-input" type="checkbox" role="switch" 
                   id="{$inputName}" 
                   name="{$inputName}" 
                   value="Não" 
                   {$required_attr}>
            <label class="form-check-label" for="{$inputName}">{$label}</label>
            
            <?php if (session('errors.{$inputName}')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.{$inputName}') ?>
                </div>
            <?php endif ?>
        </div>
HTML;
      } elseif (str_starts_with($inputName, 'data_')) {
        $type = 'date';
        $formFieldsNew .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control datepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_starts_with($inputName, 'datahora_')) {
        $type = 'date';
        $formFieldsNew .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control datetimepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_starts_with($inputName, 'hora_')) {
        $type = 'time';
        $formFieldsNew .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control timepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_ends_with($inputName, '_at')) {
        $type = 'datetime-local'; // Ou 'text' se preferir, o datepicker vai gerenciar
        $formFieldsNew .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control datepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_starts_with($inputName, 'valor_')) { // Detecta campos que começam com 'valor_'
        $type = 'text';
        $formFieldsNew .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control monetary-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', (isset(\$value) && \$value !== null) ? number_format(\$value / 100, 2, ',', '.') : '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (strpos(strtoupper($column['type']), 'TEXT') !== false || ($ci4Type === 'VARCHAR' && ($column['max_length'] ?? 0) > 255)) {
        $formFieldsNew .= <<<HTML
                  <div class="form-floating mb-3 position-relative"> 
                  <input type="{$type}" class="form-control" id="{$inputName}" name="{$inputName}" placeholder="{$label}" value="<?= old('{$inputName}') ?>" {$required_attr}>
                  <label for="{$inputName}">{$label}</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#{$inputName}" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <?php if (session('errors.{$inputName}')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.{$inputName}') ?>
                        </div>
                    <?php endif ?>
                </div>
HTML;
      }
    }
  }

  // **CONTEÚDO BASE da new.php - APENAS HTML/PHP Estrutural e Placeholders**
  $newViewContent = <<<HTML
<?= \$this->extend('layout/principal') ?>
<?= \$this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= \$titulo ?></h1>
  </div>

  <?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        <?php foreach (session('errors') as \$error) : ?>
          <li><?= \$error ?></li>
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
      <h6 class="m-0 font-weight-bold text-primary">Novo</h6>
    </div>
    <div class="card-body">
      <form action="/{$entity_name_plural_lower}/create" method="post">
          <?= csrf_field() ?>
          {$formFieldsNew}
          <div class="d-flex justify-content-start mt-3">
              <?php if (service('Carol')->pode('{$entity_name_plural_upper}.NOVO')) : ?>
              <button type="submit" class="btn btn-primary btn-icon-split mr-2">
                  <span class="icon text-white-50">
                      <i class="fas fa-save"></i>
                  </span>
                  <span class="text">Salvar</span>
              </button>
              <?php endif; ?>
              <a href="/{$entity_name_plural_lower}" class="btn btn-secondary btn-icon-split">
                  <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary">
    </div>
  </div>
</div>

<?= \$this->endSection() ?>

<?= \$this->section('scripts') ?>
<?= \$this->endSection() ?>
HTML;

  // --- View: edit.php (Formulário de Edição) ---
  $formFieldsEdit = '';
  foreach ($displayFields as $field) {
    $label = ucwords(str_replace('_', ' ', $field));
    $type = 'text'; // Default
    $inputName = $field;
    $value = "<?= old('{$inputName}', \${$entity_name_singular_lower}->{$field}) ?>";
    // Adiciona 'required' se a coluna for NOT NULL e não tiver valor padrão, e não for a PK.
    $column_data_for_required = array_values(array_filter($columns, fn($col) => $col['name'] === $field));
    $required_attr = (count($column_data_for_required) > 0 && (bool)$column_data_for_required[0]['notnull'] && $column_data_for_required[0]['dflt_value'] === null && $column_data_for_required[0]['name'] !== $primaryKey) ? 'required' : '';


    if (isset($fkFields[$field])) { // É um campo de chave estrangeira
      $fkInfo = $fkFields[$field];
      $optionsVarName = $fkInfo['related_table_singular_snake'] . '_options';
      $formFieldsEdit .= <<<HTML
                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="{$inputName}" name="{$inputName}" {$required_attr}>
                              <option value="" disabled selected><?= esc("Selecione um {$label}") ?></option>
                              <?php
                              \$selectedValue = old('{$inputName}', \${$entity_name_singular_lower}->{$inputName} ?? '');
                              if (isset(\${$optionsVarName}) && is_array(\${$optionsVarName})) {
                                  foreach (\${$optionsVarName} as \$optionValue => \$optionLabel) {
                                      \$selected = (\$optionValue == \$selectedValue) ? 'selected' : '';
                                      echo "<option value=\"{\$optionValue}\" {\$selected}>" . esc(\$optionLabel) . "</option>";
                                  }
                              }
                              ?>
                          </select>
                          <label for="{$inputName}" class="form-label choices-label"><?= esc('$label') ?></label>
                          <?php if (session('errors.{$inputName}')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.{$inputName}') ?>
                              </div>
                          <?php endif ?>
                      </div>
HTML;
    } else { // Não é uma chave estrangeira
      // Encontra a coluna para pegar o tipo e max_length
      $column_data = null;
      foreach ($columns as $col_info) {
        if ($col_info['name'] === $field) {
          $column_data = $col_info;
          break;
        }
      }

      $ci4Type = map_sqlite_type_to_ci4_forge_type($column_data['type']);
      if ($ci4Type === 'INT' || $ci4Type === 'DOUBLE' || $ci4Type === 'DECIMAL') {
        $type = 'number';
        $formFieldsEdit .= <<<HTML
                 <div class="form-floating mb-3 number-spinner-input-group">
                    <div class="input-group">
                        <input type="number" class="form-control text-center" id="{$inputName}" name="{$inputName}" 
                              placeholder="{$label}" value="<?= old('{$inputName}', (isset(\$value) && \$value !== null) ? esc(\$value) : '') ?>" 
                              min="0" step="1" {$required_attr}> <label for="{$inputName}">{$label}</label>
                        <button class="btn btn-outline-secondary spinner-minus" type="button" title="Diminuir">
                            <i class="bi bi-dash"></i> </button>
                        <button class="btn btn-outline-secondary spinner-plus" type="button" title="Aumentar">
                            <i class="bi bi-plus"></i> </button>
                    </div>
                    <?php if (session('errors.{$inputName}')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.{$inputName}') ?>
                        </div>
                    <?php endif ?>
                </div>
HTML;
      } elseif (str_contains($inputName, 'sn_')) {
        $type = 'text';
        $formFieldsEdit .= <<<HTML
       <div class="mb-3 form-check form-switch">
                    <input type="hidden" name="{$inputName}" value="Não"> 
                    
                    <input class="form-check-input" type="checkbox" role="switch" 
                           id="{$inputName}" 
                           name="{$inputName}" 
                           value="Sim" 
                           <?php 
                               \$currentValue = old('{$inputName}', \$value ?? null);
                               if (\$currentValue === 'Sim') {
                                   echo 'checked';
                               }
                           ?> {$required_attr}>
                    <label class="form-check-label" for="{$inputName}">{$label}</label>
                    
                    <?php if (session('errors.{$inputName}')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.{$inputName}') ?>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (session('errors.{$inputName}')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.{$inputName}') ?>
                </div>
            <?php endif ?>
        </div>
HTML;
      } elseif (str_starts_with($inputName, 'data_')) {
        $type = 'date';
        $formFieldsEdit .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control datepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_starts_with($inputName, 'datahora_')) {
        $type = 'date';
        $formFieldsEdit .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control datetimepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_starts_with($inputName, 'hora_')) {
        $type = 'time';
        $formFieldsEdit .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control timepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_ends_with($inputName, '_at')) {
        $type = 'datetime-local';
        $formFieldsEdit .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control datepicker-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', \$value ?? '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (str_starts_with($inputName, 'valor_')) { // Detecta campos que começam com 'valor_'
        $type = 'text';
        $formFieldsEdit .= <<<HTML
                    <div class="form-floating mb-3">
                        <input type="{$type}" class="form-control monetary-input" id="{$inputName}" name="{$inputName}" placeholder="{$label}" 
                            value="<?= old('{$inputName}', (isset(\$value) && \$value !== null) ? number_format(\$value / 100, 2, ',', '.') : '') ?>" 
                            {$required_attr}>
                        <label for="{$inputName}">{$label}</label>
                        <?php if (session('errors.{$inputName}')) : ?>
                            <div class="invalid-feedback d-block">
                                <?= session('errors.{$inputName}') ?>
                            </div>
                        <?php endif ?>
                    </div>
    HTML;
      } elseif (strpos(strtoupper($column['type']), 'TEXT') !== false || ($ci4Type === 'VARCHAR' && ($column['max_length'] ?? 0) > 255)) {
        $formFieldsNew .= <<<HTML
                  <div class="form-floating mb-3 position-relative"> 
                  <input type="{$type}" class="form-control" id="{$inputName}" name="{$inputName}" placeholder="{$label}" value="<?= old('{$inputName}') ?>" {$required_attr}>
                  <label for="{$inputName}">{$label}</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#{$inputName}" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <?php if (session('errors.{$inputName}')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.{$inputName}') ?>
                        </div>
                    <?php endif ?>
                </div>
HTML;
      }
    }
  }

  $editViewContent = <<<HTML
<?= \$this->extend('layout/principal') ?>
<?= \$this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= \$titulo ?></h1>
  </div>

  <?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        <?php foreach (session('errors') as \$error) : ?>
          <li><?= \$error ?></li>
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
      <h6 class="m-0 font-weight-bold text-primary">Editar</h6>
    </div>
    <div class="card-body">
      <form action="/{$entity_name_plural_lower}/update/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          {$formFieldsEdit}
          <div class="d-flex justify-content-start mt-3">
              <?php if (service('Carol')->pode('{$entity_name_plural_upper}.EDITAR')) : ?>
              <button type="submit" class="btn btn-primary btn-icon-split mr-2">
                  <span class="icon text-white-50">
                      <i class="fas fa-save"></i>
                  </span>
                  <span class="text">Atualizar</span>
              </button>
              <?php endif; ?>
              <a href="/{$entity_name_plural_lower}" class="btn btn-secondary btn-icon-split">
                  <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary">
    <p><strong>Criado em:</strong> \${$entity_name_singular_lower}->criado_em</p>
    <p><strong>Editado em:</strong> \${$entity_name_singular_lower}->editado_em</p>
    <?php if (!is_null(\${$entity_name_singular_lower}->excluido_em)) : ?>
    <p><strong>Excluído em:</strong> \${$entity_name_singular_lower}->excluido_em</p>
    <?php endif; ?>
    </div>
  </div>
</div>

<?= \$this->endSection() ?>

<?= \$this->section('scripts') ?>
<?= \$this->endSection() ?>
HTML;

  // --- View: show.php (Detalhes) ---
  $detailsList = '';
  foreach ($displayFields as $field) {
    $label = ucwords(str_replace('_', ' ', $field));
    $value = "<?= \$registro->{$field} ?>";

    // Se for um campo de chave estrangeira, exibe o nome da relação, não apenas o ID
    if (isset($fkFields[$field])) {
      $fkInfo = $fkFields[$field];
      $value = "<?= \$registro->{$fkInfo['related_table_singular_snake']}_nome ?? 'N/A' ?>";
    }

    $detailsList .= <<<HTML
    <p><strong>{$label}:</strong> {$value}</p>
HTML;
  }

  $showViewContent = <<<HTML
    <?= \$this->extend('layout/principal') ?>
    <?= \$this->section('content') ?>

    <div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= \$titulo ?></h1>
      </div>

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Detalhes</h6>
        </div>
        <div class="card-body">
          {$detailsList}
          <div class="d-flex justify-content-start mt-4">
              <?php if (service('Carol')->pode('{$entity_name_plural_upper}.EDITAR')) : ?>
              <a href="/{$entity_name_plural_lower}/edit/<?= \${$entity_name_singular_lower}->{$primaryKey} ?>" class="btn btn-warning btn-icon-split mr-2">
                  <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                  </span>
                  <span class="text">Editar</span>
              </a>
              <?php endif; ?>
              <a href="/{$entity_name_plural_lower}" class="btn btn-secondary btn-icon-split">
                  <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
        </div>
        <div class="card-footer text-body-secondary">
          <p><strong>Criado em:</strong> \${$entity_name_singular_lower}->criado_em</p>
          <p><strong>Editado em:</strong> \${$entity_name_singular_lower}->editado_em</p>
          <?php if (!is_null(\${$entity_name_singular_lower}->excluido_em)) : ?>
          <p><strong>Excluído em:</strong> \${$entity_name_singular_lower}->excluido_em</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?= \$this->endSection() ?>
HTML;


  $newViewContent = $newViewContent;
  $editViewContent = $editViewContent;
  $newViewContent = $newViewContent;
  $editViewContent = $editViewContent;

  return [
    'index.php' => $indexViewContent,
    'new.php' => $newViewContent,
    'edit.php' => $editViewContent,
    'show.php' => $showViewContent
  ];
}

/**
 * Gera o conteúdo PHP para um arquivo de Seeder do CodeIgniter 4 com dados existentes.
 *
 * @param string $entity_name_pascal O nome da entidade em PascalCase (ex: 'Produto').
 * @param string $table_name O nome da tabela no banco de dados (ex: 'produtos').
 * @param PDO $pdo A conexão PDO com o banco de dados.
 * @return string O conteúdo PHP do Seeder.
 * @throws Exception Se ocorrer um erro ao buscar os dados da tabela.
 */
function generate_seeder_content(string $entity_name_pascal, string $table_name, PDO $pdo): string
{
  $seederClassName = $entity_name_pascal . 'Seeder';

  try {
    // Seleciona todos os dados da tabela
    $stmt = $pdo->query("SELECT * FROM `{$table_name}`");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    error_log("ERRO PDO ao buscar dados para seed da tabela '{$table_name}': " . $e->getMessage());
    throw new Exception("Erro de banco de dados ao buscar dados para seed de '{$table_name}': " . $e->getMessage());
  }

  if (empty($rows)) {
    echo "AVISO: Tabela '{$table_name}' está vazia. Gerando seed sem dados.\n";
    $data_php = "[]"; // Array vazio
  } else {
    // Formata os dados em uma string PHP para o array $data
    $data_php_parts = [];
    foreach ($rows as $row) {
      $row_parts = [];
      foreach ($row as $col_name => $col_value) {
        // Escapar valores para PHP. NULL vira 'null', strings com aspas, etc.
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
      $data_php_parts[] = "[" . implode(",\n                 ", $row_parts) . "]";
    }
    $data_php = "[\n            " . implode(",\n            ", $data_php_parts) . "\n        ]";
  }

  $seederContent = <<<PHP
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class {$seederClassName} extends Seeder
{
    public function run()
    {
        \$data = {$data_php};

        // Usando insertBatch para inserir múltiplos registros
        // Ajuste conforme necessário se a tabela tiver gatilhos ou colunas auto-preenchidas
        // \$this->db->table('{$table_name}')->truncate(); // Descomente para limpar antes de inserir
        if (!empty(\$data)) {
            \$this->db->table('{$table_name}')->insertBatch(\$data);
        } else {
            // Se o array de dados estiver vazio, você pode optar por não fazer nada
            // ou logar uma mensagem.
            // \$this->db->table('{$table_name}')->where('id IS NOT NULL')->delete(); // Exemplo: limpar a tabela se o seed for vazio
        }
    }
}
PHP;
  return $seederContent;
}

// --- FASE 2: Conexão e Inspeção do Banco de Dados SQLite ---

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
  $stmt_columns = $pdo->prepare("PRAGMA table_info('{$table_name}')");
  $stmt_columns->execute();
  $raw_columns = $stmt_columns->fetchAll(PDO::FETCH_ASSOC);

  if (empty($raw_columns)) {
    throw new Exception("Tabela '{$table_name}' não retornou informações de coluna (PRAGMA table_info vazia).");
  }

  $columns = [];
  foreach ($raw_columns as $col) {
    $columns[] = [
      'cid'         => $col['cid'],
      'name'        => $col['name'],
      'type'        => $col['type'],
      'notnull'     => (bool) $col['notnull'], // Mantém o original para referência
      'pk'          => (bool) $col['pk'],
      'dflt_value'  => $col['dflt_value'], // Mantém o original para referência
      // Adiciona as chaves esperadas pelas funções de geração:
      'is_nullable' => (bool) $col['notnull'] === false, // Se 'notnull' é 0, então é anulável (true)
      'default'     => $col['dflt_value'], // Usa o valor padrão diretamente
    ];
  }

  // --- PASSO 2: Obter informações das chaves estrangeiras (PRAGMA foreign_key_list) ---
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


// --- FUNÇÕES AUXILIARES PARA GERAÇÃO DE ARQUIVOS ---

/**
 * Gera e escreve o arquivo de Migration.
 */
function generate_migration_file(string $entity_name_pascal, string $table_name, array $columns, array $foreign_keys, array $options): void
{
  $migration_content = generate_migration_content($entity_name_pascal, $table_name, $columns, $foreign_keys);
  $timestamp = date('Y-m-d-His');
  $migration_file_name = "{$timestamp}_Create{$entity_name_pascal}.php";
  $migration_path = CI4_BASE_PATH . "/app/Database/Migrations/{$migration_file_name}";
  write_file($migration_path, $migration_content, $options['overwrite'] ?? false);
}

/**
 * Gera e escreve o arquivo de Model.
 */
function generate_model_file(string $entity_name_pascal, string $table_name, array $columns, array $options): void
{
  $model_content = generate_model_content($entity_name_pascal, $table_name, $columns);
  $model_file_name = "{$entity_name_pascal}Model.php";
  $model_path = CI4_BASE_PATH . "/app/Models/{$model_file_name}";
  write_file($model_path, $model_content, $options['overwrite'] ?? false);
}

/**
 * Função para gerar o arquivo da Entity.
 *
 * @param string $entity_name_pascal Nome da Entidade em PascalCase (ex: 'TblUsuario', 'Produto').
 * @param string $table_name Nome da tabela no banco de dados (ex: 'tbl_usuarios', 'produtos').
 * @param array $columns Informações das colunas da tabela.
 * @param array $options Opções adicionais.
 */
function generate_entity_file(string $entity_name_pascal, string $table_name, array $columns, array $options): void
{
  $attributes_array = [];
  $casts_array = [];
  $dates_array = [];
  $foreignkey = [];

  $entity_name_pascalx = snake_to_pascal_case(singularize($table_name));

  // Processar colunas para $attributes e $casts
  foreach ($columns as $column) {
    $column_name = $column['name'];
    $column_type = $column['type'];
    $is_nullable = $column['is_nullable'];
    $default_value = $column['default'];
    // Remove aspas simples ou duplas extras se o valor padrão vier do DB com elas
    if (is_string($default_value) && (str_starts_with($default_value, "'") && str_ends_with($default_value, "'") || str_starts_with($default_value, '"') && str_ends_with($default_value, '"'))) {
      $default_value = substr($default_value, 1, -1);
    }

    if ($default_value !== null) {
      $formatted_value = is_numeric($default_value) ? $default_value : "'" . str_replace("'", "\\'", $default_value) . "'";
      $attributes_lines[] = "        '{$column_name}' => {$formatted_value},";
    }

    // Adiciona ao protected $attributes
    if ($default_value !== null) {
      // Se tem um valor padrão explícito no DB, usa ele.
      // Para strings, garante aspas simples. Para números, sem aspas.
      $attributes_array[] = "        '{$column_name}' => " . (is_numeric($default_value) ? $default_value : "'{$default_value}'") . ",";
    } elseif ($is_nullable) {
      // Se é nulo no DB, define como null
      $attributes_array[] = "        '{$column_name}' => null,";
    } else {
      // Se não é nulo e não tem padrão, ainda assim inicializa com null ou um valor genérico
      // Você pode ajustar isso para, por exemplo, strings vazias para Varchar não-nulos.
      $attributes_array[] = "        '{$column_name}' => null,";
    }

    // Adiciona ao protected $casts
    switch (strtolower($column_type)) {
      case 'integer':
      case 'int':
      case 'tinyint':
      case 'smallint':
      case 'mediumint':
      case 'bigint':
        $casts_array[$column_name] = 'int';
        break;
      case 'float':
      case 'double':
      case 'decimal':
        $casts_array[$column_name] = 'float';
        break;
      case 'boolean':
      case 'bool':
        $casts_array[$column_name] = 'bool';
        break;
      case 'datetime':
      case 'timestamp':
        // Colunas de data/hora são automaticamente tratadas pelo CI se estiverem no $dates
        // Mas podemos adicioná-las aos casts para clareza ou tipagem mais estrita.
        // Não adicionamos aqui se já forem para $dates.
        break;
      default:
        // Se não for um tipo numérico ou booleano, não precisa de cast explícito para string.
        break;
    }

    // Adiciona ao protected $dates
    if (in_array(strtolower($column_name), ['created_at', 'updated_at', 'deleted_at'])) {
      $dates_array[] = "'{$column_name}'";
    }
  }

  $attributes_string = implode("\n", $attributes_array);
  $casts_string_parts = [];
  foreach ($casts_array as $col => $type) {
    $casts_string_parts[] = "        '{$col}' => '{$type}'";
  }
  $casts_string = implode(",\n", $casts_string_parts);
  $dates_string = implode(', ', array_unique($dates_array)); // unique para evitar duplicatas


  // gera codigo para foreignkeys
  $entity_name_pascalx = snake_to_pascal_case(singularize($table_name));
  $entity_name_pascalxx = snake_to_pascal_case(pluralize($table_name));
  $entity_name_pascalxLower = strtolower(snake_to_pascal_case(singularize($table_name)));
  if (str_ends_with($col, "_id")) {
    $foreignkey[] = '
    // Método para carregar a entidade do arquivo associado
    private $' . $entity_name_pascalxLower . ' = null;
    public function get' . $entity_name_pascalx . '()
    {
      if ($this->' . $entity_name_pascalxLower . ' === null && $this->attributes[\'' . $col . '\'] !== null) {
        $' . $entity_name_pascalxLower . ' = new ' . $entity_name_pascalx . '();
        $this->' . $entity_name_pascalxLower . ' = $this->' . $entity_name_pascalxx . 'Model->find($this->attributes[\'' . $col . '\']);
      }
      return $this->' . $entity_name_pascalxLower . ';
    }';
  }

  $foreignkeys = implode(",\n", $foreignkey);


  $content = <<<PHP
<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class {$entity_name_pascalx} extends Entity
{
    protected \$attributes = [
{$attributes_string}
    ];

    protected \$datamap = [];
    protected \$dates   = [{$dates_string}];
    protected \$casts   = [
{$casts_string}
    ];

    {$foreignkeys}
}
PHP;

  $file_path = CI4_BASE_PATH . "/app/Entities/{$entity_name_pascalx}.php";
  write_file($file_path, $content, $options['overwrite'] ?? false);
}

/**
 * Gera e escreve o arquivo de Controller.
 */
function generate_controller_file(string $entity_name_pascal, string $table_name, array $options): void
{
  $controller_content = generate_controller_content($entity_name_pascal, $table_name);
  $controller_file_name = "{$entity_name_pascal}.php";
  $controller_path = CI4_BASE_PATH . "/app/Controllers/{$controller_file_name}";
  write_file($controller_path, $controller_content, $options['overwrite'] ?? false);
}

/**
 * Gera e escreve os arquivos de View.
 */
function generate_view_files(string $entity_name_pascal, string $table_name, array $columns, array $options): void
{
  $view_contents = generate_view_contents($entity_name_pascal, $table_name, $columns);
  $entity_name_plural_lower = strtolower(pluralize($entity_name_pascal));
  foreach ($view_contents as $view_file => $content) {
    $view_dir_path = CI4_BASE_PATH . "/app/Views/{$entity_name_plural_lower}/";
    // As views de layout e modais terão um tratamento de diretório diferente
    if (str_starts_with($view_file, 'layout/')) {
      $view_dir_path = CI4_BASE_PATH . "/app/Views/layout/";
      $view_file = str_replace('layout/', '', $view_file); // Remove 'layout/' do nome do arquivo
    } elseif (str_starts_with($view_file, 'modals/')) {
      $view_dir_path = CI4_BASE_PATH . "/app/Views/modals/";
      $view_file = str_replace('modals/', '', $view_file); // Remove 'modals/' do nome do arquivo
    }
    $view_path = $view_dir_path . $view_file;
    // Para todas as views, usa a opção overwrite padrão
    write_file($view_path, $content, $options['overwrite'] ?? false);
  }
}

/**
 * Gera e escreve o arquivo de Seeder.
 */
function generate_seeder_file(string $entity_name_pascal, string $table_name, PDO $pdo, array $options): void
{
  // Verifica se a tabela deve ser ignorada para seeds
  if (in_array($table_name, IGNORED_TABLES)) {
    echo "Ignorando geração de seed para a tabela: '{$table_name}' (na lista de ignorados).\n";
    return;
  }

  $seeder_content = generate_seeder_content($entity_name_pascal, $table_name, $pdo);
  $seeder_file_name = "{$entity_name_pascal}Seeder.php";
  $seeder_path = CI4_BASE_PATH . "/app/Database/Seeds/{$seeder_file_name}";
  write_file($seeder_path, $seeder_content, $options['overwrite'] ?? false);
}


// --- Lógica de Ação Principal (Switch/Case para as fases) ---

// Analisa os argumentos da linha de comando
$arguments = parse_arguments($argv);

try {
  $pdo = null; // Inicializa PDO como nulo
  // Ações que precisam de conexão com o banco de dados
  if (in_array($arguments['type'], ['all', 'crud', 'migration', 'model', 'controller', 'view', 'entity', 'seed'])) {
    echo "Conectando ao banco de dados SQLite em: " . SQLITE_DB_PATH . "\n";
    $pdo = connect_db();
    echo "Conexão com o banco de dados bem-sucedida.\n\n";
  }

  // Função auxiliar para processar uma única tabela/entidade
  $process_single_entity = function (string $entity_name_pascal, PDO $pdo, array $options, string $component_type = 'all') {
    $table_name = pascal_to_snake_case(pluralize($entity_name_pascal));
    echo "--- Processando entidade: {$entity_name_pascal} (Tabela: {$table_name}) ---\n";

    $table_info = inspect_table($pdo, $table_name);
    $columns = $table_info['columns'];
    $foreign_keys = $table_info['foreign_keys'];

    if ($component_type === 'all' || $component_type === 'migration') {
      generate_migration_file($entity_name_pascal, $table_name, $columns, $foreign_keys, $options);
    }
    if ($component_type === 'all' || $component_type === 'model') {
      generate_model_file($entity_name_pascal, $table_name, $columns, $options);
    }
    if ($component_type === 'all' || $component_type === 'entity') {
      generate_entity_file($entity_name_pascal, $table_name, $columns, $options);
    }
    if ($component_type === 'all' || $component_type === 'controller') {
      generate_controller_file($entity_name_pascal, $table_name, $options);
    }
    if ($component_type === 'all' || $component_type === 'view') {
      generate_view_files($entity_name_pascal, $table_name, $columns, $options);
    }
    if ($component_type === 'all' || $component_type === 'seed') {
      generate_seeder_file($entity_name_pascal, $table_name, $pdo, $options);
    }
  };


  switch ($arguments['type']) {
    case 'all':
      $tables = get_all_tables($pdo);
      echo "Gerando CRUD completo para TODAS as tabelas: " . implode(', ', $tables) . "\n";
      foreach ($tables as $table_name) {
        // Ignora tabelas específicas ao gerar para 'all'
        if (in_array($table_name, IGNORED_TABLES)) {
          echo "Ignorando tabela: '{$table_name}'.\n";
          continue;
        }
        $entity_name_pascal = snake_to_pascal_case(pluralize($table_name));
        // $process_single_entity($entity_name_pascal, $pdo, $arguments['options'], 'all');
        $process_single_entity($entity_name_pascal, $pdo, $arguments['options'], 'all');
      }
      break;

    case 'crud':
      echo "Gerando CRUD completo para a entidade: **{$arguments['entity_name']}**\n";
      $process_single_entity($arguments['entity_name'], $pdo, $arguments['options'], 'all');
      break;

    case 'migration':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Migrações para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          if (in_array($table_name, IGNORED_TABLES)) {
            echo "Ignorando tabela: '{$table_name}'.\n";
            continue;
          }
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          generate_migration_file($entity_name_pascal, $table_name, inspect_table($pdo, $table_name)['columns'], inspect_table($pdo, $table_name)['foreign_keys'], $arguments['options']);
        }
      } else {
        echo "Gerando Migração para a entidade: **{$arguments['entity_name']}**\n";
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        generate_migration_file($arguments['entity_name'], $table_name, inspect_table($pdo, $table_name)['columns'], inspect_table($pdo, $table_name)['foreign_keys'], $arguments['options']);
      }
      break;

    case 'model':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Models para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          if (in_array($table_name, IGNORED_TABLES)) {
            echo "Ignorando tabela: '{$table_name}'.\n";
            continue;
          }
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          generate_model_file($entity_name_pascal, $table_name, inspect_table($pdo, $table_name)['columns'], $arguments['options']);
        }
      } else {
        echo "Gerando Model para a entidade: **{$arguments['entity_name']}**\n";
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        generate_model_file($arguments['entity_name'], $table_name, inspect_table($pdo, $table_name)['columns'], $arguments['options']);
      }
      break;

    case 'entity':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Entities para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          if (in_array($table_name, IGNORED_TABLES)) {
            echo "Ignorando tabela: '{$table_name}'.\n";
            continue;
          }
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          generate_entity_file($entity_name_pascal, $table_name, inspect_table($pdo, $table_name)['columns'], $arguments['options']);
        }
      } else {
        echo "Gerando Entity para a entidade: **{$arguments['entity_name']}**\n";
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        generate_entity_file($arguments['entity_name'], $table_name, inspect_table($pdo, $table_name)['columns'], $arguments['options']);
      }
      break;

    case 'controller':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Controllers para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          if (in_array($table_name, IGNORED_TABLES)) {
            echo "Ignorando tabela: '{$table_name}'.\n";
            continue;
          }
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          generate_controller_file($entity_name_pascal, $table_name, $arguments['options']);
        }
      } else {
        echo "Gerando Controller para a entidade: **{$arguments['entity_name']}**\n";
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        generate_controller_file($arguments['entity_name'], $table_name, $arguments['options']);
      }
      break;

    case 'view':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Views para todas as tabelas: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          if (in_array($table_name, IGNORED_TABLES)) {
            echo "Ignorando tabela: '{$table_name}'.\n";
            continue;
          }
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          generate_view_files($entity_name_pascal, $table_name, inspect_table($pdo, $table_name)['columns'], $arguments['options']);
        }
      } else {
        echo "Gerando Views para a entidade: **{$arguments['entity_name']}**\n";
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        generate_view_files($arguments['entity_name'], $table_name, inspect_table($pdo, $table_name)['columns'], $arguments['options']);
      }
      break;

    case 'seed':
      if ($arguments['entity_name'] === 'all') {
        $tables = get_all_tables($pdo);
        echo "Gerando Seeds para todas as tabelas com dados existentes: " . implode(', ', $tables) . "\n";
        foreach ($tables as $table_name) {
          // A função generate_seeder_file já faz a verificação de IGNORED_TABLES
          $entity_name_pascal = snake_to_pascal_case(singularize($table_name));
          generate_seeder_file($entity_name_pascal, $table_name, $pdo, $arguments['options']);
        }
      } else {
        echo "Gerando Seeder para a entidade: **{$arguments['entity_name']}** com dados existentes.\n";
        $table_name = pascal_to_snake_case(pluralize($arguments['entity_name']));
        generate_seeder_file($arguments['entity_name'], $table_name, $pdo, $arguments['options']);
      }
      break;

    default:
      echo "Erro: Tipo de componente inválido ou não implementado.\n";
      display_help();
      exit(1);
  }
} catch (Exception $e) {
  echo "Erro inesperado: " . $e->getMessage() . "\n";
  exit(1);
}

echo "\nProcesso concluído.\n";

// Finaliza o script com sucesso
exit(0);
