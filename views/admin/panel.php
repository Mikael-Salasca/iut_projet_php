<section id="corps">

    <section id="main-page-large">

        <div class="card-header">
            <h2>Panneau de contrôle</h2>
        </div>
        <?php if (isset($_SESSION['no_user_found'])) echo $_SESSION['no_user_found'] ; unset($_SESSION['no_user_found']); ?>
        <div class="row-compte">
            <form action = '/admin/changerank' method="post">
                <table id="panel-admin">
                    <tr class="info-table">
                        <td> Nom de compte </td>
                        <td class="panel-td"> Email </td>
                        <td class="panel-td2"> Type de compte </td>
                    </tr>
                    <?php if (isset($_SESSION['user_infos'])) {
                        $i = 1;
                        $users = $_SESSION['user_infos'];
                        //unset($_SESSION['user_infos']);
                        //$types = $_SESSION['user_types'];
                        $types = array('ADMIN' /*=> 'ADMIN'*/, 'TRANSLATOR' /*=> 'TRANSLATOR'*/, 'PREMIUM' /*=> 'PREMIUM'*/, 'ORDINARY' /*=> 'ORDINARY'*/);
                        //unset($_SESSION['user_types']);
                        //var_dump($types);
                        foreach ($users as $row) {
                            $current_user = 'fail';
                            $row = get_object_vars($row);

                            if($i%2) {
                                echo '<tr class="c-20">';
                            }
                            else{
                                echo '<tr>';
                            }
                            $i++;
                            foreach ($row as $key => $value) {
                                if ($key == 'NAME')
                                    $current_user = $value;
                                if ($key == 'TYPEACCOUNT') {
                                    echo '<td>';
                                    echo '<select name='.$current_user.'>';
                                    foreach ($types as $type) {
                                        //$type = (string)$type;
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
                <input type="submit" value = "Valider les modifications">
            </form>
        </div>
        <?php if (isset($_SESSION['rank_changes'])) echo $_SESSION['rank_changes']; unset ($_SESSION['rank_changes']);?>
    </section>
</section>
