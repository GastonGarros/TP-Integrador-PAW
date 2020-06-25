document.addEventListener("DOMContentLoaded", function () {
	var imgSlider = document.getElementsByClassName("mySlideImg"), imgSrc;
	
	// Le doy a las imágenes del slider el comportamiento al hacerles click
	for (var i in imgSlider) {
		var imgAttrOnclick;
		/*imgSrc = imgSlider[i].getAttribute("src");
		imgAttrOnclick = "getImgData(\"" + imgSrc + "\")";
		imgSlider[i].setAttribute("onclick", imgAttrOnclick);*/
		
		imgAttrOnclick = "getImgData(\"" + i + "\")"; // Esta variable contiene el contenido del atributo "onclick"
		imgSlider[i].setAttribute("onclick", imgAttrOnclick); // Inserto el atributo en la img
	}

});

function getImgData(imgSrc) { // Función llamada al hacer click en una img del slider
	var 
		imgSrc = imgSrc || {},
		formData = new FormData(),
		xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			//var resultado = JSON.parse(this.responseText);
			var resultado = this.responseText;
			console.log(resultado);
		}

		if (this.readyState == 4 && this.status == 404) {
			console.log("Error 404!");	
		}
	};

	formData.append("imgNumber", imgSrc);
	xmlhttp.open("POST", "app_cell/app/controllers/test.php");
	xmlhttp.send(formData);
}