<?php

$finder = PhpCsFixer\Finder::create()
  ->in(__DIR__)
  ->exclude('.github')
  ->exclude('docs')
  ->exclude('writable')
  ->exclude('uploads')
  ->exclude('vendor');

return (new PhpCsFixer\Config())
  ->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'single_quote' => true,
    'no_unused_imports' => true, // Remove imports não utilizados



        // Garante que o operador de concatenação (.) tenha espaços ao redor.
        // Ex: $a . $b  (ao invés de $a.$b)
        'concat_space' => ['spacing' => 'one'],

        // Remove espaços desnecessários no final das linhas.
        'no_trailing_whitespace' => true,

        // Remove quebras de linha extras no final dos arquivos.
        'no_extra_blank_lines' => [
            'tokens' => ['extra', 'throw', 'use', 'use_trait', 'switch', 'case', 'default', 'return', 'continue', 'break']
        ],

        // Garante uma linha em branco no final de cada arquivo.
        'final_newline' => true,

        // Adiciona um espaço antes da atribuição de propriedades de classe.
        // Ex: public $var = 'value'; (ao invés de public $var= 'value';)
        'class_attributes_separation' => ['elements' => ['method' => 'one']],

        // Adiciona uma linha em branco após a abertura da tag PHP.
        'blank_line_after_opening_tag' => true,

        // Garante que um DocBlock exista para classes, funções, métodos, etc.
        // Útil para manter a documentação PHPDoc.
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => false, // Opcional: Se preferir manter DocBlocks e não transformá-los em comentários de linha
        'phpdoc_trim' => true,
        'phpdoc_indent' => true,
        'phpdoc_order' => true, // Opcional: Ordena as tags dentro dos DocBlocks
        'phpdoc_scalar' => true, // Corrige tipos escalares em DocBlocks (ex: int, string)
        'phpdoc_trim_consecutive_blank_lines' => true,


        // Garante que operadores como '==', '!=', '+', '-' tenham espaços ao redor.
        'binary_operator_spaces' => [
            'operators' => ['=' => null, '=>' => null, '+=' => null, '-=' => null, '*=' => null, '/=' => null, '%=' => null]
        ],
        // O valor `null` para os operadores '=' e '=>' na regra acima
        // significa que ela vai usar o padrão do PSR-12, que geralmente é um espaço.
        // Se quiser um espaço garantido, pode ser `['operators' => ['=' => 'single_space']]`
        // mas o padrão já costuma ser bom.

        // Remove espaços extras dentro de parênteses em chamadas de função/método.
        // Ex: myMethod($arg); (ao invés de myMethod( $arg );)
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,

        // Garante que as chaves de abertura de classes, funções, etc., estejam na mesma linha que a declaração.
        // (Já coberto em grande parte pelo PSR-12, mas reforça)
        'braces' => [
            'position_after_functions_and_class_methods' => 'same',
            'position_after_control_structures' => 'same',
            'position_after_anonymous_constructs' => 'same',
        ],
    ])
  ->setFinder($finder)
  ->setRiskyAllowed(true) // Permite regras que podem mudar o comportamento do código
  ->setUsingCache(true);
