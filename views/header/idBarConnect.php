<div class="ak-idbar">
    <ul id="menu">
        <li>
            <a href="#"><?php echo strtoupper($_SESSION['name']) . '&nbsp;' ; ?>
                <img class="img-responsive" src="/img/profil.png"></a>
            <ul class="hidden">
                <li class="bl-1"><a href="/account/informations"><?php echo translate("Mon compte") ?></a></li>
                <li><a href="/home/disconnect"><?php echo translate("Deconnexion") ?></a></li>

            </ul>
        </li>
    </ul>
</div>

