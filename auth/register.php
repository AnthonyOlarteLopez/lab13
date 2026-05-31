<?php

require_once '../config/database.php';
require_once 'security.php';

$errores = [];
$mensajeExito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $resultado = registrarUsuario(
        $pdo,
        $email,
        $password
    );

    if ($resultado['success']) {
        $mensajeExito = "Usuario registrado correctamente.";
    } else {
        $errores = $resultado['errores'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<?php if (!empty($errores)): ?>
    <div>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($mensajeExito): ?>
    <p><?= $mensajeExito ?></p>
<?php endif; ?>

<form method="POST">

    <label>Email:</label><br>
    <input
        type="email"
        name="email"
        required
    ><br><br>

    <label>Contraseña:</label><br>
    <input
        type="password"
        name="password"
        required
    ><br><br>

    <button type="submit">
        Registrarse
    </button>

</form>

</body>
</html>