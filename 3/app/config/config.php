<?php
return [
    'view' => [
        'class' => '\app\lib\components\View',
    ],
    'db' => [
        'class' => '\app\lib\components\DB',
        'dsn' => 'mysql:host=localhost;dbname=YOUR_DATABASE_NAME', //@todo: set database here
        'user' => '', //@todo: set username here
        'password' => '', //@todo: set password here
        'options' =>
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
    ],
    'request' => [
        'class' => '\app\lib\components\Request',
    ],
    'router' => [
        'class' => '\app\lib\components\Router',
    ],
];