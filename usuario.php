<?php

// Importar conexion
require 'includes/config/database.php';
$db = ConnectDB();
// Crear un email y password
$email = "amezcua041196@gmail.com";
$password = "atenea07";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

var_dump($passwordHash);

// Query para crear el usuario
$query = "INSERT INTO usuario( email, password) VALUES ( '${email}', '${passwordHash}');";
// echo $query;

// Agregarlo a la BD
mysqli_query($db, $query);


?>