<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Mail Plugin',
    'description' => 'Send form data via Mail via FormHandlers',
    'category' => 'be',
    'author' => '',
    'author_email' => '',
    'shy' => '',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'author_company' => '',
    'version' => '1.0.5',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-9.5.99',
            'formrelay' => '>=2.0.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'suggests' => [
    ],
];
