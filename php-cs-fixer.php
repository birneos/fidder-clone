<?php
//Aufruf über Docker
//php vendor/bin/php-cs-fixer fix --config .php-cs-fixer.php
//PHP_CS_FIXER_IGNORE_ENV=1 php vendor/bin/php-cs-fixer fix --config .php-cs-fixer.php
$finder = PhpCsFixer\Finder::create()->in(__DIR__.'/src');

$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(true)
    ->setRules([
    '@PSR12' => true,
    'strict_param' => true,
    'array_syntax' => ['syntax'=>'short']
])->setFinder($finder);