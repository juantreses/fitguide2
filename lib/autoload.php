<?php
session_start();
$_SESSION["head_printed"] = false;
$_application_folder = "/wdev_joannes/fitguide2/";

require_once "pdo.php";                          //database functies
require_once "sql.php";
require_once "view_functions.php";      //basic_head, load_template, replacecontent...
require_once "show_messages.php";
require_once "authorization.php";