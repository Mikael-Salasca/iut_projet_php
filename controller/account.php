<?php


require ROOT . '/core/User.php';
require ROOT . '/model/accountmodif.php';

class account extends Controller {

    public function informations() {
        session_start();
        $this->isConnect();
        $this->start_page(translate("Gestion du compte"));
        require ROOT . '/views/account/viewAccount.php';
        $this->end_page();
    }

    public function modify_email() {
        session_start();
        $this->isConnect();
        $this->start_page(translate("Changement d'adresse"));
        require ROOT . '/views/account/viewChangeMail.php';
        $this->end_page();
    }

    public function send_email() {
        session_start();

        $this->isConnect();
        $email = filter_input(INPUT_POST, 'email');
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">' . translate('Veuillez entrer une adresse mail valide') . '</div>';
            header('location:/account/modify_email');
        }

        else if ($email != $_SESSION['email']) {
            $_SESSION['error_account_email'] = '<div class="error-register">' . translate('Votre compte n\'est pas lié à cette adresse email.') . '</div>';
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
                    $this->start_page(translate("Erreur technique"));
                    require ROOT . '/views/errorGestion/technicalError.php';
                    $this->end_page();
                    exit();
                }
            }
        }


    private function sendCodeVerification($email) {
        //$key = md5(microtime(TRUE)*65413);
        $code = $this->generateKeyAscii(6);
        if(!saveCodeVerification($code,$_SESSION['name']))
            return false;

        $TO = $email;
        $head = "From: support@projetphpmvg.alwaysdata.net;" . "\n";
        $head = 'Content-Type: text/html; charset=ISO-8859-1\r\n;';
        $message = '<p><b>'. translate('Bonjour') . '</b>, </br>'. translate('Bonjour, vous avez demandé à changer votre adresse mail. Si ce message ne vous concerne pas, veuillez l\'ignorer.') . '<br>' .
                    translate('Voici votre code de confirmation :') .  '<br><br>';
        $message .= '<p style="font-weight:bold;font-size:20px;">'. $code . '</p><br><br>';


        $message .= '<p>' . translate('Ceci est un message automatique, merci de ne pas y répondre') . '</p>';
        $subject = translate('Votre code de confirmation') ;

        if(mail($TO, $subject, $message, $head))
            return true;
        else
            return false;
    }

    public function confirm_code() {
        session_start();
        $this->start_page(translate('Verification du compte'));
        if($_SESSION['access_code'])
        {
            require ROOT . '/views/account/viewConfirmation.php';
        }
        else{
            require ROOT . '/views/errorGestion/error403View.php';
        }
        $this->end_page();
    }

    public function verify_code() {
        session_start();
        if(!isset($_SESSION['access_code'])){
            $this->start_page(translate('Accès refusé'));
            require ROOT . '/views/errorGestion/error403View.php';
            $this->end_page();
            exit();
        }

        $code = filter_input(INPUT_POST, 'code');



        if (!checkCode($_SESSION['name'], $code) || checkDateCode($code)) {
            $_SESSION['wrong_code'] = '<div class="error-register">'. translate('Le code entré n\'est pas le bon ! (Ou a expiré)') . '</div>';
            header('location:/account/confirm_code');
            exit();
        }

        $_SESSION['access_new_email'] =1;
        header('location:/account/new_email');

    }


    public function new_email(){
        session_start();
        if(!isset($_SESSION['access_new_email']))
        {
            $this->start_page(translate('Accès refusé'));
            require ROOT . '/views/errorGestion/error403View.php';
            $this->end_page();
            exit();
        }
        else
        {
            $this->start_page(translate('Nouvelle adresse email'));
            require ROOT . '/views/account/viewNewEmail.php';
            $this->end_page();

        }





    }

    public function send_new_mail(){
        session_start();
        if(!isset($_SESSION['access_new_email']))
        {
            $this->start_page(translate('Accès refusé'));
            require ROOT . '/views/errorGestion/error403View.php';
            $this->end_page();
            exit();

        }



        $new_email =  filter_input(INPUT_POST,'newemail');
        $new_email2 = filter_input(INPUT_POST,'newemail2');

        if($new_email == $_SESSION['email']){
            $_SESSION['error_account_email'] = '<div class="error-register">' . translate('Cette adresse email est déja liée à votre compte.') . '</div>';
            header('location:/account/new_email');
            exit();

        }
        else if (checkEmailExist($new_email)) {
            $_SESSION['error_account_email'] = '<div class="error-register">' . translate('Cette adresse email n\'est pas disponible.') . '</div>';
            header('location:/account/new_email');
            exit();
        }
        else if($new_email != $new_email2)
        {
            $_SESSION['error_account_email'] = '<div class="error-register">' . translate('Vos adresses emails ne sont pas les mêmes !') . '</div>';
            header('location:/account/new_email');
            exit();
        }
        else if(!filter_var($new_email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">' . translate('Veuillez entrer une adresse mail valide') . '</div>';
            header('location:/account/new_email');
            exit();
        }


            if (!modifyemail($_SESSION['name'], $new_email)) {
                unset($_SESSION['access_code'] );
                unset($_SESSION['acces_new_email']);
                //$_SESSION['error_new_email'] = '<p class="error_register">Une erreur s\'est produite, veuillez réessayer.<br>Si le problème persiste, veuillez contacter le support.</p>';
                $this->start_page(translate("Erreur technique"));
                require ROOT . '/views/errorGestion/technicalError.php';
                $this->end_page();
                exit();
            }

            $_SESSION['email_changed'] = 1;
            $_SESSION['email'] = $new_email; // on stocke sa nouvelle adresse email dans sa session

            $_SESSION['crypt_email'] = $this->cryptEmail($new_email);

            unset($_SESSION['access_code']); // l'utilisateur n'a plus le droit de renouveller les requetes à présent.
            unset($_SESSION['acces_new_email']); // pareil pr la page de mail.
            header('Location:/account/mail_change');





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
        $this->start_page(translate('Adresse mail changée'));

        if(isset($_SESSION['email_changed']))
        {
            require ROOT . '/views/account/viewMailHadChange.php';
            unset($_SESSION['email_changed']);
        }
        else{
            header('location:/account/informations');
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


    public function modify_password(){

        session_start();
        $this->isConnect();
        if(isset($_SESSION['pass_has_change'])){
            $this->start_page(translate("Mot de passe changé"));
            require ROOT . '/views/account/passmodfiedOk.php';
            unset($_SESSION['pass_has_change']);
        }
        else {
            $this->start_page(translate("Modifiez votre mot de passe"));
            require ROOT . '/views/account/viewChangePassword.php';
        }
        $this->end_page();






    }

    public function send_pass(){

        session_start();
        $this->isConnect();
        require ROOT . '/model/connexion.php'; // on charge des fonctions déja écrite antérieurement(donc pas la peine de les réécrire)
        require ROOT . '/model/forgotpass.php';


        $password = filter_input(INPUT_POST,'mypass');
        $newpass = filter_input(INPUT_POST,'newpass');
        $newpass2 = filter_input(INPUT_POST,'newpass2');
        if(!checkConnexionValid($_SESSION['email'],$password))
        {
            $_SESSION['error_mypass'] = '<div class="error-register">' . translate('Le mot de passe est incorrect') .'</div>';
            header('location:/account/modify_password');
            exit();
        }

        if($password == $newpass)
        {
            $_SESSION['error_pass'] = '<div class="error-register">' . translate('Votre ancien mot de passe et le nouveau sont identiques') . '</div>';
            header('location:/account/modify_password');
            exit();
        }

        if($newpass != $newpass2)
        {
            $_SESSION['error_pass'] = '<div class="error-register">' . translate('Vos mot de passes ne sont pas identiques') . '</div>';
            header('location:/account/modify_password');
            exit();
        }

        //si on arrive ici on peut changer le mot de passe

        if(!saveNewPass($_SESSION['name'],md5($newpass)))
        {
            $this->start_page(translate("Erreur technique"));
            require ROOT . '/views/errorGestion/technicalError.php';
            $this->end_page();
            exit();
        }
        $_SESSION['pass_has_change'] = 1;
        header('location:/account/modify_password');
        exit();

    }

    private function isConnect(){

        if(!isset($_SESSION['user']))
        {
            header('location:/connection/connect');
            exit();
        }

    }



}
