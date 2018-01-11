<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 17:25
 */

//define("WEBROOT");
define("ROOT", __DIR__);
echo '<pre>';
print_r($_SERVER);
echo '</pre>';


$params = explode('/', $_SERVER['REQUEST_URI']);
if (isset($params[1]) && isset($params[2])) {

    $controller = $params[1];
    $action = $params[2];
    echo 'controller : ' . $controller . '</br>';
    echo 'action : ' . $action;
    if (file_exists('controller/' . $controller . '.php') && (class_exists($controller)) && (method_exists($controller, $action))) {
        require 'controller/' . $controller . '.php';
        $controllerObject = new $controller();
        $controllerObject->$action();
    } else {
        require 'controller/pagenotfound.php';
        $controllerObject = new Pagenotfound();
        $controllerObject->displayError();
        $controllerObject->end_page();


    }

} else {
    require 'controller/home.php';
    $controllerObject = new Home();
    $controllerObject->index();
}







