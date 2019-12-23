<?php
$register_form = true;
require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$pkey = $_POST["pkey"];

if ( $formname == "registration_form" AND $_POST['registerbutton'] == "Registreer" )
{
    //controle of gebruiker al bestaat
    $sql = "SELECT * FROM fitguideUser WHERE usr_username='" . $_POST['usr_username'] . "' " . "OR usr_email='" . $_POST['usr_email'] . "'";
    $data = GetData($sql);
    if ( count($data) > 0 ) die("Deze gebruiker bestaat reeds! Gelieve een andere login te gebruiken.");

    //controle wachtwoord minimaal 8 tekens
    if ( strlen($_POST["usr_wachtwoord"]) < 8 ) die("Uw wachtwoord moet minstens 8 tekens bevatten!");

    //controle geldig e-mailadres
    if (!filter_var($_POST["usr_email"], FILTER_VALIDATE_EMAIL)) die("Ongeldig email formaat voor login");

    //wachtwoord coderen
    $password_encrypted = password_hash ( $_POST["usr_wachtwoord"] , PASSWORD_DEFAULT );

    $sql = "INSERT INTO $tablename SET " .
        " usr_voornaam='" . htmlentities($_POST['usr_voornaam'], ENT_QUOTES) . "' , " .
        " usr_naam='" . htmlentities($_POST['usr_naam'], ENT_QUOTES) . "' , " .
        " usr_ges_id='" . htmlentities($_POST['usr_geslacht'], ENT_QUOTES) . "' , " .
        " usr_email='" . $_POST['usr_email'] . "' , " .
        " usr_usernaam='". htmlentities($_POST['usr_username'], ENT_QUOTES) . "' , " .
        " usr_geboortedatum='" . htmlentities($_POST['usr_geboortedatum'], ENT_QUOTES) . "' , " .
        " usr_wachtwoord='" . $password_encrypted . "' , " .
        " usr_lengte='" . htmlentities($_POST['usr_lengte'], ENT_QUOTES) . "' , " .
        " usr_gewicht='" . htmlentities($_POST['usr_gewicht'], ENT_QUOTES) . "' , " ;




    if ( ExecuteSQL($sql) )
    {
        $_SESSION["msg"][] = "Bedankt voor uw registratie!" ;

        if ( ControleLoginWachtwoord( $_POST["usr_email"] , $_POST["usr_wachtwoord"]) )
        {
            header("Location: ". $_application_folder . "index.php");
        }
    }
    else
    {
        $_SESSION["msg"][] = "Sorry, er liep iets fout. Uw gegevens werden niet goed opgeslagen" ;
    }
}
?>