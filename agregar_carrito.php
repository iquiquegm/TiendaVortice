<?php
// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}
// Start the session
session_start();

// Check if a session variable is set
if (isset($_SESSION['telefono'])) {
  // If not, set a session variable
 echo "Sesión abierta.<br>";
 echo "Teléfono: ". $_SESSION['telefono']. "<br>";
 include "conector.php";
 include "bases.php";
 $producto = $productos[$_GET["modelo"] - 1]["descripcion"];
 consola ($producto);
 echo "Producto: ". $producto;
 $color = $colores[$_GET["color"] - 1]["nombre"];
 echo "<br>Color: ". $color;
 $texto1 = $_GET["texto1"];
 echo "<br>Grabado 1: ". $texto1;
} else {
    echo ("No hay sesión.");
}
session_unset();
session_destroy();
?>
