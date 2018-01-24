<?php
require ROOT .'/model/lang.php';
require ROOT .'/model/userRequest.php';



class Translation extends Controller
{

    function translate()
    {
        session_start();

        if (!isset($_SESSION['lang_Input'])) {
            $_SESSION['lang_Input'][0] = "FRENCH"; // par default
            $_SESSION['lang_Input'][1] = "ENGLISH";
        }
            $source = $_SESSION['lang_Input'][0];
            $target = $_SESSION['lang_Input'][1];




        $all_language = getAllLangs(); // les colonnes sont en anglais

        $this->updateRestriction();


        $this->start_page('Page de traduction');
        require ROOT . '/views/translate/translateView.php';
        $this->end_page();


    }

    public function displayTranslation()
    {

        session_start();

        $switch = filter_input(INPUT_POST,'switch');
        $targetLangage = filter_input(INPUT_POST, 'langDest');
        $sourceLangage = filter_input(INPUT_POST, 'langSrc');
        $wordToTranslate = filter_input(INPUT_POST, 'word-to-translate');
        if(!empty($switch))
        {
            $this->switch($sourceLangage,$targetLangage);
            $sourceLangage = $_SESSION['lang_Input'][0];
            $targetLangage = $_SESSION['lang_Input'][1];
        }


        $this->saveSourceTargetInput($sourceLangage, $targetLangage);

        if (!isset($_SESSION['user']) || isset($_SESSION['isActive']) && !$_SESSION['isActive']) { //non connecté ou compte pas activé

            $this->updateRestriction();

            if ($this->isRestriction()) {

                header('location:/translation/translate');
                exit();
            }

        }

        unset($_SESSION['haveToWait']);
        unset($_SESSION['min_to_wait']);
        // pas besoin d'attendre

        $translation = userTranslation($sourceLangage, $targetLangage, $wordToTranslate);
        $translation = mb_strtolower($translation); // met tout en minuscule
        if (!empty($translation)) {
            $_SESSION['translation'] = array($wordToTranslate, $translation);
            unset($_SESSION['translation_not_found']);
        } else {

            if (checkIfWaiting($wordToTranslate, $sourceLangage, $targetLangage)) // si le mot est déja en attente de traduction
            {
                $_SESSION['dataIsWaiting'] = $wordToTranslate;
            } else {
                $_SESSION['translation_not_found'] = array($wordToTranslate, $sourceLangage, $targetLangage);
            }
        }
            if(!isset($_SESSION['user']))
            {
                $_SESSION['haveToWait'] = true;
                $_SESSION['last_translation'] = new DateTime("NOW");
            }




        header('location:/translation/translate');
        exit();


    }// fin de la fonction

    private function saveSourceTargetInput($source, $target)
    {

        $_SESSION['lang_Input'] = array($source, $target);


    }

    private function array_middle_shift(&$array, $key)
    {

        $length = (($key + 1) - count($array) == 0) ? 1 : ($key + 1) - count($array);
        return array_splice($array, $key, $length);

    }

    private function translateLanguageNameToFrench($tabLang)
    {
        $tab = array();
        foreach ($tabLang as $lang) {
            $l = translateLanguageNameToFrench($lang);
            if ($l != '')
                $tab[] = $l;
            else
                $tab[] = $lang;
        }
        return $tab;


    }

    private function isRestriction()
    {
        if(isset($_SESSION['haveToWait'])) {

            if ($_SESSION['min_to_wait'] <= 0) {

                return false;

            }
            else
                return true;

        }
        return false;
    }


    private function updateRestriction()
    {

        if (isset($_SESSION['haveToWait'])) {

            $now = new DateTime("NOW");
            $last_translation = $_SESSION['last_translation'];
            $since_last_translation = $last_translation->diff($now);

            if (!($since_last_translation->i >= 10)) {
                $_SESSION['min_to_wait'] = 10 - $since_last_translation->i;

            }
            else{
                unset($_SESSION['min_to_wait']);
                unset($_SESSION['haveToWait']);
            }

        }


    }


    public function request(){

        session_start();

        if(!isset($_SESSION['translation_not_found']) || !isset($_SESSION['user']) || !$_SESSION['isPrenium'])
        {
            header('location:/translation/translate');
            exit();
        }
        $word = $_SESSION['translation_not_found'][0];
        $source = $_SESSION['translation_not_found'][1];
        $destination = $_SESSION['translation_not_found'][2];
        if(insertNewWord($word,$source,$destination,$_SESSION['name'])) // si l'insertion s'est bien passé
        {
            $_SESSION['insert_ok'] = $word;
            unset($_SESSION['translation_not_found']);
        }
        else
        {
            $_SESSION['error_insert'] = 1;
        }

        header('location:/translation/translate');






    }

    private function switch($source,$target){

        session_start();

        if(isset($_SESSION['lang_Input'])) {

            $_SESSION['lang_Input'][0] = $target;
            $_SESSION['lang_Input'][1] = $source;
        }
    }

}

