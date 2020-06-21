/*
var a = "TESTING";
document.getElementById("mainH1").innerHTML = a;
alert(TEST);
*/

// Creando los botones para los sliders y su contenido
function createButtonsSlider(contenedorId) {
      var contenedor = document.getElementById(contenedorId),
      elemButtonLeft = document.createElement("button"),
      elemButtonRight = document.createElement("button"),
      contentButtonLeft = document.createTextNode("<"),
      contentButtonRight = document.createTextNode(">");

      // Seteo el contenido a los botones (en este caso "<" y ">")
      elemButtonLeft.appendChild(contentButtonLeft);
      elemButtonRight.appendChild(contentButtonRight);

      // Seteo los atributos de los botones
      elemButtonLeft.setAttribute("class", "botonSliderIzq");
      elemButtonLeft.setAttribute("id", "botonSliderIzq");
      elemButtonRight.setAttribute("class", "botonSliderDer");
      elemButtonRight.setAttribute("id", "botonSliderDer");

      // Seteo los event listener de los botones
      elemButtonLeft.addEventListener("click", slideBack);
      elemButtonRight.addEventListener("click", slideForward);

      // Inserto los botones en el documento
      contenedor.appendChild(elemButtonLeft);
      contenedor.appendChild(elemButtonRight);
}

// Creando via javascript las miniaturas
function createSliderMinis(contenedorId) {
      // Creo una variable con el contenedor de los elementos y luego creo dichos elementos
      var contenedor = document.getElementById(contenedorId),
      elemFigureLeft = document.createElement("figure"),
      elemFigureRight = document.createElement("figure"),
      elemImgLeft = document.createElement("img");
      elemImgRight = document.createElement("img");

      // Seteo los atributos de la miniatura izquierda e inserto el elemento "img" dentro del elemento "figure"
      setAttributes(elemFigureLeft, {"class": "mySlideLeft"});
      setAttributes(elemImgLeft, {"id": "mySlideLeftImg", "alt": "Foto anterior"});
      elemFigureLeft.appendChild(elemImgLeft);

      // Seteo los atributos de la miniatura derecha e inserto el elemento "img" dentro del elemento "figure"
      setAttributes(elemFigureRight, {"class": "mySlideRight"});
      setAttributes(elemImgRight, {"id": "mySlideRightImg", "alt": "Foto siguiente"});
      elemFigureRight.appendChild(elemImgRight);

      // Inserto los elementos en el documento
      contenedor.appendChild(elemFigureLeft);
      contenedor.appendChild(elemFigureRight);
            
      // Pequeña función utilizada sólo dentro de la función createSliderMinis, para facilitar el seteo de los atributos
      function setAttributes(element, attributes) {
            for(var key in attributes) {
                  element.setAttribute(key, attributes[key]);
            }
      }
}

function slideBack(){ // Esta función se dispara al hacer click en el botón "<". A la slide actual se le va a restar una posición
      showDivs(-1);
}

function slideForward(){ // Esta función se dispara al hacer click en el botón ">". A la slide actual se le va a sumar una posición
      showDivs(1);
}

function showDivs(n) { // Sumarle o restarle 1 a la slide actual y mostrarla
      var slides = document.getElementsByClassName("mySlide"),
      imgsSrc = new Array(),
      imgs = document.getElementsByClassName("mySlideImg"),
      hasMiniSlides = false;

      slideIndex += n; // slideIndex es la nueva posición

      if (document.getElementsByClassName("mySlideLeft").length > 0 && document.getElementsByClassName("mySlideRight").length > 0){ //Verifico que haya mini slides
            hasMiniSlides = true;
      }

      if (slideIndex > slides.length) { // La slide siguiente a la útlima es la primera
            slideIndex = 1;
      } 

      if (slideIndex < 1) { // La slide anterior a la primera es la útlima
          slideIndex = slides.length;
      } 

      if (hasMiniSlides) { // Calculo los nuevos valores de las posiciones de las miniaturas (izquierda y derecha)
            var slideIndexLeft, slideIndexRight;
            if (slideIndex == 1){ 
                  slideIndexLeft = slides.length;
                  slideIndexRight = slideIndex + 1;
            } else if (slideIndex == slides.length){
                  slideIndexLeft = slideIndex - 1;
                  slideIndexRight = 1;
            } else {
                  slideIndexLeft = slideIndex - 1;
                  slideIndexRight = slideIndex + 1;
            }
      }

      for (var i = 0; i < slides.length; i++) { // Primero, oculto todas las imágenes grandes
            slides[i].style.display = "none";
            if (hasMiniSlides) {imgsSrc[i] = imgs[i].getAttribute("src");} // Aprovecho este bucle para cargar los nombres de las imágenes
      }

      slides[slideIndex-1].style.display = "block"; // Luego, muestro sólo la imagen correspondiente
      if (hasMiniSlides){
            document.getElementById("mySlideLeftImg").setAttribute("src", imgsSrc[slideIndexLeft-1]); // Actualizo el campo "src" de la miniatura izquierda
            document.getElementById("mySlideRightImg").setAttribute("src", imgsSrc[slideIndexRight-1]); // Actualizo el campo "src" de la miniatura derecha
      }

}

// Comienzo del script
var slideIndex = 0; // Variable global que contiene el índice actual del slider de ventas
window.onload = function() {
      if (document.getElementsByClassName("mySlide").length > 0) { // Verifico que efectivamente haya imágenes para mostrar en el slider
            var sliderContainerId = "sliderContainer"; // ID del contenedor del slider

            createButtonsSlider(sliderContainerId);
            if (document.getElementsByClassName("mySlide").length > 2) { createSliderMinis(sliderContainerId); }
            showDivs(1); // Dado que slideIndex se inicializa en 0, le sumo 1 la primera vez, para que la primera slide a mostrar sea la primera
      }
}


