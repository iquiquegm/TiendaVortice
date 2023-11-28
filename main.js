 // FUNCIONES

    // CAMBIA LA IMAGEN DEL PRODUCTO
    function cambiaImagen(){
        console.log("Cambio de imagen");
        selector = document.getElementById("selectorModelo");
        idProducto = selector.selectedOptions[0].value;
        imagen = document.getElementById("imagenModelo");
        imagen.src = "imagenes/" + productos[idProducto - 1].nombre + ".png";
        modeloFinal = productos[idProducto - 1].descripcion;
        precioModelo = parseInt(productos[idProducto - 1].precio, 10);
        document.getElementById("formaModelo").value = idProducto;
        infoFinal.innerHTML = modeloFinal;
        if (grabadosFinal != "") {
            infoFinal.innerHTML = infoFinal.innerHTML + ", Número de Grabados: " + grabadosFinal;
        }
        infoFinal.style.display = "block";
        document.getElementById("selectorGrabados").style.display = "block";
        banderaColor = 0;
        validaForma();
    }

    //ACTUALIZA EL CATALOGO DE COLORES
    function actualizaColores(){
    console.log("Actualización de colores.");
    document.getElementById("formaColor").value = "";
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
        document.getElementById("formaColor").value = idColor;
        infoFinal.innerHTML = modeloFinal + ", " + colorFinal;
        banderaColor = 1;
        validaForma();
    }

    //VISUALIZADOR DE SECCIONES DE GRABADO
    function seccionesGrabado() {
        selector = document.getElementById("selectorGrabados");
        numeroGrabados = selector.selectedOptions[0].value;
        switch(numeroGrabados){
            case "0":
                document.getElementById("informacionGrabado1").style.display = "none";
                document.getElementById("informacionGrabado2").style.display = "none";
                precioGrabado = "";
                banderaGrabados = 2;
                break;
            case "1":
                document.getElementById("informacionGrabado1").style.display = "block";
                document.getElementById("informacionGrabado2").style.display = "none";
                precioGrabado = parseInt(grabados[0].precio, 10);
                banderaGrabados = 1;
                break;
            case "2":
                document.getElementById("informacionGrabado1").style.display = "block";
                document.getElementById("informacionGrabado2").style.display = "block";
                precioGrabado = parseInt(grabados[0].precio, 10) + parseInt(grabados[1].precio, 10);
                banderaGrabados = 0;
                break;
        }
        grabadosFinal = numeroGrabados;
        document.getElementById("formaGrabados").value = numeroGrabados;
        infoFinal.innerHTML = modeloFinal + ", " + colorFinal + ", Número de Grabados: " + grabadosFinal;
        validaForma();
    }

    //ACTUALIZACION DE PRECIOS
    function actualizaPrecios() {
        console.log("Actualiza Precios");
        precioFinal = precioModelo + precioGrabado;
        textoPrecio = "$" + precioFinal + ".00";
        document.getElementById("precioSeleccionado").innerHTML = textoPrecio;
        document.getElementById("formaPrecio").value = precioFinal;
    }

    //CAPTURA DEL TEXTO DE GRABADOS
    function actualizaTexto(selector) {
        console.log("Cambio en el texto.");
        textoTemp = document.getElementById("descripcion" + selector).value;
        textoFinal[selector - 1] = textoTemp;
        if (textoTemp == "") {
            banderaTexto[selector - 1] = 0;
        } else {
            banderaTexto[selector - 1] = 1;
        }
        console.log(banderaTexto[selector - 1]);
        validaForma();
        document.getElementById("formaDescripcion" + selector).value = textoTemp;
    }

    //ACTUALIZA LA IMAGEN DEL GRABADO
    function actualizaImagenGrabado(selector) {
        console.log("Actualiza Imagen de Grabado");
        imagenSubir = document.getElementById("rutaImagenLocal" + selector);
        imagenVistaPrevia = document.getElementById("imagenLocal" + selector);
        archivo = imagenSubir.files[0];
        if (archivo && archivo.type.startsWith("image/")) {
            lector = new FileReader();
            lector.onload =() => {
                imagenVistaPrevia.src = lector.result;
            };
            lector.readAsDataURL(archivo);
        } else {
            console.log("Tipo de archivo no válido.");
        }
        imagenFinal[selector] = archivo;
        document.getElementById("formaImagen" + selector).value = archivo;
        console.log(imagenFinal[selector]);
    }

    //BORRA IMAGEN DE GRABADO
    function borraImagenGrabado(selector) {
        console.log("Borra imagen de grabado.");
        document.getElementById("rutaImagenLocal" + selector).value = [];
        document.getElementById("imagenLocal" + selector).src = "imagenes/LogoVortice.png";
        imagenFinal[selector] = "";
        document.getElementById("formaImagen" + selector).value = "";
    }

    //ACTIVACION O DESACTIVACION DE BOTON ENVIAR
    function validaForma() {
        console.log("Valida Forma.");
        botonEnvio = document.getElementById("formaBoton");
        banderaFinal = banderaColor + banderaGrabados + banderaTexto[0] + banderaTexto[1];
        console.log(banderaGrabados);
        console.log(banderaTexto[0]);
        if (banderaFinal < 3) {
            botonEnvio.disabled = true;
        } else {
            botonEnvio.disabled = false;
        }
    }