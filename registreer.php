<?php
$register = true;
require_once "lib/autoload.php";

BasicHead();
PrintNavBar();
?>


<main class="register">
    <?php
    print LoadTemplate("registratie");

    ?>
</main>
<footer>
    <p>&copy; 2020 by FitGuide</p>
</footer>