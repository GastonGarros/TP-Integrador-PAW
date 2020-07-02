<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Model\Session;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Psr\Container\ContainerInterface;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;
return function (App $app) {


    
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $phpView = new PhpRenderer("../app/views");
        //$response->getBody()->write('<h1>Hello world!</h1>');
        $response = $phpView->render($response, "index.html");
        return $response;

    });
    $app->get('/mercadopago', function (Request $request, Response $response) {
        $phpView = new PhpRenderer("../app/views");
       //crear un controlador y construir logica
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1; //$response->getBody()->write('<h1>Hello world!</h1>');
        $item->unit_price = 75.56;
        $preference->items = array($item);
        $preference->save();
        $arg=[
            "id"=>$preference->id
        ];
        $response = $phpView->render($response, "view.php",$arg);
        return $response;

    });

    $app->group('/users', function (Group $group) {
        $group->get('', Session::class);
        $group->get('/{id}', ViewUserAction::class);
    });
//metodos HTTP
  
    
    //metodos sobre usuarios
    $app->get('/user', 'UserController:index');
    $app->get('/user/{id}', 'UserController:read');
    $app->post('/user/register', 'UserController:store');
    $app->put('/user', 'UserController:update');
    $app->post('/user/login', 'UserController:login');
 //   $app->get('/user/logout', 'UserController:logout');
    $app->delete('/user/{id}', 'UserController:deleteUser');  

    // datos personales
    $app->get('/personas', 'PersonaController:indexPersona');
    $app->get('/personas/{id}', 'PersonaController:readPersona');
    $app->post('/personas', 'PersonaController:storePersona');
    $app->put('/personas', 'PersonaController:updatePersona');
    $app->delete('/personas/{id}', 'PersonaController:deletePersona');  
  
    $app->get('/productos', 'ProductoController:index');
    $app->get('/productos/busqueda/{search}[/{pag}]', 'ProductoController:busqueda');
    $app->get('/productos/{id}', 'ProductoController:read');
    $app->post('/productos', 'ProductoController:store');
    $app->delete('/productos/{id}', 'ProductoController:delete');
    
    $app->post('/mp', 'ProductoController:mp');
    
     //Metodos sobre Stock
     $app->get('/stock', 'StockController:index');
     $app->get('/stock/{id}', 'StockController:read');
     $app->post('/stock', 'StockController:store');

   
       //Metodos sobre HashProductoCategoria
    $app->get('/hashprodcat', 'HashProdCatController:index');
    $app->get('/hashprodcat/{id}', 'HashProdCatController:read');
    $app->post('/hashprodcat', 'HashProdCatController:store');

    $app->delete('/hashprodcat/{id}', 'HashProdCatController:delete'); 

   //Metodos sobre Detalles 
    $app->get('/detalles', 'DetalleController:index');
    $app->get('/detalles/{id}', 'DetalleController:read');
    $app->post('/detalles', 'DetalleController:store');
    
   //Metodos sobre Ventas
    $app->get('/ventas', 'VentaController:index');
    $app->get('/ventas/{id}', 'VentaController:read');
    $app->post('/ventas', 'VentaController:store');

    $app->get('/categorias', 'CategoriaController:index');
    $app->get('/categorias/{id}', 'CategoriaController:read');
    $app->post('/categorias', 'CategoriaController:store');

   
};
