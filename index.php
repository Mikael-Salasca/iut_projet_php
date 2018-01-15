<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 17:25
 */

//define("WEBROOT");
define("ROOT",__DIR__);
/*
echo '<pre>';
print_r($_SERVER);
echo '</pre>';
*/

$params = explode('/',$_SERVER['REDIRECT_URL']);
if (isset($params[1])&& isset($params[2])) {

    $controller = $params[1];
    $action = $params[2];
    //echo 'controller : ' . $controller . '</br>';
    //echo 'action : ' . $action;
    if (file_exists('controller/' . $controller . '.php')) {
        require 'controller/' . $controller . '.php';
        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (is_callable(array($controllerObject, $action)))
                $controllerObject->$action();
        }

    }
    else {
        require 'controller/pagenotfound.php';
        $controllerObject = new Pagenotfound();
        $controllerObject->displayError();
        $controllerObject->end_page();
    }
}

else {
    require 'controller/home.php';
    $controllerObject = new Home();
    $controllerObject->index();
}
                            