<?php

namespace App\Model;

class HashProdCat extends Base{

 
    public function findAll(){
        
        return parent::findAlll("Producto_has_Categoria");
        
     }
     
}