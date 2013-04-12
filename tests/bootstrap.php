<?php
spl_autoload_register(function ($className) {
    set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../lib');

    $className = str_replace('\\', '/', ltrim($className, '\\')) . '.php';
    require_once $className;
});

ini_set('display_errors', 1);
ini_set('error_reporting', -1);

