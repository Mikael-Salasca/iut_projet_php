<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}

function getAllLangs() {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = "translate"';
    $stmt = $dbConnection->prepare($query);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $columns = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                $columns[] = $row['COLUMN_NAME'];
        }
        return $columns;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function addLanguage($newlanguage) {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'ALTER TABLE translate ADD ' . $newlanguage . ' VARCHAR(24)';
    $stmt = $dbConnection->prepare($query);
    //utiliser la valeur bindée dans la requête renvoie une syntax error
    $stmt->bindValue('newLanguage', $newlanguage, PDO::PARAM_STR);
    try {
        if ($stmt->execute())
            return true;
        return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function removeLanguage($lang) {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'ALTER TABLE translate DROP ' . $lang;
    $stmt = $dbConnection->prepare($query);
    //utiliser la valeur bindée dans la requête renvoie une syntax error
    try {
        if ($stmt->execute())
            return true;
        return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function langAlreadyExists($newlanguage) {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = "translate"';
    try {
        $stmt = $dbConnection->prepare($query);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($row['COLUMN_NAME'] == $newlanguage)
                return true;
        }
        return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

