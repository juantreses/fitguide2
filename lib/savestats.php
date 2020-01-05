<?php
require_once "autoload.php";

$tablename = $_POST["tablename"];
$formname = $_POST["formname"];
$afterinsert = $_POST["afterinsert"];
$pkey = $_POST["pkey"];
$usr = $_SESSION['usr']['usr_id'];


if ( $_POST["savebutton"] == "Save" )
{
    $sql_body = array();

    foreach( $_POST as $field => $value )
    {
        if ( $field <> "img_id" AND $field <> "savebutton" )
        {
            $sql_body[]  = " $field = '" . htmlentities($value, ENT_QUOTES) . "' " ;
        }
    }

    $sql .= "UPDATE $tablename SET " . implode( ", " , $sql_body ) . " WHERE usr_id=" . $usr;
    print $sql;

    if ( ExecuteSQL($sql) ) {
        $new_url = "$_application_folder$afterinsert?insertOK=true#traininglog";
        $_SESSION["msg"][] = "Uw dagboeklog werd correct opgeslagen!" ;
    }
    else {
        $new_url = "$_application_folder$afterinsert?insertOK=false#traininglog";
        $_SESSION["msg"][] = "You have to fill in an exercise";
    }
    }


    header("Location: $new_url");
?>