<?php
$login = true;
require_once "lib/autoload.php";



//redirect naar homepage als de gebruiker al ingelogd is
if ( isset($_SESSION['usr']) ) { $_SESSION["msg"][] = "U bent al ingelogd!"; header("Location: index.php"); exit; }

BasicHead();
ShowMessages();
?>

<main>
    <?php
    print LoadTemplate("login");
    ?>
</main>
