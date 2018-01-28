<?php



Class Pagenotfound extends Controller {

    function displayError()
    {
        session_start();
        $_SESSION['last_page'] = $_SESSION['param'];
        $this->start_page(translate('Page d\'Erreur'));
        require ROOT . '/views/errorGestion/pagenotfoundView.php';
        $this->end_page();

    }

}