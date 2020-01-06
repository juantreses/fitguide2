<?php
require_once "lib/autoload.php";

BasicHead();
PrintNavBar();
?>


<main class="stats">
    <?php
    $sql = "select usr_username, usr_lengte, ant_gewicht from fitguideUser
            inner join fitguideAntropometrie fA on fitguideUser.usr_id = fA.ant_usr_id
            where usr_id = " . $_SESSION['usr']['usr_id'] . " order by ant_datum desc
            limit 1";

    $data = GetData($sql);
    $template =  LoadTemplate("editstats");
    print ReplaceContent($data, $template)
    ?>
</main>
<footer>
    <p>&copy; 2020 by FitGuide</p>
</footer>