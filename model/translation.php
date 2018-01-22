<?php


if(!class_exists('Translator')) {

    require ROOT . '/core/translate.php';
}


if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}



function translate ($toTranslate,$optionLangSource = 'FRENCH') //fr par defaut
{
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $targetLangage = $_SESSION['lang']; // si la target lang n'existe pas c'est que par default on traduit le site en francais
    if(empty($targetLangage)) $targetLangage = 'FRENCH';

    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE '.$optionLangSource . '=:toTranslate';
    $stmt = $dbConnection->prepare($query);

    $stmt->bindValue('toTranslate', $toTranslate, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if($stmt->rowCount())
        {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $word = $stmt->fetch()->$targetLangage;
            if(empty($word)) // Permet de nous aider pr le debug des phrases a traduire ou non.
            {
                return $toTranslate;
            }
            else{
                return $word;
            }
        }
        else // si la phrase n'est pas encore reference dans notre base on retourne '?', ceci est temporaire c pr aider au debug
        {
            return '?';
        }



    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function userTranslation($srcLangage,$targetLangage, $toTranslate) //fr par defaut
{


    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE ' .$srcLangage .'=:toTranslate';
    //var_dump($query);
    $stmt = $dbConnection->prepare($query);

    $stmt->bindValue('toTranslate', $toTranslate, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if($stmt->rowCount())
        {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetch()->$targetLangage;
        }
        return '';


    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function translateLanguageNameToFrench($lang){


    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = 'SELECT * FROM translate WHERE ENGLISH =:toTranslate';
    //var_dump($query);
    $stmt = $dbConnection->prepare($query);

    $stmt->bindValue('toTranslate', $lang, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if($stmt->rowCount())
        {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetch()->FRENCH;
        }
        return '';


    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }



}

function getExistingTranslation($langueSource, $langueDestination){

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $queryGetTuple = 'SELECT ID_TRANSLATION, ' . $langueSource . ',' . $langueDestination . ' FROM translate';
    $stmtGetTuple = $dbConnection->prepare($queryGetTuple);
    //$stmtGetTuple->bindParam('langueSource',$langueSource,PDO::PARAM_STR);
    //$stmtGetTuple->bindParam('langueDestination',$langueDestination,PDO::PARAM_STR);
    try {
        $stmtGetTuple->execute();
        if($stmtGetTuple->rowCount()) {


            $stmtGetTuple->setFetchMode(PDO::FETCH_OBJ);

            while ($row = $stmtGetTuple->fetch()) {
                $tab[] = new Translate($row->ID_TRANSLATION, $langueSource, $langueDestination, $row->$langueSource, $row->$langueDestination);
            }

            return $tab;
        }

    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }




}


function updateExistingTranslation($tabObjet)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    foreach ($tabObjet as $objet)
    {
        $id = $objet->getId();
        $langueSource = $objet->getLangSource();
        $langueDestination = $objet->getLangDestination();
        $dataSource = $objet->getDataSource();
        $dataDestination = $objet->getDataDestination();
        //$query = 'UPDATE translation SET :langueSource=:dataSource, :langueDestination=:dataDestination WHERE ID_TRANSLATION = :id';
        $query = 'UPDATE translate SET ' . $langueSource . ' = :dataSource , ' . $langueDestination . '=:dataDestination WHERE ID_TRANSLATION=' . $id;
        $stmt = $dbConnection->prepare($query);
        //$stmt->bindParam('langueSource',$langueSource,PDO::PARAM_STR);
        //$stmt->bindParam('langueDestination',$langueDestination,PDO::PARAM_STR);
        $stmt->bindParam('dataSource',$dataSource,PDO::PARAM_STR);
        $stmt->bindParam('dataDestination',$dataDestination,PDO::PARAM_STR);
        //$stmt->bindParam('id',$id,PDO::PARAM_INT);



        try {
            $stmt->execute();
            if($stmt->rowCount()) {
                //on ne fait rien, on remonte a la boucle en haut
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
    return true;



}