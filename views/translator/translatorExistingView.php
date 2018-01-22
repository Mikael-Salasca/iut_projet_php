<p> Modifier les traductions existantes.<br>
    (Pense à cocher les traductions pour confirmer leur modifications)
</p>
<a href="/translator/change_control">Acceder aux demandes</a>

<br>



<table style="color: black; border: solid;width: 100%">
    <form method="post" action="/translator/change_lang">
        <tr>
            <td>
                <select name="lgSource">
                    <?php foreach ($all_langues as $lang)
                    {
                        $option = '<option value="'. $lang . '" ';
                        if($lang == $source) $option .= 'selected="' . $lang . '"';
                        $option .= '">' . translate($lang,'ENGLISH') . '</option>';
                        echo $option;

                    } ?>

                </select>



            </td>
            <td>
                <select name="lgTarget">
                    <?php
                    foreach ($all_langues as $lang)
                    {
                        $option = '<option value="'. $lang . '" ';
                        if($lang == $target) $option .= 'selected="' . $lang . '"';
                        $option .= '">' . translate($lang,'ENGLISH') . '</option>';
                        echo $option;

                    }
                    ?>

                </select>

            <td>
                <input type="submit" value="Appliquer le choix des langues" </td>


            </td>

        </tr>
    </form>
    <form method="post" action="/translator/update_translation">
        <?php foreach ($allTuple as $objWord) {

            echo '<tr>';
            echo '<td><textarea style="width: 100%" name ="textareaSource['. $objWord->getId() . '][' . $objWord->getLangSource() . ']">'. $objWord->getDataSource() . '</textarea>';
            echo '<td COLSPAN=2><textarea style="width: 100%" name ="textareaTarget['. $objWord->getId() . '][' . $objWord->getLangDestination() . ']">'. $objWord->getDataDestination() .'</textarea>';
            echo '<td><input type="checkbox" name="checkbox[' .$objWord->getId() . ']" value="' . $objWord->getId() . '">';
            echo '</tr>';

        }

        ?>



</table>

<input type="submit" value="envoyer">
</form>
<?php if(isset($_SESSION['update_translation_msg'])) echo $_SESSION['update_translation_msg']; unset($_SESSION['update_translation_msg']); ?>