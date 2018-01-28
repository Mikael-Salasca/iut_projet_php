<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}
if(!class_exists('Request')) {

    require ROOT . '/core/request.php';
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








function getRequestTranslation($source,$target,$start_page,$limite_page){


    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $queryGetTuple = 'SELECT * FROM userRequest WHERE SOURCE =:source AND TARGET = :target AND STATUS = "WAITING" ORDER BY ID LIMIT :start, :limit';
    $stmtGetTuple = $dbConnection->prepare($queryGetTuple);
    $stmtGetTuple->bindParam('source',$source,PDO::PARAM_STR);
    $stmtGetTuple->bindParam('target',$target,PDO::PARAM_STR);
    $stmtGetTuple->bindParam('start',$start_page,PDO::PARAM_INT);
    $stmtGetTuple->bindParam('limit',$limite_page,PDO::PARAM_INT);
    try {
        $stmtGetTuple->execute();
        if($stmtGetTuple->rowCount()) {


            $stmtGetTuple->setFetchMode(PDO::FETCH_OBJ);

            while ($row = $stmtGetTuple->fetch()) {

                $tab[] = new Request($row->ID,$row->SOURCE,$row->TARGET,$row->DATA,$row->STATUS);
            }

            return $tab;
        }

    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $queryGetTuple, PHP_EOL;
        exit();
    }



}

function updateRequestAccept($object)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();


    $id = $object->getId();
    $langueSource = $object->getLangSource();
    $langueDestination = $object->getLangDestination();
    $dataSource = $object->getDataSource();
    $status = $object->getStatus();

    $query = 'UPDATE userRequest SET SOURCE=:source, TARGET=:target, DATA=:data, STATUS=:status WHERE ID = :id';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('source',$langueSource,PDO::PARAM_STR);
    $stmt->bindParam('target',$langueDestination,PDO::PARAM_STR);
    $stmt->bindParam('data', $dataSource, PDO::PARAM_STR);
    $stmt->bindParam('status', $status, PDO::PARAM_STR);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);

    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function getAllRequestPremium($name,$start_page,$limit)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $queryGetTuple = 'SELECT * FROM userRequest WHERE USER = :name ORDER BY ID DESC LIMIT :start,:end';
    $stmtGetTuple = $dbConnection->prepare($queryGetTuple);

    $stmtGetTuple->bindParam('name',$name,PDO::PARAM_STR);
    $stmtGetTuple->bindParam('start',$start_page,PDO::PARAM_INT);
    $stmtGetTuple->bindParam('end',$limit,PDO::PARAM_INT);
    try {
        $stmtGetTuple->execute();
        if($stmtGetTuple->rowCount()) {


            $stmtGetTuple->setFetchMode(PDO::FETCH_OBJ);

            while ($row = $stmtGetTuple->fetch()) {

                $tab[] = new Request($row->ID,$row->SOURCE,$row->TARGET,$row->DATA,$row->STATUS);
            }

            return $tab;
        }

    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $queryGetTuple, PHP_EOL;
        exit();
    }



}

function getNumberRequest($source,$target){


    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $query = 'SELECT COUNT(ID) TOTAL FROM userRequest WHERE STATUS="WAITING" AND SOURCE = :source AND TARGET = :target';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('source',$source,PDO::PARAM_STR);
    $stmt->bindParam('target',$target,PDO::PARAM_STR);

    try {
        $stmt->execute();
        if ($stmt->rowCount()) {

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result->TOTAL;
        }
        else {

            return 0;
        }

    } catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function getNumbersRequestPremium($name)
{


    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $query = 'SELECT COUNT(ID) TOTAL FROM userRequest WHERE USER=:user';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindParam('user',$name,PDO::PARAM_STR);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result->TOTAL;
        }
        else {

            return 0;
        }

    } catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}