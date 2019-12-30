<?php
$register = true;
require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$pkey = $_POST["pkey"];
$now = date("Y-m-d H:i:s",time());


if ( $formname == "registration_form" )
{
    //controle of gebruiker al bestaat
    $sql = "SELECT * FROM fitguideUser WHERE usr_username='" . $_POST['usr_username'] . "' " . "OR usr_email='" . $_POST['usr_email'] . "'";
    $data = GetData($sql);
    if ( count($data) > 0 ) {
        $_SESSION["msg"][] = "Deze gebruiker bestaat reeds! Gelieve een andere login te gebruiken.";
        header("Location: ". $_application_folder . "registreer.php");
        exit();
    }

    //controle wachtwoord minimaal 8 tekens
    if ( strlen($_POST["usr_wachtwoord"]) < 8 ) {
        $_SESSION["msg"][] = "Uw wachtwoord moet minstens 8 tekens bevatten!";
        header("Location: ". $_application_folder . "user.php");
        exit();
    }

    //controle geldig e-mailadres
    if (!filter_var($_POST["usr_email"], FILTER_VALIDATE_EMAIL)) {
        $_SESSION["msg"][] ="Ongeldig email formaat voor login";
        header("Location: ". $_application_folder . "user.php");
        exit();
    }

    //wachtwoord coderen
    $password_encrypted = password_hash ( $_POST["usr_wachtwoord"] , PASSWORD_DEFAULT );

    $sql = "INSERT INTO $tablename SET " .
        " usr_voornaam='" . htmlentities($_POST['usr_voornaam'], ENT_QUOTES) . "' , " .
        " usr_naam='" . htmlentities($_POST['usr_naam'], ENT_QUOTES) . "' , " .
        " usr_ges_id='" . htmlentities($_POST['usr_geslacht'], ENT_QUOTES) . "' , " .
        " usr_email='" . $_POST['usr_email'] . "' , " .
        " usr_username='". htmlentities($_POST['usr_username'], ENT_QUOTES) . "' , " .
        " usr_geboortedatum='" . htmlentities($_POST['usr_geboortedatum'], ENT_QUOTES) . "' , " .
        " usr_wachtwoord='" . $password_encrypted . "' , " .
        " usr_lengte='" . htmlentities($_POST['usr_lengte'], ENT_QUOTES) . "' ";

    if (ExecuteSQL($sql)) {
    $usr = GetData("SELECT usr_id FROM fitguideUser WHERE usr_username='" . $_POST['usr_username'] . "'");
    }
    $sql2 = "INSERT INTO fitguideAntropometrie SET " .
    "ant_gewicht='" . htmlentities($_POST['usr_gewicht'], ENT_QUOTES) . "' , " .
    "ant_datum ='" . htmlentities($now, ENT_QUOTES) . "' , " .
    "ant_usr_id ='" . htmlentities($usr[0]['usr_id'],ENT_QUOTES) . "'";


    $sql3 = "INSERT INTO fitguideTest SET " .
    "tst_situp='" . htmlentities($_POST['tst_situp'],ENT_QUOTES) . "' ," .
    "tst_wallsit='" . htmlentities($_POST['tst_wallsit'],ENT_QUOTES) . "' ," .
    "tst_pushup='" . htmlentities($_POST['tst_pushup'],ENT_QUOTES) . "' ," .
    "tst_datum='" . htmlentities($now,ENT_QUOTES) . "' ," .
    "tst_usr_id ='" . htmlentities($usr[0]['usr_id'],ENT_QUOTES) . "'";


    if (ExecuteSQL($sql2) and ExecuteSQL($sql3) )
    {
        $_SESSION["msg"][] = "Bedankt voor uw registratie!" ;

        if ( ControleLoginWachtwoord( $_POST["usr_username"] , $_POST["usr_wachtwoord"]) )
        {
            header("Location: ". $_application_folder . "user.php");
        }
    }
    else
    {
        $_SESSION["msg"][] = "Sorry, er liep iets fout. Uw gegevens werden niet goed opgeslagen" ;
    }
}
?>