# TP-Integrador-PAW
Sistema de ventas de celulares y accesorios.

Presentación de la Idea:

Este documento describe de forma breve una visión global del alcance que este proyecto pretende tener.
Lo que se plantea desarrollar es un sistema web el cual se encargará de gestionar las ventas de una pyme dedicada a la venta de dispositivos móviles y sus accesorios, así como también de repuestos para la reparación de los mismos. A continuación se irán mencionando las diferentes secciones del sitio con sus funcionalidades. 

Nota: El diseño del sitio será una single-page application (en adelante, SPA). En la carpeta [wireframes](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes) pueden verse los wireframes tentativos para cada sección, así como también el [sitemap](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/Sitemap.png) del sitio. El título de cada sección está linkeado a su correspondiente wireframe (si lo hubiere):

## Sección [Home](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/Home.png):
La sección Home es el punto de entrada al sitio web. Al tratarse de una SPA, será la página que contendrá a todas las demás secciones.

## Sección de [Login](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/Login.png)/[Sign Up](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/SignUp.png):
El sistema contará con un sistema de login que les permitirá a los usuarios identificarse dentro del sitio; o registrarse en caso de no haberlo hecho antes. 
Existen 4 tipos de usuarios:
* **No registrados:** Pueden visitar el sitio pero no pueden realizar compras.
* **Registrados:** Pueden, además, realizar compras de dispositivos y accesorios, pero no de repuestos de reparación.
* **Gremio:** Los usuarios gremio no tienen limitaciones en cuanto a los productos que pueden comprar. Son usuarios registrados que fueron aceptados como gremio por un usuario administrador. Se tratan de técnicos en reparación de celulares.
* **Administrador:** El usuario administrador es el que se encarga de gestionar el sitio y es el único que puede convertir usuarios registrados en usuarios gremio.

## Sección de [venta de productos](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/VentaProductos.png):
La sección de venta de productos muestra todos los productos que hay a la venta (dependiendo del tipo de usuario que esté accediendo), cada uno con una imagen, una breve descripción y datos propios del producto en cuestión, tales como su precio, modelo, fabricante, colores disponibles, etc. Los usuarios registrados  y gremio pueden ir seleccionado los productos e irlos agregando a una lista. Una vez finalizada, se puede proceder a efectuar el pago del total la misma siempre y cuando haya stock suficiente. Para ello, el sitio contará con el servicio de Mercadopago, delegando las responsabilidades pertinentes al cobro a este Mashup. Una vez realizado el pago, se descuenta el stock de los productos seleccionados y se arma el pedido. Actualmente la empresa no cuenta con un servicio de envíos, con lo cual el punto de retiro será en el establecimiento.
Otra característica de esta sección será la inclusión un pequeño input de búsqueda para que los usuarios puedan buscar determinados productos en particular y facilitarles así la adquisición de los productos que deseen.

## Sección de [ver producto](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/Producto.png):
Esta sección es simplemente la página que se le mostrará al usuario cuando haga click en un producto en particular. Se le mostrarán todas las imágenes disponibles del producto, así como también todos sus datos.

## Sección de [reparaciones](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/Reparaciones.png):
Si bien el sitio web que estamos modelando se encargará únicamente de las ventas de la empresa, lo cierto es que la principal actividad de esta pyme es la reparación de dispositivos móviles. Por esto, la sección de reparaciones únicamente tendrá información y publicidad de la empresa, facilitando a los usuarios la dirección del local, sus horarios y los requisitos necesarios para poder llevar a cabo una solicitud de reparación. Cabe mencionar que para efectuar una reparación en el establecimiento, el usuario debe estar registrado en el sistema, con lo cual los usuarios que no estén registrados y quieran reparar su celular, deberán antes ser dados de alta por el empleado del establecimiento. Sin embargo, los usuarios que estén registrados vía la plataforma web también lo estarán para efectuar reparaciones.
En esta sección también habrá un botón que llevará al usuario a la sección de diagnóstico en tiempo real, una funcionalidad de la que se darán más detalles en la siguiente sección.

## Sección de [diagnóstico en tiempo real](https://github.com/GastonGarros/TP-Integrador-PAW/tree/master/Diagramas/Wireframes/DiagTiempoReal.png):
La sección de diagnóstico en tiempo real es una funcionalidad adicional cuya implementación en nuestro sitio aún está en debate. A priori, se trata de un pequeño formulario en el cual los usuarios pueden ingresar los datos de su dispositivo móvil y luego, mediante una serie de opciones pre-establecidas, determinar cuáles son las posibles fallas que pueda llegar a tener. Con toda esta información lo que se pretende es que se le pueda mostrar al usuario un presupuesto, tomando como base los precios de los repuestos cargados en el sistema.
Cabe mencionar que, de llevarse a cabo, esta funcionalidad no pretende dar un presupuesto exacto ni mucho menos, sino más bien darle al usuario una idea del coste que tendrá la reparación de su dispositivo.

## Sección de contacto:
La sección de contacto será una sección simple en la cual se le mostrará al usuario la información de la empresa y todas las formas con las que puede ponerse en contacto con la misma.


## Instalación:

La única dependencia obligatoria para instalar es la librería de XML de PHP.

sudo apt-get install php-xml
Luego, clonamos la aplicación nos posicionamos en el directorio App_cell.

cd ~/TP-Integrador-PAW/app_cell

Finalizado el proceso, ejecutamos el Servidor Web Stand-alone de PHP

php -S localhost:8000 -t public
