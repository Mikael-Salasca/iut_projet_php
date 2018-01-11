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
if (isset($params[1])&& isset($params[2])){

    $controller = $params[1];
    $action = $params[2];
}




echo $controller;
echo $action;


require ('controller/' . $controller . '.php');

if (class_exists($controller)){
    $controllerObject = new $controller(); //test si la classe existe
    if (method_exists($action))
        $controllerObject->$action();

}

else {
    $controllerObject = new Home();
    $controllerObject->index();
}



