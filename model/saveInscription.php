<?php // informations de l'inscription inscrites dans la bd


require 'base.php';

function saveInscription($name, $email, $password)
{
    $db = dbConnect();
    $query = 'INSERT INTO user (NAME, EMAIL, PASSWORD, DATE) VALUES (?,?,?,NOW())';

    $inscription = $db->prepare($query);
    $affectedLines = $inscription->execute(array($name, $email, $password));

    return $affectedLines;



}

