<?php
try {
    $conn = new PDO(
        "mysql:host=db;dbname=my_database;charset=utf8",
        "user",
        "password"
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO usuarios (nombre, email, telefono) 
            VALUES (:nombre, :email, :telefono)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);

    $nombre = "Carlos Rodríguez";
    $email = "carlos@ejemplo.com";
    $telefono = "555-123-4567";

    $stmt->execute();

    echo "Nuevo registro creado exitosamente";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
