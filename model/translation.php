<?php

if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}



function translate ($toTranslate) //fr par defaut
{
    $usersDataBase = new UsersDataBase();
    $dbConnection  = $usersDataBase->dbConnect();
    $targetLangage = $_SESSION['lang'];
    if(empty($targetLangage)) $targetLangage = 'FRENCH';
    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE FRENCH=:toTranslate';
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
    $dbConnection  = $usersDataBase->dbConnect();


    $query = 'SELECT ' . $targetLangage . ' FROM translate WHERE ' .$srcLangage .'=:toTranslate';
    //var_dump($query);
    $stmt = $dbConnection->prepare($query);

    $stmt->bindValue('toTranslate', $toTranslate, PDO::PARAM_STR);
    try {
        $stmt->execute();
        $stmt->rowCount() or die('Pas de traduction disponible' . PHP_EOL);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetch()->$targetLangage;

    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

