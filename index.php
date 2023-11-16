<?php
// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}

//CONEXION A BASE DE DATOS
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
   <select name="Grabados" id="selectorGrabados">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
   </select>

   <!-- CAPTURA DE DATOS DE GRABADO 2 -->
   <div id="informacionGrabado1" style="display:none;">
    <textarea name="Descrippcion1" id="descripcion1" cols="30" rows="10" placeholder="Escriba la descripción de su grabado."></textarea>
    <input type="file" name="ImagenLocal1" id="rutaImagenLocal1" accept="image">
    <img src="imagenes/LogoVortice.png" alt="Imagen 1" id="imagenLocal1" width="100px">
    <input type="button" value="Borrar">    
   </div>

   <!-- CAPTURA DE DATOS DE GRABADO 2 -->
   <div id="informacionGrabado2" style="display:none;">
    <textarea name="Descrippcion2" id="descripcion2" cols="30" rows="10" placeholder="Escriba la descripción de su grabado."></textarea>
    <input type="file" name="ImagenLocal2" id="rutaImagenLocal2" accept="image">
    <img src="imagenes/LogoVortice.png" alt="Imagen 2" id="imagenLocal2" width="100px">
    <input type="button" value="Borrar">
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
   <script>

    //VARIABLES GLOBALES
    productos = <?php echo json_encode($productos); ?>;
    existencias = <?php echo json_encode($existencias); ?>;
    colores = <?php echo json_encode($colores); ?>;
    colorFinal = "";
    modeloFinal = "";
    grabadosFinal ="";
    infoFinal = document.getElementById("informacionSeleccionado");
    
    //SELECTOR DE EVENTOS
    document.getElementById("selectorModelo").addEventListener("change", function() {cambiaImagen();});
    document.getElementById("selectorModelo").addEventListener("change", function() {actualizaColores();});
    document.getElementById("selectorGrabados").addEventListener("change", function() {seccionesGrabado();});


    // FUNCIONES

    // CAMBIA LA IMAGEN DEL PRODUCTO
    function cambiaImagen(){
        console.log("Cambio de imagen");
        selector = document.getElementById("selectorModelo");
        idProducto = selector.selectedOptions[0].value;
        imagen = document.getElementById("imagenModelo");
        imagen.src = "imagenes/" + productos[idProducto - 1].nombre + ".png";
        modeloFinal = productos[idProducto].descripcion;
        infoFinal.innerHTML = modeloFinal;
        if (grabadosFinal != "") {
            infoFinal.innerHTML = infoFinal.innerHTML + ", Número de Grabados: " + grabadosFinal;
        }
        infoFinal.style.display = "block";
    }

    //ACTUALIZA EL CATALOGO DE COLORES
    function actualizaColores(){
    console.log("Actualización de colores.");
    modeloSeleccionado = selector.selectedOptions[0].value;
    document.querySelectorAll(".muestraColor").forEach(function(color) {
        color.style.display = "none";
    });
    existencias.forEach(function(modelo) {
        if (modelo.id_producto == modeloSeleccionado) {
            colorModelo = modelo.id_color;
            document.getElementById(colorModelo).style.display = "inline-block";
            document.getElementById("cantidad" + colorModelo).innerHTML = modelo.cantidad;
        }
    });
    }

    //SELECCIONA COLOR
    function seleccionaColor(idColor) {
        console.log("Seleccion de Color.");
        colorFinal = colores[idColor -1].nombre;
        infoFinal.innerHTML = modeloFinal + ", " + colorFinal;
    }

    //VISUALIZADOR DE SECCIONES DE GRABADO
    function seccionesGrabado() {
        selector = document.getElementById("selectorGrabados");
        numeroGrabados = selector.selectedOptions[0].value;
        switch(numeroGrabados){
            case "0":
                document.getElementById("informacionGrabado1").style.display = "none";
                document.getElementById("informacionGrabado2").style.display = "none";
                break;
            case "1":
                document.getElementById("informacionGrabado1").style.display = "block";
                document.getElementById("informacionGrabado2").style.display = "none";
                break;
            case "2":
                document.getElementById("informacionGrabado1").style.display = "block";
                document.getElementById("informacionGrabado2").style.display = "block";
                break;
        }
        grabadosFinal = numeroGrabados;
        infoFinal.innerHTML = modeloFinal + ", " + colorFinal + ", Número de Grabados: " + grabadosFinal;
    }
   </script>
</body>
</html>