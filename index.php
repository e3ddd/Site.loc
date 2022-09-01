<?php
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);

const CONTROLLERS_FOLDER = 'Controllers';

function getRealPath(string $relativePath): string
{
    return BASE_PATH . DIRECTORY_SEPARATOR . $relativePath;
}
function getControllerByName(string $name): string
{
    return getRealPath(CONTROLLERS_FOLDER . DIRECTORY_SEPARATOR . $name . '.php');
}

$controllerPath = getControllerByName($_REQUEST['page'] ?  : 'index');

if (file_exists($controllerPath)) {
    include $controllerPath;
} else {
    echo "Not found !";
    var_dump($controllerPath);
}