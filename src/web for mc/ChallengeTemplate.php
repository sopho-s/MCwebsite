<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../Websiteformat.css">
        <title>
            (Title)
        </title>
        <script src="../funcs.js"></script>
        <script src="../markdownparser.js"></script>
    </head>
    <body>
        <ul class="menu">
            <li class="menu"><a href="../index.html"><button class="menu"><img class="menu" src="photos/home.png"></button></a></li>
            <li class="menu"><a href="../loginpage.php"><button class="menu"><img class="menu" src="photos/login.png"></button></a></li>
            <?php
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $conn = new mysqli($servername, $username, $password);
                $query = "USE mc";
                $result  = $conn->query($query);
                $username = "";
                $password = "";
                if (isset($_SESSION["user"])) {
                    $username = $_SESSION["user"];
                    $password = $_SESSION["password"];
                } else if (isset($_COOKIE["user"])){
                    $username = $_COOKIE["user"];
                    $password = $_COOKIE["password"];
                }
                $query = "CALL `CheckUserPrivileges`('$username', '$password');";
                try {
                    $result  = $conn->query($query);
                    $result->data_seek(0);
                    $result = $result->fetch_assoc();
                    if ($result["PageEditAccess"]) {
                        echo "<li class=\"menu\">
                                <form action=\"../Editpage.php\" method=\"post\">
                                    <button type=\"submit\" class=\"menu\">
                                        <img class=\"menu\" src=\"photos/edit.png\">
                                    </button>
                                    <input type=\"hidden\" name=\"origin\" value=\"Challenge_(Challengenum)\" class=\"upload\">
                                </form>
                            </li>";
                    }
                } catch(Exception $e) {
                    echo "";
                }
            ?>
            
        </ul>
        <div class="blog" id="blog">
            
        </div>
        <div class="src">
            <a href="../challengepages/challengesrc/Challenge_(Challengenum)src.php" class="src">Source Code</a>
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
            <?php
                $myfile = fopen("markdown/Challenge_(Challengenum).md", "r");
                $text = explode("\n", str_replace("\r", "\n", fread($myfile,filesize("markdown/Challenge_(Challengenum).md"))));
                fclose($myfile);
                $strarr = "[\"";
                for ($x = 0; $x < count($text)-2; $x++) {
                    $strarr = $strarr . $text[$x] . "\",\"";
                }
                $strarr = $strarr . $text[count($text)-1] . "\"];\n";
                echo "const strarr = " . str_replace("\r", "", $strarr);
            ?>
            var blog = document.getElementById("blog");
            blog.innerHTML = inputDoc(strarr);
        </script>
    </body>
</html>