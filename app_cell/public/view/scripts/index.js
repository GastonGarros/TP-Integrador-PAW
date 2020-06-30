/*
function init() {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            buildHome(this.responseText);
        }

        if (this.readyState == 4 && this.status == 404) {
            console.error(this.responseText);
        }
    };
    ajax.open("GET", "/start", true);
    ajax.send();
}

function buildNav(nav_elements) {
    // aca va el armado del nav
    console.log("Ejecutando buildNav");
    console.log(nav_elements);
}

function buildMain(main_elements) {
    // aca va el armado del main
    console.log("Ejecutando buildMain");
    console.log(main_elements);
}

function buildFooter(footer_links) {
    // aca va el armado del footer
    console.log("Ejecutando buildFooter");
    console.log(footer_links);
}

function buildHome(contenido) {
    objeto = JSON.parse(contenido);
    buildNav(objeto["nav"]);
    buildMain(objeto["main"]);
    buildFooter(objeto["nav"]);
}

window.onload = function() {
    init();
};
*/