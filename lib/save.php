<?php
require_once "autoload.php";

$tablename = $_POST["tablename"];
$formname = $_POST["formname"];
$pkey = $_POST["pkey"];
$usr = $_SESSION['usr']['usr_id'];
$date = date("Y/m/d H:i:s");


if ( $_POST["savebutton"] == "Save" ) {

    $sqluser = "UPDATE $tablename SET " .
        " usr_username='" . htmlentities($_POST['usr_username'], ENT_QUOTES) . "' , " .
        " usr_lengte='" . htmlentities($_POST['usr_lengte'], ENT_QUOTES) . "' 
         WHERE usr_id =" . $usr;

    $sqlant = "INSERT INTO fitguideAntropometrie SET " .
        " ant_datum='" .$date . "' ," .
        " ant_gewicht='" . htmlentities($_POST['ant_gewicht'],ENT_QUOTES) . "' , " .
        " ant_usr_id=" . htmlentities($usr, ENT_QUOTES);


    if ( ExecuteSQL($sqluser) and ExecuteSQL($sqlant) ) {
        $new_url = $_application_folder."user.php?insertOK=true";
        $_SESSION["msg"][] = "Your data was correctly stored" ;
    }
    else {
        $new_url = $_application_folder."user.php?insertOK=false";
        $_SESSION["msg"][] = "Please try again";
    }
    }

    header("Location: $new_url");
?>