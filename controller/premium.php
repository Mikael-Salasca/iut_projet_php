<?php

require ROOT . '/model/userRequest.php';

class Premium extends Controller {


    public function my_request()
    {
        session_start();
        if( !isset($_SESSION['user']) || !isset($_SESSION['isPrenium']))
        {
            header('location:/');
            exit();
        }
        if(!isset($_SESSION['limite_page']))
        {
            $_SESSION['limite_page'] = 10;
        }

        if (!isset($_SESSION['page_actuelle_premium'])) {
            $_SESSION['page_actuelle_premium'] = 1; // page par default
        }

        $_SESSION['nb_page_premium'] = $this->calculNumbersOfPagePremium($_SESSION['name']);

        $all_request = getAllRequestPremium($_SESSION['name'],($_SESSION['page_actuelle_premium'] -1) * $_SESSION['limite_page'],$_SESSION['limite_page']);

        $page_precedente = $_SESSION['page_actuelle_premium'] - 1;
        $page_suivante = $_SESSION['page_actuelle_premium'] + 1;

        $this->start_page(translate("Mes demandes"));
        require ROOT . '/views/premium/my_requestView.php';
        $this->end_page();




    }

    public function select_page()
    {

        session_start();

        $value = filter_input(INPUT_GET,'select_page',FILTER_VALIDATE_INT)  ;
        $_SESSION['limite_page'] = $value;
        $_SESSION['page_actuelle_premium'] = 1;
        header('location:/premium/my_request');



    }

    private function calculNumbersOfPagePremium($name){

        $nb_tuple = getNumbersRequestPremium($name);
        $nb = ceil($nb_tuple / $_SESSION['limite_page']);

        return $nb;


}

    public function operation()
    {

        session_start();
        $value = filter_input(INPUT_GET, 'page');
        if (empty($value) || $value == 0 || $value > $_SESSION['nb_page_premium']) {
            header('location:/premium/my_request');
            exit();
        }


        $_SESSION['page_actuelle_premium'] = $value;
        header('location:/premium/my_request');




    }



}
