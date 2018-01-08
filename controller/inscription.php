
<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 15:52
 */




function validInscription($name, $email, $password)
{
    $affectedLines = saveInscription($name, $email, $password);

    if ($affectedLines === false) {
        die('Inscription non enregistrée !');
    }
    else {
        header('Location: index.php?action=post');
    }
}