<?php
$host = 'localhost';
$dbname = 'empresa3';
$user = 'root';
$password = 'antonio';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
    ]);
    $mensaje = "Conexión ok";

} catch (PDOException $e) {
    $mensaje = "Error de conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Bases de datos</h3>
    <p><?=$mensaje?></p>
</body>
</html>