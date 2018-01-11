<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 15:52
 */

require(ROOT . '/model/saveRegistration.php');

require ROOT . '/core/controller.php';

class Inscription extends  Controller
{

    function validate()
    {
        $name = $_POST['name'];
        $email = $_POST['mail'];
        $password = $_POST['password'];

        $affectedLines = saveRegistration($name, $email, $password);

        if ($affectedLines === false) {
            //$_SESSION['erreur_inscription'] = true;
            header('Location: /');

        } else {

            echo 'bien inscrit';
        }
    }


    function register()
    {

        $this->start_page('Page d\'Inscription');
        require ROOT . '/views/inscriptionView.php';
        $this->end_page();


    }



}