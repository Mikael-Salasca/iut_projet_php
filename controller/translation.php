<?php

class Translation extends Controller {

    function translate() {
        session_start();
        if (!isset($_SESSION['user'])) { //non connecté


            $this->start_page('Page de traduction');
            require ROOT . '/views/translate/translateView.php';
            $this->end_page();


        }

        else {
            $this->start_page('Page de traduction');
            require ROOT . '/views/translate/translateView.php';
            $this->end_page();
        }


    }

    function displayTranslation() {

        session_start();
        if (!isset($_SESSION['user'])) { //non connecté



            if (isset($_SESSION['haveToWait'])) {
                $now = new DateTime("NOW");
                $last_translation = $_SESSION['last_translation'];


                $since_last_translation = $last_translation->diff($now);
                if ($since_last_translation->i >= 10 ) {
                    unset($_SESSION['haveToWait']);
                    header("location: /translation/translate");
                    exit();

                }
                else {
                    echo 10 - $since_last_translation->i . ' minutes à attendre';


                }




        }

            else { // pas besoin d'attendre
                    $targetLangage = filter_input(INPUT_POST, 'langDest');
                    $sourceLangage = filter_input(INPUT_POST, 'langSrc');
                    $wordToTranslate = filter_input(INPUT_POST, 'word-to-translate');

                    echo $sourceLangage;
                    echo $targetLangage;
                    echo $wordToTranslate;

                    $translation = userTranslation($sourceLangage, $targetLangage, $wordToTranslate);

                    echo 'traduction : ' . $translation . "\r\n";

                    $this->start_page('Page de connexion');
                    require ROOT . '/views/translate/translateView.php';
                    $this->end_page();

                    $_SESSION['haveToWait'] = true;
                    $_SESSION['last_translation'] = new DateTime("NOW");


            }




        }

        else { // les autres

                $targetLangage = filter_input(INPUT_POST, 'langDest');
                $sourceLangage = filter_input(INPUT_POST, 'langSrc');
                $wordToTranslate = filter_input(INPUT_POST, 'word-to-translate');

                echo $sourceLangage;
                echo $targetLangage;
                echo $wordToTranslate;

                $translation = userTranslation($sourceLangage, $targetLangage, $wordToTranslate);

                echo 'traduction : ' . $translation . "\r\n";

                $this->start_page('Page de connexion');
                require ROOT . '/views/translate/translateView.php';
                $this->end_page();
        }


    }


}