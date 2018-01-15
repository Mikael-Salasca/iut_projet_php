<?php // Connexion à la BD alwaysdata

class UsersDataBase
{
    function dbConnect()
    {


        try {
// Connexion à la base de données.
            $dsn = 'mysql:host=mysql-projetphpmvg.alwaysdata.net;dbname=projetphpmvg_bd';
            $pdo = new PDO($dsn, '150277', '123456789');
// Codage de caractères.
            $pdo->exec('SET CHARACTER SET utf8');
// Gestion des erreurs sous forme d'exceptions.
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
// Affichage de l'erreur.
            die('Erreur : ' . $e->getMessage());
        }
        return $pdo;
    }
}



