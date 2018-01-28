<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}

//Récupérer toutes les langues du site
function getAllLangs() {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'SELECT COLUMN_NAME 
              FROM INFORMATION_SCHEMA.COLUMNS 
              WHERE table_name = "translate"
              AND COLUMN_NAME != "ID_TRANSLATION"';
    $stmt = $dbConnection->prepare($query);
    try {
        $stmt->execute();
        $columns = array();
        if ($stmt->rowCount()) {
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

//On récupère les pourcentages de traductions effectuées pour une langue choisie, cela sera affiché sur la page d'accueil du site
function getPercentageTranslated($lang) {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $percentage = 'SELECT COUNT('.$lang.') / COUNT(*) * 100 AS PERCENTAGE, '.$lang.' FROM translate';
    $stmt = $dbConnection->prepare($percentage);
    try {
        $stmt->execute();
        $result = '';
        if ($stmt->rowCount()) {
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                $result = $row['PERCENTAGE'];
        }
        return $result;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $percentage, PHP_EOL;
        exit();
    }
}

//Ajouter une nouvelle langue sur le site
function addLanguage($newlanguage) {
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = 'ALTER TABLE translate ADD ' . $newlanguage . ' VARCHAR(24)';
    $stmt = $dbConnection->prepare($query);
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

//Supprimer une langue (inutilisée)
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

//Vérifier si la langue que l'on souhaite ajouter n'existe pas déjà sur le site
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

function addLanguageInEnglish($newlang){

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $query = 'INSERT INTO translate (ENGLISH) VALUES (:lang)';
    $stmt = $dbConnection->prepare($query);

    $stmt->bindParam('lang',$newlang,PDO::PARAM_STR);

    try {
        $stmt->execute();
        if($stmt->rowCount())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }



}

