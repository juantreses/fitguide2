<?php
$index = true;
require_once "lib/autoload.php";

BasicHead();
?>
<body>
<?php
PrintNavBar();
?>


<main>
    <?php
    print LoadTemplate("registratie");

    ?>
</main>