/*
var a = "TESTING";
document.getElementById("mainH1").innerHTML = a;
console.log(a);
alert(a);
*/

// ##########################################
// ###### Funciones para goToTopButton ######
// ##########################################

function goToTopFunction() { // Función que hace scroll top
    document.documentElement.scrollTop = 0;
}

// ##########################################
// # Funciones para el form del diagnóstico #
// ##########################################

function activateDiagForm() {
    document.getElementById("diagButton").style.display = "none";
    document.getElementById("formDiag").style.display = "flex";
}


// ############################################
// ###### Comienzo del código del Script ######
// ############################################

//var aux2; //Variable de testing para arreglar el problema de sync
document.addEventListener("DOMContentLoaded", function () { // Todo el código se carga luego de que se haya cargado el documento

      // #### Código para el manejo del goToTopButton y el cambio del nav al scrollear ####
      var goToTopButton = document.getElementById("goToTop");
      goToTopButton.addEventListener("click", goToTopFunction); // Le doy el evento al botón goToTopButton
      window.onscroll = function() {scrollFunction()}; // Cuando se hace scroll, se llama la la función scrollFunction

      function scrollFunction() {
          if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) { // Si el scroll es lo suficientemente bajo...
              goToTopButton.style.display = "block"; // Se muestra el botón goToTopButton
              document.getElementById("navContainer").className = "navContainerMini"; // Le cambio la clase al nav para que se muestre más compacto
          } else { // Si el scroll NO es lo suficientemente bajo...
              goToTopButton.style.display = "none"; // Oculto el botón goToTopButton
              document.getElementById("navContainer").className = "navContainer"; // Le cambio la clase al nav para que se muestre con normalidad
          }
      }

      // #### Código para el manejo del slider ####
      /*aux2 = document.getElementsByClassName("mySlide");//Testing
      console.log(aux2);//Testing*/
      if (document.getElementsByClassName("mySlide").length > -1) { // (0) Verifico que efectivamente haya imágenes para mostrar en el slider
            var sliderContainerId = "sliderContainer"; // ID del contenedor del slider
            createButtonsSlider(sliderContainerId); // Llamo a la función para crear los botones del slider, pasandole el contenedor
            if (document.getElementsByClassName("mySlide").length > -1) { createSliderMinis(sliderContainerId); } // (2) Sólo creo miniaturas para el slider si hay más de dos imágenes en el slider
            showDivs(1); // Dado que slideIndex se inicializa en 0, le sumo 1 la primera vez, para que la primera slide a mostrar sea siempre la primera
      }

      // #### Código para darle la funcionalidad al botón del diagnóstico ####
      //document.getElementById("diagButton").setAttribute("onclick", "activateDiagForm()");
});


