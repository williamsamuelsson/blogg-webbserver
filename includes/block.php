<?php
if (!isset($_SESSION["userId"])) {
    echo "<h1>you need to be logged in to access blog</h1>";
    echo "<a href=\"/index.php\">login here</a>";
    exit();
}
?>