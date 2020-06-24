<?php

namespace App\Model;

class Venta extends Base{

    private $cliente;
    private $listProductos;

  /*  public function __construct(\PDO $db    ){
        $this->db = $db;
    }   
*/
    public function getCliente(){
        $this->insert();
        return $this->cliente->getNombre();
    }
    
    public function findAll(){
        
        return parent::findAlll("Venta");
        
     }
     

}