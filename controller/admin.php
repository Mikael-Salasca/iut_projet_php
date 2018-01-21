<?php

require ROOT . '/core/User.php';
require ROOT . '/model/userinfo.php';
require ROOT . '/model/lang.php';

class Admin extends Controller {

    function control() {
        session_start();
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = 'Vous n\'avez pas le droit d\'accéder à cette page.';
                header('Location:/');
            }

            $this->start_page('Panneau de contrôle');
            $_SESSION['langs'] = getAllLangs();
            $_SESSION['user_infos'] = getAllUsersInfo();
            $_SESSION['user_types'] = getAllAccountType();
            //var_dump($_SESSION['user_infos']);
            if (empty($_SESSION['user_infos'])) {
                $_SESSION['no_user_found'] = 'Il n\'y a aucun utilisateur enregistré sur le site, mdr t tou seul';
            }
            require ROOT . '/views/admin/panel.php';
            $this->end_page();
        }
        else header('Location:/');
    }

    function changerank() {
        session_start();
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = 'Vous n\'avez pas le droit d\'accéder à cette page.';
                header('Location:/');
                exit();
            }
            $users = $_SESSION['user_infos'];
            foreach ($users as $row) {
                $row = get_object_vars($row);
                updateRanks($row['NAME'], $_POST[$row['NAME']]);
                    $_SESSION['rank_changes'] = '<div class="error-co">Changements de rangs effectués</div>';

            }
            header('Location:/admin/control');
            exit();
        }

        header('Location:/');


    }

    function addlang() {
        session_start();
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = 'Vous n\'avez pas le droit d\'accéder à cette page.';
                header('Location:/');
                exit();
            }
            $newlang = filter_input(INPUT_POST, 'new_lang');
            $newlangconfirm = filter_input(INPUT_POST, 'new_lang_confirm');
            if ($newlang != $newlangconfirm) {
                $_SESSION['error_confirm'] = 'Les deux saisies ne correspondent pas.';
                header('Location:/admin/control');
            }
            if (preg_match('/^[A-Z]{3,24}$/', $newlang)) {
                if (!langAlreadyExists($newlang)) {
                    if (addLanguage($newlang))
                        $_SESSION['lang_add'] = 'Langue ajoutée avec succès !';
                    else
                        $_SESSION['lang_add'] = 'Une erreur est survenue, veuillez réessayer ou contacter le support en cas d\'échecs répétés.';
                }
                else
                    $_SESSION['lang_already_exists'] = 'La langue choisie existe déjà !';

            }
            else
                $_SESSION['wrong_pattern'] = "La saisie est invalide !";
            header('Location:/admin/control');
        }
    }
}
?>


