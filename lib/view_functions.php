<?php

function LoadTemplate( $name )
{
    if ( file_exists("$name.html") ) return file_get_contents("$name.html");
    if ( file_exists("templates/$name.html") ) return file_get_contents("templates/$name.html");
    if ( file_exists("../templates/$name.html") ) return file_get_contents("../templates/$name.html");
}

function ReplaceContent( $data, $template_html )
{
    $returnval = "";

    foreach ( $data as $row )
    {
        $content = $template_html;
        foreach($row as $field => $value)
        {
            $content = str_replace("@@$field@@", $value, $content);
        }

        $returnval .= $content;
    }

    return $returnval;
}

function ReplaceContentOneRow( $row, $template_html )
{
    $content = $template_html;
    foreach($row as $field => $value)
    {
        $content = str_replace("@@$field@@", $value, $content);
    }

    return $content;
}

function PrintNestedTemplate ( $item, $template, $data ) {
    //template voor 1 item samenvoegen met data voor items
    $template_item = LoadTemplate("$item");
    $items = ReplaceContent($data, $template_item);

    //item template samenvoegen met resultaat ($items)
    $data = array( "items" => $items );
    $print_template = LoadTemplate("$template");
    print ReplaceContentOneRow($data, $print_template);
};

function BasicHead() {
    print LoadTemplate("head");
    $_SESSION["head_printed"] = true;
};

function PrintNavBar()
{
    $laatste_deel_url = $_SERVER['SCRIPT_NAME'];
    if ( isset($_SESSION['usr'])) {
        $sql = Navigatie("Login", "Register");
        $data = GetData($sql);


        foreach( $data as $r => $row )
        {
            if ( $laatste_deel_url == $data[$r]['men_destination'] )
            {
                $data[$r]['active'] = 'active';
                $data[$r]['sr_only'] = '<span class="sr-only">(current)</span>';
            }
            else
            {
                $data[$r]['active'] = '';
                $data[$r]['sr_only'] = '';
            }
        }
        PrintNestedTemplate("navbar_item", "navbar", $data);
    }
    else {
        $sql = Navigatie("Logout", '');
        $data = GetData($sql);

        foreach( $data as $r => $row )
        {
            if ( $laatste_deel_url == $data[$r]['men_destination'] )
            {
                $data[$r]['active'] = 'active';
                $data[$r]['sr_only'] = '<span class="sr-only">(current)</span>';
            }
            else
            {
                $data[$r]['active'] = '';
                $data[$r]['sr_only'] = '';
            }
        }
        PrintNestedTemplate("navbar_item", "navbar", $data);
    }
}

function PrintDagBoek()
{
    $year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
    $week = (isset($_GET['week'])) ? $_GET['week'] : date("W");
    if ($week > 52) {
        $year++;
        $week = 1;
    } elseif ($week < 1) {
        $year--;
        $week = 52;
    }
    ?>
    <section class="traininglog">
        <h2>My Fitlog</h2>
    <table>
        <thead>
        <tr>
            <th>Dagen</th>
            <th>Datum</th>
            <th>Oefeningen</th>
            <th>Resultaat</th>
        </tr>
        </thead>
    <?php
    if ($week < 10) {
        $week = '0' . $week;
    }

    for ($day = 1; $day <= 7; $day++) {
        $d = strtotime($year . "W" . $week . $day);
        $sqldate = date("Y/m/d", $d);

        $sql = "SELECT * FROM fitguideDagboek
                    INNER JOIN fitguideOefening fO on fO.oef_id = dag_oef_id
                WHERE dag_datum ='" . $sqldate . "' AND dag_usr_id ='" . $_SESSION['usr']['usr_id'] . "'";
        $data = GetData($sql);


        $oefeningen = array();
        $resultaten = array();

        $i = 0;

        foreach ($data as $row) {
            $post = $data[$i]['dag_id'];
            $link = "lib/deleteblog.php?post=$post";
            $i++;

            $oefeningen[] = $row['oef_naam'];
            $resultaten[] = $row['dag_resultaat'] . '<br><a href='. "$link" .' . title="Deze knop verwijdert je oefening uit het dagboek"><button class="btn btn-danger">Delete</button></a>';



        }

        $oefenlijst = "<ul class='list-unstyled'><li>" . implode("</li><li>", $oefeningen) . "</li></ul>";
        $resultatenlijst = "<ul class='list-unstyled'><li>" . implode("</li><li>", $resultaten) . "</li></ul>";



        echo "<tr>";
        echo "<td>" . date("l", $d) . "</td>";
        echo "<td>" . date("d/m/Y", $d) . "</td>";
        echo "<td>" . $oefenlijst . "</td>";
        echo "<td>" . $resultatenlijst . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    $link_vorige = "user.php?week=" . ($week == 1 ? 52 : $week - 1) . "&year=" . ($week == 1 ? $year - 1 : $year);
    $link_volgende = "user.php?week=" . ($week == 52 ? 1 : $week + 1) . "&year=" . ($week == 52 ? $year + 1 : $year);
    echo "<a href=$link_vorige>Vorige Week</a>&nbsp";
    echo "<a href=$link_volgende>Volgende Week</a>&nbsp";
    echo "</section>";
}

function PrintRec($fitlevel, $lowestfit)
{
    $data = GetData("Select lic_naam from fitguideLichaamsdeel
                                where lic_naam = '$lowestfit'");

    //template voor 1 item samenvoegen met data voor items
    $template_user_schema = LoadTemplate("user_recomendations");
    print ReplaceContent($data, $template_user_schema);

    $data2 = GetData("Select lic_naam from fitguideLichaamsdeel");
    $template_tabs = LoadTemplate("user_exercises_tabs");
    echo "<div class='tabs'>";
    foreach ($data2 as $row => $r) {

        if ($lowestfit == $data2[$row]['lic_naam']) {
            $data2[$row]['default'] = "defaultOpen";
        }
        else {
            $data2[$row]['default'] = "";
        }
    }
    print ReplaceContent($data2, $template_tabs);
    echo "</div>";

    $data3 = GetData("Select oef_naam, lic_naam from fitguideOefening o 
                                inner join fitguideOef_level ol on o.oef_id = ol.oef_level_oef_id
                                inner join fitguideLichaamsdeel l on o.oef_lic_id = l.lic_id
                                where oef_level_lev_id = $fitlevel");



    $template_exercise_item = LoadTemplate("user_exercises_item");
    $exercise_items = ReplaceContent($data3, $template_exercise_item);

    //navbar template samenvoegen met resultaat ($navbar_items)
    $data = array( "item" => $exercise_items ) ;
    $template_exercises = LoadTemplate("user_exercises");
    print ReplaceContentOneRow($data, $template_exercises);

}