<?php // informations de l'inscription inscrites dans la bd


require 'base.php';

function saveRegistration($name, $email, $password)
{

    $usersDataBase = new UsersDataBase();
    $db = $usersDataBase->dbConnect();
    $password = md5($password);
    $query = "INSERT INTO user (NAME, EMAIL, PASSWORD, DATE) VALUES ('$name','$email','$password',NOW())";

    $inscription = $db->prepare($query);
    $affectedLines = $inscription->execute();

    return $affectedLines;
}

function checkAccountExist($name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $registerCheckQuery = "SELECT * FROM user WHERE NAME = '$name'";
    $queryResult = mysqli_query($dbConnection, $registerCheckQuery);
    if (mysqli_num_rows($queryResult) != 0) {
        return true;
    }
    else
        return false;
}

