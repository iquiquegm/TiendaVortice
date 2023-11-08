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
        print_r($productos);

        
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
        print_r($existencias);

        
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
        print_r($colores);

    ?>
    <form action="$" method="post" id="seleccion">
        <!-- HTML code for select component -->
        <select name="producto" onchange="cambiaImagen()" id="selector">
            <?php foreach ($productos as $producto) {?>
                <option class="campotexto" nombre="<?php echo $producto['nombre'];?>"value="<?php echo $producto['id'];?>"><?php echo $producto['descripcion'];?></option>
            <?php }?>
        </select>
        <img src="imagenes/LogoVortice.png" height="200px" id="imagenProducto">
        
    </form>

    <script>
            function cambiaImagen(){
                console.log("Funcion");
                var nuevaImagen = document.getElementById("selector");
                imagen = document.getElementById("imagenProducto");
                nombre = <?php echo json_encode($productos); ?>;
                console.log(nombre[(nuevaImagen.selectedOptions[0].value) - 1].nombre);
                imagen.src = "imagenes/" + nombre[(nuevaImagen.selectedOptions[0].value) - 1].nombre + ".png";
            }
    </script>
</body>
</html>