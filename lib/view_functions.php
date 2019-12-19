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

function LoadNestedTemplate ( $item, $template, $data ) {
    //template voor 1 item samenvoegen met data voor items
    $template_item = LoadTemplate("$item");
    $items = ReplaceContent($data, $template_item);

    //item template samenvoegen met resultaat ($items)
    $data = array( "items" => $items );
    $print_template = LoadTemplate("$template");
    return ReplaceContentOneRow($data, $print_template);
};

function BasicHead() {
    print LoadTemplate("head");
    $_SESSION["head_printed"] = true;
};

function PrintNavBar()
{
    $laatste_deel_url = $_SERVER['SCRIPT_NAME'];
    if ( isset($_SESSION['usr'])) {
        $data = GetData("select * from fitguideMenu where men_caption not like 'Login' and men_caption not like 'Registreer' order by men_order");

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


        //template voor 1 item samenvoegen met data voor items
        $template_navbar_item = LoadTemplate("navbar_item");
        $navbar_items = ReplaceContent($data, $template_navbar_item);

        //navbar template samenvoegen met resultaat ($navbar_items)
        $data = array( "navbar_items" => $navbar_items ) ;
        $template_navbar = LoadTemplate("navbar");
        print ReplaceContentOneRow($data, $template_navbar);
    }
    else {
        $data = GetData("select * from fitguideMenu where men_caption not like 'Afmelden' order by men_order");


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


        //template voor 1 item samenvoegen met data voor items
        $template_navbar_item = LoadTemplate("navbar_item");
        $navbar_items = ReplaceContent($data, $template_navbar_item);

        //navbar template samenvoegen met resultaat ($navbar_items)
        $data = array( "navbar_items" => $navbar_items ) ;
        $template_navbar = LoadTemplate("navbar");
        print ReplaceContentOneRow($data, $template_navbar);
    }
}
