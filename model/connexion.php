<?php

require 'base.php';

function checkConnexionValid($email,$passwd)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();


    $connectCheckQuery = "SELECT * FROM user WHERE EMAIL = '$email' AND PASSWORD = md5('$passwd')";
    $queryResult = mysqli_query($dbConnection, $connectCheckQuery);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        $_SESSION['name'] = $dbRow['NAME'];
        $_SESSION['account_active'] = $dbRow['accountActive'];
        $_SESSION['account_type'] = $dbRow['TYPEACCOUNT'];
        return true;
    }
    else
    {
        return false;
    }
}

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