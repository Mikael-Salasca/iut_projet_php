<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 15:52
 */

require(ROOT . '/model/saveRegistration.php');

require ROOT . '/core/controller.php';

class Inscription extends  Controller
{

    function validate()
    {
        session_start();
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'mail');
        $password = filter_input(INPUT_POST, 'password');

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error_register'] = '<p>Vous devez remplir tout les champs.</p>';
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