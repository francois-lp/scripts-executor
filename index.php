<?php

use  \Model\Service\ScriptsExecutor\ScriptsExecutor;

require_once realpath('vendor/autoload.php');

// processing of scripts in different languages
$scripts = [
    'create_txt_file.py',
    'create_txt_file.py',
    'create_txt_file.java',
    'create_txt_file.java',
    'create_txt_file.php',
    'create_txt_file.php',
    'create_txt_file.php',
];
(new ScriptsExecutor($scripts))->executeScripts();
