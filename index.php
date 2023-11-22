<?php
// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}

include "conector.php";
include "bases.php";

?>

<!-- ENCABEZADO DE LA PAGINA -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grabado de Termo</title>
</head>

<!-- CUERPO DE LA PAGINA -->
<body>
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
   <div id="informacionGrabado1" style="display:none;">
    <textarea name="Descrippcion1" id="descripcion1" cols="30" rows="10" placeholder="Escriba la descripción de su grabado."></textarea>
    <input type="file" name="ImagenLocal1" id="rutaImagenLocal1" accept="image">
    <img src="imagenes/LogoVortice.png" alt="Imagen 1" id="imagenLocal1" width="100px">
    <input type="button" value="Borrar" id = "borraImagen1">    
   </div>

   <!-- CAPTURA DE DATOS DE GRABADO 2 -->
   <div id="informacionGrabado2" style="display:none;">
    <textarea name="Descrippcion2" id="descripcion2" cols="30" rows="10" placeholder="Escriba la descripción de su grabado."></textarea>
    <input type="file" name="ImagenLocal2" id="rutaImagenLocal2" accept="image">
    <img src="imagenes/LogoVortice.png" alt="Imagen 2" id="imagenLocal2" width="100px">
    <input type="button" value="Borrar" id = "borraImagen2">
   </div>

   <!-- FORMA A SER ENVIADA -->
   <form action="#" id="formaCompra">
    <input type="hidden" name="modelo" id="formaModelo" value="Modelo">
    <input type="hidden" name="color" id="formaColor" value="Color">
    <input type="hidden" name="texto1" id="formaDescripcion1" value="Descripcion">
    <input type="hidden" name="imagen2" id="formaImagen2" value="Imagen">
    <input type="hidden" name="texto2" id="formaDescripcion2" value="Descripcion">
    <input type="hidden" name="imagen2" id="formaImagen2" value="Imagen">
    <input type="submit" value="Agregar">
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
    infoFinal = document.getElementById("informacionSeleccionado");
    
    //SELECTOR DE EVENTOS
    document.getElementById("selectorModelo").addEventListener("change", function() {cambiaImagen();});
    document.getElementById("selectorModelo").addEventListener("change", function() {actualizaColores();});
    document.getElementById("selectorModelo").addEventListener("change", function() {actualizaPrecios();});
    document.getElementById("selectorGrabados").addEventListener("change", function() {seccionesGrabado();});
    document.getElementById("selectorGrabados").addEventListener("change", function() {actualizaPrecios();});
    document.getElementById("rutaImagenLocal1").addEventListener("change", function() {actualizaImagenGrabado("rutaImagenLocal1", "imagenLocal1");});
    document.getElementById("rutaImagenLocal2").addEventListener("change", function() {actualizaImagenGrabado("rutaImagenLocal2", "imagenLocal2");});
    document.getElementById("borraImagen1").addEventListener("click", function() {borraImagenGrabado("rutaImagenLocal1", "imagenLocal1");});
    document.getElementById("borraImagen2").addEventListener("click", function() {borraImagenGrabado("rutaImagenLocal2", "imagenLocal2");});
   </script>
</body>
</html>