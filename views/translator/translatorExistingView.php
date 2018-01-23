<div class="card-header">
    <h2>Traductions existantes</h2>
</div>
<a href="/translator/change_control">Acceder aux demandes</a>

<br>

<div class="row-compte">

    <table id="panel-admin">

        <form method="post" action="/translator/change_lang">
            <tr class="info-table">
                <td>
                    <select class="select-admin" name="lgSource">
                        <?php foreach ($all_langues as $lang) {
                            $option = '<option value="' . $lang . '" ';
                            if ($lang == $source) $option .= 'selected="' . $lang . '"';
                            $option .= '">' . translate($lang, 'ENGLISH') . '</option>';
                            echo $option;

                        } ?>

                    </select>


                </td>
                <td>
                    <select class="select-admin" name="lgTarget">
                        <?php
                        foreach ($all_langues as $lang) {
                            $option = '<option value="' . $lang . '" ';
                            if ($lang == $target) $option .= 'selected="' . $lang . '"';
                            $option .= '">' . translate($lang, 'ENGLISH') . '</option>';
                            echo $option;

                        }
                        ?>

                    </select>

                <td>
                    <input type="submit" class="button-50" value="Appliquer le choix des langues"</td>


                </td>

            </tr>
        </form>
        <form method="post" action="/translator/update_translation">
            <?php foreach ($allTuple as $objWord) {

                echo '<tr>';
                echo '<td><textarea class="area-trad trad-source" name ="textareaSource[' . $objWord->getId() . '][' . $objWord->getLangSource() . ']">' . $objWord->getDataSource() . '</textarea>';
                echo '<td COLSPAN=2><textarea class="area-trad trad-target" name ="textareaTarget[' . $objWord->getId() . '][' . $objWord->getLangDestination() . ']">' . $objWord->getDataDestination() . '</textarea>';
                echo '<td><input type="checkbox" name="checkbox[' . $objWord->getId() . ']" value="' . $objWord->getId() . '">';
                echo '</tr>';

            }

            ?>


    </table>
</div>

<input type="submit" value="envoyer">
</form>
<?php if (isset($_SESSION['update_translation_msg'])) echo $_SESSION['update_translation_msg'];
unset($_SESSION['update_translation_msg']); ?>