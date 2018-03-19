<?php
@session_start();

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'core' . DIRECTORY_SEPARATOR);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . preg_replace('@/*(public|)/?$@', '', dirname($_SERVER['SCRIPT_NAME'])) . '/');

require ROOT . 'core' . DIRECTORY_SEPARATOR . 'FrontController.php';

$app = new FrontController();
