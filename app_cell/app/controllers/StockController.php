<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use App\Model\Stock ;

class StockController{
    public function __construct(ContainerInterface $container, Stock $model)
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
       
        $id = $this->model->insert("Stock",$params);
        $response->getBody()->write(\json_encode($params));
        return $response->withHeader('Content-Type', 'application/json');  

    } 
}