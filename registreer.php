<?php
$register = true;
require_once "lib/autoload.php";

BasicHead();
PrintNavBar();
?>


<main>
    <?php
    print LoadTemplate("registratie");

    ?>
</main>
<footer>
    <p>&copy; 2019 by FitGuide</p>
</footer>