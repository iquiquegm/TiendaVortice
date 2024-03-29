<!DOCTYPE html>
<?php

// CONSOLA DE PHP
function consola($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}

//VERIFCACION DE DATOS DE SESION
session_start();
if (isset($_SESSION['telefono'])) {
    consola("Si hay datos de sesión.");
    header("Location: index.php");
    die();
}
include "conector.php";
consola("Telefono: " . $_SESSION['telefono']);

// DATOS DE LOS CLIENTES
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
$clientes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row;
}
}
consola("Clientes leídos con éxito.");
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
    <form action="validaCliente.php" id="formaEnvio" method="post">
        <input type="hidden" name="existente" id="existente" value="false" autocomplete="off">
        <label for="telefono">Telefono: </label>
        <input type="tel" id="telefono" name="telefono" placeholder="123-456-7890" pattern="[0-9]{3}\-[0-9]{3]\-[0-9]{4}" value="" form="formaEnvio" required >
        <label for="correo">Correo: </label>
        <input type="email" name="correo" id="correo"  form="formaEnvio" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" form="formaEnvio">
        <input type="submit" value="Aceptar" id="aceptar" >
    </form>

    <!-- JAVASCRIPT -->

    <script>
        clientes = <?php echo json_encode($clientes); ?>;
        clienteExistente = document.getElementById("existente");
        // clienteExistente.value = "true";
        campoCorreo = document.getElementById('correo');
        campoNombre = document.getElementById('nombre');

        //COMPARA TELEFONO CON REGISTRO EXISTENTE
        function buscaRegistro(numero) {
            console.log(numero);
            for (let i = 0; i < clientes.length; i++) {
            if (clientes[i].whatsapp === numero) {
                campoCorreo.value = clientes[i].correo;
                console.log(campoCorreo.value);
                campoNombre.value = clientes[i].nombre;
                console.log(campoNombre.value);
                document.getElementById('correo').readOnly = true;
                document.getElementById('nombre').readOnly = true;
                document.getElementById('aceptar').disabled = false;
                clienteExistente.value = "true";
                break;
            } else {
                clienteExistente.value = "false";
            }
}
    }

// Get the input field element
const telefonoInput = document.getElementById('telefono');

// Add an event listener to the input field
telefonoInput.addEventListener('input', function() {
  // Get the value of the input field
  const telefonoValue = telefonoInput.value;

  // Remove any existing dashes from the value
  const telefonoNoDashes = telefonoValue.replace(/-/g, '');

  // Check if the value is a valid telephone number
  const isValidTelephone = /^\d{10}$/.test(telefonoNoDashes);

  // If the value is a valid telephone number, add dashes to it
  if (isValidTelephone) {
    const telefonoWithDashes = telefonoNoDashes.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
    telefonoInput.value = telefonoWithDashes;
    buscaRegistro(telefono.value);
  } else {
    // If the value is not a valid telephone number, remove any dashes from it
    const telefonoNoFormat = telefonoValue.replace(/-/g, '');
    telefonoInput.value = telefonoNoFormat;
  }
});

function cambiaStatus() {
    console.log("Campo: " + this.value);
}


    </script>
</body>