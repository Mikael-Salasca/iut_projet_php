<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}

function getAllUsersInfo() {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'SELECT NAME, EMAIL, TYPEACCOUNT FROM user';
    $stmt = $dbConnection->prepare($query);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetchAll();
            return $result;
        }
        else {
            return false;
        }
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function getAllAccountType() {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'SELECT TYPEACCOUNT FROM user';
    $stmt = $dbConnection->prepare($query);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetchAll();
            return $result;
        }
        else {
            return false;
        }
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}