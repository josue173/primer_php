<?php
try {
    $conn = new PDO(
        "mysql:host=db;dbname=my_database;charset=utf8",
        "user",
        "password"
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
