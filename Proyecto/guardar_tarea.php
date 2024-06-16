<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la solicitud POST para agregar tarea
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado']; // 'todo', 'in-progress', 'completed'

    // Preparar y ejecutar la consulta SQL para insertar la tarea
    $stmt = $conn->prepare("INSERT INTO tareas (titulo, descripcion, estado) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descripcion, $estado);
    $stmt->execute();

    // Verificar si la inserción fue exitosa
    if ($stmt->affected_rows > 0) {
        echo "Tarea insertada correctamente.";
    } else {
        echo "Error al insertar la tarea: " . $stmt->error;
    }

    // Cerrar la declaración preparada
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
