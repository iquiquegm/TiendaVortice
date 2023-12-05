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
    // header("Location: index.php");
    echo "Si existe.";
    die();    
}
echo "No existe el registro.";
include "conector.php";

// Prepare the SQL statement
$sql = "INSERT INTO clientes (nombre, whatsapp, correo) VALUES (?,?,?)";
echo "Preparando...";

// Bind the parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_POST['nombre'], $_POST['telefono'], $_POST['correo']);
echo "<br>". $_POST['nombre']. "<br>";

// Execute the statement
$stmt->execute();
echo "Ejecutando...<br>";

// Close the statement and connection
$stmt->close();
$conn->close();

echo "Agregado.";
?>

