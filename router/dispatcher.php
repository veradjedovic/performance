<?php

$controller = 'App\controllers\\' . (isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Client') . 'Controller';
$method = isset($_GET['method']) ? $_GET['method'] : 'insert';

$route = new $controller();
$route->$method();