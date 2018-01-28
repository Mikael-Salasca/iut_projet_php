<div class="card-header">
    <h2><?php echo translate('Demandes de traductions')?></h2>
</div>


<a style="text-decoration: none;" href="/translator/change_control"><div class="link-2"><?php echo translate('Accéder aux traductions existantes')?></div></a>
<br>
<div class = "page-manage">



    <?php
    if($page_precedente != 0)
    {
        echo '<a href="/translator/operation_request?page=1">' . translate('Début').'</a>';
        echo '<==<a href="/translator/operation_request?page=' .$page_precedente . '">' . translate('Début').'</a><==';
    }
    ?>
    <?php echo 'page '. $_SESSION['page_actuelle_request'] . ' / page ' . $_SESSION['nb_page_request']; ?>
    <?php
    if($page_suivante <= $_SESSION['nb_page_request']) {
        echo '==><a href="/translator/operation_request?page=' . $page_suivante . '">' . translate('Suivant').'</a>';
        echo '==><a href = "/translator/operation_request?page='. $_SESSION['nb_page_request'] .'">' . translate('Fin').'</a >';

    }
    ?>

</div>
<form method="get" action="/translator/select_page">
<select name="select_page">
    <?php

    if($_SESSION['limite_page'] == 10)
        echo '<option value="10" selected>' . translate('Afficher par 10'). '</option>';
    else
        echo '<option value="10">' . translate('Afficher par 10'). '</option>';
    if($_SESSION['limite_page'] == 20)
        echo '<option value="20" selected>'. translate('Afficher par 20') .'</option>';
    else
        echo '<option value="20">' .translate('Afficher par 20') .'</option>';
    if ($_SESSION['limite_page'] == 50)
        echo '<option value="50" selected>' .translate('Afficher par 50').'</option>';
    else
        echo '<option value="50">' .translate('Afficher par 50') .'</option>';

    ?>
</select>
<button type="submit"><?php echo translate('valider')?></button>
</form>

<div class="row-compte">
<table id="panel-admin">
    <form method="post" action="/translator/change_lang">
        <tr class="info-table">
            <td>
                <select class="select-admin" name="lgSource">
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
                <select class="select-admin" name="lgTarget">
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
                <input type="submit" class="button-50" value="<?php echo translate('Appliquer le choix des langues')?>" </td>


            </td>

        </tr>
    </form>
    <form method="post" action="/translator/update_request">

        <?php
        if(!empty($allTuple)) {
            foreach ($allTuple as $objWord) {

                echo '<tr>';
                echo '<td><textarea class="area-trad trad-source" style="width: 100%" name ="textareaSource[' . $objWord->getId() . '][' . $objWord->getLangSource() . ']">' . $objWord->getDataSource() . '</textarea>';
                echo '<td COLSPAN=2><textarea class="area-trad trad-target" style="width: 100%" name ="textareaTarget[' . $objWord->getId() . '][' . $objWord->getLangDestination() . ']"></textarea>';
                //echo '<td><input type="checkbox" name="checkbox[' . $objWord->getId() . ']" value="' . $objWord->getId() . '">';

                echo '<td><select class="select-trad" name="optionsSelect[' . $objWord->getId() . ']">
                       <option value="wait" selected>'.translate('En attente'). '</option> 
                        <option value="accept">'.translate('Accepter'). '</option>
                        <option value="reject">'.translate('Rejeter'). '</option>



                </select>';

                echo '</tr>';

            }
        }
        ?>


</table>
<br>
<!-- <button type="submit" name="buttonOption" value="accept">Accepter et traduire</button>
 <button type="submit" name="buttonOption" value="reject">Refuser</button> !-->

 <button type ="submit" class="button-valid-4" name="buttonvalid" value="buttonOn"><?php echo translate('Appliquer')?></button>
<?php if (isset($_SESSION['request_translation_msg'])) echo $_SESSION['request_translation_msg']; unset($_SESSION['request_translation_msg']); ?>



    <div class="alert-info">
        <img src="/img/info.png">&nbsp;&nbsp;<b><?php echo translate('Rappel')?></b><br>
        <?php echo translate('N\'oubliez pas de sélectionner les actions à appliquer !')?>
    </div>
</div>
<br>
<br><br><br>
<div class = "page-manage">



    <?php
    if($page_precedente != 0)
    {
        echo '<a href="/translator/operation_request?page=1">' . translate('Début').'</a>';
        echo '<==<a href="/translator/operation_request?page=' .$page_precedente . '">' . '' . translate('Précédent').'</a><==';
    }
    ?>
    <?php echo 'page '. $_SESSION['page_actuelle_request']; ?>
    <?php
    if($page_suivante <= $_SESSION['nb_page_request']) {
        echo '==><a href="/translator/operation_request?page=' . $page_suivante . '">' . translate('Suivant').'</a>';
        echo '==><a href = "/translator/operation_request?page='. $_SESSION['nb_page_request'] .'"> ' . translate('Fin').'</a >';

    }
?>

</div>

<br>