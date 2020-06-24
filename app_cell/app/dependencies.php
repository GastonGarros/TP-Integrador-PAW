<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        'db' => function(ContainerInterface $c){
            $settings = $c->get('settings');
          
            $db = $settings['db'];
           
            $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'] . ';port=' . $db['port'],
           $db['user'], $db['pass']);
           // $pdo = new PDO('mysql:host=localhost;dbname=moviedb;port=3306',
            //  "root", "root");
                    
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        },
      
        'ClienteController' => function(ContainerInterface $c){
            $model = new \App\Model\Cliente($c->get('db'));
            return new \App\Controller\ClienteController($c, $model);
        },
        'VentaController' => function(ContainerInterface $c){
            $model = new \App\Model\Venta($c->get('db'));
            return new \App\Controller\VentaController($c, $model);
        },
        'ProductoController' => function(ContainerInterface $c){
            $model = new \App\Model\Producto($c->get('db'));
            return new \App\Controller\ProductoController($c, $model);
        },
        'DetalleController' => function(ContainerInterface $c){
            $model = new \App\Model\Detalle($c->get('db'));
            return new \App\Controller\DetalleController($c, $model);
        },
        'CategoriaController' => function(ContainerInterface $c){
            $model = new \App\Model\Categoria($c->get('db'));
            return new \App\Controller\CategoriaController($c, $model);
        },
        'StockController' => function(ContainerInterface $c){
            $model = new \App\Model\Stock($c->get('db'));
            return new \App\Controller\StockController($c, $model);
        },
        
        'HashProdCatController' => function(ContainerInterface $c){
            $model = new \App\Model\HashProdCat($c->get('db'));
            return new \App\Controller\HashProdCatController($c, $model);
        },
    ]);
};
