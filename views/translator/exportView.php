<section id="corps">
    <section id="main-page">

    <p>Langues à exporter :</p>
        <form method="post" action="/translator/sub_export">

            Source
            <select class="select-admin" name="lgSource">
                <?php foreach ($all_langues as $lang) {
                    $option = '<option value="' . $lang . '" ';
                    $option .= '">' . translate($lang, 'ENGLISH') . '</option>';
                    echo $option;

                } ?>

            </select>
            Destination
            <select class="select-admin" name="lgTarget">
                <?php
                foreach ($all_langues as $lang) {
                    $option = '<option value="' . $lang . '" ';
                    $option .= '">' . translate($lang, 'ENGLISH') . '</option>';
                    echo $option;

                }
                ?>

            </select>

            <br><br>


            <input type="submit" value="Exporter">
        </form>

    </section>



</section>