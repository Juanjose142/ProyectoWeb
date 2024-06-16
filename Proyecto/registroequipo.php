<?php

$conexion = mysqli_connect('localhost', 'root', '', 'Proyecto');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO equipo (nombre, apellido, email, telefono) VALUES ('$nombre', '$apellido', '$email', '$telefono')";
    if (mysqli_query($conexion, $sql)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Exito',
                    text: 'Registro guardado con exito',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'registroequipo.php';
                    }
                });
            });
          </script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($conexion) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Equipo</title>
    <link rel="stylesheet" href="Styles/StyleRegistroEquipo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmar() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estás seguro de que deseas cerrar sesión?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.html";
                }
            });
        }
    </script>
</head>

<body>
<div class="content-wrapper">
    <header class="header">
        <div class="content">
            <div class="menu container">
            <a href="principal.html" class="logo">Registro</a>
                <a href="principal.html"></a>
                <input type="checkbox" id="menu">
                <label for="menu">
                    <img src="Images/menu.png" class="menu-icono" alt="Menu">
                </label>
                <nav class="navbar">
                    <ul>
                        <li><a href="principal.html">Inicio</a></li>
                        <li><a href="equipo.php">Equipo</a></li>
                        <li><a href="Tareas.html">Tareas</a></li>
                        <li><a href="registroequipo.php">Registro</a></li>
                        <li><a href="cuenta.php">Cuenta</a></li>
                        <li onclick="confirmar()"><a href="#">Cerrar Sesion</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="container">
        <h1>Nuevo integrante de Equipo</h1>
        <form action="registroequipo.php" method="POST" class="formulario">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <button type="submit">Guardar</button>
        </form>
    </div>
    </div>
    <footer class="footer">
    <div class="footer-content container">
        <div class="footer-section">
            <img src="Images/Rapid-flow_SinFondo.png" alt="Logo" class="footer-logo">
            <p>© 2024 Rapid-flow.</p>
        </div>
        <div class="footer-section">
            <h4>Actividad</h4>
            <ul>
                <li>Proyecto Final</li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Integrantes</h4>
            <ul>
                <li>Alex Missael Torres Hernandez</li>
                <li>Arturo Yael Posadas Guadarrama</li>
                <li>Juan José de Jesús González Andrade</li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Materia</h4>
            <ul>
                <li>Desarrollo Web</li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Escuela</h4>
            <ul>
                <li>Ceti Plantel Colomos</li>
            </ul>
        </div>
       
        <div class="footer-section">
            <h4>Social</h4>
            <ul>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">LinkedIn</a></li>
                <li><a href="#">Github</a></li>
                <li><a href="#">YouTube</a></li>
                <li><a href="#">Twitch</a></li>
            </ul>
        </div>
    </div>
</footer>
</body>

</html>