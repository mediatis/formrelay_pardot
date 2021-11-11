<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Form Relay - Pardot Plugin',
    'description' => 'Send form data to Pardot via Formhandlers',
    'category' => 'be',
    'author' => '',
    'author_email' => '',
    'author_company' => 'Mediatis AG',
    'state' => 'alpha',
    'version' => '4.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99',
            'formrelay' => '>=5.0.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
