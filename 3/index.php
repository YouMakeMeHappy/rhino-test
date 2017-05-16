<?php
spl_autoload_register();

define('APP_WEB_PATH' , '/3/');
define('ASSETS_WEB_PATH' , '/3/assets');

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'app/App.php';

(new App)->run(require_once 'app/config/config.php');