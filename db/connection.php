<?php

try {
    $dbc = new PDO(
        'mysql:host=localhost;dbname=blogg;charset=utf8',
        'it',
        'abc123!'
    );
} catch (PDOException $exception) {
    echo "Connection Error: " . $exception->getMessage();
}

?>