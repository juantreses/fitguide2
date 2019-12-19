<?php
// Bestand met alle SQL statements

function Navigatie ($status) {
    $sql = "select * from fitguideMenu where men_caption not like $status order by men_order";
    return $sql;
}