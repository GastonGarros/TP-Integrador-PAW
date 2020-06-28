<?php
namespace App\Model;

class Cliente  extends Base {

  //Seteo la tabla 
  private $table = "Persona"; 
   private $tableHija = "user";
   private $primaryKey= "nro_doc";

 /* 
public function __construct(\PDO $db){
   $validations = new Validations();
   parent::__construct($db);
}*/

public function findAll(){
   return parent::findAlll($this->tableHija);

    
}

public function find($id){
   
   return parent::findId($this->primaryKey,$id,$this->table);
}

public function deleteUser($valor){
   return parent::delete($this->tableHija,$this->primaryKey,$valor);


}

//Metodos Para Persona

public function findPersona($id){
   return parent::findId($this->primaryKey,$id,$this->table);

}
public function findAllPersona(){
        
   return parent::findAlll($this->table);
    
}
public function insertUser($params){

   if($this->validations->ValidUser($params['username'],$params['password'],$params['email'],$params['rol'])){
   return parent::insert($this->tableHija,$params);
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
public function insertPersona($params){

   if($this->validations->ValidPersona($params['nro_doc'],$params['nombre'],$params['apellido'],$params['tipo_doc'],$params['fecha_nac'],$params['domicilio'],$params['email'],$params['telefono'],$params['estado'])){
   return parent::insert($this->table,$params);
 }else{
    return $this->validations->getMensaje();
 }
  
}
public function updatePersona($params){
        
   //llamo al update base con los parametros necesaios para el update, en $params estan los nuevos valores
   //y el el 3er parametro es el filtro del update correspondiente a esa tabla
   if($this->validations->ValidPersona($params['nro_doc'],$params['nombre'],$params['apellido'],$params['tipo_doc'],$params['fecha_nac'],$params['domicilio'],$params['email'],$params['telefono'],$params['estado'])){
      return parent::update($this->table,$params,$this->primaryKey);
    }else{
       return $this->validations->getMensaje();
    }
   
    
}

public function deletePersona($valor){
   //$valor es el valoor del id que voy a eliminar
  //valido que el numero de documento sea correcto
   if($this->validations->ValDoc($valor)){
      return parent::delete($this->table,$this->primaryKey,$valor);
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
private function validationPersona($params){

   foreach ($values as $item => $value){
      if(!isset($value)){
         return false;
      }else{
         
      }
 }
}

}