<?php
try {
    $servername = "db"; // service name from docker-compose.yml
    $dbname = "my_database";
    $username = "user";
    $password = "password";

    // Create PDO connection
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    // Enable exceptions for errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión exitosa<br>";

    // SQL Insert with named parameters
    $sql = "INSERT INTO usuarios (nombre, email, telefono) 
            VALUES (:nombre, :email, :telefono)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);

    // Assign values
    $nombre = "Carlos Rodríguez";
    $email = "carlos@ejemplo.com";
    $telefono = "555-123-4567";

    // Execute
    $stmt->execute();

    echo "Nuevo registro creado exitosamente";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
