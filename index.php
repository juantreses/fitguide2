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
    <section class="section-one">
        <div class="pic">
            <img src="images/running_shoes.jpg" alt="">
            <div class="overlay">
                <h1>Fitguide</h1>
                <p>Progress starts here</p>
            </div>
        </div>
    </section>
    <section class="section-two">
        <div class="pic">
            <h2>Our promise</h2>
            <img src="images/boxjump.jpg" alt="">
        </div>
        <article>
            <span class="fa fa-check-square"></span>
            <h3>Improve performance</h3>
            <p>Practice makes perfect</p>
            <span class="fa fa-user"></span>
            <h3>Go at your own pace</h3>
            <p>Make the most of your time</p>
            <span class="fas fa-medal"></span>
            <h3>Achieve personal goals</h3>
            <p>A lasting impact</p>
        </article>
    </section>
</main>
<!-- Eigen scripts -->
<script src="js/main.js"></script>
</body>
