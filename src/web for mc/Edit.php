<?php
session_start();
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
    echo "<!DOCTYPE html>
    <html>
        <head>
            <link rel=\"stylesheet\" href=\"Websiteformat.css\">
            <title>
                Monthly Challenge
            </title>
            <script type=\"text/javascript\" src=\"funcs.js\"></script>
        </head>
        <body>
            <h1>401 Unauthenticated
        </body>";
}
if (isset($_SESSION["user"]) || isset($_COOKIE["user"])) {
    $query = "USE mc";
    $result  = $conn->query($query);
    $query = "CALL `CheckUserPrivileges`('$username', '$password');";
    $result  = $conn->query($query);
    $result->data_seek(0);
    $result = $result->fetch_assoc();
    if ($result["PageEditAccess"]) {
        $file = $_POST["file"];
        $text = $_POST["text"];
        for ($i = 0; $i < 10; $i++) {
            $text = str_replace("\r", "\n", $text);
            $text = str_replace("\n\n\n", "\n\n", $text);
        }
        $myfile = fopen("challengepages/markdown/$file.md", "w");
        fwrite($myfile, $text);
        fclose($myfile);
        $path = "challengepages/$file.php";
        header("Location: $path");
    } else {
        echo "<!DOCTYPE html>
                <html>
                    <head>
                        <link rel=\"stylesheet\" href=\"Websiteformat.css\">
                        <title>
                            Monthly Challenge
                        </title>
                        <script type=\"text/javascript\" src=\"funcs.js\"></script>
                    </head>
                    <body>
                        <h1>403 Forbidden
                    </body>";
    }
}
?>