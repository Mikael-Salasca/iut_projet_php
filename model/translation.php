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
        else // si la phrase n'est pas encore reference dans notre base on retourne le mot à traduire, ceci est temporaire pour aider au debug
        {
            return $toTranslate;
        }



    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function userTranslationNormal($srcLangage, $targetLangage, $toTranslate)
{


    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE ' .$srcLangage .'=:toTranslate';
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

function userTranslationPrenium($srcLangage, $targetLangage, $listToTranslate)
{
    // permet de rechercher avec une plus grande précision un mot demandé dans l'ensemble des traductions existantes et de sortir une proposition au prenium
    // listToTranslate est un tableau contenant chaque mot.



    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = 'SELECT ' . $targetLangage .',' . $srcLangage . ' FROM translate ';
    $stmt = $dbConnection->prepare($query);

    try {
        $stmt->execute();
        if($stmt->rowCount())
        {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($data = $stmt->fetch())
            {
                $sourceData = $data->$srcLangage;
                $targetData = $data->$targetLangage;
                $listSourceData = replaceWithSpace($sourceData);
                foreach ($listToTranslate as $wordRequest)
                {   $wordRequestNoAccent = noAccent($wordRequest);

                    foreach ($listSourceData as $wordBase)
                    {
                        $wordBaseNoAccent = noAccent($wordBase);
                        $wordBaseNoAccent = strtolower($wordBaseNoAccent);
                        if($wordRequestNoAccent == $wordBaseNoAccent)
                        {
                            $assocWord[] = array($wordRequest => $targetData);
                        }
                    }

                }


            }
            return $assocWord;

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

function getExistingTranslation($langueSource, $langueDestination,$start_page,$limite_page){

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $queryGetTuple = 'SELECT ID_TRANSLATION, ' . $langueSource . ',' . $langueDestination . ' FROM translate ORDER BY ID_TRANSLATION DESC LIMIT :start, :limit ';
    $stmtGetTuple = $dbConnection->prepare($queryGetTuple);
    $stmtGetTuple->bindParam('start',$start_page,PDO::PARAM_INT);
    $stmtGetTuple->bindParam('limit',$limite_page,PDO::PARAM_INT);
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
        echo 'Requête : ', $queryGetTuple, PHP_EOL;
        exit();
    }




}


function updateExistingTranslation($tabObject)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    foreach ($tabObject as $object)
    {
        $id = $object->getId();
        $langueSource = $object->getLangSource();
        $langueDestination = $object->getLangDestination();
        $dataSource = $object->getDataSource();
        $dataDestination = $object->getDataDestination();
        $query = 'UPDATE translate SET ' . $langueSource . ' = :dataSource , ' . $langueDestination . '=:dataDestination WHERE ID_TRANSLATION=' . $id;
        $stmt = $dbConnection->prepare($query);
        $stmt->bindParam('dataSource',$dataSource,PDO::PARAM_STR);
        $stmt->bindParam('dataDestination',$dataDestination,PDO::PARAM_STR);



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

function insertNewTranslation($object)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $langueSource = $object->getLangSource();
    $langueDestination = $object->getLangDestination();
    $dataSource = $object->getDataSource();
    $dataDestination = $object->getDataDestination();



    $query = 'INSERT INTO translate  (' . $langueSource . ',' . $langueDestination . ') VALUES(:dataSource,:dataTarget);';
    $stmt = $dbConnection->prepare($query);


    $stmt->bindParam('dataSource', $dataSource, PDO::PARAM_STR);
    $stmt->bindParam('dataTarget', $dataDestination, PDO::PARAM_STR);


        try {
            $stmt->execute();
            if ($stmt->rowCount()) {
                return true;
            }
            else {
                return false; // si il y a une erreur lors de l'insertion
            }

        } catch (PDOException $e) {
            echo 'Erreur : ', $e->getMessage(), PHP_EOL;
            echo 'Requête : ', $query, PHP_EOL;
            exit();
        }


}

function getNumbersTranslation()
{

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $query = 'SELECT COUNT(ID_TRANSLATION) TOTAL FROM translate';
    $stmt = $dbConnection->prepare($query);

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

function noAccent($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}

function replaceWithSpace($wordToTranslate){



    $removeCharSpecial = array(".","?","!",",");
    $removeSubject = array(" l'","un ","le "," la "," une "," de "," se "," du "," d'");
    $temp = str_replace($removeCharSpecial," ",$wordToTranslate);
    $temp = str_replace($removeSubject," ",$temp);
    $explode = explode(" ",$temp); // explode est un tableau contenant chaque mot

    foreach ($explode as $word)
    {
        if(strlen($word) != 0 && strlen($word) > 2) // les mots de moins de 3 lettres sont considéres comme nul
            $tab[] = $word;
    }

    return $tab;


}

function getAllExistTranslation($langSource,$langTarget)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();

    $queryGetTuple = 'SELECT '. $langSource . ',' . $langTarget . ' FROM translate';
    $stmtGetTuple = $dbConnection->prepare($queryGetTuple);

    try {
        $stmtGetTuple->execute();
        if($stmtGetTuple->rowCount()) {


            $stmtGetTuple->setFetchMode(PDO::FETCH_OBJ);

            while ($row = $stmtGetTuple->fetch()) {
                $tab[] = new Translate($row->ID_TRANSLATION, $langSource, $langTarget, $row->$langSource, $row->$langTarget);
            }

            return $tab;
        }

    }
    catch (PDOException $e) {
        return false;
        exit();
    }





}