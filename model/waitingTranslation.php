<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}


function insertNewWord($data,$sourceLang){

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = "INSERT INTO waitTranslate (DATA,SOURCE) VALUES(:data,:source)";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('source',$sourceLang,PDO::PARAM_STR);
    $stmt->bindParam('data',$data,PDO::PARAM_STR);
    try{

        $stmt->execute();
        if ($stmt->rowCount())
            return true;
        else
            return false;

    }

    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function checkIfWaiting($data){


    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = "SELECT * FROM waitTranslate WHERE DATA = :data";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('data',$data,PDO::PARAM_STR);
    try{

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