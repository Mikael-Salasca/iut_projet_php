<div class="card-header">
    <h2>Traductions existantes</h2>
</div>

<a style="text-decoration: none;" href="/translator/change_control"><div class="link-2">Acceder aux demandes</div></a>
<br>
<div class = "page-manage">
    <?php
    if($page_precedente != 0) {
        echo '<a href="/translator/operation_exist?page=1">Début</a>';
        echo ' <== ' . '<a href="/translator/operation_exist?page=' . $page_precedente . '">' . 'Précédent</a><==';
    }
    ?>
    <?php echo 'page ' . $_SESSION['page_actuelle_exist'] .' / page ' . $_SESSION['nb_page_exist']; ?>
    <?php
    if($page_suivante <= $_SESSION['nb_page_exist']) {
        echo '==><a href="/translator/operation_exist?page=' . $page_suivante . '">Suivant</a>';
        echo '==><a href="/translator/operation_exist?page=' . $_SESSION['nb_page_exist'] . '">Fin</a>';
    }
    ?>
</div>
<br>
<form method="get" action="/translator/select_page">
    <select name="select_page">
        <?php

        if($_SESSION['limite_page'] == 10)
            echo '<option value="10" selected>Afficher par 10</option>';
        else
            echo '<option value="10">Afficher par 10</option>';
        if($_SESSION['limite_page'] == 20)
            echo '<option value="20" selected>Afficher par 20</option>';
        else
            echo '<option value="20">Afficher par 20</option>';
        if ($_SESSION['limite_page'] == 50)
            echo '<option value="50" selected>Afficher par 50</option>';
        else
            echo '<option value="50">Afficher par 50</option>';

        ?>
    </select>
    <button type="submit">valider</button>
</form>

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

<input type="submit" class="button-valid-4" value="Valider les modifications">
</form>


<div class="alert-info">
    <img src="/img/info.png">&nbsp;&nbsp;<b>Rappel</b><br>
    N'oubliez pas de cocher les traductions pour valider leurs modifications !
</div>

<br><br><br><br><br><br>

<?php if (isset($_SESSION['update_translation_msg'])) echo $_SESSION['update_translation_msg'];
unset($_SESSION['update_translation_msg']); ?>


<div class = "page-manage">
    <?php
    if($page_precedente != 0) {
        echo '<a href="/translator/operation_exist?page=1">Début</a>';
        echo ' <== ' . '<a href="/translator/operation_exist?page=' . $page_precedente . '">' . 'Précédent</a><==';
    }
    ?>
    <?php echo 'page ' . $_SESSION['page_actuelle_exist'] .' / page ' . $_SESSION['nb_page_exist']; ?>
    <?php
    if($page_suivante <= $_SESSION['nb_page_exist']) {
        echo '==><a href="/translator/operation_exist?page=' . $page_suivante . '">Suivant</a>';
        echo '==><a href="/translator/operation_exist?page=' . $_SESSION['nb_page_exist'] . '">Fin</a>';
    }
    ?>
</div>

<br><br>