<?php
session_start();
require_once ("includes/block.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include ("includes/header.php") ?>
    <main>
        <form action="db_operations/delete.php" method="post">
            <h1>are you sure you want to delete this post?</h1>
            <input type="hidden" name="userId" value="<?php echo $_GET["userId"] ?>">
            <input type="hidden" name="datetime" value="<?php echo $_GET["datetime"] ?>">
            <button>delete</button>
            <a href="/profile.php?id=<?php echo $_GET["userId"] ?>">cancel</a>
        </form>

    </main>
</body>

</html>