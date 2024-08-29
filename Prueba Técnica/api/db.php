<?php
//creando conexion a la base de datos
$host = "localhost";
$db_name = "php_api_restful";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
?>