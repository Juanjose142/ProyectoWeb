<?php
$conexion = mysqli_connect('localhost', 'root', '', 'proyecto');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

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
    <link rel="stylesheet" href="Styles/stylesequipo.css">
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

        function confirmarEliminacion() {
            return confirm('¿Estás seguro de que deseas eliminar este registro?');
        }
    </script>
</head>
<body>
    <div class="content-wrapper">
        <header class = "header">
            <div class="content">
                <div class="menu container">
                <a href="principal.html" class="logo">Equipo</a>
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
                            <li onclick="confirmar()"><a href="#">Cerrar Sesión</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div class="container">

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
                                <a href="UpdateEquipo.php?actualizar=<?php echo $mostrar['id'] ?>">Actualizar</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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
