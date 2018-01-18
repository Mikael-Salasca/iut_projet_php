<?php

require ROOT . '/model/base.php';

function checkCode($name, $code) {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'SELECT codeVerificationEmail FROM user WHERE NAME = :name';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);

    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            if ($result->codeVerificationEmail == $code)
                return true;
            return false;

        }
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
    return false;
}

function modifyemail($name, $email) {
    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();

    $query = 'UPDATE user SET EMAIL = :email WHERE NAME = :name';
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);
    $stmt->bindValue('email', $email, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $affectedLines = $stmt->rowCount();
        return $affectedLines;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }

}

function saveCodeVerification($code,$name){


    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET codeVerificationEmail=:code WHERE NAME = :name";
    $update = $dbConnection->prepare($query);
    $update->bindValue('code', $code, PDO::PARAM_STR);
    $update->bindValue('name', $name, PDO::PARAM_STR);
    try {
        $update->execute();
        $affectedLines = $update->rowCount();
        return $affectedLines;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }



}

function checkEmailExist($email){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $registerCheckQuery = "SELECT * FROM user WHERE EMAIL = :email";
    $stmt = $dbConnection->prepare($registerCheckQuery);
    $stmt->bindValue('email', $email, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $affectedLines = $stmt->rowCount();
        if ($affectedLines != 0)
            return true;
        return false;
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $registerCheckQuery, PHP_EOL;
        exit();
    }
}
?>