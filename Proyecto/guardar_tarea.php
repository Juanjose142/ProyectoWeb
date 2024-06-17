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
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $usuario_id = $_POST['usuario_id'];

    $stmt = $conn->prepare("INSERT INTO tareas (titulo, descripcion, estado, fecha_creacion, usuario_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $titulo, $descripcion, $estado, $fecha_creacion, $usuario_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Tarea insertada correctamente.";
    } else {
        echo "Error al insertar la tarea: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
