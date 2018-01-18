<?php


require ROOT . '/model/connexion.php';


class Connection extends Controller {

    public function connect() {
        session_start();
        $this->start_page('Page de connexion');
        require ROOT . '/views/connection/connectionView.php';
        $this->end_page();
    }

    public function validate() {
        session_start();

        $email = filter_input(INPUT_POST,email);
        $passwd = filter_input(INPUT_POST,mdp);

        if(empty($email || $passwd))
        {
            header("Location: /connection/connect");
            exit();
        }
        if(checkConnexionValid($email,$passwd) == true)
        {
            // on initialise toute les infos de compte du client
            if(!$this->getInfo()){
                header('location:/error/technical');
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

        $this->start_page('Impossible de se connecter ?');
        require ROOT . '/views/connection/impossibleConnectionView.php';
        $this->end_page();


    }

    private function getInfo() {
        if (isset($_SESSION['user'])) {
            $current_user = $_SESSION['user'];
            $_SESSION['name'] = $current_user->getName();
            $_SESSION['email'] = $current_user->getEmail();
            $_SESSION['password'] = $current_user->getPassword();
            $_SESSION['type'] = $current_user->getAccountType();
            $_SESSION['isActive'] = $current_user->getActivation();
            $_SESSION['crypt_email'] = $this->cryptEmail($_SESSION['email']);

            return true;
        }
         return false;


    }

    private function cryptEmail($email){

        $crypt = '';


        for($i=0; $i < iconv_strlen($email);$i++)
        {
            if(substr($email,$i,1) == "@") break;
            if($i > 1)
                $crypt .= '*';
            else
                $crypt .=  substr($email,$i,1);

        }
        for($i; $i < iconv_strlen($email); $i++)
        {
            $crypt .= substr($email,$i,1);
        }



        return $crypt;

    }




}