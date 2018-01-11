<?php // Connexion à la BD alwaysdata

class UsersDataBase {
    function dbConnect(){

        $dbLink = mysqli_connect('mysql-projetphpmvg.alwaysdata.net', ' 150277', '123456789')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());



        mysqli_select_db($dbLink , 'projetphpmvg_bd')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink)
        );

        return $dbLink;
    }
}

?>



