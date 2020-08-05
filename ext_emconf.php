<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Form Relay - Pardot Plugin',
    'description' => 'Send form data to Pardot via Formhandlers',
    'category' => 'be',
    'author' => '',
    'author_email' => '',
    'author_company' => 'Mediatis AG',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '3.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-10.4.99',
            'formrelay' => '>=4.0.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'suggests' => [
    ],
];
