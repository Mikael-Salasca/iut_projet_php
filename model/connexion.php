<?php

require 'base.php';

function checkConnexionValid()
{

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $name = filter_input(INPUT_POST,name);
    $passwd = filter_input(INPUT_POST,mdp);
    $connectCheckQuery = "SELECT * FROM user WHERE NAME = '$name' AND PASSWORD = md5('$passwd')";
    $queryResult = mysqli_query($dbConnection, $connectCheckQuery);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        return true;
    }
    else
    {
        return false;
    }
}