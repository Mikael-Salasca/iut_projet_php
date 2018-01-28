<section id="corps">

    <section id="main-page-large">

        <div class="card-header">
            <h2><?php echo ('Panneau de contrôle')?></h2>
        </div>
        <?php if (isset($_SESSION['no_user_found'])) echo $_SESSION['no_user_found'] ; unset($_SESSION['no_user_found']); ?>
        <form action = '/admin/changerank' method="post">
        <div class="row-compte">
                <table id="panel-admin">
                    <tr class="info-table">
                        <td> <?php echo translate('Nom de compte')?> </td>
                        <td class="panel-td"> <?php echo translate('Email')?> </td>
                        <td class="panel-td2"> <?php echo translate('Type de compte')?> </td>
                    </tr>
                    <?php if (isset($_SESSION['user_infos'])) {
                        $i = 1;
                        $users = $_SESSION['user_infos'];
                        $types = $_SESSION['user_types'];
                        foreach ($users as $row) {
                            $current_user = 'fail';
                            $row = get_object_vars($row);

                            if($i%2) {
                                echo '<tr class="c-20">';
                            }
                            else{
                                echo '<tr class="c-22">';
                            }
                            $i++;
                            foreach ($row as $key => $value) {
                                if ($key == 'NAME')
                                    $current_user = $value;
                                if ($key == 'TYPEACCOUNT') {
                                    echo '<td>';
                                    echo '<select class="select-admin" name='.$current_user.'>';
                                    foreach ($types as $type) {
                                        if ($value == $type)
                                            echo '<option name='.$current_user." selected =  . $type>" . $type.'</option>';
                                        else
                                            echo '<option name='.$current_user.'>'. $type . '</option>';
                                    }
                                    echo '</select>';
                                    echo '</td>';
                                }
                                else
                                    echo '<td>' . $value . '</td>';
                            }
                            echo '</tr>';
                        }
                    }?>
                </table>
                <br>
            <input type="submit" class="button-valid-4" value = "<?php echo translate('Valider les modifications')?>">
            <?php if (isset($_SESSION['rank_changes'])) echo $_SESSION['rank_changes']; unset ($_SESSION['rank_changes']);?>
        </div>
        <br>


        </form>
        <br>
        <div class="panel-modif-pass">

            <div class="panel-heading">
               <?php translate('Ajouter une nouvelle langue'); ?>
            </div>
            <div class="panel-modif-body">

                <form action = '/admin/addlang' method="post">
                    <label class="panel-modif-label" for="lang"><?php echo translate('Ajouter la langue') ?></label><br>
                    <input type="text" name="new_lang"><br>
                    <label class="panel-modif-label" for="confirmlang"><?php echo translate('Confirmer la langue') ?></label></br>
                    <input type="text" name="new_lang_confirm"><br>
                    <input type="submit" class="button-modif-admin" value="<?php echo translate('Valider') ?>">
                    <?php if (isset($_SESSION['lang_add'])) echo '<div class="insert-success">' . translate( $_SESSION['lang_add']) . '!</div>'; unset($_SESSION['lang_add']); ?>
                    <?php if (isset($_SESSION['wrong_pattern'])) echo '<div class="error-co">' . translate( $_SESSION['wrong_pattern']) . '.</div>'; unset($_SESSION['wrong_pattern']);?>
                    <?php if (isset($_SESSION['error_confirm'])) echo '<div class="error-co">'. translate( $_SESSION['error_confirm']) . '!</div>'; unset( $_SESSION['error_confirm']);?>
                    <?php if (isset($_SESSION['lang_already_exists'])) echo '<div class="error-co">'. translate($_SESSION['lang_already_exists']) .'!</div>'; unset ($_SESSION['lang_already_exists']);?>
                    <br><br>

                </form>

                <?php echo translate('La langue dois être en anglais, tout en majuscule et être entre 3 et 24 caractères') ?>.

            </div>
        </div>













        <br><br>

    </section>
</section>
