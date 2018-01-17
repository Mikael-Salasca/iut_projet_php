<?php

require 'base.php';
require ROOT . '/core/User.php';

function checkConnexionValid($email,$passwd)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();


    $connectCheckQuery = "SELECT * FROM user WHERE EMAIL = :email AND PASSWORD = md5(:password)";
    $stmt = $dbConnection->prepare($connectCheckQuery);
    $stmt->bindValue('email', $email, PDO::PARAM_STR);
    $stmt->bindValue('password', $passwd, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();

            $_SESSION['user'] = serialize(new User($result->NAME, $result->EMAIL, $result->PASSWORD, $result->TYPEACCOUNT));

            return true;
        }
        else
            return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $connectCheckQuery, PHP_EOL;
        exit();
    }
}



