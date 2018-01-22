<a href="/translator/change_control">Acceder aux traductions existantes</a>


<p> EN DEVELOPEMMENT (Le bouton Accepter et traduire est fonctionnel)</p>
<p> N'oubliez pas de cocher pour confirmer l'action !</p>
<p>Voici les demandes de traductions :</tra></p>

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
    <form method="post" action="/translator/update_request">

        <?php
        if(!empty($allTuple)) {
            foreach ($allTuple as $objWord) {

                echo '<tr>';
                echo '<td><textarea style="width: 100%" name ="textareaSource[' . $objWord->getId() . '][' . $objWord->getLangSource() . ']">' . $objWord->getDataSource() . '</textarea>';
                echo '<td COLSPAN=2><textarea style="width: 100%" name ="textareaTarget[' . $objWord->getId() . '][' . $objWord->getLangDestination() . ']"></textarea>';
                echo '<td><input type="checkbox" name="checkbox[' . $objWord->getId() . ']" value="' . $objWord->getId() . '">';
                echo '</tr>';

            }
        }
        ?>



</table>
<br><br>
<button type="submit" name="buttonOption" value="accept">Accepter et traduire</button>
<button type="submit" name="buttonOption" value="reject">Refuser</button>
<?php if (isset($_SESSION['request_translation_msg'])) echo $_SESSION['request_translation_msg']; unset($_SESSION['request_translation_msg']); ?>