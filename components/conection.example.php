<?php
$servidor = "";
$usuario = "";
$password = ""; 
$base_datos = ""; 

// Crear la conexión usando MySQLi
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar si hubo un error al conectar
if ($conexion->connect_error) {
    // Si falla, detenemos todo y mostramos el error
    die("Conexión fallida: " . $conexion->connect_error);
}

// Configurar la codificación de caracteres para que acepte tildes y la letra ñ correctamente
$conexion->set_charset("utf8mb4");
?>