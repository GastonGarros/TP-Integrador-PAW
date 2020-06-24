<?php

namespace App\Model;

class Categoria extends Base{

 
    public function findAll(){
        
        return parent::findAlll("Categoria");
        
     }
     
}