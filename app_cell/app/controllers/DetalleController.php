<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use App\Model\Detalle ;

class DetalleController{
    public function __construct(ContainerInterface $container, Detalle $model)
    {
        $this->container = $container;
        $this->model = $model;
    }

    public function index($request, $response, $args){
        $movies = $this->model->findAll();
        $response->getBody()->write(\json_encode($movies));
        return $response->withHeader('Content-Type', 'application/json');  
    }
    public function read($request, $response, $args){
        $movie = $this->model->find($args['id']);
        $response->getBody()->write(\json_encode($movie));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function store($request, $response, $args)
    {
        $params = $request->getParsedBody();
       
        $id = $this->model->insert("Detalle",$params);
        $response->getBody()->write(\json_encode($params));
        return $response->withHeader('Content-Type', 'application/json');  

    } 
  
    
    
}