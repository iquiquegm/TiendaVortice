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

//CARGA DATOS DE SERVIDOR
include "conector.php";
include "bases.php";

//CREA VARIABLES Y TOMA VALORES
$nombre = $_SESSION['nombre'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$grabados = $_POST['grabados'];
$precio = $_POST['precio'];
$texto1 = $_POST['texto1'];
$imagen1 = $_POST['imagen1'];
$texto2 = $_POST['texto2'];
$imagen2 = $_POST['imagen2'];

//CREAR REGISTRO DEL ARTICULO
$articulo = array(
    'modelo' => $modelo,
    'color' => $color,
    'precio' => $precio,
    'grabados' => $grabados,
    'texto1' => $texto1,
    'imagen1' => $imagen1,
    'texto2' => $texto2,
    'imagen2' => $imagen2
);
print_r($articulo);

//DATOS DEL MODELO
$descripcion = $productos[$modelo]['descripcion'];
$nombreColor = $colores[$color]['nombre'];
$valorColor = $colores[$color]['valor'];

//CARGA IMAGEN DEL MODELO
$foto = "imagenes/". $productos[$modelo]['nombre'] . ".png";
echo $foto;
echo "<img src='".$foto."'>";

//CARGA DE IMAGENES
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if a file was selected for upload
    if (isset($_FILES["imagenLocal1"])) {
        echo $_FILES['imagenLocal1'];
        // Specify the directory where you want to save the uploaded image
        $uploadDirectory = "disenos/";

        // Get the file details
        $fileName = $_FILES["imagenLocal1"]["name"];
        echo "<br>Archivo: ". $fileName. "<br>";
        $fileTempName = $_FILES["imagenLocal1"]["tmp_name"];
        $fileSize = $_FILES["imagenLocal1"]["size"];
        $fileError = $_FILES["imagenLocal1"]["error"];
        $fileType = $_FILES["imagenLocal1"]["type"];

        // Generate a unique name for the uploaded file
        $uniqueName = uniqid($_SESSION['telefono'], false) . '_' . $fileName;

        // Specify the path where the file will be saved
        $uploadPath = $uploadDirectory . $uniqueName;

        // Check if the file was uploaded without errors
        if ($fileError === 0) {
            // Move the uploaded file to the specified directory
            move_uploaded_file($fileTempName, $uploadPath);

            echo "File uploaded successfully. File path: " . $uploadPath;
        } else {
            echo "Error uploading file. Error code: " . $fileError;
        }
    } else {
        echo "No file selected for upload.";
    }
    // Check if a file was selected for upload
    if (isset($_FILES["imagenLocal2"])) {
        echo $_FILES['imagenLocal2'];
        // Specify the directory where you want to save the uploaded image
        $uploadDirectory = "disenos/";

        // Get the file details
        $fileName = $_FILES["imagenLocal2"]["name"];
        echo "<br>Archivo: ". $fileName. "<br>";
        $fileTempName = $_FILES["imagenLocal2"]["tmp_name"];
        $fileSize = $_FILES["imagenLocal2"]["size"];
        $fileError = $_FILES["imagenLocal2"]["error"];
        $fileType = $_FILES["imagenLocal2"]["type"];

        // Generate a unique name for the uploaded file
        $uniqueName = uniqid($_SESSION['telefono'], false) . '_' . $fileName;

        // Specify the path where the file will be saved
        $uploadPath = $uploadDirectory . $uniqueName;

        // Check if the file was uploaded without errors
        if ($fileError === 0) {
            // Move the uploaded file to the specified directory
            move_uploaded_file($fileTempName, $uploadPath);

            echo "File uploaded successfully. File path: " . $uploadPath;
        } else {
            echo "Error uploading file. Error code: " . $fileError;
        }
    } else {
        echo "No file selected for upload.";
    }
}

session_unset();
session_destroy();
?>
