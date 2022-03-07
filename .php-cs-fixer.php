<?php
declare(strict_types=1);

$finder = PhpCsFixer\Finder
    ::create()
    ->exclude(__DIR__.'/vendor') // Vendor Verzeichnis
    // ausschließen
    ->in(__DIR__);

$config = new PhpCsFixer\Config();

return $config->setRules([ // Regelsets festlegen
    '@PSR12' => true,
])->setFinder($finder);
