<?php



if(!class_exists('PageErrors')) {

    Class PageErrors extends Controller
    {

        public function pagenotfound()
        {
            session_start();
            $this->start_page(translate('Page d\'Erreur'));
            require ROOT . '/views/errorGestion/pagenotfoundView.php';
            $this->end_page();

        }

        public function technical()
        {
            session_start();
            $this->start_page(translate('Page d\'Erreur'));
            require ROOT . '/views/errorGestion/technicalError.php';
            $this->end_page();
        }

    }

}