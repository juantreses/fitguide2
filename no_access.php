<?php
$no_access = true;
require_once "lib/autoload.php";

BasicHead();
PrintNavBar();

?>
<body>
    <?php
    print LoadTemplate("no_access");
    ?>
</body>
</html>
<footer>
    <p>&copy; 2020 by FitGuide</p>
</footer>
