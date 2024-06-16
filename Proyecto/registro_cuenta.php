<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "proyecto";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("No hay conexión: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar si se ingresó una nueva contraseña
if (!empty($password)) {
   
    $query = "UPDATE usuarios SET nombre = '$name', Email = '$email', password = '$password' WHERE id = '$user_id'";
} else {
    $query = "UPDATE usuarios SET nombre = '$name', Email = '$email' WHERE id = '$user_id'";
}

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Información actualizada correctamente');</script>";
    echo "<script>window.location.href = 'perfil.php';</script>";
} else {
    echo "<script>alert('Error al actualizar la información');</script>";
    echo "<script>window.location.href = 'perfil.php';</script>";
}

mysqli_close($conn);
?>
