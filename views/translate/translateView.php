


<section id="translate-page">

    <div>
        <h1>Traduction</h1>
    </div>

    <div id="form-translation">
        <form action = "/translation/displayTranslation" method="post" >
            <textarea name="word-to-translate"> </textarea> </br>
            <h1> Mot traduit :  <?php echo $translation?> </h1></br>
            <input type="checkbox" name="fr" /> fr
            <input type="checkbox" name="en" /> en </br>
            <input type="submit" name="action" value="Traduire" />



        </form>
    </div>
</section>