<div class="ak-idbar">

    <a href="#">
        <?php if (isset($_SESSION['name'])) echo strtoupper($_SESSION['name']) . '&nbsp;' ;
              if (isset($_SESSION['account_type'])) echo '| ' . strtoupper($_SESSION['account_type']) . '&nbsp;' ;?>
        <img class="img-responsive" src="/img/profil.png">
    </a>




</div>