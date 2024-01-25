<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <script>
            <?php
            $challenge = $_POST["Challenge"];
            $description = $_POST["Description"];
            $photo = $_POST["Photo"];
            $challengenum = $_POST["Challengenum"];
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
                window.location.replace("loginpage.php");
            }
            if (isset($_SESSION["user"]) || isset($_COOKIE["user"])) {
                $query = "USE mc";
                $result  = $conn->query($query);
                $query = "CALL `CheckUserPrivileges`('$username', '$password');";
                $result  = $conn->query($query);
                $result->data_seek(0);
                $result = $result->fetch_assoc();
                if ($result["PageEditAccess"]) {
                    for ($i = 0; $i < 10; $i++) {
                        $description = str_replace("\r", "\n", $description);
                        $description = str_replace("\n\n", "\n", $description);
                    }
                    $myfile = fopen("challengepages/markdown/Challenge_$challengenum.md", "w");
                    fclose($myfile);
                    $myfile = fopen("IndexTemplate.html", "r");
                    $addtext = fread($myfile,filesize("IndexTemplate.html"));
                    fclose($myfile);
                    $addtext = str_replace("(Title)", $challenge, $addtext);
                    $addtext = str_replace("(Description)", $description, $addtext);
                    $addtext = str_replace("(Challengenum)", $challengenum, $addtext);
                    $myfile = fopen("Index.html", "r");
                    $index = fread($myfile,filesize("Index.html"));
                    fclose($myfile);
                    $index = str_replace("<!--indicator-->", $addtext, $index);
                    $myfile = fopen("index.html", "w");
                    fwrite($myfile, $index);
                    fclose($myfile);
                    $myfile = fopen("ChallengeTemplate.php", "r");
                    $template = fread($myfile,filesize("ChallengeTemplate.php"));
                    fclose($myfile);
                    $template = str_replace("(Title)", $challenge, $template);
                    $template = str_replace("(Challengenum)", $challengenum, $template);
                    $myfile = fopen("challengepages/Challenge_$challengenum.php", "w");
                    fwrite($myfile, $template);
                    fclose($myfile);
                    $myfile = fopen("Challengesrctemplate.php", "r");
                    $template = fread($myfile,filesize("Challengesrctemplate.php"));
                    fclose($myfile);
                    $template = str_replace("(Challengenum)", $challengenum, $template);
                    $myfile = fopen("challengepages/challengesrc/Challenge_" . $challengenum . "src.php", "w");
                    fwrite($myfile, $template);
                    fclose($myfile);
                    $structure = "challengepages/challengesrc/versions/$challengenum/";
                    try {
                        mkdir($structure);  
                    } catch(Exception $e) {
                        echo "";
                    }
                    $target_dir = "challengepages/photos/";
                    $target_file = $target_dir . basename($_FILES["Photo"]["name"]);
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file);
                    header("Location: challengepages/Challenge_$challengenum.php");
                }
            }
            ?>
        </script>
    </body>
</html>