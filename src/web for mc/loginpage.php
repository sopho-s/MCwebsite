<?php
session_start();
if (isset($_SESSION["user"])) {
    if (strlen($_SESSION["user"]) > 0) {
        $path = "user.php";
        header("Location: $path");
    }
} else if (isset($_COOKIE["user"])) {
    if(strlen($_COOKIE["user"]) > 0) {
        $path = "user.php";
        header("Location: $path");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../Websiteformat.css">
        <title>
            User Login
        </title>
        <script src="funcs.js"></script>
    </head>
    <body>
        <ul class="menu">
            <li class="menu"><a href="index.html"><button class="menu"><img class="menu" src="challengepages/photos/home.png"></button></a></li>
            <li class="menu"><a href="loginpage.php"><button class="menu"><img class="menu" src="challengepages/photos/login.png"></button></a></li>
        </ul>
        <form action="login.php" method="post" enctype="multipart/form-data" class="upload">
            <input type="text" name="username" placeholder="Username" class="upload">
            <input type="text" name="password" placeholder="Password" class="upload">
            <input type="submit" name="submit" class="upload">
        </form>
        <div id="cookies" class="cookie-start cookie-transition cookie-fadein">
            <div>
                <p class="cookie-text">
                    Cookies
                </p>
            </div>
            <div>
                <p class="cookie-text">
                    Accept all:
                </p>
            </div>
            <div class="cookie-holder">
                <div class="slider-holder">
                    <button id="slider" onClick="sliderActive()" class="cookie-text slider"></button>
                </div>
            </div>
            <div class="submit-holder">
                <button onClick="submit()" class="submit-button cookie-text">
                    Submit
                </button>
            </div>
        </div>
        <script>
            if (getCookie("cookies-accepted") != "") {
                document.getElementById("cookies").remove();
            }
        </script>
    </body>
</html>