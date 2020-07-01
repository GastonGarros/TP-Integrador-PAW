<?php
namespace App\Model;
use App\Model\Validations;
class User  extends Persona {

  //Seteo la tabla 
 
   private $table = "user";
   private $primaryKey= "nro_doc";

  
public function __construct(\PDO $db){
   $validations = new Validations();
   parent::__construct($db);
}

public function findAll(){
   return parent::findAlll($this->table);

    
}

public function find($id){
   
   return parent::findId($this->primaryKey,$id,$this->table);
}

public function deleteUser($valor){
   return parent::delete($this->table,$this->primaryKey,$valor);


}



public function insertUser($params){

   if($this->validations->ValidUser($params['username'],$params['password'],$params['email'],$params['rol'])){
   return parent::insert($this->table,$params);
 }else{
    return $this->validations->getMensaje();
 }
  
}

public function updateUser($params){
        
   //llamo al update base con los parametros necesaios para el update, en $params estan los nuevos valores
   //y el el 3er parametro es el filtro del update correspondiente a esa tabla
   if($this->validations->ValidPersona($params['nro_doc'],$params['nombre'],$params['apellido'],$params['tipo_doc'],$params['fecha_nac'],$params['domicilio'],$params['email'],$params['telefono'],$params['estado'])){
      return parent::update($this->table,$params,$this->primaryKey);
    }else{
       return $this->validations->getMensaje();
    }
   
    
}



public function loggin($params){
 /* session_start();
  $_SESSION['name']='1';
*/
 return  $this->validationLoggin($params);

  //return $this->validationLoggin($params['user']);
   
}

private function validationLoggin($params){
   //retorno falso si no completaron los campos de user o pass
   if(!isset($params['user'])|| ($params['user'] =="") || (strlen($params['pass']) >16) || (strlen($params['pass']) <8)|| ($params['pass']=="") || (!isset($params['pass'])) ){
		
		return false;
	}else{

   
   return true;//isset($params['user']);
   }
}


}