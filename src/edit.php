<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) { die("ID no especificado"); }

// Obtener datos actuales
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) { die("Usuario no encontrado"); }

// Actualizar si se envía formulario
if (isset($_POST['update'])) {
    $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombre' => $_POST['nombre'],
        ':email' => $_POST['email'],
        ':telefono' => $_POST['telefono'],
        ':id' => $id
    ]);
    header("Location: index.php");
}
?>

<h1>Editar Usuario</h1>
<form method="POST">
    <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <input type="text" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>" required>
    <button type="submit" name="update">Actualizar</button>
</form>
