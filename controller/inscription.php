<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 15:52
 */

require(ROOT . '/model/registration.php');

require ROOT . '/core/controller.php';

class Inscription extends  Controller
{

    function validate()
    {
        session_start();
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'mail');
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST,'password2');
        $cuAccept = filter_input(INPUT_POST,'cu');

        if (empty($name) || empty($email) || empty($password) || empty($password2)) {
            $_SESSION['error_register'] = '<div class="error-register">Vous devez remplir tout les champs.</div>';
            header('location:/inscription/register');
        }
        else if(checkAccountExist($name))
        {
            $_SESSION['error_account_exist'] = '<div class="error-register">Le compte \'' .$name .'\' existe déja !</div>';
            header('location:/inscription/register');
        }
        else if ($password != $password2)
        {
            $_SESSION['error_register'] = '<div class="error-register">Vos mots de passe doivent être identique</div>';
            header('location:/inscription/register');

        }
        else if($cuAccept != true)
        {
            $_SESSION['error_register'] = '<div class="error-register">Veuillez lire et accepter les conditions d\'utilisation</div>';
            header('location:/inscription/register');
        }
        else
            {

                $affectedLines = saveRegistration($name, $email, $password);

                if ($affectedLines === false)
                {
                    $_SESSION['error_register'] = '<p class="error_register">Une erreur s\'est produite lors de l\'inscription, veuillez reassayer.<br>Si le problème persiste, contactez le service client</p>';
                    header('Location: /inscription/register');

                }
                else{
                    header('Location:/inscription/confirme');
                }
            }

    }


    function register()
    {

        session_start();
        $this->start_page('Page d\'Inscription');
        require ROOT . '/views/inscriptionView.php';
        $this->end_page();


    }

    function confirme()
    {
        $this->start_page('Inscription terminé.');
        require ROOT . '/views/inscriptionFinish.php';
        $this->end_page();
    }




}