<?php
namespace App\Model;
use App\Model\Validations;
class Persona  extends Base {

  //Seteo la tabla 
  private $table = "Persona"; 
   private $tableHija = "user";
   private $primaryKey= "nro_doc";

 /* 
public function __construct(\PDO $db){
   $validations = new Validations();
   parent::__construct($db);
}*/



public function find($id){
   
   return parent::findId($this->primaryKey,$id,$this->table);
}


//Metodos Para Persona

public function findPersona($id){
   return parent::findId($this->primaryKey,$id,$this->table);

}
public function findAllPersona(){
        
   return parent::findAlll($this->table);
    
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
      
      $col = ["estado"=>"0",
         "idProductos"=>$valor   
      ];
      //baja logica de una persona
      return parent::update($this->table,$col,$this->primaryKey);

     
   }else{
      return $this->validations->getMensaje();
   }
} 





}