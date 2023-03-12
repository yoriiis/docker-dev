<?php
    require __DIR__.'/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $dsn = 'mysql:host=mysql;dbname='.$_ENV['MYSQL_DATABASE'];
    $user = $_ENV['MYSQL_USER'];
    $password = $_ENV['MYSQL_PASSWORD'];

    try {
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        echo "Hello, world! The database is connected.<br><br>";

        $stmt = $pdo->query('SELECT * FROM articles');
        foreach ($stmt as $row) {
            echo $row['title'] . '<br>';
            echo $row['description'] . '<br>';
            echo $row['date'] . '<br>';
        }

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>
