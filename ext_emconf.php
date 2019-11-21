<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Pardot Plugin',
    'description' => 'Send form data to Pardot via FormHandlers',
    'category' => 'be',
    'author' => '',
    'author_email' => '',
    'shy' => '',
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
    'version' => '1.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-9.5.99',
            'formrelay' => '>=0.2.9',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'suggests' => [
    ],
];
