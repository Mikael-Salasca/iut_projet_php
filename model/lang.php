<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}

function addLanguage($newlanguage) {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'ALTER TABLE translate ADD :newlanguage VARCHAR( 255 )';
    $stmt = $dbConnection->prepare($query);
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