<?php

require ROOT . '/model/userRequest.php';

class Premium extends Controller {


    public function my_request()
    {
        session_start();
        if( !isset($_SESSION['user']) || !$_SESSION['isPrenium'])
        {
            header('location:/');
            exit();
        }
        $all_request = getAllRequestPremium($_SESSION['name']);

        $this->start_page("Mes demandes");
        require ROOT . '/views/premium/my_requestView.php';
        $this->end_page();




    }





}
