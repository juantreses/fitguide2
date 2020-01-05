<?php
require_once "autoload.php";

$tablename = $_POST["tablename"];
$formname = $_POST["formname"];
$pkey = $_POST["pkey"];
$usr = $_SESSION['usr']['usr_id'];
$date = date("Y/m/d H:i:s");


if ( $_POST["savebutton"] == "Save" ) {

    $sql = "INSERT INTO fitguideTest SET " .
        " tst_datum='" . $date . "' ," .
        " tst_situp='" . htmlentities($_POST['tst_situp'],ENT_QUOTES) . "' , " .
        " tst_pushup='" . htmlentities($_POST['tst_pushup'],ENT_QUOTES) . "' , " .
        " tst_wallsit='" . htmlentities($_POST['tst_wallsit'],ENT_QUOTES) . "' , " .
        " tst_usr_id=" . htmlentities($usr, ENT_QUOTES);

    if ( ExecuteSQL($sql) ) {
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