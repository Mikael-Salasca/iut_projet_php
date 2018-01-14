<?php

require 'base.php';

function findEnglishTranslation($wordToTranslate)
{
        $usersDataBase = new UsersDataBase();
        $dbConnection = $usersDataBase->dbConnect();
        $query = "SELECT ENGLISH FROM translate WHERE FRENCH='$wordToTranslate'";
        $queryResult = mysqli_query($dbConnection, $query);
        if (mysqli_num_rows($queryResult) != 0) {
            $dbRow = mysqli_fetch_assoc($queryResult);
            return $dbRow;

        }
        else
            return '';

}

$a = findEnglishTranslation('Bonjour');
echo $a;


function findFrenchTranslation($wordToTranslate)
{
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $Query = 'SELECT FRENCH FROM translate WHERE ENGLISH=\'' .$wordToTranslate.'\'';

    $queryResult = mysqli_query($dbConnection, $Query);
    $trad = mysqli_fetch_assoc($queryResult);
    return $trad;
}


