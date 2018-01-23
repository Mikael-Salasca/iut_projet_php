<section id="corps">



    <section id="main-page-large">
        <div class="card-header">
            <h2>Mes demandes premiums</h2>
        </div>

        <div class = "page-manage">
            <?php
            if($page_precedente != 0) {
                echo '<a href="/premium/operation?page=1">Début</a>';
                echo ' <== ' . '<a href="/premium/operation?page=' . $page_precedente . '">' . 'Précédent</a><==';
            }
            ?>
            <?php echo 'page ' . $_SESSION['page_actuelle_premium'] .' / page ' . $_SESSION['nb_page_premium']; ?>
            <?php
            if($page_suivante <= $_SESSION['nb_page_premium']) {
                echo '==><a href="/premium/operation?page=' . $page_suivante . '">Suivant</a>';
                echo '==><a href="/premium/operation?page=' . $_SESSION['nb_page_premium'] . '">Fin</a>';
            }
            ?>
        </div>

        <div class="row-compte">

            <form method="get" action="/premium/select_page">
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
            <table class="prenium-tab">

                <tr class="prenium-info-tab">
                    <td>Ma demande</td>
                    <td>Langue source</td>
                    <td>Langue destination</td>
                    <td>Statut</td>
                </tr>

                <?php
                $i = 0;
                if (!empty($all_request)) {
                    foreach ($all_request as $object) {

                        if ($i % 2) {
                            echo '<tr class="c-24">';
                        } else {
                            echo '<tr class="c-23">';
                        }
                        $i++;
                        echo '<td>' . $object->getDataSource() . '</td>';
                        echo '<td>' . translate($object->getLangSource(), 'ENGLISH') . '</td>';
                        echo '<td>' . translate($object->getLangDestination(), 'ENGLISH') . '</td>';
                        echo '<td><div class="'. $object->getStatus() .'-requet"   </div>' . translate($object->getStatus(), 'ENGLISH') . '</td>';
                        echo '</tr>';
                    }
                }
                ?>


            </table>

        </div>
        <br>
        <div class = "page-manage">
            <?php
            if($page_precedente != 0) {
                echo '<a href="/premium/operation?page=1">Début</a>';
                echo ' <== ' . '<a href="/premium/operation?page=' . $page_precedente . '">' . 'Précédent</a><==';
            }
            ?>
            <?php echo 'page ' . $_SESSION['page_actuelle_premium'] .' / page ' . $_SESSION['nb_page_premium']; ?>
            <?php
            if($page_suivante <= $_SESSION['nb_page_premium']) {
                echo '==><a href="/premium/operation?page=' . $page_suivante . '">Suivant</a>';
                echo '==><a href="/premium/operation?page=' . $_SESSION['nb_page_premium'] . '">Fin</a>';
            }
            ?>
        </div>
    </br>
        <br>


    </section>
</section>
