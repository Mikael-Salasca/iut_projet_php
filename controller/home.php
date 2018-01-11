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
        $this->start_page('Page d\'Accueil');
        if ($_SESSION['login'] == 'ok')
            echo  'Vous êtes connecté !';
        $_SESSION['login'] = 'connecté';
        require ROOT . '/views/homeView.php';
        $this->end_page();

    }

}
