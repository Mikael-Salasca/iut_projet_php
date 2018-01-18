<section id="corps">

    <section id="main-page-large">

        <div class="card-header">
            <h2>Panneau de contrôle</h2>
        </div>
        <?php if (isset($_SESSION['no_user_found'])) echo $_SESSION['no_user_found'] ; unset($_SESSION['no_user_found']); ?>

        <table style = "..." id="panel-admin" border="1">
            <tr>
                <td> Nom de compte </td>
                <td> Email </td>
                <td> Type de compte </td>
            </tr>
            <?php if (isset($_SESSION['user_infos'])) {
                $users = $_SESSION['user_infos'];
                //var_dump($users);
                unset($_SESSION['user_infos']);
                foreach ($users as $row) {
                    $row = get_object_vars($row);
                    echo '<tr>';
                    foreach ($row as $key => $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';
                }
            }?>
        </table>
    </section>
</section>



