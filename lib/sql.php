<?php

// Bestand met alle SQL statements

function Navigatie($status, $status2)
{
    $sql = "select * from fitguideMenu where men_caption not like '$status' and men_caption not like '$status2' order by men_order";
    return $sql;
}