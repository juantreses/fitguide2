<?php

function FitLevel() {
    $usr = $_SESSION['usr']['usr_id'];
    $sql = "Select * FROM fitguideTest WHERE tst_usr_id = $usr
                AND tst_datum = (select max(tst_datum) 
                                    from fitguideTest where tst_usr_id = $usr)";

    $data = GetData($sql);

    $resultaatpush = $data[0]['tst_pushup'];
    $resultaatsit = $data[0]['tst_situp'];
    $resultaatwall = $data[0]['tst_wallsit'];

    $fitlevel = 0;
    $fitpush = 0;
    $fitsit = 0;
    $fitwall = 0;

    if ($resultaatpush >= 60) $fitpush += 10;
    elseif ($resultaatpush >= 40) $fitpush += 9;
    elseif ($resultaatpush >= 31) $fitpush += 8;
    elseif ($resultaatpush >= 25) $fitpush += 7;
    elseif ($resultaatpush >= 19) $fitpush += 6;
    elseif ($resultaatpush >= 15) $fitpush += 5;
    elseif ($resultaatpush >= 11) $fitpush += 4;
    elseif ($resultaatpush >= 8) $fitpush += 3;
    elseif ($resultaatpush >= 5) $fitpush += 2;
    elseif ($resultaatpush >= 3) $fitpush += 1;
    else $fitpush += 0;


    if ($resultaatsit >= 80) $fitsit += 10;
    elseif ($resultaatsit >= 65) $fitsit += 9;
    elseif ($resultaatsit >= 55) $fitsit += 8;
    elseif ($resultaatsit >= 45) $fitsit += 7;
    elseif ($resultaatsit >= 35) $fitsit += 6;
    elseif ($resultaatsit >= 25) $fitsit += 5;
    elseif ($resultaatsit >= 15) $fitsit += 4;
    elseif ($resultaatsit >= 9) $fitsit += 3;
    elseif ($resultaatsit >= 7) $fitsit += 2;
    elseif ($resultaatsit >= 5) $fitsit += 1;
    else  $fitsit += 0;

    if ($resultaatwall >= 80) $fitwall += 10;
    elseif ($resultaatwall >= 65) $fitwall += 9;
    elseif ($resultaatwall >= 50) $fitwall += 8;
    elseif ($resultaatwall >= 40) $fitwall += 7;
    elseif ($resultaatwall >= 30) $fitwall += 6;
    elseif ($resultaatwall >= 20) $fitwall += 5;
    elseif ($resultaatwall >= 16) $fitwall += 4;
    elseif ($resultaatwall >= 12) $fitwall += 3;
    elseif ($resultaatwall >= 8) $fitwall += 2;
    elseif ($resultaatwall >= 5) $fitwall += 1;
    else  $fitwall += 0;

    $fitlevel = round(($fitpush + $fitsit + $fitwall)/3);

    $fitresult = array();
    $fitresult += ["fitlevel" => $fitlevel, "fitpush" => $fitpush, "fitsit" => $fitsit, "fitwall" => $fitwall];

    return $fitresult;
}

function LowestFit() {

    $fitdata = FitLevel();
    $resultaatpush = $fitdata['fitpush'];
    $resultaatsit = $fitdata['fitsit'];
    $resultaatwall = $fitdata['fitwall'];


    if ($resultaatpush < $resultaatsit and $resultaatpush < $resultaatwall) return "arms";

    elseif ($resultaatsit < $resultaatpush and $resultaatsit < $resultaatwall) return "abs";

    else return "legs";
}

