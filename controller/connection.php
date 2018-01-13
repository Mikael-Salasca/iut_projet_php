<?php

require ROOT . '/core/controller.php';
require ROOT . '/model/connexion.php';



class Connection extends Controller {

    function connect() {
        session_start();
        $this->start_page('Page de connexion');
        require ROOT . '/views/connectionView.php';
        $this->end_page();
    }

    function validate() {
        session_start();

        $name = filter_input(INPUT_POST,name);
        $passwd = filter_input(INPUT_POST,mdp);
        if(checkConnexionValid($name,$passwd) == true)
        {
            $_SESSION['name'] = $dbRow['NAME'];
            $_SESSION['login'] = 'ok';
            $_SESSION['first_co'] = 1;
            header("Location: /");
        }
        else {
            $_SESSION['error_connexion'] = '<p>Le nom d’utilisateur ou le mot de passe est incorrect.<br>Veuillez essayer à nouveau.<p>';
            header("Location: /connection/connect");
        }

        }


    function disconnect()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
            unset($_SESSION['name']);
            $_SESSION['isDisconnect'] = 1;
            header('Location: /');
        }

    }

}