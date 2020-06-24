<?php
namespace App\Model;

class Detalle  extends Base {

  //Seteo la tabla  
   private $table = "Detalle";
  
public function findAll(){
        
   return parent::findAlll($this->table);
    
}

public function find($id){
   return parent::findId("idDetalle",$id,$this->table);
}

}