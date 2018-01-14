<?php
/**
 * Created by PhpStorm.
 * User: s16008030
 * Date: 09/01/18
 * Time: 13:08
 */

class Controller {

    function start_page($title)
    {
        echo '<!DOCTYPE html> <html lang="fr"> <head><title>'
            . PHP_EOL . $title . '</title> <link  rel="stylesheet" href="../fic.css"/>
                <meta charset="utf-8"/>
                <meta name="description" content="Site web de Traduction"/> 
                <meta name="keywords" content="HTML,CSS,JS"/>
                </head>';

        require ROOT . '/views/header/header.php';
        echo '<body> '. PHP_EOL;
    }

   function end_page()
   {
       require ROOT. '/views/footer.php';
    echo '</body></html>';
   }





};