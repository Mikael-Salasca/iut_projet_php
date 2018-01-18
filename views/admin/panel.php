<section id="corps">

    <section id="main-page-large">

        <div class="card-header">
            <h2>Panneau de contrôle</h2>
        </div>
        <?php if (isset($_SESSION['no_user_found'])) echo $_SESSION['no_user_found'] ; unset($_SESSION['no_user_found']); ?>

        <table id="panel-admin" border="1">
            <tr>
                <td> Nom de compte </td>
                <td> Email </td>
                <td> Type de compte </td>
            </tr>
            <?php if (isset($_SESSION['user_infos'])) {
                $users = $_SESSION['user_infos'];
                unset($_SESSION['user_infos']);
                $types = $_SESSION['user_types'];
                unset($_SESSION['user_types']);
                foreach ($users as $row) {
                    $row = get_object_vars($row);
                    echo '<tr>';
                    foreach ($row as $key => $value) {
                        if ($key == 'TYPEACCOUNT') {
                            echo '<td>';
                            echo '<select name="types">';
                            foreach ($types as $type) {
                                $type = (string)$type;
                                if ($value == $type)
                                    echo "<option selected = $type>" . $type . '</option>';
                                echo "<option>" . $type . '</option>';
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
    </section>
</section>



