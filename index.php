<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 17:25
 */

//define("WEBROOT");
define("ROOT",__DIR__);
echo '<pre>';
print_r($_SERVER);
echo '</pre>';


$params = explode('/',$_SERVER['REQUEST_URI']);
$controller = $params[1];
if($controller == "accueil" || $controller == "acceuil")
{
    header('Location: accueil.php');
}
echo $controller;
$action = $params[2];
echo $action;


require ('controller/' . $controller . '.php');

if(!empty($action))
{
    $controller = new $controller();
    $controller->$action();
}
