<?php

// VALIDACIÓN DE CONTRASEÑA
function validarPassword(string $password): array
{
    $errores = [];

    if (strlen($password) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errores[] = "La contraseña debe contener al menos una letra mayúscula.";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errores[] = "La contraseña debe contener al menos un número.";
    }

    if (!preg_match('/[@#$%&*]/', $password)) {
        $errores[] = "La contraseña debe contener al menos un carácter especial (@#$%&*).";
    }

    return $errores;
}


// REGISTRO DE USUARIO
function registrarUsuario(PDO $pdo, string $email, string $password): array
{
    $errores = [];

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Correo electrónico inválido.";
    }

    // Validar contraseña
    $errores = array_merge($errores, validarPassword($password));

    if (!empty($errores)) {
        return [
            'success' => false,
            'errores' => $errores
        ];
    }

    // Hash bcrypt
    $hash = password_hash(
        $password,
        PASSWORD_BCRYPT,
        ['cost' => 12]
    );

    $stmt = $pdo->prepare(
        "INSERT INTO usuarios(email, password_hash, rol)
         VALUES(:email, :hash, 'usuario')"
    );

    $stmt->execute([
        ':email' => $email,
        ':hash' => $hash
    ]);

    return [
        'success' => true,
        'errores' => []
    ];
}