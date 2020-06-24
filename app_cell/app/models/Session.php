<?php
declare(strict_types=1);

namespace App\Model;
use Slim\Psr7\Factory\ResponseFactory;;
use Psr\Http\Message\ResponseInterface as Response;

class Session extends Action
{
    public function __construct()
    {
    }
    protected function action(): Response
    {
        //$users = $this->userRepository->findAll();
        $users['id'] ="asdas";
     //   $this->logger->info("Users list was viewed.");
        $responseFactory = new ResponseFactory();
        $response = $responseFactory->createResponse();
        $response->getBody()->write(\json_encode($users));
return $response;
       // return $this->respondWithData($users);
    }
}
