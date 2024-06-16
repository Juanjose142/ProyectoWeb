<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// Conexión a la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "proyecto";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Obtener información del usuario actual
$query = "SELECT * FROM usuarios WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

// Procesar la actualización de información del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Verificar si se ingresó una nueva contraseña
    if (!empty($password)) {
        $update_query = "UPDATE usuarios SET Nombre = ?, Email = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $password, $user_id);
    } else {
        $update_query = "UPDATE usuarios SET Nombre = ?, Email = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $user_id);
    }

    // Ejecutar la consulta de actualización
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Información actualizada correctamente');</script>";
        // Redirigir de nuevo a la página de cuenta.php para mostrar la información actualizada
        header("refresh:2; url=cuenta.php"); // Redireccionar a cuenta.php después de 2 segundos
        exit();
    } else {
        echo "<script>alert('Error al actualizar la información: " . mysqli_stmt_error($stmt) . "');</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapidFlow Logistic - Cuenta</title>
    <link rel="stylesheet" href="Styles/styles_cuenta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <div class="content">
            <div class="menu container">
                <div class="logo">
                    <!-- Aquí puede ir tu logo -->
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

    <div class="container">
        <div class="login-box">
            <h2>Actualizar Información</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Nombre" value="<?php echo htmlspecialchars($user['Nombre']); ?>" required>
                </div>

                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Correo Electrónico" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                </div>

                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Nueva Contraseña">
                </div>

                <button class="btn" type="submit">Actualizar</button>
            </form>
        </div>
    </div>

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
