<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Websiteformat.css">
        <title>
            Monthly Challenge 2 Source Code
        </title>
        <script src="/funcs.js"></script>
    </head>
<style>
</style>
    <body>
        <ul class="menu">
            <li class="menu"><a href="/index.html"><button class="menu"><img class="menu" src="/challengepages/photos/home.png"></button></a></li>
            <li class="menu"><a href="/loginpage.php"><button class="menu"><img class="menu" src="/challengepages/photos/login.png"></button></a></li>
        </ul>
        <div class="versions">
            <h1>versions</h1>
            <table>
                <tr>
                    <th>File Name</th>
                    <th>Upload Time</th>
                    <th>Upload Size</th>
                </tr>
                <tr>
                <?php
                $dir = "versions/2";
                $files = scandir($dir, SCANDIR_SORT_NONE);
                usort($files, function($a,$b){return filesize( "versions/2/" . $a) <=> filesize( "versions/2/" . $b);});
                foreach ($files as $file) {
                    if (strlen($file) > 2) {
                        $uploadtime = date("d F Y H:i:s.", filemtime("versions/2/$file"));
                        $uploadsize = filesize("versions/1/$file") / 1000;
                        $uploadsize = (int) $uploadsize;
                        echo "<tr><td><a href=\"versions/2/$file\" download>$file</a></td><td>$uploadtime</td><td>$uploadsize KB</td></tr>";
                    }
                }
                ?>
                </tr>
            </table>
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