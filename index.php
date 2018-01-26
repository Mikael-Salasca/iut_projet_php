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
require 'core/controller.php';
$params = explode('/',$_SERVER['REDIRECT_URL']);
if (isset($params[1])&& isset($params[2])) {

    $controller = $params[1];
    $action = $params[2];
    if (sizeof($params) < 4 && file_exists('controller/' . $controller . '.php')) {
        require 'controller/' . $controller . '.php';
        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (is_callable(array($controllerObject, $action))) {
                $controllerObject->$action();
            }
            else {
                require 'controller/error.php';
                $ObjectErreur = new PageErrors();
                $ObjectErreur->pagenotfound();
                exit();
                }
        }
    }
    else {
        require 'controller/error.php';

        $ObjectErreur = new PageErrors();
        $ObjectErreur->pagenotfound();
        exit();
    }
}

else if (sizeof($params) == 1 || (sizeof($params) == 2 && $params[1] == 'home')) {
    require 'controller/home.php';

    $controllerObject = new Home();
    $controllerObject->index();
}

else {
    require 'controller/error.php';

    $ObjectErreur = new PageErrors();
    $ObjectErreur->pagenotfound();
    exit();

}
                            