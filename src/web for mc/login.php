<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
$username = $_POST["username"];
$password = $_POST["password"];
$query = "USE mc";
$result  = $conn->query($query);
$query = "SELECT UserID FROM users WHERE Username=\"$username\" AND Pass=\"$password\"";
$result  = $conn->query($query);
$path = "login.php";
if ($result->num_rows > 0) {
    $path = "user.php";
    if (isset($_COOKIE["cookies-accepted"])) {
        $query = "UPDATE users SET CookiesAccepted=1, CookieAskTime=CURRENT_TIMESTAMP() WHERE Username=\"$username\" AND Pass=\"$password\"";
        $result  = $conn->query($query);
        setcookie("user", $username, time() + (86400) * 30 * 6, "/");
        setcookie("password", $password, time() + (86400) * 30 * 6, "/");
    }
    $_SESSION["user"] = $username;
    $_SESSION["password"] = $password;
}
header("Location: $path");
?>