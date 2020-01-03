<?php
require_once "lib/autoload.php";
require_once "lib/fitlevel.php";

BasicHead();
ShowMessages();
PrintNavBar();

$sql = "Select * from fitguideUser 
inner join fitguideTest fT on fitguideUser.usr_id = fT.tst_usr_id
where usr_id = '" . $_SESSION['usr']['usr_id'] . "'
order by tst_datum desc";
$gewicht = GetData("Select ant_gewicht from fitguideAntropometrie where ant_usr_id = '" . $_SESSION['usr']['usr_id'] . "' ORDER BY ant_datum DESC");
$lengte = GetData("Select usr_lengte from fitguideUser where usr_id = '" . $_SESSION['usr']['usr_id'] . "'");
$bmi = round((int)$gewicht[0]['ant_gewicht'] / ((int)$lengte[0]['usr_lengte']*(int)$lengte[0]['usr_lengte']) * 10000);
$fitdata = FitLevel();
$fitlevel = $fitdata["fitlevel"];
$lowestfit = LowestFit();


$data = GetData($sql);

$data[0] += ['usr_bmi' => $bmi, 'usr_gewicht'  => $gewicht[0]['ant_gewicht'], 'usr_level' => "$fitlevel / 10"];


$template = LoadTemplate("user");



print ReplaceContent($data,$template);
PrintRec($fitlevel, $lowestfit);
PrintDagBoek();
    ?>
</main>
<footer>
    <p>&copy; 2019 by FitGuide</p>
</footer>
