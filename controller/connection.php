<?php

    require ROOT . '/core/controller.php';
    require ROOT . '/model/base.php';
    session_start();

    class Connection extends Controller {

        function connect() {
            require ROOT . '/views/connectionView.php';
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
                echo 'Réussi';
                //header(accueil.php?step=LOGIN);
                exit;
            }
            echo 'Zut';
            //header(accueil.php?step=ERROR);
        }


    }