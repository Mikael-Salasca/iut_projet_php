<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 17:25
 */

require 'inscription.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'enregistrer') {

        validInscription($_POST['name'],$_POST['email'],$_POST['password']);


    }



    }
