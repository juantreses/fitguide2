<?php
session_start();
$_SESSION["head_printed"] = false;
$_application_folder = "/wdev_joannes/fitguide2/";

require_once "pdo.php";                          //database functies
require_once "view_functions.php";      //basic_head, load_template, replacecontent...