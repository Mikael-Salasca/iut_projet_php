<?php

require ROOT . '/core/controller.php';
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


    public function disconnect()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
            unset($_SESSION['name']);
            $_SESSION['isDisconnect'] = 1;
            header('Location: /');
        }

    }

    public function impossible(){

        $this->start_page('Impossible de se connecter ?');
        require ROOT . '/views/connection/impossibleConnectionView.php';
        $this->end_page();


    }

    public function forgotpass()
    {
        session_start();
        $this->start_page('Récupérer mon mot de passe');
        require ROOT . '/views/connection/recoverypassView.php';
        $this->end_page();

    }

    public function recoverypass()
    {
        session_start();

        //verifier que le compte est bien associé au mail envoyé
        $name = filter_input(INPUT_POST,'account');
        $email = filter_input(INPUT_POST,'mail');

        if(!checkAccountWithMail($name,$email)){ // Si les deux ne sont pas associés
            $_SESSION['error_account'] = '<div class="error-recovery-1">Nom de compte et/ou adresse e-mail incorrect</div>';
            header('location:/connection/forgotpass');
            exit();
        }

        //générer une clée crypé
        $key = md5(microtime(TRUE)*100000);

        //stockée la clée dans la base de donnée
        if(!saveKeyPass($key,$name)) // si la clé n'a pas pu être sauvegardé
        {
            $_SESSION['error_system'] = '<div class="error-recovery-1">Une erreur est survenue lors de la procédure de vérification.<br> Veuillez réessayer.</div>';
            header('location:/connection/forgotpass');
            exit();
        }

            // envoyé un mail de récupération au client

        if(!$this->sendEmailVerification($email,$key)){ // Si l'envoie n'a pas pu avoir lieu

            $_SESSION['error_system'] = '<div class="error-recovery-1">Une erreur est survenue lors de la procédure de vérification.<br> Veuillez réessayer.</div>';
            header('location:/connection/forgotpass');
            exit();
        }


            // si tout s'est bien passé, rediriger le client vers une page lui disant qu'un mail viens de lui être envoyé

        $_SESSION['send_mail'] = 1;
        $_SESSION['email_send'] = $email;
        header('location:/connection/mailsend');




    }


    private function sendEmailVerification($email,$key)
    {

        $TO = $email;
        $head = "From: support@projetphpmvg.alwaysdata.net;";
        $head = 'Content-Type: text/html; charset=ISO-8859-1\r\n;';
        $message = '<p><b>Bonjour</b>, </br> Vous avez demandé à recevoir un nouveau mot de passe pour votre compte . <br><br> Il vous suffit de cliquer sur ce lien pour choisir votre nouveau mot de passe dans un délai de 48h après la réception de cet email.<br>';
        $lien = 'http://projetphpmvg.alwaysdata.net/connection/resetpassword?guid=' . urlencode($key);
        $message .= '<a href="' . $lien . '">' . $lien . '</a><br><br>';
        $message .= '<p>Ceci est un message automatique, merci de ne pas y répondre</p>';
        $subject ='Modification de votre mot de passe' ;

        if(mail($TO, $subject, $message, $head))
            return true;
        else
            return false;




    }

    public function resetpassword(){

    //une fois que l'utilisateur aura cliqué sur le lien pr changer son mot de passe par mail, il sera redirigé ici
        session_start();
        $key = filter_input(INPUT_GET,'guid');

        $row = getAccountByKey($key);

        if($row == '' || !checkDatePass($key))
        {
            $_SESSION['error_key_invalid'] = 1;
            header('location:/connection/changepass');
            exit();
        }

        // sinon la clé a était trouver dans la base de donnée

        $_SESSION['reset_name'] = $row['NAME']; // on sauvegarde le nom de compte de la personne

        header('location:/connection/changepass');
        exit();
    }

    public function mailsend(){
        session_start();
        $this->start_page('Récupérer mon mot de passe');
        if(isset($_SESSION['send_mail'])){
            require ROOT . '/views/connection/mailSendView.php';
            unset($_SESSION['send_mail']);
            unset($_SESSION['email_send']);

        }
        else
        {
            require ROOT . '/views/errorGestion/error403View.php';
        }

        $this->end_page();


    }

    public function changepass(){
        session_start();
        $this->start_page('Récupérer mon mot de passe');
        if(isset($_SESSION['reset_name'])) {
            require ROOT . '/views/resetpassword/resetPassOkView.php';

        }
        else if (isset($_SESSION['error_key_invalid'])) {
            require ROOT . '/views/resetpassword/resetPassErrorView.php';
            unset($_SESSION['error_key_invalid']);
        }
        else
            require ROOT . '/views/errorGestion/error403View.php';
        $this->end_page();
    }

    public function activerecovery(){
        //Une fois que les deux nouveaux mots de passe ont étaient recus, les traites
        session_start();
        if(!isset($_SESSION['reset_name']))
        {
            header('location:/');
            exit();

        }
        $pass1 = filter_input(INPUT_POST,'mdp');
        $pass2 = filter_input(INPUT_POST,'mdp2');

        if(!isset($pass1) || !isset($pass2))
        {

            require ROOT . '/views/errorGestion/error403View.php';
        }
        if(empty($pass1) || empty($pass2) || $pass1 != $pass2)
        {
            $_SESSION['error_recovery'] = '<div class="error-recovery-1">Vos mots de passe doivent être identiques</div>';
            header('location:/connection/changepass');
            exit();
        }

        if(!saveNewPass($_SESSION['reset_name'],md5($pass1))) // si le nouveau mot de passe n'a pas pu être sauvegardé
        {

            require ROOT . '/views/errorGestion/technicalError.php';
            exit();

        }



        // on redirige le client en lui disant que son mot de passe a bien était sauvegardé.
        $this->start_page("Mot de passe modifié");
        require ROOT . '/views/connection/passmodifiedOK.php';
        $this->end_page();
        unset($_SESSION['reset_name']);
        exit();

    }

}