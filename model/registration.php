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

function saveKeyAccount($key,$name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET keyVerificationAccount='$key',accountActive=0 WHERE NAME = '$name'";
    $update = $dbConnection->prepare($query);
    $affectedLines = $update->execute();

    return $affectedLines;



}

function getAccountByKey($key){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE keyVerificationAccount='$key'";
    $queryResult = mysqli_query($dbConnection, $query);
    if (mysqli_num_rows($queryResult) != 0) {
        $dbRow = mysqli_fetch_assoc($queryResult);
        return $dbRow;

    }
    else
        return '';


}

function activeAccount($name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET accountActive=1 WHERE NAME = '$name'";
    $update = $dbConnection->prepare($query);
    $affectedLines = $update->execute();
    return $affectedLines;

}



