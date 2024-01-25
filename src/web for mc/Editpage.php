<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="Websiteformat.css">
        <title>
            Edit Page <?php echo $_POST["origin"]; ?>
        </title>
        <script type="text/javascript" src="funcs.js"></script>
        <script src="markdownparser.js"></script>
    </head>
    <body id="body">
        <ul class="menu">
            <li class="menu"><a href="index.html"><button class="menu"><img class="menu" src="/challengepages/photos/home.png"></button></a></li>
            <li class="menu"><a href="loginpage.php"><button class="menu"><img class="menu" src="/challengepages/photos/login.png"></button></a></li>
        </ul>
        <div class="blog blog-edit">
            <form action="Edit.php" method="post">
                <input type="hidden" name="file" value=<?php echo `"`. $_POST["origin"]. `"`; ?> class="upload">
                <textarea id="blog" name="text" style="width:100%; height:800px;"></textarea>
                <input type="submit" name="submit">
            </form>
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
            <?php
                if (isset($_SESSION["user"])) {
                    $username = $_SESSION["user"];
                    $password = $_SESSION["password"];
                } else if (isset($_COOKIE["user"])){
                    $username = $_COOKIE["user"];
                    $password = $_COOKIE["password"];
                } else {
                    echo "var body = document.getElementById(\"body\"); \n body.innerHTML = \"<h1>401 Unauthenticated<\h1>\"";
                }
            ?>

            if (getCookie("cookies-accepted") != "") {
                document.getElementById("cookies").remove();
            }
            <?php
                $origin = $_POST["origin"];
                $myfile = fopen("challengepages/markdown/$origin.md", "r");
                $text = fread($myfile,filesize("challengepages/markdown/$origin.md"));
                $text = str_replace("\r", "\n", $text);
                fclose($myfile);
                echo "const text = `" . $text . "`;\n";
            ?>
            var blog = document.getElementById("blog");
            blog.innerHTML = text;
            
        </script>
    </body>
</html>