<?php


require ROOT . '/model/connexion.php';


class Connection extends Controller {

    public function connect() {
        session_start();

        if(isset($_SESSION['user']))
        {
            header('location:/');
        }
        $this->start_page('Page de connexion');
        require ROOT . '/views/connection/connectionView.php';
        $this->end_page();
    }

    public function validate() {
        session_start();
        if(isset($_SESSION['user']))
        {
            header('location:/');
        }


        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $passwd = filter_input(INPUT_POST,'mdp');

        if(empty($email || $passwd))
        {
            header("Location: /connection/connect");
            exit();
        }
        if(checkConnexionValid($email,$passwd) == true)
        {
            // on initialise toute les infos de compte du client
            if(!$this->getInfo()){
                $this->start_page("Erreur technique");
                require ROOT . '/views/errorGestion/technicalError.php';
                $this->end_page();
                exit();

            }
            $_SESSION['first_co'] = 1;

            header("Location:/");
        }
        else {
            $_SESSION['error_connexion'] = '<div class="error-co">Le compte associé n\'existe pas ou le mot de passe est incorrect.</div>';
            header("Location: /connection/connect");
        }
    }




    public function impossible(){

        session_start();

        if(isset($_SESSION['user']))
        {
            header('location:/');
        }
        $this->start_page('Impossible de se connecter ?');
        require ROOT . '/views/connection/impossibleConnectionView.php';
        $this->end_page();


    }








}