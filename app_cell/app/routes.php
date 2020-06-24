<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Model\Session;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', Session::class);
        $group->get('/{id}', ViewUserAction::class);
    });
//metodos HTTP
  
    
    //metodos sobre usuarios
    $app->get('/user', 'ClienteController:index');
    $app->get('/user/{id}', 'ClienteController:read');
    $app->post('/user/register', 'ClienteController:store');
    $app->put('/user', 'ClienteController:update');
    $app->post('/loggin', 'ClienteController:loggin');
 //   $app->get('/user/logout', 'ClienteController:logout');
    $app->delete('/user/{id}', 'ClienteController:deleteUser');  

    // datos personales
    $app->get('/personas', 'ClienteController:indexPersona');
    $app->get('/personas/{id}', 'ClienteController:readPersona');
    $app->post('/personas', 'ClienteController:storePersona');
    $app->put('/personas', 'ClienteController:updatePersona');
    $app->delete('/personas/{id}', 'ClienteController:deletePersona');  
     //Metodos sobre user
    // $app->get('/user', 'BaseController:index');
  
   //Metodos sobre Productos
    $app->get('/productos', 'ProductoController:index');
    $app->get('/productos/{id}', 'ProductoController:read');
    $app->post('/productos', 'ProductoController:store');
    $app->delete('/productos/{id}', 'ProductoController:delete'); 
    
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
