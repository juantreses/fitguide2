<?php
require_once "autoload.php";


$post = $_GET["post"];

    //delete

    $sql = "DELETE From fitguideDagboek WHERE dag_id = '$post'";

if ( ExecuteSQL($sql) ) {
    $new_url = $_application_folder ."user.php?deleteOK=true#traininglog";
    $_SESSION["msg"][] = "Your exercise was correctly deleted from the calendar" ;
} ;

header("Location: $new_url");