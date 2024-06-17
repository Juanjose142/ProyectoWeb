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

    $stmt = $conn->prepare("DELETE FROM tareas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Tarea eliminada correctamente.";
    } else {
        echo "Error al eliminar la tarea: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
