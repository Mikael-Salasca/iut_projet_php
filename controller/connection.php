<?php

require ROOT . '/core/controller.php';
require ROOT . '/model/base.php';
session_start();

class Connection extends Controller {

    function connect() {
        $this->start_page('Page de connexion');
        if($_SESSION['login'] == 'ko')
            echo 'Identifiants incorrects.';
        unset($_SESSION['login']);
        require ROOT . '/views/connectionView.php';
        $this->end_page();
    }

    function validate() {

        $usersDataBase = new UsersDataBase();
        $dbConnection = $usersDataBase->dbConnect();

        $name = $_POST['name'];
        $passwd = $_POST['mdp'];
        $connectCheckQuery = "SELECT * FROM user WHERE NAME = '$name' AND PASSWORD = md5('$passwd')";
        $queryResult = mysqli_query($dbConnection, $connectCheckQuery);
        if (mysqli_num_rows($queryResult) != 0) {
            $dbRow = mysqli_fetch_assoc($queryResult);
            $_SESSION['name'] = $dbRow['NAME'];
            $_SESSION['passwd'] = md5($dbRow['PASSWORD']);

            $_SESSION['login'] = 'ok';
            header("Location: /home/index");
        }
        else {
            $_SESSION['login'] = 'ko';
            header("Location: /connection/connect");
        }
    }


}