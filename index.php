<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        print_r($productos);
    ?>
    <form action="$" method="post" id="seleccion">
        <!-- HTML code for select component -->
        <select name="producto" onchange="cambiaImagen()" id="selector">
            <?php foreach ($productos as $producto) {?>
                <option value="<?php echo $producto['nombre'];?>"><?php echo $producto['descripcion'];?></option>
            <?php }?>
        </select>
        <img src="img/LogoVortice.png" width="200px" id="imagenProducto">
        
    </form>

    <script>
            function cambiaImagen(){
                console.log("Funcion");
                var nuevaImagen = document.getElementById("selector");
                imagen = document.getElementById("imagenProducto"); 
                imagen.src = "imagenes/" + nuevaImagen.selectedOptions[0].value + ".png";
            }
    </script>
</body>
</html>