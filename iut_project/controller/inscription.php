
<?php
/**
 * Created by PhpStorm.
 * User: MIKSS
 * Date: 07/01/2018
 * Time: 15:52
 */


define("ROOT", '/home/projetphpmvg/www/iut_project/');

require ROOT . 'model/saveInscription.php';

require ROOT . 'views/inscriptionView.php';


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