<!-- Crear conexión con la base de datos (config.php)-->
<?php
$host = 'localhost';
$user = 'root'; // Cambiar si es necesario
$pass = ''; // Agregar contraseña si aplica
$dbname = 'proyecto_final';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

<!---- Crear tabla de usuarios (ejecutar en MySQL una vez)-->
<!--CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);-->

<!---- Formulario de registro (register.php)-->
<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>

<!---- Formulario de login (login.php)-->
<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Credenciales incorrectas";
    }
    $stmt->close();
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
</form>

<!---- Modificación de index.php para mostrar el login arriba a la derecha-->
<?php
session_start();
?>
<div style="position: absolute; top: 10px; right: 10px;">
    <?php if (isset($_SESSION['user_id'])): ?>
        Bienvenido, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Cerrar sesión</a>
    <?php else: ?>
        <a href="login.php">Sign in</a> / <a href="register.php">Sign up</a>
    <?php endif; ?>
</div>

<!-- Logout (logout.php)-->
<?php
session_start();
session_destroy();
header("Location: index.php");
?>
