<?php

namespace App\Model;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use App\Model\Validations;
class Base  {
   public  $log ;
    public $validations;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
        $this ->log = new Logger('App_bytecell');
        $this->log->pushHandler(new StreamHandler('../logs/app.log', Logger::DEBUG));
        $this->validations = new Validations;
        
    }
    //valor= valor a buscar
    //variable= nombre de la variable a filtrar
    public function findId($variable,$valor, $table){
        $sentencia = $this->db->prepare("SELECT * FROM $table WHERE $variable = :valor");
        $sentencia->execute(compact('valor'));
        $this->log->info('Consulta el id '.$variable.' de '.$table);
        return $sentencia->fetch();
    }

    public function findAlll($table){
        $sentencia = $this->db->prepare("SELECT * FROM .$table");    
        $sentencia->execute();    

        $this->log->info('listo el contenido de '.$table);
        
        return $sentencia->fetchAll();        
    }

    
    public function insert($table, $parameters)
    { 
        //falta descriminar si el producto ya esta cargado pero con estado 0
        
        $sql = "INSERT INTO
        $table
        (".implode(', ', array_keys($parameters)).")
    VALUES
        (:". implode(', :', array_keys($parameters)).")";
        $sentencia = $this->db->prepare($sql);
        $sentencia->execute($parameters);
        $this->log->info('INSERT EN '.$table .' los parametros '.implode(" ,",$parameters));
        return $this->db->lastInsertId(); 
     
    }

    public function delete($table ,$col,$valor){
        $sql = "delete from $table where $col = $valor";
    $sentencia = $this->db->prepare($sql);
    $sentencia->execute();
    $this->log->info('DELETE EN '.$table .' ID = '.$valor);
    return $sentencia->execute();
      

    }


    public function update($table,$parameters,$filtro){
        //genero el sql 
        $sql = sprintf(
            'update %s set %s =? where %s= %s',
            $table,
            implode('=?, ', array_keys($parameters)),
            $filtro,
            $parameters[$filtro]
        );
            $statement = $this->db->prepare($sql);
           
            $statement->execute(array_values( $parameters));
            //log con los parametros
            $this->log->info("UPDATE en ".$table ." los parametros ".implode(" ,",$parameters));
           return $this->db->lastInsertId();
            
    }

  
}