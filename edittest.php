<?php
require_once "lib/autoload.php";

BasicHead();
PrintNavBar();
?>


<main class="test">
    <?php
    $sql = "select tst_pushup, tst_situp, tst_wallsit from fitguideTest 
            where tst_usr_id= " . $_SESSION['usr']['usr_id'] . " 
            order by tst_datum desc
            limit 1";

    $data = GetData($sql);
    $template =  LoadTemplate("edittest");
    print ReplaceContent($data, $template)
    ?>
</main>
<footer>
    <p>&copy; 2020 by FitGuide</p>
</footer>