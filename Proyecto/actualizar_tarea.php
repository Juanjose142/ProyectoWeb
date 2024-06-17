<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "proyecto";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE tareas SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $estado, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Estado de la tarea actualizado correctamente.";
    } else {
        echo "Error al actualizar el estado de la tarea: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
