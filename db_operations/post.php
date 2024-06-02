<?php
session_start();
date_default_timezone_set("Europe/Stockholm");

require_once ("../includes/block.php");


if (isset($_POST["bloggtext"]) && !empty($_POST["bloggtext"])) {

    $userId = $_SESSION["userId"];
    $bloggtext = $_POST["bloggtext"];
    $datetime = date("Y-m-d H:i:s");
    require_once ("../db/connection.php");

    $sql = "insert into bloggtext(userId, bloggtext, datetime) values (:userId, :bloggtext, :datetime)";
    $st = $dbc->prepare($sql);
    $st->bindValue(":userId", $userId);
    $st->bindValue(":bloggtext", $bloggtext);
    $st->bindValue(":datetime", $datetime);
    $st->execute();

    echo "<p>your blogg has been posted</p>";
    echo '<a href = "/blogg.php">back to blogg</a>';
} else {
    echo "<p> please write something</p>";
    echo '<a href = "/blogg.php">back to blogg</a>';
}

?>