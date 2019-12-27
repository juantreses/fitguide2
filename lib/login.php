<?php
$login = true;
require_once "autoload.php";

$formname = $_POST["formname"];
$buttonvalue = $_POST['loginbutton'];

if ( $formname == "login_form" AND $buttonvalue == "Log in" )
{
    if ( ControleLoginWachtwoord( $_POST['usr_username'], $_POST['usr_wachtwoord'] ) )
    {
        $_SESSION["msg"][] = "Welkom, " . $_SESSION['usr']['usr_voornaam'] . "!" ;
        header("Location: ". $_application_folder . "user.php");
    }
    else
    {
        $_SESSION["msg"][] = "Sorry! Verkeerde login of wachtwoord!";
        header("Location: ". $_application_folder . "login.php");
    }
}
?>