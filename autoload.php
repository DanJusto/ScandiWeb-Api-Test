<?php

spl_autoload_register(function (string $className) {
    $filePath = str_replace('Scandiweb\\Test', 'src', $className);
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $filePath);
    $filePath .= '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});