<?php

require 'base.php';


function checkAccountWithMail($name,$email){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $connectCheckQuery = "SELECT * FROM user WHERE NAME = '$name'";
    $queryResult = mysqli_query($dbConnection, $connectCheckQuery);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        if ($email == $dbRow['EMAIL'])
            return true;
        else
            return false;
    }
    else
        return false;




}

function saveKeyPass($key,$name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET keyVerificationPass='$key',dateVerificationPass=NOW() + INTERVAL 2 DAY WHERE NAME = '$name'";
    $update = $dbConnection->prepare($query);
    $affectedLines = $update->execute();

    if($affectedLines == 1)
        return true;
    else
        return false;



}


function getAccountByKey($key){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE keyVerificationPass='$key'";
    $queryResult = mysqli_query($dbConnection, $query);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        return $dbRow;

    }
    else
        return '';


}

function checkDatePass($key)
{
    //retourne vrai si la date d'expiration est après la date actuelle
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE keyVerificationPass='$key'";
    $query2 = "SELECT NOW()";
    $queryResult = mysqli_query($dbConnection, $query);
    $queryDate = mysqli_query($dbConnection, $query2);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        $date = mysqli_fetch_assoc($queryDate);
        $date_base = $dbRow['dateVerificationPass'];
        $date_now = $date['NOW()'];

        if ($date_base > $date_now)
            return true;
        else
            return false;


    } else
        return false;

}


function saveNewPass($name,$pass)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET PASSWORD='$pass',keyVerificationPass=NULL WHERE NAME = '$name'";
    $update = $dbConnection->prepare($query);
    $affectedLines = $update->execute();

    if($affectedLines == 1)
        return true;
    else
        return false;

}