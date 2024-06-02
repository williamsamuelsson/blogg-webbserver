<?php

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE username = '$username' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';

    } else {

        if ($pass != $cpass) {
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO user_form(name, username, password, user_type) VALUES('$name','$username','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:index.php');
        }
    }

}
;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="form-container">

        <form action="db_operations/createuser.php" method="post">
            <h3>register now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ;
            }
            ?>

            <input type="text" name="name" required placeholder="enter your name">
            <input type="text" name="username" required placeholder="enter your username">
            <input type="password" name="password" required placeholder="enter your password">

            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="index.php">login now</a></p>
        </form>

    </div>

</body>

</html>