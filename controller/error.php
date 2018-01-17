<?php


//commentaire
class PageErrors extends Controller {

    public function pagenotfound()
    {

        $this->start_page('Page d\'Erreur');
        require ROOT . '/views/errorGestion/pagenotfoundView.php';
        $this->end_page();

    }

    public function technical(){

        $this->start_page('Page d\'Erreur');
        require ROOT . '/views/errorGestion/technicalError.php';
        $this->end_page();
    }

}