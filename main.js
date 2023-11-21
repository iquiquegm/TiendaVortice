 // FUNCIONES

    // CAMBIA LA IMAGEN DEL PRODUCTO
    function cambiaImagen(){
        console.log("Cambio de imagen");
        selector = document.getElementById("selectorModelo");
        idProducto = selector.selectedOptions[0].value;
        imagen = document.getElementById("imagenModelo");
        imagen.src = "imagenes/" + productos[idProducto - 1].nombre + ".png";
        modeloFinal = productos[idProducto].descripcion;
        precioModelo = parseInt(productos[idProducto].precio, 10);
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
                precioGrabado = "";
                break;
            case "1":
                document.getElementById("informacionGrabado1").style.display = "block";
                document.getElementById("informacionGrabado2").style.display = "none";
                precioGrabado = parseInt(grabados[0].precio, 10);
                break;
            case "2":
                document.getElementById("informacionGrabado1").style.display = "block";
                document.getElementById("informacionGrabado2").style.display = "block";
                precioGrabado = parseInt(grabados[0].precio, 10) + parseInt(grabados[1].precio, 10);
                break;
        }
        grabadosFinal = numeroGrabados;
        infoFinal.innerHTML = modeloFinal + ", " + colorFinal + ", Número de Grabados: " + grabadosFinal;
    }

    //ACTUALIZACION DE PRECIOS
    function actualizaPrecios() {
        console.log("Actualiza Precios");
        precioFinal = precioModelo + precioGrabado;
        textoPrecio = "$" + precioFinal + ".00";
        document.getElementById("precioSeleccionado").innerHTML = textoPrecio;
    }