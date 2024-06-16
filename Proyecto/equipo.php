<?php

$conexion = mysqli_connect('localhost', 'root', '', 'Proyecto');



if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM equipo WHERE id=$id";
    if (mysqli_query($conexion, $sql)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Exito',
                    text: 'Registro Eliminado con exito',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'equipo.php';
                    }
                });
            });
          </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al eliminar el registro',
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
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Equipo</title>
    <link rel="stylesheet" href="Styles/StylesPrincipal.css">
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
    <header class="header">
        <div class="content">
            <div class="menu container">
                <a href="principal.html" class="logo">RapidFlow</a>
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
                        <li><a href="#">Cuenta</a></li>
                        <li onclick="confirmar()"><a href="#">Cerrar Sesión</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="container">

        <h1>Equipo</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM equipo";
                $result = mysqli_query($conexion, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $mostrar['id'] ?></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['apellido'] ?></td>
                        <td><?php echo $mostrar['email'] ?></td>
                        <td><?php echo $mostrar['telefono'] ?></td>
                        <td>
                            <a href="equipo.php?eliminar=<?php echo $mostrar['id'] ?>" onclick="return confirmarEliminacion()">Eliminar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <div class="footer-content container">
            <div class="link">
                <a href="#" class="logo">RapidFlow</a>
            </div>
            <div class="link">
                <ul>
                    <li><a href="equipo.php">Equipo</a></li>
                        <li><a href="Tareas.html">Tareas</a></li>
                        <li><a href="registroequipo.php">Registro</a></li>
                        <li><a href="#">Cuenta</a></li>
                        <li onclick="confirmar()"><a href="#">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>