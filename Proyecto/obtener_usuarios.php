<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "proyecto";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, nombre FROM equipo";
$result = $conn->query($sql);

$usuarios = array();
while($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

$conn->close();

echo json_encode($usuarios);
?>
