<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "proyecto";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM tareas";
$result = $conn->query($sql);

$tareas = array();
while($row = $result->fetch_assoc()) {
    $tareas[] = $row;
}

$conn->close();

echo json_encode($tareas);
?>
