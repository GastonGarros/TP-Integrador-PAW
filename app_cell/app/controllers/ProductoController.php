<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use App\Model\Producto ;
use App\Model\MercadoPago;
class ProductoController{
    public function __construct(ContainerInterface $container, Producto $model)
    {
        $this->container = $container;
        $this->model = $model;
    }

    public function index($request, $response, $args){
        $movies = $this->model->findAll();
        $response->getBody()->write(\json_encode($movies));
        return $response->withHeader('Content-Type', 'application/json');  
    }
    public function store($request, $response, $args)
    {
        $params = $request->getParsedBody();
         $id = $this->model->insertProducto($params);
      //  $id = $this->model->insert("Producto",$params);
        $response->getBody()->write(\json_encode($id));
        return $response->withHeader('Content-Type', 'application/json');  

    } 

     public function read($request, $response, $args){
        $producto = $this->model->productoItem($args['id']);
        $response->getBody()->write(\json_encode($producto));
     return $response->withHeader('Content-Type', 'application/json');

       
    }
    
    public function delete ($request, $response,$args){
     
        $rep = $this->model->deleteProducto($args['id']);
        $response->getBody()->write(\json_encode($rep));
        return $response->withHeader('Content-Type', 'application/json');  
    }
    public function busqueda ($request, $response,$args){
     
        $rep = $this->model->busquedap($args);
        $response->getBody()->write(\json_encode($rep));
        return $response->withHeader('Content-Type', 'application/json');  
    }
    public function mp ($request, $response,$args){
        require 'app/models/MercadoPAgo.php';
     $params = $request->getParsedBody();
      $response->getBody()->write(\json_encode($params));
        return $response->withHeader('Content-Type', 'application/json');  


    }
}   