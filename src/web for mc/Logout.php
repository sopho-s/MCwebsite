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
            unset($_SESSION['user']);
            unset($_SESSION['password']);
            echo "document.cookie = \"user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";\n";
            echo "document.cookie = \"password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";\n";
            ?>
            window.location.replace("loginpage.php");
        </script>
    </body>
</html>