<?php // informations de l'inscription inscrites dans la bd


require 'base.php';

function saveInscription($name, $email, $password)
{
    $db = dbConnect();
    $password = md5($password);
    $query = "INSERT INTO user (NAME, EMAIL, PASSWORD, DATE) VALUES ('$name','$email','$password',NOW())";

    $inscription = $db->prepare($query);
    $affectedLines = $inscription->execute();

    return $affectedLines;



}

