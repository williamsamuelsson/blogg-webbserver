<?php
session_start();
require_once ("db/connection.php");
require_once ("includes/block.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include "includes/header.php" ?>
    <main>

        <form action="/db_operations/post.php" method="post" class="postbox">
            <textarea name="bloggtext" placeholder="new text"></textarea>
            <button>post</button>
        </form>

        <ul class="posts">
            <?php
            $sql = "select * from bloggtext order by datetime desc";
            $st = $dbc->prepare($sql);
            $st->execute();
            $result = $st->fetchAll();
            foreach ($result as $row) {
                $sql2 = "select (userFullName) from users where userId = :userId";
                $st2 = $dbc->prepare($sql2);
                $st2->bindValue(":userId", $row["userId"]);
                $st2->execute();
                $row2 = $st2->fetch();
                $userFullName = $row2["userFullName"];
                echo "<li class = \"post\">";
                echo "<span class = \"alignpost\">";
                echo "<a href=\"profile.php?id=" . $row["userId"] . "\">" . htmlspecialchars($userFullName) . "</a>";
                echo "<time>" . $row["datetime"] . "</time>";
                echo "</span>";
                echo "<p>" . htmlspecialchars($row["bloggtext"]) . "</p>";
                echo "</li>";
            }
            ?>
        </ul>
    </main>

</body>

</html>