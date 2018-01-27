<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 15:52
 */

require(ROOT . '/model/registration.php');



class Inscription extends  Controller
{

    public function validate()
    {
        session_start();
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'mail');
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST,'password2');
        $cuAccept = filter_input(INPUT_POST,'cu');

        if (!preg_match('/^[a-zA-Z0-9]/', $name)) {
            $_SESSION['error_register'] = '<div class="error-register">Votre nom comporte des caractères interdits.</div>';
            header('location:/inscription/register');
            exit();
        }


        if (empty($name) || empty($email) || empty($password) || empty($password2)) {
            $_SESSION['error_register'] = '<div class="error-register">Vous devez remplir tout les champs.</div>';
            header('location:/inscription/register');
        }
        else if(checkAccountExist($name))
        {
            $_SESSION['error_account_name'] = '<div class="error-register">Ce compte existe déja !</div>';
            header('location:/inscription/register');
        }
        else if(checkEmailExist($email))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">Cette adresse email est déja enregistré !</div>';
            header('location:/inscription/register');
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error_account_email'] = '<div class="error-register">Veuillez entrer une adresse mail valide</div>';
            header('location:/inscription/register');
        }
        else if ($password != $password2)
        {
            $_SESSION['error_mdp'] = '<div class="error-register">Vos mots de passe doivent être identique</div>';
            header('location:/inscription/register');

        }
        else if($cuAccept != true)
        {
            $_SESSION['error_cu'] = '<div class="error-register">Veuillez lire et accepter les conditions d\'utilisation</div>';
            header('location:/inscription/register');
        }
        else
            {

                $affectedLines = saveRegistration($name, $email, $password);

                if ($affectedLines === false)
                {
                    $_SESSION['error_register'] = '<p class="error_register">Une erreur s\'est produite lors de l\'inscription, veuillez reassayer.<br>Si le problème persiste, contactez le support</p>';
                    header('Location: /inscription/register');

                }
                else{

                    if($this->sendEmailVerification($name,$email)) {

                        $_SESSION['email_send'] = $email;
                        header('Location:/inscription/confirme');
                    }
                    else
                    {
                        $_SESSION['error_register'] = '<p class="error_register">Une erreur s\'est produite lors de la validation de votre compte, veuillez reassayer.<br>Si le problème persiste, contactez le support</p>';
                        header('Location: /inscription/register');
                    }
                }
            }

    }


    public function register()
    {

        session_start();
        $this->start_page('Page d\'Inscription');
        require ROOT . '/views/inscription/inscriptionView.php';
        $this->end_page();


    }

    public function confirme()
    {
        session_start();
        $this->start_page('Verification du compte.');
        if(isset($_SESSION['email_send']))
        {

            require ROOT . '/views/inscription/inscriptionFinish.php';
            unset($_SESSION['email_send']);
        }
        else{

            header('location:/inscription/register');
        }
        $this->end_page();


    }

    public function confirmaccount()
    {
        session_start();
        $this->start_page('Activation du compte');

        if(isset($_SESSION['active_account'])) {

            require ROOT . '/views/confirmationAccount/confirmationAccountTrueView.php';
            unset($_SESSION['active_account']);
        }
        else if(isset($_SESSION['error_account']))
        {
            require ROOT . '/views/confirmationAccount/confirmationAccountErrorView.php';
            unset($_SESSION['error_account']);
        }
        else
            header('location:/inscription/register');
        $this->end_page();

    }


    private function sendEmailVerification($name,$email)
    {
        // Génération de la clée de verification et stockage de celle ci dans la base de donnée

        $key = md5(microtime(TRUE)*100000);
        if(saveKeyAccount($key,$name) != true)
            return false;

        $TO = $email;
        $head = "From: inscription@projetphpmvg.alwaysdata.net;";
        $head = 'Content-Type: text/html; charset=ISO-8859-1\r\n;';
        $message = '<p><b>Bonjour</b>, </br> Votre inscription est presque terminée ! Confirmez votre adresse email en cliquant sur le lien ci-dessous : <br>';
        $lien = 'http://projetphpmvg.alwaysdata.net/inscription/verifymail?guid=' . urlencode($key);
        $message .= '<a href="' . $lien . '">' . $lien . '</a><br><br>';
        $message .= '<p>Ceci est un message automatique, merci de ne pas y répondre</p>';
        $subject ='Activer votre compte sur notre site de traduction !' ;

        if(mail($TO, $subject, $message, $head))
            return true;
        else
            return false;




    }

    public function verifymail(){

        session_start();

        $key = filter_input(INPUT_GET,'guid');
        $row = getAccountByKey($key);
        if($row != '')
        {
            if($row->accountActive == 1)
            {

                header('location:/inscription/register');
            }
            else
            {
                // on active son compte
                if(activeAccount($row->NAME) != 0) // Si on a bien réussit à l'activé
                {
                    $_SESSION['active_account'] = 1;
                    header('location:/inscription/confirmaccount');
                }
                else // si il y a eu un problème pour l'activé dans la base
                {
                    $_SESSION['error_account'] = 1;
                    header('location:/inscription/confirmaccount');
                }

            }


        }
        else { // dans le cas ou la clé n'a pas était trouver dans le serveur (ou n'importe quoi a était passé en argument)


            header('location:/inscription/register');

        }

    }

    public function cu()
    {
        session_start();
        $this->start_page('Conditions d\'utilisation');
        require ROOT . '/views/inscription/cuView.php';
        $this->end_page();

    }

}