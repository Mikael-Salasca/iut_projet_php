<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}



function interneTranslation($targetLangage, $toTranslate) //fr par defaut
{
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();


    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE FRENCH=:toTranslate';
    var_dump($query);
    $stmt = $dbConnection->prepare($query);

    $stmt->bindValue('toTranslate', $toTranslate, PDO::PARAM_STR);
    try {
        $stmt->execute();
        $stmt->rowCount() or die('Pas de résultat' . PHP_EOL);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetch()->$targetLangage;

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
    $dbConnection  = $usersDataBase->dbConnect();


    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE ' .$srcLangage .'=:toTranslate';
    var_dump($query);
    $stmt = $dbConnection->prepare($query);

    $stmt->bindValue('toTranslate', $toTranslate, PDO::PARAM_STR);
    try {
        $stmt->execute();
        $stmt->rowCount() or die('Pas de résultat' . PHP_EOL);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetch()->$targetLangage;

    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

