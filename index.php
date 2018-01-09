<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 17:25
 */

//define("WEBROOT");
define("ROOT",__DIR__);

print_r($_SERVER);



$params = explode('/',$_SERVER['REQUEST_URI']);
$controller = $params[1];
echo $controller;
$action = $params[2];
echo $action;

require ('controller/' .$controller .'.php');
$controller = new $controller();
$controller->$action();