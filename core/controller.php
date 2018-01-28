<?php
/**
 * Created by PhpStorm.
 * User: s16008030
 * Date: 09/01/18
 * Time: 13:08
 */

require ROOT . '/model/translation.php';

    /**
     * @summary Classe Controller permettant d'avoir nos objets controller instanciés dans l'index, faisant le lien entre le modèle et les vues
     */
class Controller {
    /**
     * @summary fonction générant le code html correspondant au head de nos vues
     * @param string, titre de la page web
     */
    protected function start_page($title)
    {
        echo '<!DOCTYPE html> <html lang="fr"> <head><title>'
            . PHP_EOL . $title . '</title> <link  rel="stylesheet" href="/fic.css"/>
                <meta charset="utf-8"/>
                <meta name="description" content="'.translate('Site web de traduction offrant un outil simple et performant permettant de trouver rapidement la traduction d\'un mot ou d\'une phrase') . '"/>         
                <meta name="keywords" content="'.translate('traduction').', '.translate('traductions').', '.translate('traduire').', '.translate('traducteur').', '.translate('traduction en ligne')  .'"/>
                <link rel="icon" href="/img/favicon.png"
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
                </head>';
        if(isset($_SESSION['user'])) $this->refreshInfoUser();
        require ROOT . '/views/header/header.php';
        echo '<body> '. PHP_EOL;
    }


    /**
     * @summary fonction générant le code html correspondant au footer de nos vues
     */
   protected function end_page()
   {
       require ROOT. '/views/footer.php';
    echo '</body></html>';
   }





    /**
     * @summary fonction récupérant les informations de l'utilisateur
     * @see getAllInfoUser()
     * @see getInfo()
     */
    private function refreshInfoUser(){

        require ROOT . '/model/connexion.php';

        if(getAllInfoUser($_SESSION['email'])){

            $this->getInfo();

        }


    }

    /**
     * @summary fonction récupérant les informations de l'utilisateur courant
     */
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

    /**
     * @summary fonction chiffrant un email
     * @param string, l'email à chiffrer
     * @return string, l'email chiffré
     */
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