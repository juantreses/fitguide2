<?php
function ShowMessages()
{
    if ( ! $_SESSION["head_printed"] ) BasicHead();
    //weergeven messages
    if ( count($_SESSION["msg"]) > 0)
    {
        foreach( $_SESSION["msg"] as $message )
        {
            $row = array( "message" => $message );
            $data = array( $row ) ;
            $templ = LoadTemplate("message");
            print ReplaceContent( $data, $templ );
        }

        unset($_SESSION['msg']);
    }
}