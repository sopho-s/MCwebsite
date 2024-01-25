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
    $target_dir = "challengepages/challengesrc/versions/";
    if ($_POST["sources"] != "photo") {
        $tempdest = substr($_POST["sources"], 10);
        $dest = substr($tempdest, 0, strlen($tempdest)-7);
        $target_dir = $target_dir . $dest . "/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    } else {
        $target_dir = "challengepages/photos/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    }
}
$path = $_POST["destination"];
header("Location: $path");
?>