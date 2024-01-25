<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../Websiteformat.css">
        <title>
            Monthly Challenge upload
        </title>
        <script src="funcs.js"></script>
    </head>
    <body>
        <ul class="menu">
            <li class="menu"><a href="index.html"><button class="menu"><img class="menu" src="challengepages/photos/home.png"></button></a></li>
            <li class="menu"><a href="loginpage.php"><button class="menu"><img class="menu" src="challengepages/photos/login.png"></button></a></li>
        </ul>
        <form action="SourceCode.php" method="post" enctype="multipart/form-data" class="upload">
            <input type="hidden" name="destination" value="/upload.php" class="upload">
            <input type="file" name="file" class="upload">
            <br>
            <select list="sources" name="sources" class="upload">
                <option value="photo">Photos</option>
                <?php
                $dir = "challengepages/challengesrc";
                $files = scandir($dir);
                foreach ($files as $file) {
                    if (strlen($file) > 2 && str_contains($file,'.')) {
                        echo "<option value=\"$file\">$file</option>";
                    }
                }
                ?>
            </datalist>
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