<?php

$dbhost = "localhost";  // Localhost should be lowercase
$dbuser = "root";
$dbpass = "";
$dbname = "Proyecto";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("No hay conexión: " . mysqli_connect_error());
}

$Email = $_POST["email"];
$pass = $_POST["password"];

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE Email = '$Email' and password = '$pass'");
$nr = mysqli_num_rows($query);

if ($nr == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Login Exitoso',
                    text: 'Bienvenido: " . $Email . "',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'principal.html';
                    }
                });
            });
          </script>";
} else if ($nr == 0) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'No existe el usuario.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.html';
                    }
                });
            });
          </script>";
}
