<?php

require ROOT . '/core/controller.php';
require ROOT . '/model/base.php';


class Connection extends Controller {

    function connect() {
        session_start();
        $this->start_page('Page de connexion');
        require ROOT . '/views/connectionView.php';
        $this->end_page();
    }

    function validate() {
        session_start();

        $usersDataBase = new UsersDataBase();
        $dbConnection = $usersDataBase->dbConnect();

        $name = filter_input(INPUT_POST,name);
        $passwd = filter_input(INPUT_POST,mdp);
        $connectCheckQuery = "SELECT * FROM user WHERE NAME = '$name' AND PASSWORD = md5('$passwd')";
        $queryResult = mysqli_query($dbConnection, $connectCheckQuery);
        if (mysqli_num_rows($queryResult) != 0) {
            $dbRow = mysqli_fetch_assoc($queryResult);
            $_SESSION['name'] = $dbRow['NAME'];
            $_SESSION['login'] = 'ok';
            $_SESSION['first_co'] = 1;
            header("Location: /");
        }
        else {
            $_SESSION['error_connexion'] = '<p>Le nom d’utilisateur ou le mot de passe est incorrect.<br>Veuillez essayer à nouveau.<p>';
            header("Location: /connection/connect");
        }
    }

    function disconnect()
    {
        session_start();
        if(isset($_SESSION['login']))
        {
            unset($_SESSION['login']);
            unset($_SESSION['name']);
            $_SESSION['isDisconnect'] = 1;
            header('Location: /');
        }

    }

}