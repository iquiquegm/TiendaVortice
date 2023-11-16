<?php

$servername = "localhost";
$username = "enrique";
$password = "3nri9u3";
$dbname = "tienda";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Fallo de conexión: ". $conn->connect_error);
}
consola ("Conexión exitosa.");

?>