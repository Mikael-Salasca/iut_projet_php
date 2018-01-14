<?php

require ROOT . '/core/controller.php';
require ROOT . '/model/connexion.php';



class Connection extends Controller {

    function connect() {
        session_start();
        $this->start_page('Page de connexion');
        require ROOT . '/views/connection/connectionView.php';
        $this->end_page();
    }

    function validate() {
        session_start();

        $email = filter_input(INPUT_POST,email);
        $passwd = filter_input(INPUT_POST,mdp);
        if(checkConnexionValid($email,$passwd) == true)
        {
            $_SESSION['login'] = 'ok';
            $_SESSION['first_co'] = 1;
            header("Location: /");
        }
        else {
            $_SESSION['error_connexion'] = '<div class="error-co">Le compte associé n\'existe pas ou le mot de passe est incorrect.<br>Veuillez essayer à nouveau.<div>';
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

    function impossible(){

        $this->start_page('Impossible de se connecter ?');
        require ROOT . '/views/connection/impossibleConnectionView.php';
        $this->end_page();


    }

    function recoverypass()
    {
        $this->start_page('Récupérer mon mot de passe');
        require ROOT . '/views/connection/recoverypassView.php';
        $this->end_page();

    }

}