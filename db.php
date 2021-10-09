<?php

require_once __DIR__ . "/consts.php";

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    echo "Site is temporarily unavailable";
    die();
}

?>