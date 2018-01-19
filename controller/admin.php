<?php

require ROOT . '/core/User.php';
require ROOT . '/model/userinfo.php';


class Admin extends Controller {

    function control() {
        session_start();
        if (isset($_SESSION['user'])) {
            if ($_SESSION['type'] != 'ADMIN') {
                $_SESSION['access_denied'] = 'Vous n\'avez pas le droit d\'accéder à cette page.';
                header('Location:/');
            }

            $this->start_page('Panneau de contrôle');
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
                    $_SESSION['rank_changes'] = 'Changements de rangs effectués';

            }
            header('Location:/admin/control');
            exit();
        }

        header('Location:/');


    }
}
?>