<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use App\Model\Venta ;

class VentaController{
    public function __construct(ContainerInterface $container, Venta $model)
    {
        $this->container = $container;
        $this->model = $model;
    }

    public function index($request, $response, $args){
        $result = $this->model->findAll();
        $response->getBody()->write(\json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');  
    }
    
}