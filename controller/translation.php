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
                $time = date("H:i",strtotime("now"));
                echo $time;




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

                    $_SESSION['last_translation'] = date("H:i");;


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