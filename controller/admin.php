 <?php

require ROOT . '/core/User.php';
require ROOT . '/model/userinfo.php';
require ROOT . '/model/lang.php';

class Admin extends Controller {

    function control() {
        session_start();
        //Si l'on est pas connecté en tant qu'admin, on ne peut pas accéder à la page
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = translate('Vous n\'avez pas le droit d\'accéder à cette page.');
                header('Location:/');
            }

            $this->start_page(translate('Panneau de contrôle'));
            //On récupère les infos sur les utilisateurs (nom et rang)
            $_SESSION['user_infos'] = getAllUsersInfo();
            //On conserve en mémoire les différents types d'utilisateur
            $_SESSION['user_types'] = array('ADMIN', 'TRANSLATOR', 'PREMIUM', 'ORDINARY');
            if (empty($_SESSION['user_infos'])) {
                $_SESSION['no_user_found'] = translate('Il n\'y a aucun utilisateur enregistré sur le site, mdr t tou seul');
            }
            require ROOT . '/views/admin/panel.php';
            $this->end_page();
        }
        else header('Location:/');
    }

    //Fonction pour update les changements de rang pour les utilisateurs choisis
    function changerank() {
        session_start();
        //Si l'on est pas connecté en tant qu'admin, on ne peut pas accéder à la page
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = translate('Vous n\'avez pas le droit d\'accéder à cette page.');
                header('Location:/');
                exit();
            }
            $users = $_SESSION['user_infos'];
            foreach ($users as $row) {
                //On update tous les changements de rang effectués par l'admin
                $row = get_object_vars($row);
                updateRanks($row['NAME'], $_POST[$row['NAME']]);
                    $_SESSION['rank_changes'] = '<div class="error-co">' . translate('Changements de rangs effectués') . '</div>';

            }
            header('Location:/admin/control');
            exit();
        }

        header('Location:/');


    }


    //Ajouter une langue sur le site au même titre que les autres
    function addlang() {
        session_start();
        //Si l'on est pas connecté en tant qu'admin, on ne peut pas accéder à la page
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = translate('Vous n\'avez pas le droit d\'accéder à cette page.');
                header('Location:/');
                exit();
            }
            //On récupère la langue souhaitée
            $newlang = filter_input(INPUT_POST, 'new_lang');
            $newlangconfirm = filter_input(INPUT_POST, 'new_lang_confirm');
            if ($newlang != $newlangconfirm) {
                $_SESSION['error_confirm'] = translate('Les deux saisies ne correspondent pas');
                header('Location:/admin/control');
            }
            //On fait des vérifications sur la langue choisie
            if (preg_match('/^[A-Z]{3,24}$/', $newlang)) {
                if (!langAlreadyExists($newlang)) {
                    if (addLanguage($newlang))
                    {
                        addLanguageInEnglish($newlang);
                        $_SESSION['lang_add'] = translate('Langue ajoutée avec succès');

                    }

                    else {
                        $_SESSION['lang_add'] = translate('Une erreur est survenue, veuillez réessayer ou contacter le support en cas d\'échecs répétés');
                    }
                }
                else
                    $_SESSION['lang_already_exists'] = translate('La langue choisie existe déjà');

            }
            else
                $_SESSION['wrong_pattern'] = translate("La saisie est invalide");
            header('Location:/admin/control');
        }

        header('location:/admin/control');
    }
}
?>


