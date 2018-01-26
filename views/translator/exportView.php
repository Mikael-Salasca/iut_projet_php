<section id="corps">
    <section id="main-page">

    <p>Langues à exporter :</p>
        <form method="post" action="/translator/sub_export">
        <?php foreach ($all_langues as $lang) {
            echo $lang . '<input type="checkbox" name="langues[]" value="' . $lang . '">';

        } ?>
            <br><br>
            <input type="submit" value="Exporter">
        </form>

    </section>



</section>