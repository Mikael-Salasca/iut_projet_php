<?php

require 'base.php';

function checkConnexionValid($name,$passwd)
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();


    $connectCheckQuery = "SELECT * FROM user WHERE NAME = '$name' AND PASSWORD = md5('$passwd')";
    $queryResult = mysqli_query($dbConnection, $connectCheckQuery);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        $_SESSION['name'] = $dbRow['NAME'];
        $_SESSION['account_active'] = $dbRow['accountActive'];
        return true;
    }
    else
    {
        return false;
    }
}