<?php


require ROOT . '/core/User.php';
require ROOT . '/model/accountmodif.php';

class account extends Controller {

    public function modify() {
        session_start();
        $this->start_page("Gestion du compte");
        if(isset($_SESSION['user'])) {
            require ROOT . '/views/account/viewAccount.php';
        }
        else
        {
            require ROOT . '/views/errorGestion/error403View.php';
        }
        $this->end_page();
    }

    public function modify_email() {
        session_start();
        $this->start_page("Changement d'adresse");
        require ROOT . '/views/account/viewChangeMail.php';
        $this->end_page();
    }

    public function send_email() {
        session_start();
        if(!isset($_SESSION['user'])){

            $this->start_page('Acces refusé');
            require ROOT . '/views/errorGestion/error403View.php';
            $this->end_page();
            exit();

        }
        $email = filter_input(INPUT_POST, 'email');
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">Veuillez entrer une adresse mail valide</div>';
            header('location:/account/modify_email');
        }

        else if ($email != $_SESSION['email']) {
            $_SESSION['error_account_email'] = '<div class="error-register">Votre compte n\'est pas lié à cette adresse email.</div>';
            header('location:/account/modify_email');
        }

        else {

            if($this->sendCodeVerification($email)) {
                $_SESSION['access_code'] = 1;
                header('location:/account/confirm_code');
            }
            else
                {
                    //$_SESSION['error_register'] = '<p class="error_register">Une erreur s\'est produite, veuillez réessayer.<br>Si le problème persiste, veuillez contacter le support.</p>';
                    header('Location: /error/technical');
                }
            }
        }


    private function sendCodeVerification($email) {
        //$key = md5(microtime(TRUE)*65413);
        $code = $this->generateKeyAscii(6);
        if(!saveCodeVerification($code,$_SESSION['name']))
            return false;

        $TO = $email;
        $head = "From: support@projetphpmvg.alwaysdata.net;";
        $head = 'Content-Type: text/html; charset=ISO-8859-1\r\n;';
        $message = '<p><b>Bonjour</b>, </br> Bonjour, vous avez demandé à changer votre adresse mail. Si ce message ne vous concerne pas, veuillez l\'ignorer. <br>
                    Voici votre code de confirmation : <br><br>';
        $message .= '<p style="font-weight:bold;font-size:20px;">'. $code . '</p><br><br>';


        $message .= '<p>Ceci est un message automatique, merci de ne pas y répondre</p>';
        $subject ='Votre code de confirmation' ;

        if(mail($TO, $subject, $message, $head))
            return true;
        else
            return false;
    }

    public function confirm_code() {
        session_start();
        $this->start_page('Verification du compte.');
        if($_SESSION['access_code'])
        {
            require ROOT . '/views/account/viewConfirmation.php';
        }
        else{
            require ROOT . '/views/errorGestion/error403View.php';
        }
        $this->end_page();
    }

    public function verifycode() {
        session_start();
        if(!isset($_SESSION['access_code'])){
            $this->start_page('Acces refusé');
            require ROOT . '/views/errorGestion/error403View.php';
            $this->end_page();
            exit();
        }

        $code = filter_input(INPUT_POST, 'code');
        $new_email = filter_input(INPUT_POST, 'new_email');
        $new_email2 = filter_input(INPUT_POST, 'new_email2');


        if($new_email == $_SESSION['email']){
            $_SESSION['error_account_email'] = '<div class="error-register">Cette adresse email est déja lié à votre compte.</div>';
            header('location:/account/confirm_code');
            exit();

        }
        else if (checkEmailExist($new_email)) {
            $_SESSION['error_account_email'] = '<div class="error-register">Cette adresse email n\' est pas disponible.</div>';
            header('location:/account/confirm_code');
            exit();
        }
        else if($new_email != $new_email2)
        {
            $_SESSION['error_account_email'] = '<div class="error-register"> Vos adresses emails ne sont pas les mêmes</div>';
            header('location:/account/confirm_code');
            exit();
        }
        else if(!filter_var($new_email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">Veuillez entrer une adresse mail valide</div>';
            header('location:/account/confirm_code');
            exit();
        }

        if (!checkCode($_SESSION['name'], $code)) {
            $_SESSION['wrong_code'] = '<div class="error-register">Le code entré n\'est pas le bon !</div>';
            header('location:/account/confirm_code');
        }
        else {
            if (!modifyemail($_SESSION['name'], $new_email)) {
                unset($_SESSION['access_code'] );
                //$_SESSION['error_new_email'] = '<p class="error_register">Une erreur s\'est produite, veuillez réessayer.<br>Si le problème persiste, veuillez contacter le support.</p>';
                header('Location: /error/technical');
            }
            else {
                // faire comme thomas a fait pour afficher que la connexion a été effectuée avec succès (OK Je le ferais bientôt. Cordialement, Thomas.)
                $_SESSION['email_changed'] = 1;
                $_SESSION['email'] = $new_email; // on stocke sa nouvelle adresse email dans sa session

                $_SESSION['email_crypt'] = $this->cryptEmail($new_email);
                unset($_SESSION['access_code']); // l'utilisateur n'a plus le droit de renouveller les requetes à présent.
                header('Location:/account/mail_change');
            }
        }

    }

    private function generateKeyAscii($size){

        $characts = 'abcdefghijklmnopqrstuvwxyz';
        $characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characts .= '1234567890';
        $code = '';

        for($i=0;$i < $size;$i++) {
            $code .= substr($characts,rand()%(strlen($characts)),1);
        }

        return $code;

    }

    public function mail_change(){
        session_start();
        $this->start_page('Adresse mail changé.');

        if(isset($_SESSION['email_changed']))
        {
            require ROOT . '/views/account/viewMailHadChange.php';
            unset($_SESSION['email_changed']);
        }
        else{
            header('location:/account/modify');
        }

        $this->end_page();


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
