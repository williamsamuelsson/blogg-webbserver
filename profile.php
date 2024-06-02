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

        <h1 class="postname">
            <?php $sql2 = "select (userFullName) from users where userId = :userId";
            $st2 = $dbc->prepare($sql2);
            $st2->bindValue(":userId", $_GET["id"], PDO::PARAM_STR);
            $st2->execute();
            $row2 = $st2->fetch();
            $userFullName = $row2["userFullName"];
            echo "$userFullName's posts";
            ?>
        </h1>

        <ul class="posts">
            <?php
            $sql = "select * from bloggtext where userId = :userId order by datetime desc";
            $st = $dbc->prepare($sql);
            $st->bindValue(":userId", $_GET["id"], PDO::PARAM_STR);
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
                echo "<span>" . htmlspecialchars($userFullName) . "</span>";
                echo "<time>" . $row["datetime"] . "</time>";
                echo "</span>";
                echo "<p>" . htmlspecialchars($row["bloggtext"]) . "</p>";
                if ($_SESSION["userId"] == $row["userId"]) {
                    echo "<span class=\"actions\">";
                    echo "<a href=\"edit.php?userId="
                        . $row["userId"] . "&datetime="
                        . $row["datetime"] . "&bloggtext="
                        . $row["bloggtext"] . "\">edit</a>";

                    echo "<a href=\"delete.php?userId="
                        . $row["userId"] . "&datetime="
                        . $row["datetime"] . "&bloggtext="
                        . $row["bloggtext"] . "\">delete</a>";
                    echo "</span>";

                }
                echo "</li>";
            }
            ?>
        </ul>


    </main>

</body>

</html>