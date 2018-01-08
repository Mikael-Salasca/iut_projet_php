<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 17:25
 */

define("WEBROOT");
define("ROOT",__DIR__);

print_r($_SERVER);

require (ROOT . 'model/base.php');
require (ROOT . 'model/saveInscription.php');
require (ROOT . 'controller/inscription.php');

$params = explode('/',$_SERVER['REQUEST_URI']);
$controller = $params[0];
$action = $params[1];

require ('controller/' .$controller .'.php');
$controller = new $controller();