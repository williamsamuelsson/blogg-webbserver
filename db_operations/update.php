<?php
session_start();
require_once ("../db/connection.php");
require_once ("../includes/block.php");


if ($_SESSION["userId"] != $_POST["userId"]) {
    echo "<p>cant edit others posts</p>";
} else {
    $sql = "select * from bloggtext where userId = :userId and datetime=:datetime";
    $st = $dbc->prepare($sql);
    $st->bindValue(":userId", $_POST["userId"]);
    $st->bindValue(":datetime", $_POST["datetime"]);
    $st->execute();
    if ($st->rowCount() > 0) {
        $sql2 = "update bloggtext set bloggtext = :bloggtext where userId = :userId and datetime = :datetime";
        $st2 = $dbc->prepare($sql2);
        $st2->bindValue(":userId", $_POST["userId"]);
        $st2->bindValue(":datetime", $_POST["datetime"]);
        $st2->bindValue(":bloggtext", $_POST["bloggtext"]);
        $st2->execute();
        echo "<p>your post has been updated</p>";
    } else {
        echo "<p>post does not exist</p>";
    }
}
?>

<a href="/profile.php?id=<?php echo $_POST["userId"] ?>">back to profile</a>