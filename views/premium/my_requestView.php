<section id="corps">



    <section id="main-page-large">
        <div class="card-header">
            <h2>Mes demandes premiums</h2>
        </div>
        <div class="row-compte">
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


    </section>
</section>
