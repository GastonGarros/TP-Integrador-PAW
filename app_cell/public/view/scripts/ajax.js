// Variable con una función que genera una conexión AJAX genéricamente
// Recibe la URL a la cual debe conectarse y la función que debe ejecutar con la respuesta que reciba del server
var x;
var AJAX = function (URL, formData, funcionDeCallback,) {
	var _URL = URL || {},
    	_funcion = funcionDeCallback || {},
    	_formData = formData || null;

  	ajaxRequest();

	function ajaxRequest() {
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

	    if (_formData == null) {
		    xmlhttp.open("GET",  _URL);
		    xmlhttp.send();
		} else 

	   	if (_formData != null) {
	    	//Código para generar la petición AJAX pasandole el FormData

	    }
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
	var a = new AJAX("/productos", null, function(response) {
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
//var x = document.querySelector(".sliderContainer figure[style='display: block;']"); //otra forma de capturar la imagen clickeada?
function sliderOnClick(id) {
	var _id = id || {},
		e = e || window.event,
		target = e.target || e.srcElement,
		a = new AJAX("/productos/" + id, null, function(response){
			var _response = response || {},
				slides = document.getElementsByClassName("slideDesc");
			if (_response[0] != null) {
				slides[slideIndex-1].innerHTML += " - " + "Precio: $"+ _response[0].PrecioVenta + " - " + "Descripción: " + _response[0].descripcion;
			} else {
				slides[slideIndex-1].innerHTML += " - " + "No hay información adicional.";
			}
		});
		target.removeAttribute("onclick");
}

function userLogin() {
	//Código para generar un FormData con los datos ingresados para el login. Los pasos a seguir son:
	//1- Generar el FormData con los datos ingresados en el login usando:
	//var formData = new FormData();
	//formData.append(name, value);
	//2- Crear una instancia de AJAX pasándole:
	//Como 1er parámetro: la url "/login"
	//Como 2do parámetro: el formData con los datos cargados
	//Como 3er parámetro: la funcionDeCallback, la cual determina los pasos a seguir según la respuesta del servidor
	console.log("Pendiente de implementar");
}

sliderFirstLoad(); //El slider se carga



/*
var sliderLoader = function(response) {
	
	}

	return {
		sliderFirstLoad : sliderFirstLoad
	}
}*/