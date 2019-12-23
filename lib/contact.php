<?php
require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$pkey = $_POST["pkey"];

if ( $formname == "contact_form" AND $_POST['contactbutton'] == "Submit" )
{
    $sql = "INSERT INTO $tablename SET " .
        " con_naam='" . htmlentities($_POST['con_naam'], ENT_QUOTES) . "' , " .
        " con_email='" . htmlentities($_POST['con_email'], ENT_QUOTES) . "' , " .
        " con_subject='" . htmlentities($_POST['con_subject'], ENT_QUOTES) . "' , " .
        " con_vraag='" . htmlentities($_POST['con_vraag'], ENT_QUOTES) . "' ";


    if ( ExecuteSQL($sql) )
    {
        $_SESSION["msg"][] = "We will answer your question as soon as possible!" ;
        header("Location: ". $_application_folder . "index.php");
    }
    else
    {
        $_SESSION["msg"][] = "Something went wrong. Try again!";
        header("Location: ". $_application_folder . "index.php#contact");
    }
}
?>