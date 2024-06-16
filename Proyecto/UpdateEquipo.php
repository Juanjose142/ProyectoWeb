<?php
$conexion = mysqli_connect('localhost', 'root', '', 'proyecto');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$equipo = null;

if (isset($_GET['actualizar'])) {
    $id = intval($_GET['actualizar']);
    $sql = "SELECT * FROM equipo WHERE id=$id";
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $equipo = mysqli_fetch_assoc($result);
    } else {
        echo "No se encontró ningún registro con ese ID.";
        exit;
    }
}

if (isset($_POST['actualizar'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE equipo SET nombre='$nombre', apellido='$apellido', email='$email', telefono='$telefono' WHERE id=$id";
    if (mysqli_query($conexion, $sql)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Éxito',
                    text: 'Registro actualizado con éxito',
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
                    text: 'Error al actualizar el registro',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'equipo.php';
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
    <title>Actualizar Equipo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/StylesUpdateEquipo.css">
</head>
<body>
<header>
        <div class="content">
            <div class="menu container">
                <div class="logo">
                   
                </div>
                <label for="menu">
                    <img src="Images/menu.png" class="menu-icono" alt="">
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

    <div class="container mt-5">
        <h1 class="mb-4">Actualizar Información del Equipo</h1>
        <?php if ($equipo) : ?>
        <form method="POST" action="UpdateEquipo.php">
            <input type="hidden" name="id" value="<?php echo $equipo['id']; ?>">
            <div class="form-group row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $equipo['nombre']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="apellido" class="col-sm-2 col-form-label">Apellido:</label>
                <div class="col-sm-10">
                    <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo $equipo['apellido']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $equipo['email']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="telefono" class="col-sm-2 col-form-label">Teléfono:</label>
                <div class="col-sm-10">
                    <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $equipo['telefono']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='equipo.php'">Regresar</button>
                </div>
            </div>
        </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Error: No se pudo encontrar la información del equipo.
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</body>
</html>
