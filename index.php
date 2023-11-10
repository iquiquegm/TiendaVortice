<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Tienda</title>
</head>
<body>


    <?php
        include "conector.php";
        // Select data from table
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        // Store data in array
        $productos = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $productos[] = $row;
        }
        }
        // Print array
        // print_r($productos);

        
        // Select data from table
        $sql = "SELECT * FROM inventario";
        $result = $conn->query($sql);

        // Store data in array
        $existencias = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $existencias[] = $row;
        }
        }
        // Print array
        // print_r($existencias);

        
        // Select data from table
        $sql = "SELECT * FROM colores";
        $result = $conn->query($sql);

        // Store data in array
        $colores = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $colores[] = $row;
        }
        }
        // Print array
        // print_r($colores);

    ?>
    <form action="$" method="post" id="seleccion">
        <!-- HTML code for select component -->
        <select name="producto" onchange="cambiaImagen()" id="selector">
            <?php foreach ($productos as $producto) {?>
                <option class="campotexto" nombre="<?php echo $producto['nombre'];?>"value="<?php echo $producto['id'];?>"><?php echo $producto['descripcion'];?></option>
            <?php }?>
        </select>
        <img src="imagenes/LogoVortice.png" height="200px" id="imagenProducto">

        <?php

            foreach ($colores as $valorColor) {
             
                echo '<div class="color" id="' . $valorColor['id'] . '"style="width:50px; height:50px;background:#'. $valorColor['valor'] . ';border-radius:50%;display:none;" onclick="seleccionaProducto(' . $valorColor['id'] . ')">0</div>';
       
            }

        ?>
        
       
            
       
        
    </form>

    <script>

nombre = <?php echo json_encode($productos); ?>;
modelo = <?php echo json_encode($existencias); ?>;
color = <?php echo json_encode($colores); ?>;


   function cambiaImagen(){
 
    //Cambio de Imagen
    console.log(nombre);
    var nuevaImagen = document.getElementById("selector");
    var productoSeleccionado = nuevaImagen.selectedOptions[0].value;
    var imagen = document.getElementById("imagenProducto");
    console.log(nombre[(nuevaImagen.selectedOptions[0].value) - 1].nombre);
    imagen.src = "imagenes/" + nombre[productoSeleccionado - 1].nombre + ".png";

    //Cambio de Colores
    console.log("Colores");
    document.querySelectorAll('.color').forEach(function(el) {
    el.style.display = 'none';
    });
    modelo.forEach(function(modeloActual) {
        console.log(modeloActual.id_producto);
        console.log(productoSeleccionado);
        if (modeloActual.id_producto == productoSeleccionado) {
            var identificador = modeloActual.id_color;
            console.log(identificador);
            document.getElementById(identificador).style.display='block';
            document.getElementById(identificador).innerHTML = modeloActual.cantidad;
        }
    });
}

function seleccionaProducto(id) {
    var nuevaImagen = document.getElementById("selector");
    var productoSeleccionado = nuevaImagen.selectedOptions[0].value;
    console.log(nombre[productoSeleccionado - 1].descripcion);
    var colorSeleccionado = color[id].nombre;
    console.log(colorSeleccionado + id);
}

</script> 
</body>
</html>