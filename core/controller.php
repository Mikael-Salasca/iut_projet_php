<?php
/**
 * Created by PhpStorm.
 * User: s16008030
 * Date: 09/01/18
 * Time: 13:08
 */

require ROOT . '/model/translation.php';
class Controller {

    protected function start_page($title)
    {
        echo '<!DOCTYPE html> <html lang="fr"> <head><title>'
            . PHP_EOL . $title . '</title> <link  rel="stylesheet" href="/fic.css"/>
                <meta charset="utf-8"/>
                <meta name="description" content="Site web de Traduction"/> 
                <meta name="keywords" content="HTML,CSS,JS"/>
                <link rel="icon" href="/img/favicon.png"
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
                </head>';
        if(isset($_SESSION['user'])) $this->refreshInfoUser();
        require ROOT . '/views/header/header.php';
        echo '<body> '. PHP_EOL;
    }

   protected function end_page()
   {

       require ROOT. '/views/footer.php';
    echo '</body></html>';
   }




    private function refreshInfoUser(){

        require ROOT . '/model/connexion.php';

        if(getAllInfoUser($_SESSION['email'])){

            $this->getInfo();

        }


    }

    protected function getInfo() {
        if (isset($_SESSION['user'])) {
            $current_user = $_SESSION['user'];
            $_SESSION['name'] = $current_user->getName();
            $_SESSION['email'] = $current_user->getEmail();
            $_SESSION['password'] = $current_user->getPassword();
            $_SESSION['type'] = $current_user->getAccountType();
            $_SESSION['isActive'] = $current_user->getActivation();
            $_SESSION['crypt_email'] = $this->cryptEmail($_SESSION['email']);
            $_SESSION['isPrenium'] = $current_user->isPrenium();
            $_SESSION['isTranslator'] = $current_user->isTranslator();
            return true;
        }
        return false;


    }

    private function cryptEmail($email){

        $crypt = '';


        for($i=0; $i < iconv_strlen($email);$i++)
        {
            if(substr($email,$i,1) == "@") break;
            if($i > 1)
                $crypt .= '*';
            else
                $crypt .=  substr($email,$i,1);

        }
        for($i; $i < iconv_strlen($email); $i++)
        {
            $crypt .= substr($email,$i,1);
        }



        return $crypt;

    }


};