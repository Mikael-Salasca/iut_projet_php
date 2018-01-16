<?php

require 'base.php';


function checkAccountWithMail($name,$email){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $connectCheckQuery = "SELECT * FROM user WHERE NAME = :name";
    $stmt = $dbConnection->prepare($connectCheckQuery);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            if ($email == $result->EMAIL)
                return true;
            return false;
        }
        return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $connectCheckQuery, PHP_EOL;
        exit();
    }
}

function saveKeyPass($key,$name)
{
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET keyVerificationPass=:key,dateVerificationPass=NOW() + INTERVAL 2 DAY WHERE NAME = :name";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('key', $key, PDO::PARAM_STR);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $affectedLines = $stmt->rowCount();
        if ($affectedLines == 1)
            return true;
        return false;

    } catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}


function getAccountByKey($key){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE keyVerificationPass=:key";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('key', $key, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result;
        }
        return '';
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function checkDatePass($key)
{
    //retourne vrai si la date d'expiration est après la date actuelle
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE keyVerificationPass=:key";
    $query2 = "SELECT NOW()";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('key', $key, PDO::PARAM_STR);
    $stmt2 = $dbConnection->prepare($query2);
    try {
        $stmt->execute();
        $stmt2->execute();
        if ($stmt->rowCount() && $stmt2->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            $result2 = $stmt2->fetch();
            $date_base = $result->dateVerificationPass;
            $date_now = $result2->NOW();
            if ($date_base > $date_now)
                return true;
            return false;

        }
        return false;
    }

    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function saveNewPass($name,$pass)
{
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = "UPDATE user SET PASSWORD=:pass,keyVerificationPass=NULL WHERE NAME =:name";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('pass', $pass, PDO::PARAM_STR);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if($stmt->rowCount() == 1)
            return true;
        else
            return false;


    }
    catch (PDOException $e)
    {
        return false;
    }

}