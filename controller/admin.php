<?php

require ROOT . '/core/User.php';
require ROOT . '/model/userinfo.php';

class Admin extends Controller {

    function control() {
        var_dump($_SESSION['user']);
        if (isset($_SESSION['user']) && $_SESSION['type'] != 'ADMIN') {
            $_SESSION['access_denied'] = 'Vous n\'avez pas le droit d\'accéder à cette page.';
            header('Location:/');
        }
        session_start();
        $this->start_page('Panneau de contrôle');
        if (!$_SESSION['user_infos'] = getAllUsersInfo()) {
            $_SESSION['no_user_found'] = 'Il n\'y a aucun utilisateur enregistré sur le site, mdr t tou seul';
        }
        header('Location:/views/admin/panel.php');
        $this->end_page();
    }
}
?>