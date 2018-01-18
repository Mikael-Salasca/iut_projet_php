<?php

require ROOT . '/model/base.php';

function checkCode($name, $code) {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'SELECT codeVerificationEmail FROM user WHERE NAME = :name';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);

    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            if ($result->codeVerificationEmail == $code)
                return true;
            return false;

        }
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
    return false;
}

function modifyemail($name, $email) {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'UPDATE user SET EMAIL = :email WHERE NAME = :name';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    $stmt->bindValue('email', $email, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $affectedLines = $stmt->rowCount();
        return $affectedLines;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function saveCodeVerification($code,$name){


    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET codeVerificationEmail=:code, dateVerificationCode=NOW()+INTERVAL 30 MINUTE WHERE NAME = :name";
    $update = $dbConnection->prepare($query);
    $update->bindValue('code', $code, PDO::PARAM_STR);
    $update->bindValue('name', $name, PDO::PARAM_STR);
    try {
        $update->execute();
        $affectedLines = $update->rowCount();
        return $affectedLines;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }



}

function checkEmailExist($email){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $registerCheckQuery = "SELECT * FROM user WHERE EMAIL = :email";
    $stmt = $dbConnection->prepare($registerCheckQuery);
    $stmt->bindValue('email', $email, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $affectedLines = $stmt->rowCount();
        if ($affectedLines != 0)
            return true;
        return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $registerCheckQuery, PHP_EOL;
        exit();
    }
}

function checkDateCode($code)
{
    //retourne vrai si la date d'expiration est après la date actuelle
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE codeVerificationEmail=:code AND dateVerificationCode > DATE_SUB(NOW(),INTERVAL 0 MINUTE )";
    $query2 = "SELECT NOW()";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('code', $code, PDO::PARAM_STR);
    $stmt2 = $dbConnection->prepare($query2);
    try {
        $stmt->execute();
        $stmt2->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            $result2 = $stmt2->fetch();
            $date_base = $result->dateVerificationCode;

            return false;

        }
        return true;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}