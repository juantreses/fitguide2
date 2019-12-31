<?php
$login = true;
require_once "lib/autoload.php";


//redirect naar homepage als de gebruiker al ingelogd is
if ( isset($_SESSION['usr']) ) { $_SESSION["msg"][] = "U bent al ingelogd!"; header("Location: index.php"); exit; }
ShowMessages();
BasicHead();

?>

<body>
<?php
PrintNavBar();
?>
<main>
    <?php
    print LoadTemplate("login");
    ?>
</main>
<footer>
    <p>&copy; 2019 by FitGuide</p>
</footer>
