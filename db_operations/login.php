<?php
require_once ("../db/connection.php");

?>

<?php

// write query for select statement
$sql = "select * from users where loginName = :loginName";

// prepare query for the database
$st = $dbc->prepare($sql);
$st->bindValue(':loginName', $_POST['username']);


// run query against the database
$st->execute();
if ($st->rowCount() > 0) {
    $row = $st->fetch(PDO::FETCH_ASSOC);
    $password = $row['password'];
}



if (isset($password) && $password == $_POST["password"]) {
    session_start();
    $_SESSION["userId"] = $row["userId"];
    header("Location: /blogg.php");
} else {
    echo "<p>wrong username or password</p>";
    echo '<a href = "/index.php">back to login page</a>';
}


?>