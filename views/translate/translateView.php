<section id="corps">
    <section id="main-page-large-wh">
        <div id="gt-appbar">
            <div id="gt-apb-main">
                <a id="gt-appname" href="">Traduction</a>
            </div>
        </div>
        <form action="/translation/displayTranslation" method="post">
        <div id="gt-text-c">

            <table id="gt-langs">
                <tr>
                    <td id="gt-lang-left">

                        <select class="select-trad" name="langSrc">
                            <?php
                            foreach ($all_language as $lang)
                            {
                                $option = '<option value="'. $lang . '" ';
                                if($lang == $source) $option .= 'selected="' . $lang . '"';
                                $option .= '">' . translate($lang,'ENGLISH') . '</option>';
                                echo $option;

                            }
                            var_dump($source);
                            var_dump($target);


                            ?>
                        </select>



                    </td>

                    <td id="gt-lang-right">
                        <select class="select-trad" name="langDest">

                            <?php
                            foreach ($all_language as $lang)
                            {
                                $option = '<option value="'. $lang . '" ';
                                if($lang == $target) $option .= 'selected="' . $lang . '"';
                                $option .= '">' . translate($lang,'ENGLISH') . '</option>';
                                echo $option;

                            }

                            ?>


                        </select>
                        <div id="button-trad"><input class="style-butt" type="submit" value="Traduire"></div>
                    </td>


                </tr>

                <tr>
                    <td>

                        <textarea name="word-to-translate" placeholder="Entrez le mot ou la phrase à traduire" id="source"><?php if(isset( $_SESSION['translation_not_found'])) echo $_SESSION['translation_not_found']; ?><?php if (isset($_SESSION['translation'])) echo $_SESSION['translation'][0]; ?></textarea>

                    </td>
                    <td COLSPAN=2>
                        <div id="gt-res-wrap">
                            <?php if(isset($_SESSION['translation_not_found'])) echo '<br><br><br><div class="error_no_word">Aucune occurence trouvé </div>' ;
                            unset($_SESSION['translation_not_found']); ?>
                            <?php if (isset($_SESSION['translation'])) echo '<div class="show-trans">' . $_SESSION['translation'][1] . '</div>'; unset($_SESSION['translation']) ?>
                            <?php if (isset($_SESSION['min_to_wait'])) echo '<div class="error_no_word">Vous devez attendre ' . $_SESSION['min_to_wait'] . 'minute(s)' . '</div>'; ?>
                        </div>
                    </td>

                </tr>
            </table>

        </div>
        </form>
        <br>
        <?php
        if(isset($_SESSION['isActive']) && isset($_SESSION['user']) && !$_SESSION['isActive'] ){
            echo '<div class="alert-info">
                <img src="/img/info.png">&nbsp;&nbsp;<b>Activé votre compte</b><br>
                Vous n\'avez pas encore activé le lien envoyé par email ! Activé votre compte pour pouvoir supprimer la restriction des 10 minutes d\'attente entre chaque traduction !
                </div>';
            }
        if(!isset($_SESSION['user'])){
            echo '<div class="alert-info">
               <img src="/img/info.png">&nbsp;&nbsp;<b>Mode restreint actif</b><br>
               Créer vous un compte <b>gratuitement</b> pour pouvoir supprimer la restriction des 10 minutes d\'attente entre chaque traduction !
               </div>';

            }

            ?>




    </section>
</section>
