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
