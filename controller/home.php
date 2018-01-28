<?php
/**
 * Created by PhpStorm.
 * User: s16005532
 * Date: 09/01/18
 * Time: 16:13
 */

require ROOT . '/model/lang.php';

Class Home extends Controller {

    public function index()
    {
        session_start();

        $this->start_page(translate('Page d\'accueil'));
        $this->checkFirstCo();
        $this->checkDisconnect();
        $_SESSION['langs'] = getAllLangs();
        $pctperlang = array();
        foreach ($_SESSION['langs'] AS $lang)
            $pctperlang[$lang] = getPercentageTranslated($lang);
        $_SESSION['langs'] = $pctperlang;
        require ROOT . '/views/homeView.php';
        $this->end_page();

    }
    private function checkFirstCo(){
        if(isset($_SESSION['first_co']))
        {
            echo '<script type="text/javascript">alert(\'' . translate("Vous êtes désormais connecté !").'\')</script>';
            unset($_SESSION['first_co']);
        }

    }
    private function checkDisconnect(){

        if(isset($_SESSION['isDisconnect']))
        {
            echo '<script type="text/javascript">alert('. translate("Vous avez bien était déconnecté !"). ')</script>';
            unset($_SESSION['isDisconnect']);
            session_destroy();
        }
    }

    public function disconnect()
    {
        session_start();
        $lang = $_SESSION['lang'];
        if (isset($_SESSION['user'])) {
            session_destroy();
            session_start();
            $_SESSION['lang'] = $lang;
            header('location:/');

        }
        header('Location: /');


    }

    public function fr(){

        session_start();
        $_SESSION['lang'] = 'FRENCH';
        if($_SESSION['last_page'] != '/home/fr' || $_SESSION['last_page'] != '/home/en')
        {

            header('location:'.$_SESSION['last_page']);
            exit();
        }
        header('location:/');

    }


    public function en(){

        session_start();
        $_SESSION['lang'] = 'ENGLISH';
        if($_SESSION['last_page'] != '/home/fr' || $_SESSION['last_page'] != '/home/en')
        {

            header('location:'.$_SESSION['last_page']);
            exit();
        }
        header('location:/');

    }

}