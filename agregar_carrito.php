<?php
// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}
// VERIFICA SI HAY SESION ABIERTA
session_start();
if(!isset($_SESSION['nombre'])) {
    echo "No hay sesión abierta.";    
    header("Location: index.php");
    die();
} 


session_unset();
session_destroy();
?>
