<?php // informations de l'inscription inscrites dans la bd



if (!class_exists('UsersDataBase'))
{
    require ROOT . '/model/base.php';
}


function saveRegistration($name, $email, $password)
{

    $usersDataBase = new UsersDataBase();
    $db = $usersDataBase->dbConnect();
    $password = md5($password);
    $query = "INSERT INTO user (NAME, EMAIL, PASSWORD, DATE) VALUES (:name,:email,:password,NOW())";
    $inscription = $db->prepare($query);
    $inscription->bindValue('name', $name, PDO::PARAM_STR);
    $inscription->bindValue('email', $email, PDO::PARAM_STR);
    $inscription->bindValue('password', $password, PDO::PARAM_STR);
    try {
        $inscription->execute();
        $affectedLines = $inscription->rowCount();
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

function checkAccountExist($name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $registerCheckQuery = "SELECT * FROM user WHERE NAME = :name";
    $stmt = $dbConnection->prepare($registerCheckQuery);
    $stmt->bindValue('name', $name, PDO::PARAM_STR);

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

function saveKeyAccount($key,$name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET keyVerificationAccount=:key WHERE NAME = :name";
    $update = $dbConnection->prepare($query);
    $update->bindValue('key', $key, PDO::PARAM_STR);
    $update->bindValue('name', $name, PDO::PARAM_INT);
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

function getAccountByKey($key){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "SELECT * FROM user WHERE keyVerificationAccount = :key";
    $stmt = $dbConnection->prepare($query);
    $stmt->bindValue('key', $key, PDO::PARAM_STR);
    try {
        $stmt->execute();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result;
        }
        return '';
    }
    catch (PDOException $e) {
        echo 'Erreur : ', $e->getMessage(), PHP_EOL;
        echo 'Requête : ', $query, PHP_EOL;
        exit();
    }
}

function activeAccount($name){

    $usersDataBase = new UsersDataBase();
    $dbConnection = $usersDataBase->dbConnect();
    $query = "UPDATE user SET accountActive=1 WHERE NAME = :name";
    $update = $dbConnection->prepare($query);
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



