<?php
    echo "Hello, world! The database is connected.<br>";

    $dsn = 'mysql:host=mysql;dbname=app';
    $user = 'root';
    $password = 'root';

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $stmt = $pdo->query('SELECT * FROM articles');

    foreach ($stmt as $row) {
        echo $row['title'] . '<br>';
        echo $row['description'] . '<br>';
        echo $row['date'] . '<br>';
    }
?>
