<section id="corps">

    <section id="main-page-large">

        <table style="width: 100%;border: solid 1px;">

            <tr>
                <td>Mot ou phrase</td>
                <td>Langue source</td>
                <td>Langue destination</td>
                <td>Statut</td>
            </tr>

            <?php
            if(!empty($all_request)) {
                foreach ($all_request as $object) {
                    echo '<tr>';
                    echo '<td style="width: 50%">' . $object->getDataSource() . '</td>';
                    echo '<td>' . translate($object->getLangSource(), 'ENGLISH') . '</td>';
                    echo '<td>' . translate($object->getLangDestination(), 'ENGLISH') . '</td>';
                    echo '<td>' . translate($object->getStatus(), 'ENGLISH') . '</td>';
                    echo '</tr>';
                }
            }
        ?>


        </table>









    </section>
</section>
