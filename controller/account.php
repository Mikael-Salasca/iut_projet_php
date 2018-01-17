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
        $new_email = filter_input(INPUT_POST, 'email');
        if(!filter_var($new_email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">Veuillez entrer une adresse mail valide</div>';
            header('location:/account/modify_email');
        }

        else if(checkEmailExist($new_email))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">Cette adresse email est déja enregistrée !</div>';
            header('location:/account/modify_email');
        }

        else if ($new_email == $_SESSION['email']) {
            $_SESSION['error_account_email'] = '<div class="error-register">Cette adresse email est déja liée à votre compte !</div>';
            header('location:/account/modify_email');
        }

        else {

            if($this->sendEmailVerification($new_email)) {
                $_SESSION['email'] = $new_email;
                header('location:/account/confirm');
            }
            else
                {
                    $_SESSION['error_register'] = '<p class="error_register">Une erreur s\'est produite, veuillez réessayer.<br>Si le problème persiste, veuillez contacter le support.</p>';
                    header('Location: /account/modify');
                }
            }
        }


    public function sendEmailVerification($new_email) {
        $key = md5(microtime(TRUE)*65413);
        if(saveKeyAccount($key,$_SESSION['name']) != true)
            return false;

        $TO = $new_email;
        //$head = "From: inscription@projetphpmvg.alwaysdata.net;";
        $head = 'Content-Type: text/html; charset=ISO-8859-1\r\n;';
        $message = '<p><b>Bonjour</b>, </br> Bonjour, vous avez demandé à changer votre adresse mail. Si ce message ne vous concerne pas, veuillez l\'ignorer. <br>
                    Voici votre code de confirmation : <br>' . $key;

        $lien = 'http://projetphpmvg.alwaysdata.net/inscription/verifymail?guid=' . urlencode($key);
        $message .= '<a href="' . $lien . '">' . $lien . '</a><br><br>';
        $message .= '<p>Ceci est un message automatique, merci de ne pas y répondre</p>';
        $subject ='Activer votre compte sur notre site de traduction !' ;

        if(mail($TO, $subject, $message, $head))
            return true;
        else
            return false;
    }

    public function confirm() {
        session_start();
        $this->start_page('Verification du compte.');
        require ROOT . '/views/account/viewConfirmation.php';
        $this->end_page();
    }

    public function verifycode() {
        $code = filter_input(INPUT_POST, 'code');
        if (!checkCode($_SESSION['name'], $code)) {
            $_SESSION['wrong_code'] = '<div class="error-register">Le code entré n\'est pas le bon !</div>';
            header('location:/account/confirm');
        }
        else {
            if (!modifyemail($_SESSION['name'], $_SESSION['email'])) {
                $_SESSION['error_register'] = '<p class="error_register">Une erreur s\'est produite, veuillez réessayer.<br>Si le problème persiste, veuillez contacter le support.</p>';
                header('Location: /account/modify');
            }
            else {
                // faire comme thomas a fait pour afficher que la connexion a été effectuée avec succès
                $_SESSION['email_changed'] = '<div class="thomasfaislecss">Votre adresse mail a été modifiée avec succès !</div>';
                header('Location:/');
            }
        }

    }

}