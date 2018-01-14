<?php

require ROOT . '/core/controller.php';
require ROOT . '/model/translation.php';



class Translation extends Controller {

    function translate() {
        session_start();
        $this->start_page('Page de traduction');
        require ROOT . '/views/translate/translateView.php';
        $this->end_page();
    }

    function displayTranslation() {

        $translateType = ($_POST["fr"] =='on') ? 'fr' : 'en';
        echo $translateType;
        $wordToTranslate =  $_POST['word-to-translate'];
        echo $wordToTranslate;
        if ($translateType=='fr') {
            $translation = findFrenchTranslation($wordToTranslate);

        }
        else {
            $translation = findEnglishTranslation($wordToTranslate);
        }

        echo 'traduction : ' . $translation ."\r\n";

        /*$this->start_page('Page de connexion');
        require ROOT . '/views/translate/translateView.php';
        $this->end_page();*/


    }


}