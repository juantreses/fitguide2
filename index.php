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
            </div> <!-- overlay -->
        </div> <!-- pic -->
    </section>
    <section class="section-two">
        <div class="pic">
            <h2>Our promise</h2>
            <img src="images/boxjump.jpg" alt="">
        </div> <!-- pic -->
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
    <section class="section-three">
        <div class="pic">
            <div class="overlay">
                <h2>Get your guide today</h2>
                <a href="register.php"><button>Register</button></a>
            </div> <!-- overlay -->
            <img src="images/dumbbells.jpg" alt="">
        </div> <!-- pic -->
    </section>
    <section class="section-four" id="contact">
        <img src="images/fitsmile.jpg" alt="">
        <form action="lib/contact.php" method="post">
            <h2>Contact</h2>
            <input type="hidden" id="formname" name="formname" value="contact_form">
            <input type="hidden" id="tablename" name="tablename" value="fitguideContact">
            <ul>
                <li>
                    <label for="con_naam"></label>
                    <input type="text" id="con_naam" name="con_naam" placeholder="Name">
                </li>
                <li>
                    <label for="con_email"></label>
                    <input type="email" id="con_email" name="con_email" placeholder="Email">
                </li>
                <li>
                    <label for="con_subject"></label>
                    <input type="text" id="con_subject" name="con_subject" placeholder="Subject">
                </li>
                <li>
                    <label for="con_vraag"></label>
                    <textarea name="con_vraag" id="con_vraag" rows="5" placeholder="Type your message here..."></textarea>
                </li>
                <li>
                    <input type="submit" value="Submit">
                </li>
            </ul>
            <p>Thanks for submitting!</p>
        </form>
    </section>
</main>
<footer>
    <p>&copy; 2019 by FitGuide</p>
</footer>
<a href="javascript:void(0);" id="goToTop">
    <span class="fa fa-arrow-circle-up"></span>
</a>
<!-- jQuery library -->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<!-- Eigen scripts -->
<script src="js/main.js"></script>
</body>
