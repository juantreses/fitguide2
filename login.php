<?php
$login = true;
require_once "lib/autoload.php";


//redirect naar homepage als de gebruiker al ingelogd is
if ( isset($_SESSION['usr']) ) { $_SESSION["msg"][] = "You are already logged in!"; header("Location: index.php"); exit; }
ShowMessages();
BasicHead();
PrintNavBar();
?>
<main>
    <?php
    print LoadTemplate("login");
    ?>
</main>
<footer>
    <p>&copy; 2020 by FitGuide</p>
</footer>
