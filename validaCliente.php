<?php

// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}
session_start();

// VERIFICA SI EXISTE EL CLIENTE
if ($_POST['existente'] == "true") {
    $_SESSION['telefono'] = $_POST['telefono'];
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['correo'] = $_POST['correo'];
    echo "Ya existe el registro.";
    header("Location: index.php");
    die();    
}
echo "No existe el registro.";
include "conector.php";

// Validate email address
$correo = $_POST['correo'];

$nombre = $_POST['nombre'];
$whatsapp = $_POST['telefono'];
echo $_POST['correo'];
echo "<br>". $nombre. " ". $whatsapp. " ". $correo. "<br>";
$sql = "INSERT INTO clientes (id, nombre, whatsapp, correo)
VALUES (NULL, '$nombre', '$whatsapp', '$correo')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
$_SESSION['telefono'] = $whatsapp;
$_SESSION['nombre'] = $nombre;
header("Location: index.php");
    die();
?>

