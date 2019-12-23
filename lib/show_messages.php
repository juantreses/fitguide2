<?php
function ShowMessages()
{
    //weergeven messages
    if ( isset($_SESSION["msg"]) )
    {
        foreach( $_SESSION["msg"] as $message )
        {
            $row = array( "message" => $message );
            $templ = LoadTemplate("message");
            print ReplaceContentOneRow( $row, $templ );
        }

        unset($_SESSION['msg']);
    }
}