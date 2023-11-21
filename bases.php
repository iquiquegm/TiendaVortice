<?php


//LECTURA DE BASES DE DATOS

// PRODUCTOS
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
$productos = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
}
}
consola("Productos leídos con éxito.");

// EXISTENCIAS
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);
$existencias = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $existencias[] = $row;
}
}
consola("Existencias leídas con éxito.");

// COLORES
$sql = "SELECT * FROM colores";
$result = $conn->query($sql);
$colores = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $colores[] = $row;
}
}
consola("Colores leídos con éxito.");

// GRABADOS
$sql = "SELECT * FROM grabados";
$result = $conn->query($sql);
$grabados = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $grabados[] = $row;
}
}
consola("Grabados leídos con éxito.");

?>