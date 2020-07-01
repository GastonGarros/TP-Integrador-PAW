<?php
namespace App\Controller;

use Psr\Container\ContainerInterface;
use App\Model\Persona ;
use Slim\Views\PhpRenderer;



class PersonaController{
    public function __construct(ContainerInterface $container, Persona $model)
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
       
        $status = $this->model->insertUser($params);
        $response->getBody()->write(\json_encode($status));
        return $response->withHeader('Content-Type', 'application/json');  

    } 

    public function update($request, $response, $args)
    {
        $params = $request->getParsedBody();
       //envia los parametros al metodo de la clasePersona
        $id = $this->model->updateUser($params);
        $response->getBody()->write(\json_encode($params));
        return $response->withHeader('Content-Type', 'application/json');  

    } 
    public function loggin($request, $response, $args)
    {
        $params = $request->getParsedBody();
      /*  \session_start();
        $_SESSION['sesion_iniciada'] = true;
        $_SESSION['nombre'] = "PEDRO";
        
      */  
      $response = new Response();
        
        $status = $this->model->loggin($params);
        $response->getBody()->write(\json_encode($status) );
        return $response->withHeader('Content-Type', 'application/json');  

    }  

    public function deleteUser ($request, $response,$args){
     
        $rep = $this->model->deleteUser($args['id']);
        $response->getBody()->write(\json_encode($rep));
        return $response->withHeader('Content-Type', 'application/json');  
    }
  
    
    public function indexPersona($request, $response, $args){
        $movies = $this->model->findAllPersona();
        $response->getBody()->write(\json_encode($movies));
        return $response->withHeader('Content-Type', 'application/json');  
    }

    public function readPersona($request, $response, $args){
        $movie = $this->model->find($args['id']);
        $response->getBody()->write(\json_encode($movie));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function storePersona($request, $response, $args)
    {
        $params = $request->getParsedBody();
       
       //envia los parametros al metodo de la clasePersona
        $id = $this->model->insertPersona($params);
        $response->getBody()->write(\json_encode($id));
        return $response->withHeader('Content-Type', 'application/json');  

    } 
    public function updatePersona($request, $response, $args)
    {
        $params = $request->getParsedBody();
       //envia los parametros al metodo de la clasePersona
        $id = $this->model->updatePersona($params);
        $response->getBody()->write(\json_encode($params));
        return $response->withHeader('Content-Type', 'application/json');  

    }   
    
    public function deletePersona ($request, $response,$args){
     
        $rep = $this->model->deletePersona($args['id']);
        $response->getBody()->write(\json_encode($rep));
        return $response->withHeader('Content-Type', 'application/json');  
    }
  /*  public function i ($request, $response,$args){
        $phpView = new PhpRenderer("../app/views");
        //$response->getBody()->write('<h1>Hello world!</h1>');
        $response = $phpView->render($response, "index.html", $args);
    return $response;
    }*/
}