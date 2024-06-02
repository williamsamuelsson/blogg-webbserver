<?php
require_once '../db/connection.php';
?>

<?php

// insert.php file taking care of insert operations

$sql = "INSERT INTO users(userFullName, loginName, password)
            VALUES(:userFullName, :loginName,:password)
        ";

// prepare query to the database
$st = $dbc->prepare($sql);

// bind form data with placeholders
$st->bindValue(':userFullName', $_POST["name"]);
$st->bindValue(':loginName', $_POST["username"]);
$st->bindValue(':password', $_POST["password"]);

// run query against the database
if ($st->execute()) {
    $success = true;
}

header("Location: /index.php")
    ?>