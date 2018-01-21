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
                            <?php if(($source == "FRENCH")){
                                echo '<option value="FRENCH" selected="FRENCH">Français</option>
                                <option value="ENGLISH">Anglais</option>    ';

                            }
                            else{
                                echo '<option value="FRENCH">Français</option>
                                <option value="ENGLISH" selected="ENGLISH">Anglais</option> ';
                            }
                            ?>
                        </select>
                    </td>

                    <td id="gt-lang-right">
                        <select class="select-trad" name="langDest">
                            <?php if(($target == "FRENCH")){
                                echo '<option value="FRENCH" selected="FRENCH">Français</option>
                                <option value="ENGLISH">Anglais</option>    ';

                            }
                            else{
                                echo '<option value="FRENCH">Français</option>
                                <option value="ENGLISH" selected="ENGLISH">Anglais</option> ';
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






    </section>
</section>

<script type="text/javascript">
    $("#word-to-translate").keypress(function (e) {
        if(e.which == 13 && !e.shiftKey) {
            $(this).closest("form").submit();
            e.preventDefault();
            return false;
        }
    });
</script>