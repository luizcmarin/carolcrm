<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Generators extends BaseConfig
{
    /*
     * Este array define o mapeamento dos comandos geradores para os arquivos de view
     * que eles estão utilizando. Se você precisar personalizá-los, copie esses
     * arquivos de view para sua própria pasta e indique o local aqui.
     *
     * Você notará que as views possuem placeholders especiais entre
     * chaves `{...}`. Esses placeholders são usados internamente pelos
     * comandos geradores no processamento de substituições, portanto, você é avisado
     * para não os apagar ou modificar os nomes. Se o fizer, poderá
     * acabar interrompendo o processo de scaffolding e gerar erros.
     *
     * VOCÊ FOI AVISADO!
     *
     * @var array<string, array<string, string>|string>
     */
    public array $views = [
        'App' => APPPATH . 'Commands/Generators/Views/',
        // 'make:cell' => [
        //     'class' => 'CodeIgniter\Commands\Generators\Views\cell.tpl.php',
        //     'view'  => 'CodeIgniter\Commands\Generators\Views\cell_view.tpl.php',
        // ],
        // 'make:command'      => 'CodeIgniter\Commands\Generators\Views\command.tpl.php',
        // 'make:config'       => 'CodeIgniter\Commands\Generators\Views\config.tpl.php',
        // 'make:controller'   => 'CodeIgniter\Commands\Generators\Views\controller.tpl.php',
        // 'make:entity'       => 'CodeIgniter\Commands\Generators\Views\entity.tpl.php',
        // 'make:filter'       => 'CodeIgniter\Commands\Generators\Views\filter.tpl.php',
        // 'make:migration'    => 'CodeIgniter\Commands\Generators\Views\migration.tpl.php',
        // 'make:model'        => 'CodeIgniter\Commands\Generators\Views\model.tpl.php',
        // 'make:seeder'       => 'CodeIgniter\Commands\Generators\Views\seeder.tpl.php',
        // 'make:validation'   => 'CodeIgniter\Commands\Generators\Views\validation.tpl.php',
        // 'session:migration' => 'CodeIgniter\Commands\Generators\Views\migration.tpl.php',
    ];
}
