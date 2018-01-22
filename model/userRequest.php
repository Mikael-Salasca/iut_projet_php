<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}


function insertNewWord($data,$sourceLang,$targetLang,$user){

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = "INSERT INTO userRequest (DATA,SOURCE,TARGET,USER) VALUES(:data,:source,:target,:user)";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('source',$sourceLang,PDO::PARAM_STR);
    $stmt->bindParam('data',$data,PDO::PARAM_STR);
    $stmt->bindParam('target',$targetLang,PDO::PARAM_STR);
    $stmt->bindParam('user',$user,PDO::PARAM_STR);
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

function checkIfWaiting($data,$source,$target){


    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $query = "SELECT * FROM userRequest WHERE DATA = :data AND SOURCE = :source  AND TARGET = :target";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('data',$data,PDO::PARAM_STR);
    $stmt->bindParam('source',$source,PDO::PARAM_STR);
    $stmt->bindParam('target',$target,PDO::PARAM_STR);
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