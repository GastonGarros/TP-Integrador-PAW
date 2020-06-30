// variable con una función que genera una conexión AJAX genéricamente
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
	        	_funcion(resultado); // Arma los sliders con la respuesta del server
	      	}

	      	if (this.readyState == 4 && this.status == 404) {
	        	console.error(this.responseText);
	        	_funcion({ // Arma un slider de error?
	          		id: "id?",
	          		src: "/",
	          		desc: "desc?",
	        	});
	      	}
	    };
	    xmlhttp.open("POST", "view/test/" + _URL + ".js"); //URL forzada para testing
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

// Función para crear elementos del slider usando la función "nuevoElemento" e irlos insertando en el slider
var sliderLoader = function(response) {
	var _response = response || {};

	function sliderFirstLoad() {
		//aca voy creando cada imagen del slider. osea el figure con su img, figcaption y div
		var figure = nuevoElemento("figure", {class: "mySlide", style: "display: none;"}, ""),
			img = nuevoElemento("img", {class: "mySlideImg", src: _response.src, alt: "Imagen del producto."}, ""),
			figcaption = nuevoElemento("figcaption", {class:"slideDesc"}, _response.desc);
			div = nuevoElemento("div", {class: "divIdImg"}, _response.id);
		figure.appendChild(img);
		figure.appendChild(figcaption);
		figure.appendChild(div);
		document.getElementById("sliderContainer").prepend(figure);
	}

	function sliderLoadImg() {

	}

	return {
		sliderFirstLoad : sliderFirstLoad
	}
}