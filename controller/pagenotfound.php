<?php

require ROOT . '/core/controller.php';

Class Pagenotfound extends Controller {

    function displayError()
    {

        $this->start_page('Page d\'Erreur');
        require ROOT . '/views/errorGestion/pagenotfoundView.php';
        $this->end_page();

    }

}