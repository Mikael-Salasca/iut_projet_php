<section id="corps">

    <section id="main-page-large">

        <div class="card-header">
            <h2>Panneau de contrôle</h2>
        </div>
        <?php if (isset($_SESSION['no_user_found'])) echo $_SESSION['no_user_found'] ; unset($_SESSION['no_user_found']); ?>
        <form action = '/admin/changerank' method="post">
        <div class="row-compte">
                <table id="panel-admin">
                    <tr class="info-table">
                        <td> Nom de compte </td>
                        <td class="panel-td"> Email </td>
                        <td class="panel-td2"> Type de compte </td>
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
            <input type="submit" class="button-valid-4" value = "Valider les modifications">
            <?php if (isset($_SESSION['rank_changes'])) echo $_SESSION['rank_changes']; unset ($_SESSION['rank_changes']);?>
        </div>
        <br>


        </form>

        <form action = '/admin/addlang' method="post">
            Ajouter une langue (en anglais, entre 3 et 24 caractères, tout en majuscules) <br>
            <input type="text" name="new_lang"><br>
            Confirmation : <br>
            <input type="text" name="new_lang_confirm">
            <input type="submit" value="Ajouter">
            <br>
            <?php if (isset($_SESSION['lang_add'])) echo $_SESSION['lang_add']; unset($_SESSION['lang_add']); ?>
            <?php if (isset($_SESSION['wrong_pattern'])) echo $_SESSION['wrong_pattern']; unset($_SESSION['wrong_pattern']);?>
            <?php if (isset($_SESSION['error_confirm'])) echo  $_SESSION['error_confirm']; unset( $_SESSION['error_confirm']);?>
            <?php if (isset($_SESSION['lang_already_exists'])) echo $_SESSION['lang_already_exists']; unset ($_SESSION['lang_already_exists']);?>
        </form>

        <br><br>

    </section>
</section>
