<section id="corps">
    <section id="main-page-large-wh">
        <div id="gt-appbar">
            <div id="gt-apb-main">
                <a id="gt-appname" href=""><?php echo translate('Traduction');?></a>
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


                                ?>
                            </select>
                            <div class="switch" role="button">
                                <button type="submit" class="no-button-style" name="switch" value="on"><span class="jfk-button-img"></span></button>
                            </div>



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
                            <div id="button-trad"><input class="style-butt" type="submit" value="<?php echo translate("Traduire");?>"></div>
                        </td>


                    </tr>

                    <tr>
                        <td>

                        <textarea name="word-to-translate" placeholder="<?php echo translate("Entrez le mot ou la phrase à traduire");?>" id="source"><?php if(isset( $_SESSION['translation_not_found'])) echo $_SESSION['translation_not_found'][0];

                            if (isset($_SESSION['translation'])) echo $_SESSION['translation'][0];
                            if(isset($_SESSION['dataIsWaiting'])) echo $_SESSION['dataIsWaiting'];
                            ?></textarea>



                        </td>
                        <td COLSPAN=2>
                            <div id="gt-res-wrap">
                                <?php if(isset($_SESSION['translation_not_found'])) echo '<br><div class="error_no_word">' . translate('Aucune occurrence exacte trouvée') . '</div>' ;
                                ?>
                                <?php if (isset($_SESSION['translation'])) echo '<div class="show-trans">' . $_SESSION['translation'][1] . '</div>'; unset($_SESSION['translation']) ?>
                                <?php if (isset($_SESSION['min_to_wait'])) echo '<div class="error_no_word">' . translate('Vous devez attendre') . PHP_EOL . $_SESSION['min_to_wait'] . PHP_EOL . translate('minute(s)') . '</div>' ?>
                                <?php if (isset($_SESSION['dataIsWaiting'])) echo '<div class="waiting">' . translate('La demande de traduction a déja été faite !') . '</div>'; unset($_SESSION['dataIsWaiting']); ?>
                                <div id="gt-res-tools">
                                    <?php if(isset($_SESSION['translation_not_found']) && isset($_SESSION['user']) && $_SESSION['user']->isPrenium())
                                        echo '<div id="gt-res-tools-sugg">

                                  
                                    <span class="jdk-button">but</span>
                                      <a href="/translation/request">' . translate('Demander une traduction') . '</a>

                                </div>';

                                    ?>
                                </div>




                            </div>
                        </td>

                    </tr>
                </table>

            </div>
        </form>
        <br>
        <?php

        if(isset($_SESSION['list_suggestion_premium']))
            {
                $listAssoc = $_SESSION['list_suggestion_premium'];
                echo '<br><br>';
                echo '<div class="suggestion">' . translate('Des suggestions ont été trouvées !') . '<br>';

                foreach ($listAssoc as $case)
                {
                    foreach ($case as $key => $value)
                    {
                        echo '<div class="sugg-tit">' . $key . ' ==> </div><div class="sugg-cont">' . $value . '</div>';
                    }
                    echo '<br>';
                }
                echo '</div>';
                unset($_SESSION['list_suggestion_premium']);

            }


        ?>


        <?php if (isset($_SESSION['no_suggestion_premium '])) echo '<div class="suggestion"><div class="error_no_word">' . translate('La recherche approfondie n\'a pas trouvé de suggestions.') . '</div></div>';
        unset($_SESSION['no_suggestion_premium ']); ?>



        <?php
        if(isset($_SESSION['isActive']) && isset($_SESSION['user']) && !$_SESSION['isActive'] ){
            echo '<div class="alert-info">
                <img src="/img/info.png">&nbsp;&nbsp;<b>' . translate('Activez votre compte') . '</b><br>'
                . translate('Vous n\'avez pas encore activé le lien envoyé par email ! Activez votre compte pour pouvoir supprimer la restriction des 10 minutes d\'attente entre chaque traduction !') .
                '</div>';
        }
        if(!isset($_SESSION['user'])){
            echo '<div class="alert-info">
               <img src="/img/info.png">&nbsp;&nbsp;<b>' . translate('Mode restreint actif') . '</b><br>'
               . translate('Créez vous un compte') .  '<b> ' . translate('gratuitement') . ' </b>' . translate('pour pouvoir supprimer la restriction des 10 minutes d\'attente entre chaque traduction !') .
               '</div>';

        }

        if(isset($_SESSION['error_insert']))
        {
            echo '<div class="err-insert">' . translate('Une erreur technique est survenue lors de votre demande.') . '</div>';
            unset($_SESSION['error_insert']);
        }
        if(isset($_SESSION['insert_ok']))
        {
            echo '<div class="insert-success">' . translate('Nous avons bien reçu votre demande de traduction pour') .  '<b> ' . $_SESSION['insert_ok'] . '</b> !';
            unset($_SESSION['insert_ok']);

        }

        ?>

    </section>
</section>