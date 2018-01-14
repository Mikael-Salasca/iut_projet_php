<?php
/**
 * Created by PhpStorm.
 * User: s16005532
 * Date: 09/01/18
 * Time: 16:13
 */

require ROOT . '/core/controller.php';

Class Home extends Controller {

    function index()
    {
        session_start();
        $this->start_page('Page d\'Accueil');
        $this->checkFirstCo();
        $this->checkDisconnect();
        require ROOT . '/views/homeView.php';
        $this->end_page();

    }
    function checkFirstCo(){
        if(isset($_SESSION['first_co']))
        {
            echo '<script type="text/javascript">alert("Vous êtes désormais connecté !");</script>';
            unset($_SESSION['first_co']);
        }

    }
    function checkDisconnect(){

        if(isset($_SESSION['isDisconnect']))
        {
            echo '<script type="text/javascript">alert("Vous avez bien était déconnecté !");</script>';
            unset($_SESSION['isDisconnect']);
            session_destroy();
        }
    }

}