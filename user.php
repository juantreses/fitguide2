<?php
require_once "lib/autoload.php";

BasicHead();
ShowMessages();
PrintNavBar();


//
$sql = "Select * from fitguideUser where usr_id = '" . $_SESSION['usr']['usr_id'] . "'";
$sqloefening = "Select oef_naam, lic_naam from fitguideOefening o inner join fitguideLichaamsdeel l on o.oef_lic_id = l.lic_id";
$gewicht = GetData("Select ant_gewicht from fitguideAntropometrie where ant_usr_id = '" . $_SESSION['usr']['usr_id'] . "'");
$lengte = GetData("Select usr_lengte from fitguideUser where usr_id = '" . $_SESSION['usr']['usr_id'] . "'");
$bmi = round((int)$gewicht[0]['ant_gewicht'] / ((int)$lengte[0]['usr_lengte']*(int)$lengte[0]['usr_lengte']) * 10000);


$data = GetData($sql);
$data2 = GetData($sqloefening);


$template = LoadTemplate("user");

?>

<main>
    <?php
    print LoadTemplate("user");
    ?>
</main>
