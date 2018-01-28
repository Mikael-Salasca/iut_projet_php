<?php

require ROOT . '/model/userRequest.php';
require ROOT . '/model/lang.php';

include ROOT . '/vendor/gettext/gettext/src/autoloader.php';
if (!class_exists('Translator')) {

    require ROOT . '/core/translate.php';
}


class Translator extends Controller
{

    public function control()
    {
        session_start();

        if (!isset($_SESSION['user']) || !$_SESSION['isTranslator']) {
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

        if (!isset($_SESSION['type_translation'])) {
            $_SESSION['type_translation'] = 'exist'; //page par default
        }

        $all_langues = getAllLangs();
        if (!isset($_SESSION['limite_page']))
            $_SESSION['limite_page'] = 10; // par default on affiche de 10 en 10


        if (!isset($_SESSION['page_actuelle_exist'])) {
            $_SESSION['page_actuelle_exist'] = 1; // page par default
        }
        if (!isset($_SESSION['page_actuelle_request'])) {
            $_SESSION['page_actuelle_request'] = 1;
        }

        if ($_SESSION['type_translation'] == 'exist') {

            $_SESSION['nb_page_exist'] = $this->calculNumbersOfPageExist();
            $allTuple = getExistingTranslation($source, $target, ($_SESSION['page_actuelle_exist'] - 1) * $_SESSION['limite_page'], $_SESSION['limite_page']);
        } else {
            $allTuple = getRequestTranslation($source, $target, ($_SESSION['page_actuelle_request'] - 1) * $_SESSION['limite_page'], $_SESSION['limite_page']);
            $_SESSION['nb_page_request'] = $this->calculNumbersOfPageRequest($source, $target);
        }


        if ($_SESSION['type_translation'] == "exist") {
            $page_precedente = $_SESSION['page_actuelle_exist'] - 1;
            $page_suivante = $_SESSION['page_actuelle_exist'] + 1;
        } else if ($_SESSION['type_translation'] == 'request') {
            $page_precedente = $_SESSION['page_actuelle_request'] - 1;
            $page_suivante = $_SESSION['page_actuelle_request'] + 1;
        }

        $this->start_page(translate('Controle des traductions'));
        require ROOT . '/views/translator/translatorControlView.php';
        $this->end_page();


    }

    public function update_translation()
    {
        session_start();

        if (!isset($_SESSION['user']) || !$_SESSION['isTranslator']) {
            header('location:/');
            exit();
        }

        $checkList = filter_input(INPUT_POST, 'checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $dataSource = filter_input(INPUT_POST, 'textareaSource', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $dataDestination = filter_input(INPUT_POST, 'textareaTarget', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if (empty($checkList)) {
            $_SESSION['update_translation_msg'] = '<div class="error-co">' . translate('Aucune traduction n\' a été mise à jour').'</div>';
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

            $_SESSION['update_translation_msg'] = '<div class="error-co">'. translate('Un problème est servenu lors de la mise à jour des traductions').'</div>';
            header('location:/translator/control');
            exit();
        }

        $_SESSION['update_translation_msg'] = '<div class="insert-success">'.translate('Les traductions ont été mises à jour').'</div>';
        header('location:/translator/control');
    }

    private function saveSourceTargetInput($source, $target)
    {
        $_SESSION['lang_translate'] = array($source, $target);
    }

    public function change_lang()
    {
        session_start();
        $langSource = filter_input(INPUT_POST, 'lgSource');
        $langTarget = filter_input(INPUT_POST, 'lgTarget');

        if (!empty($langSource) && !empty($langTarget)) {

            $this->saveSourceTargetInput($langSource, $langTarget);

        }
        header('location:/translator/control');
    }

    public function change_control()
    {
        session_start();

        if (!isset($_SESSION['user']) || !$_SESSION['isTranslator'] || !isset($_SESSION['type_translation'])) {
            header('location:/translator/control');
            exit();
        }

        if ($_SESSION['type_translation'] == 'exist')
            $_SESSION['type_translation'] = 'request';
        else
            $_SESSION['type_translation'] = 'exist';

        header('location:/translator/control');
    }


    public function update_request()
    {

        session_start();

        if (!isset($_SESSION['user']) || !$_SESSION['isTranslator'] || !isset($_SESSION['type_translation'])) {
            header('location:/translator/control');
            exit();
        }

        $button_Ok = filter_input(INPUT_POST, 'buttonvalid', FILTER_DEFAULT);

        if (empty($button_Ok)) {
            header('location:/translator/control');
            exit();
        }
        $checkOptions = filter_input(INPUT_POST, 'optionsSelect', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $dataSource = filter_input(INPUT_POST, 'textareaSource', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $dataDestination = filter_input(INPUT_POST, 'textareaTarget', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        if (empty($checkOptions)) {
            $_SESSION['request_translation_msg'] = '<div class="error-co">'.translate('Aucune modification n\'a été appliquée').'</div>';
            header('location:/translator/control');
            exit();
        }

        $modifications = 0; //si il y a eu des modifications, s'incrémentera
        foreach ($checkOptions as $key => $value) {
            foreach ($dataSource[$key] as $lang => $trad) {
                $langSource = $lang;
                $dataS = $trad;
                $status = $value;
                $id = $key;
            }
            foreach ($dataDestination[$key] as $lang => $trad) {
                $langTarget = $lang;
                $dataT = $trad;

            }


            switch ($status) {
                case "accept":
                    $tabNewData[] = new Translate('', $langSource, $langTarget, $dataS, $dataT); // tableau avec tout les nouveaux tuples à insérer(n'ont pas d'id)
                    $tabUpdateRequest[] = new Request($id, $langSource, $langTarget, $dataS, 'VALID'); // on passe le parametre valide pr la mise a jour
                    $modifications++;
                    break;
                case "wait":
                    //on ne fait rien
                    break;
                case "reject":
                    $tabNewData[] = new Translate('none', $langSource, $langTarget, $dataS, $dataT); // tableau avec tout les nouveaux tuples à insérer(n'ont pas d'id)
                    $tabUpdateRequest[] = new Request($id, $langSource, $langTarget, $dataS, 'REJECT'); // on passe le parametre valide pr la mise a jour
                    $modifications++;
                    break;
            }
        }

        //a présent on s'occupe d'insérer et mettre a jour tout ces tuples (en faisant l'insertion et la mise a jour en même temps pr chaque tuple pour réduire les erreurs techniques trop importantes)

        if (!$modifications) // si il n'y a pas eu de modifications
        {
            $_SESSION['request_translation_msg'] = '<div class="error-co">' .translate('Aucune modification n\'a été appliquée') .'</div>';
            header('location:/translator/control');
            exit();
        }


        $error = 0;
        for ($i = 0; $i < sizeof($tabUpdateRequest); $i++) {

            if (!updateRequestAccept($tabUpdateRequest[$i])) { // en cas d'erreur lors de la mise a jour des request
                $error = 1; // on signale l'erreur et on stoppe tout (pr ne pas insérer )
                break;
            }
            //si la mise a jour s'est bien effectué, on tente d'insérer la nouvelle traduction ou on ne fait rien si c'était un statut reject

            if ($tabNewData[$i]->getId() != "none") {


                if (!insertNewTranslation($tabNewData[$i])) // en cas d'erreur lors d'une insertion, on stoppe tout
                {
                    $error = 1; // on signale une erreur
                    break;// on sort du for
                }
            }

        }

        if ($error) {
            $_SESSION['request_translation_msg'] = ' <div class="error-co">' .translate('Une erreur technique s\'est produite (peut être vous êtes plusieurs à travailler sur la traduction)') .'</div>';
            header('location:/translator/control');
            exit();
        }

        // si on arrive ici tout s'est bien passé

        $_SESSION['request_translation_msg'] = '<div class="insert-success">' .translate('Votre action a bien été appliquée').'</div>';

        header('location:/translator/control');
    }


    public function operation_exist()
    {
        session_start();
        $value = filter_input(INPUT_GET, 'page');
        if (empty($value) || $value == 0 || $value > $_SESSION['nb_page_exist']) {
            header('location:/translator/control');
            exit();
        }


        $_SESSION['page_actuelle_exist'] = $value;
        header('location:/translator/control');
    }

    public function operation_request()
    {

        session_start();
        $value = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        if (empty($value) || $value == 0 || $value > $_SESSION['nb_page_request']) {
            header('location:/translator/control');
            exit();
        }

        $_SESSION['page_actuelle_request'] = $value;
        header('location:/translator/control');

    }

    private function calculNumbersOfPageExist()
    {
        $nb_tuple = getNumbersTranslation();

        $nb = ceil($nb_tuple / $_SESSION['limite_page']);

        return $nb;
    }

    private function calculNumbersOfPageRequest($source, $target)
    {

        $nb_tuple = getNumberRequest($source, $target);

        $nb = ceil($nb_tuple / $_SESSION['limite_page']);


        return $nb;

    }

    public function select_page()
    {
        session_start();

        $value = filter_input(INPUT_GET, 'select_page', FILTER_VALIDATE_INT);
        $_SESSION['limite_page'] = $value;
        $_SESSION['page_actuelle_request'] = 1;
        $_SESSION['page_actuelle_exist'] = 1;
        header('location:/translator/control');
    }

    public function export()
    {
        session_start();
        if (!isset($_SESSION['user']) || !$_SESSION['isTranslator']) {
            header('location:/');
            exit();
        }
        $all_langues = getAllLangs();
        $this->start_page(translate("Exporter des traductions"));
        require ROOT . '/views/translator/exportView.php';
        $this->end_page();

    }

    public function sub_export()
    {

        session_start();
        if (!isset($_SESSION['user']) || !$_SESSION['isTranslator']) {
            header('location:/');
            exit();
        }
        $langSource = filter_input(INPUT_POST, 'lgSource');
        $langTarget = filter_input(INPUT_POST, 'lgTarget');

       if(empty($langSource) || empty($langTarget))
       {
           header('location:/translator/export');
           exit();
       }


            if(!$allTuple = getAllExistTranslation($langSource,$langTarget))
            {
                header('location:/translator/export');
                exit();
            }
        $translationsSource = new Gettext\Translations();
            foreach ($allTuple as $objet) {

                $translationTarget = new Gettext\Translation(null, $objet->getDataSource());
                $translationTarget->setTranslation($objet->getDataDestination());
                $translationsSource[] = $translationTarget;
            }


        Gettext\Generators\Po::toFile($translationsSource, './export/export.po');
            $name = '';
            $name .= $langSource . '_' . $langTarget;
        // recuperer le fichier
        header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
        header('Content-Disposition: attachment; filename="export' . $name . '.po"');
        readfile('./export/export.po');
    }
}

