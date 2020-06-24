<?php

namespace App\Model;

class Stock extends Base{

 
    public function findAll(){
        
        return parent::findAlll("Stock");
        
     }
     
}