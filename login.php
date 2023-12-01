<!DOCTYPE html>
<?php

// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}

//VERIFCACION DE DATOS DE SESION
session_start();
if (isset($_SESSION['telefono'])) {
    consola("Si hay datos de sesión.");
    sleep(3);
    header("Location: index.php");
    die();
}
include "conector.php";

// DATOS DE LOS CLIENTES
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
$clientes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row;
}
}
consola("Clientes leídos con éxito.");
?>

<!-- ENCABEZADO DE LA PAGINA -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grabado de Termo</title>
</head>

<!-- CUERPO DE LA PAGINA -->
<body>
    <form action="post">
        <label for="telefono">Telefono: </label>
        <input type="tel" id="telefono" name="telefono" placeholder="123-456-7890" pattern="[0-9]{3}\-[0-9]{3]\-[0-9]{4}" required>
        <label for="correo">Correo: </label>
        <input type="email" nonmbre="correo" id="correo" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required disabled>
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" disabled>
        <input type="submit" value="Aceptar" disabled>
    </form>
</body>