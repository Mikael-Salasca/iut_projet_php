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

        if(!isset($_SESSION['type_translation']))
        {
            $_SESSION['type_translation'] = 'exist'; //page par default
        }

        if($_SESSION['type_translation'] == 'exist')
            $allTuple = getExistingTranslation($source,$target);
        else
            $allTuple = getRequestTranslation($source,$target);


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

        $_SESSION['update_translation_msg'] = '<div class="insert-success">Les traductions ont étaient mises à jour</div>';
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

    public function change_control()
    {

        session_start();

        if(!isset($_SESSION['user']) || !$_SESSION['isTranslator'] || !isset($_SESSION['type_translation']))
        {
            header('location:/translator/control');
            exit();
        }

        if($_SESSION['type_translation'] == 'exist')
            $_SESSION['type_translation'] = 'request';
        else
            $_SESSION['type_translation'] = 'exist';

        header('location:/translator/control');

    }


    public function update_request()
    {

        session_start();

        if(!isset($_SESSION['user']) || !$_SESSION['isTranslator'] || !isset($_SESSION['type_translation']))
        {
            header('location:/translator/control');
            exit();
        }

        $button_Ok = filter_input(INPUT_POST,'buttonvalid',FILTER_DEFAULT);


        if(empty($button_Ok))
        {
            header('location:/translator/control');
            exit();
        }
        $checkOptions = filter_input(INPUT_POST,'optionsSelect',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
        $dataSource = filter_input(INPUT_POST,'textareaSource',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
        $dataDestination = filter_input(INPUT_POST,'textareaTarget',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);


        if(empty($checkOptions)) {
            $_SESSION['request_translation_msg'] = '<div class="error-co"> Aucunes modifications n\'a été appliqué</div>';
            header('location:/translator/control');
            exit();
        }

        $modifications = 0; //si il y a eu des modifications, s'incrémentera
        foreach ($checkOptions as $key => $value)
        {
            foreach ($dataSource[$key] as $lang=> $trad)
            {
                $langSource = $lang;
                $dataS = $trad;
                $status = $value;
                $id = $key;
            }
            foreach ($dataDestination[$key] as $lang=> $trad)
            {
                $langTarget = $lang;
                $dataT = $trad;

            }


            switch ($status)
            {
                case "accept":
                    $tabNewData[] = new Translate('',$langSource, $langTarget, $dataS, $dataT); // tableau avec tout les nouveaux tuples à insérer(n'ont pas d'id)
                    $tabUpdateRequest[] = new Request($id,$langSource,$langTarget,$dataS,'VALID'); // on passe le parametre valide pr la mise a jour
                    $modifications++;
                    break;
                case "wait":
                    //on ne fait rien
                    break;
                case "reject":
                    $tabNewData[] = new Translate('none',$langSource, $langTarget, $dataS, $dataT); // tableau avec tout les nouveaux tuples à insérer(n'ont pas d'id)
                    $tabUpdateRequest[] = new Request($id,$langSource,$langTarget,$dataS,'REJECT'); // on passe le parametre valide pr la mise a jour
                    $modifications++;
                    break;


            }

        }

        //a présent on s'occupe d'insérer et mettre a jour tout ces tuples (en faisant l'insertion et la mise a jour en même temps pr chaque tuple pour réduire les erreurs techniques trop importantes)

        if(!$modifications) // si il n'y a pas eu de modifications
        {
            $_SESSION['request_translation_msg'] = '<div class="error-co"> Aucunes modifications n\'a été appliqué</div>';
            header('location:/translator/control');
            exit();
        }



        $error = 0;
            for($i = 0; $i < sizeof($tabUpdateRequest); $i++)
            {

                if(!updateRequestAccept($tabUpdateRequest[$i])){ // en cas d'erreur lors de la mise a jour des request
                    $error = 1; // on signale l'erreur et on stoppe tout (pr ne pas insérer )
                    break;
                }
                //si la mise a jour s'est bien effectué, on tente d'insérer la nouvelle traduction ou on ne fait rien si c'était un statut reject

                if($tabNewData[$i]->getId() != "none") {


                    if (!insertNewTranslation($tabNewData[$i])) // en cas d'erreur lors d'une insertion, on stoppe tout
                    {
                        $error = 1; // on signale une erreur
                        break;// on sort du for
                    }
                }

            }

            if($error)
            {
                $_SESSION['request_translation_msg'] =' <div class="error-co">Une erreur technique s\'est produite (peut être êtes vous plusieurs a travailler sur la traduction)</div>';
                header('location:/translator/control');
                exit();
            }

            // si on arrive ici tout s'est bien passé

            $_SESSION['request_translation_msg'] = '<div class="insert-success">Votre action a bien été appliqué</div>';

            header('location:/translator/control');




    }


}

