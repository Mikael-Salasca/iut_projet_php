<?php


require ROOT . '/model/translation.php';



class Translation extends Controller {

    function translate() {
        session_start();
        $this->start_page('Page de traduction');
        require ROOT . '/views/translate/translateView.php';
        $this->end_page();
    }

    function displayTranslation() {

        $targetLangage = filter_input(INPUT_POST, 'langDest');
        $sourceLangage = filter_input(INPUT_POST, 'langSrc');
        $wordToTranslate =  filter_input(INPUT_POST, 'word-to-translate');

        echo $sourceLangage;
        echo $targetLangage;
        echo $wordToTranslate;

        $translation = userTranslation($sourceLangage, $targetLangage,$wordToTranslate);

        echo 'traduction : ' . $translation ."\r\n";

        $this->start_page('Page de connexion');
        require ROOT . '/views/translate/translateView.php';
        $this->end_page();


    }


}