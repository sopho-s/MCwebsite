<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../Websiteformat.css">
        <title>
            <?php
            if (isset($_SESSION["user"])) {
                if (strlen($_SESSION["user"]) > 0) {
                    echo $_SESSION["user"];
                }else {
                    $path = "loginpage.php";
                    header("Location: $path");
                }
            } else if (isset($_COOKIE["user"])) {
                if (strlen($_COOKIE["user"]) > 0) {
                    echo $_COOKIE["user"];
                }else {
                    $path = "loginpage.php";
                    header("Location: $path");
                }
            } else {
                $path = "loginpage.php";
                header("Location: $path");
            }
            ?>
        </title>
        <script src="funcs.js"></script>
    </head>
    <body>
        <ul class="menu">
            <li class="menu"><a href="../index.html"><button class="menu"><img class="menu" src="challengepages/photos/home.png"></button></a></li>
            <li class="menu"><a href="../loginpage.php"><button class="menu"><img class="menu" src="challengepages/photos/login.png"></button></a></li>
        </ul>
        <div>
            <h1>
                Welcome 
                <?php
                if (isset($_SESSION["user"])) {
                    echo $_SESSION["user"];
                } else if (isset($_COOKIE["user"])) {
                    echo $_COOKIE["user"];
                } else {
                    $path = "loginpage.php";
                    header("Location: $path");
                }
                ?>
            </h1>
            <?php
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $conn = new mysqli($servername, $username, $password);
            if (isset($_SESSION["user"])) {
                $username = $_SESSION["user"];
                $password = $_SESSION["password"];
            } else if (isset($_COOKIE["user"])){
                $username = $_COOKIE["user"];
                $password = $_COOKIE["password"];
            } else {  
                $path = $_POST["destination"];
                header("Location: $path");
            }
            $query = "USE mc";
            $result  = $conn->query($query);
            $query = "CALL `CheckUserPrivileges`('$username', '$password');";
            $result  = $conn->query($query);
            $result->data_seek(0);
            $result = $result->fetch_assoc();
            if ($result["UploadAccess"]) {
                echo "<a href=\"upload.php\"><button>Upload file</button></a>";
            }
            ?>
            <a href="Logout.php"><button>Logout</button></a>
        </div>
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