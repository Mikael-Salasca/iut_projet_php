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

    $query = 'SELECT DISTINCT TYPEACCOUNT FROM user';
    $stmt = $dbConnection->prepare($query);
    try {
        $stmt->execute();
        $columns = array();
        if ($stmt->rowCount()) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                $columns[] = $row['TYPEACCOUNT'];
        }
        return $columns;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function updateRanks($name, $rank) {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'UPDATE user SET TYPEACCOUNT = :rank WHERE NAME = :name';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    $stmt->bindValue('rank', $rank, PDO::PARAM_STR);

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