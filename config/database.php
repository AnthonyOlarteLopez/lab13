<?php
$host = "aws-1-us-west-2.pooler.supabase.com";
$port = "5432";
$dbname = "postgres";
$user = "postgres.vsehmmplucxjklemcose";
$password = "dbclientes20##";

try {

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Error de conexión: " . $e->getMessage());

}