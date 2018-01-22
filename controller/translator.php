<?php

require ROOT . '/model/userRequest.php';
require ROOT .'/model/lang.php';

if(!class_exists('Translator')) {

    require ROOT . '/core/translate.php';
}



class Translator extends Controller
{

    public function control()
    {
        session_start();

        if(!isset($_SESSION['user']) || !$_SESSION['isTranslator'])
        {
            header('location:/');
            exit();
        }

        if (!isset($_SESSION['lang_translate'])) {
            $source = "FRENCH"; // par default
            $target = "ENGLISH";
        } else {
            $source = $_SESSION['lang_translate'][0];
            $target = $_SESSION['lang_translate'][1];

        }

        $allTuple = getExistingTranslation($source,$target);
        $all_langues = getAllLangs();





        $this->start_page('Controle des traductions');
        require ROOT . '/views/translator/translatorControlView.php';
        $this->end_page();




    }

    public function update_translation()
    {
        session_start();

        if(!isset($_SESSION['user']) || !$_SESSION['isTranslator'])
        {
            header('location:/');
            exit();
        }

        $checkList = filter_input(INPUT_POST,'checkbox',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
        $dataSource = filter_input(INPUT_POST,'textareaSource',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
        $dataDestination = filter_input(INPUT_POST,'textareaTarget',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);

        if(empty($checkList)) {
            $_SESSION['update_translation_msg'] = '<div class="error-co"> Aucunes traductions n\' a été mise à jour</div>';
            header('location:/translator/control');
        }

        foreach ($checkList as $value) {

            foreach ($dataSource[$value] as $lang => $trad) {
                $langSource = $lang;
                $dataS[] = $trad;

            }
            foreach ($dataDestination[$value] as $lang => $trad) {
                $langTarget = $lang;
                $dataT[] = $trad;

            }
            $id[] = $value;
        }

        for ($i = 0; $i < sizeof($id); $i++) {
            $tabNewData[] = new Translate($id[$i], $langSource, $langTarget, $dataS[$i], $dataT[$i]);

        }


        if (!updateExistingTranslation($tabNewData)) { // si une erreur est survenue lors de l'insertion

            $_SESSION['update_translation_msg'] = '<div class="error-co">Un problème est servenue lors de la mises à jour des traductions</div>';
            header('location:/translator/control');
            exit();

        }

        $_SESSION['update_translation_msg'] = '<div class="error-co">Les traductions ont étaient mises à jour</div>';
        header('location:/translator/control');


    }

    private function saveSourceTargetInput($source, $target)
    {

        $_SESSION['lang_translate'] = array($source, $target);


    }


    public function change_lang(){

        session_start();
        session_start();
        $langSource = filter_input(INPUT_POST,'lgSource');
        $langTarget = filter_input(INPUT_POST,'lgTarget');




        if(!empty($langSource) && !empty($langTarget))
        {

            $this->saveSourceTargetInput($langSource,$langTarget);

        }
        header('location:/translator/control');


    }




}

