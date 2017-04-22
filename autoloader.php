<?php

session_start();

$classes = [
    'config/DBConfig.php',
    'route/Router.php',
    'models/DB.php',
    'models/User.php',
    'controllers/ErrorHandlerController.php',
];


foreach($classes as $class)
    require_once $class;