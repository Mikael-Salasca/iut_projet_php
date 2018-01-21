<?php

class Translation extends Controller
{

    function translate()
    {
        session_start();

            if(!isset($_SESSION['lang_Input']))
            {
                $source = "FRENCH"; // par default
                $target = "ENGLISH";
            }
            else{
                $source = $_SESSION['lang_Input'][0];
                $target = $_SESSION['lang_Input'][1];

            }


            $this->start_page('Page de traduction');
            require ROOT . '/views/translate/translateView.php';
            $this->end_page();



    }

    function displayTranslation()
    {

        session_start();
        if (!isset($_SESSION['user'])) { //non connecté


            if (isset($_SESSION['haveToWait'])) {
                $now = new DateTime("NOW");
                $last_translation = $_SESSION['last_translation'];


                $since_last_translation = $last_translation->diff($now);
                if (!($since_last_translation->i >= 10)) {

                    $_SESSION['min_to_wait'] = 10 - $since_last_translation->i;
                    header('location:/translation/translate');
                    exit();
                }
                unset($_SESSION['haveToWait']);
                unset($_SESSION['min_to_wait']);


            }
        }

        unset($_SESSION['haveToWait']);
        unset($_SESSION['min_to_wait']);
        // pas besoin d'attendre
        $targetLangage = filter_input(INPUT_POST, 'langDest');
        $sourceLangage = filter_input(INPUT_POST, 'langSrc');
        $wordToTranslate = filter_input(INPUT_POST, 'word-to-translate');
        $this->saveSourceTargetInput($sourceLangage,$targetLangage);

        $translation = userTranslation($sourceLangage, $targetLangage, $wordToTranslate);
        $translation = mb_strtolower($translation); // met tout en minuscule
        if (!empty($translation)) {
            $_SESSION['translation'] = array($wordToTranslate,$translation);
            $_SESSION['haveToWait'] = true;
            $_SESSION['last_translation'] = new DateTime("NOW");
        } else {
            $_SESSION['translation_not_found'] = $wordToTranslate;

        }


        header('location:/translation/translate');
        exit();


    }// fin de la fonction

     private function saveSourceTargetInput($source,$target){

        $_SESSION['lang_Input'] = array($source,$target);



}

}