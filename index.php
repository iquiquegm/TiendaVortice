<!DOCTYPE html>
<?php
// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}

//VERIFICACION DE DATOS DE SESION
session_start();
if (!isset($_SESSION['telefono'])) {    
    header("Location: login.php");
    die();
}
include "conector.php";
include "bases.php";
if (isset($_SESSION['modeloCarrito'])) {
    $existencias = $_SESSION['existencias'];
    // Find the index of the row that matches the conditions
$foundIndex = -1; // Default value if not found

foreach ($existencias as $index => $row) {
    if ($row['id_producto'] === $_SESSION['modeloCarrito'] && $row['id_color'] === $_SESSION['colorCarrito']) {
        $foundIndex = $index;
        break; // Exit the loop once a match is found
    }
}

// If a matching row is found, update the 'cantidad' value
if ($foundIndex !== -1) {
    $existencias[$foundIndex]['cantidad'] -= 1;
    // Optionally, handle the case where 'cantidad' becomes negative if needed
    $_SESSION['existencias'] = $existencias;
}

} else {
    $_SESSION['existencias'] = $existencias;
}

//VERIFICA SI HAY QUE DESCONTAR EXISTENCIA
echo "Carrito: ". $_SESSION['cuentaCarrito'];

echo "Cliente: ". $_SESSION['nombre'];
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
    <div id="user"></div>
   <img src="imagenes/LogoVortice.png" width="100px" alt="Modelo Seleccionado" id="imagenModelo">
   <div id="informacionSeleccionado" style="display: none;">
    Modelo, Color y Cantidad de Grabados
   </div>
   <div id="precioSeleccionado">
    0
   </div>
   <select name="Modelo" id="selectorModelo">
   
   <!--LLENADO DEL SELECTOR DE MODELOS -->
   <?php 
    foreach ($productos as $producto) {
        echo '<option nombre="' . $producto["nombre"] . '" value="' . $producto["id"] . '">' . $producto["descripcion"] . '</option>';
    }   
    consola("Modelos cargados en Selector.");
    ?>
   </select>

   <!-- CATALOGO DE COLORES -->
   <?php
    foreach ($colores as $color){
        echo '<div class="muestraColor" id="' . $color["id"] . '"style="width:50px; height:50px; background:#' . $color["valor"] . '; border: 2px solid grey; border-radius:50%; display:none; cursor:pointer;" onclick="seleccionaColor(' . $color["id"] . ')">';
        echo '<div class="cantidadColor" id="cantidad' . $color["id"] . '">';
        echo '1';
        echo '</div>';
        echo '</div>';
    }
   ?>
   <!-- SELECTOR DE NUMERO DE GRABADOS -->
   <select name="Grabados" id="selectorGrabados" style="display:none; ">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
   </select>

   <!-- CAPTURA DE DATOS DE GRABADO 1 -->
   <form action="agregar_carrito.php" id="formaCompra" method="post" enctype="multipart/form-data">
   <div id="informacionGrabado1" style="display:none;">
    <textarea name="Descrippcion1" id="descripcion1" cols="30" rows="10" placeholder="Escriba la descripción de su grabado."></textarea>
    <input type="file" name="imagenLocal1" id="rutaImagenLocal1" accept="image">
    <img src="imagenes/LogoVortice.png" alt="Imagen 1" id="imagenLocal1" width="100px">
    <input type="button" value="Borrar" id = "borraImagen1">    
   </div>

   <!-- CAPTURA DE DATOS DE GRABADO 2 -->
   <div id="informacionGrabado2" style="display:none;">
    <textarea name="Descrippcion2" id="descripcion2" cols="30" rows="10" placeholder="Escriba la descripción de su grabado."></textarea>
    <input type="file" name="imagenLocal2" id="rutaImagenLocal2" accept="image">
    <img src="imagenes/LogoVortice.png" alt="Imagen 2" id="imagenLocal2" width="100px">
    <input type="button" value="Borrar" id = "borraImagen2">
   </div>
   

   <!-- FORMA A SER ENVIADA -->
    <input type="hidden" name="modelo" id="formaModelo" value="1">
    <input type="hidden" name="color" id="formaColor" value="">
    <input type="hidden" name="grabados" id="formaGrabados" value="0">
    <input type="hidden" name="precio" id="formaPrecio" value="0">
    <input type="hidden" name="texto1" id="formaDescripcion1" value="">
    <input type="hidden" name="imagen1" id="formaImagen1" value="">
    <input type="hidden" name="texto2" id="formaDescripcion2" value="">
    <input type="hidden" name="imagen2" id="formaImagen2" value="">
    <input type="submit" value="Agregar al Carrito" id="formaBoton" disabled>
   </form>

   <!-- JAVASCRIPT -->

   <script src="main.js"></script>
   <script>

    //VARIABLES GLOBALES
    productos = <?php echo json_encode($productos); ?>;
    existencias = <?php echo json_encode($existencias); ?>;
    colores = <?php echo json_encode($colores); ?>;
    grabados = <?php echo json_encode($grabados); ?>;
    colorFinal = "";
    modeloFinal = "";
    grabadosFinal ="";
    precioFinal = 0;
    precioModelo = 0;
    precioGrabado = 0;
    textoFinal = [];
    imagenFinal =[];
    banderaColor = 0;
    banderaGrabados = 2;
    banderaTexto = []
    banderaFinal = 0;
    infoFinal = document.getElementById("informacionSeleccionado");
    
    //SELECTOR DE EVENTOS
    document.getElementById("selectorModelo").addEventListener("change", function() {cambiaImagen();});
    document.getElementById("selectorModelo").addEventListener("change", function() {actualizaColores();});
    document.getElementById("selectorModelo").addEventListener("change", function() {actualizaPrecios();});
    document.getElementById("selectorGrabados").addEventListener("change", function() {seccionesGrabado();});
    document.getElementById("selectorGrabados").addEventListener("change", function() {actualizaPrecios();});
    document.getElementById("rutaImagenLocal1").addEventListener("change", function() {actualizaImagenGrabado(1);});
    document.getElementById("rutaImagenLocal2").addEventListener("change", function() {actualizaImagenGrabado(2);});
    document.getElementById("borraImagen1").addEventListener("click", function() {borraImagenGrabado(1);});
    document.getElementById("borraImagen2").addEventListener("click", function() {borraImagenGrabado(2);});
    document.getElementById("descripcion1").addEventListener("blur", function() {actualizaTexto(1);});
    document.getElementById("descripcion2").addEventListener("blur", function() {actualizaTexto(2);});
    cambiaImagen();
    actualizaColores();
    actualizaPrecios();
    seccionesGrabado();
    actualizaTexto(1);
    actualizaTexto(2);
    validaForma();
   </script>
</body>
</html>