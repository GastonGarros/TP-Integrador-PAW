<?php
namespace App\Model;

class Producto  extends Base {

   private $table = "producto";
   private $primaryKey = "idProductos";
    

  
public function findAll(){
        
   return parent::findAlll($this->table);
   
}

public function deleteProducto($valor){
   //$valor es el valoor del id que voy a eliminar
   return parent::delete($this->table,$this->primaryKey,$valor);
   

}

}