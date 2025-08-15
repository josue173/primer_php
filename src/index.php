<?php include 'db.php'; ?>

<h1>Lista de Usuarios</h1>

<!-- Formulario para agregar -->
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="telefono" placeholder="Teléfono" required>
    <button type="submit" name="add">Agregar</button>
</form>

<?php
// Insertar si se envía el formulario
if (isset($_POST['add'])) {
    $sql = "INSERT INTO usuarios (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombre' => $_POST['nombre'],
        ':email' => $_POST['email'],
        ':telefono' => $_POST['telefono']
    ]);
    header("Location: index.php"); // Recargar
}
?>

<!-- Tabla de registros -->
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php
    $stmt = $conn->query("SELECT * FROM usuarios");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['email']}</td>
            <td>{$row['telefono']}</td>
            <td>
                <a href='edit.php?id={$row['id']}'>Editar</a> |
                <a href='delete.php?id={$row['id']}'>Eliminar</a>
            </td>
        </tr>";
    }
    ?>
</table>
