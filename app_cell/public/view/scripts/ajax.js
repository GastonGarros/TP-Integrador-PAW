// Variable con una función que genera una conexión AJAX genéricamente
// Recibe la URL a la cual debe conectarse y la función que debe ejecutar con la respuesta que reciba del server
var AJAX = function (URL, funcionDeCallback) {
	var _URL = URL || {},
    	_funcion = funcionDeCallback || {};

  	loadXMLDoc();

	function loadXMLDoc() {
 		var xmlhttp = new XMLHttpRequest();

	    xmlhttp.onreadystatechange = function() {
	    	if (this.readyState == 4 && this.status == 200) {
	    		var resultado = JSON.parse(this.responseText);
	        	_funcion(resultado); 
	      	} else

	      	if (this.readyState == 4 && this.status == 404) {
	      		console.error("Página no encontrada - Respuesta del servidor: ");
	        	console.error(this.responseText);
	        	//_funcion(resultado);
	      	} else { 
	      		/*console.error("Error desconocido - Respuesta del servidor: ");
	      		console.error(this.responseText);*/
	      	}
	    };
	    xmlhttp.open("GET",  _URL);
	    xmlhttp.send();
	}
};

// Funcion para crear genéricamente un elemento
function nuevoElemento(tag, atributos, contenido) {		
	var atributos = atributos || {},
    	contenido = contenido || "",
    	elemento = document.createElement(tag);
    for (const propiedad in atributos) {
    	elemento.setAttribute(propiedad, atributos[propiedad]);
    }

    if (!contenido.tagName) elemento.innerHTML = contenido;
    else elemento.appendChild(contenido);

    return elemento;
}

//Función que recibe las imágenes del slider pidiéndoselas al servidor mediante AJAX, y luego crea los elementos HTML correspondientes y los inserta al DOM
function sliderFirstLoad() {
	var a = new AJAX("/productos", function(response) {
		var _response = response || {};
    	for (var i in _response) {
    		//aca voy creando cada imagen del slider. osea el figure con su img, figcaption y div
			var figure = nuevoElemento("figure", {class: "mySlide", style: "display: none;"}, ""),
				img = nuevoElemento("img", {class: "mySlideImg", src: _response[i].imagen, alt: "Imagen del producto.", onclick: "sliderOnClick("+_response[i].idProductos+")"}, ""),
				figcaption = nuevoElemento("figcaption", {class:"slideDesc"}, "Nombre del producto: " + _response[i].nombre);
				div = nuevoElemento("div", {class: "divIdImg"}, _response[i].idProductos),
				span = nuevoElemento("span", {class: "tooltiptextSlider"}, "Click para ver más datos de: " + _response[i].nombre);
			figure.appendChild(img);
			figure.appendChild(figcaption);
			figure.appendChild(div);
			figure.appendChild(span);
			document.getElementById("sliderContainer").prepend(figure);
    	}
    });
}

//Función que pide mediante AJAX datos adicionales al servidor sobre el producto seleccionado
function sliderOnClick(id) {
	var _id = id || {},
		e = e || window.event,
		target = e.target || e.srcElement,
		a = new AJAX("/productos/" + id, function(response){
			var _response = response || {},
				slides = document.getElementsByClassName("slideDesc");
				console.log(_response);
			if (_response[0] != null) {
				slides[slideIndex-1].innerHTML += " - " + "Precio: $"+ _response[0].PrecioVenta + " - " + "Stock: " + _response[0].Cantidad;
			} else {
				slides[slideIndex-1].innerHTML += " - " + "No hay información adicional.";
			}
		});
}

sliderFirstLoad(); //El slider se carga



/*
var sliderLoader = function(response) {
	
	}

	return {
		sliderFirstLoad : sliderFirstLoad
	}
}*/