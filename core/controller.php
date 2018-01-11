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
            . PHP_EOL . $title . '</title></head><body>' . PHP_EOL;
    }

   function end_page()
   {
    echo '</body></html>';
   }




};