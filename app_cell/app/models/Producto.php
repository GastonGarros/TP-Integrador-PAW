<?php
namespace App\Model;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class Producto  extends Base {

   private $table = "Producto";
   private $primaryKey = "idProductos";
   //se usa para filtrar el contenido de las consultas
   private $columns = [
      "id" =>"idProductos",
      "name"=>"nombre",
      "priceV"=>"PrecioVenta",
      "image"=> "imagen"

      
   ];
   public function __construct(\PDO $db){
      $validations = new Validations();
      parent::__construct($db);
      $this->log = new Logger('App_bytecell');
      $this->log->pushHandler(new StreamHandler('../logs/Productos.log', Logger::DEBUG));
     
   }
  
public function findAll(){
/*
creo la sentencia sql para pasar algunos parametros de finidos de columns, esto sirve 
para una breve descripcion del producto ordenados por mas visitados y con un limite de 10 producto
*/
   $sql = sprintf(
      'select %s from %s WHERE estado =1 ORDER BY visitas ASC LIMIT 0,10',
      implode(', ',array_values($this->columns)),
      $this->table
      
  );
   $sentencia = $this->db->prepare($sql);
   $sentencia->execute();
   $producto = $sentencia->fetchAll();

//agrego la imagen al resultado de la consulta
/*  $p=array();
  foreach($producto as $key => $val) {
   //print "$key = $val <br>";
   if($val['imagen']!=""){
      //agregao en el campo imagen la ruta de la imagen
      $val['imagen']=("view/".$val['imagen']);
         
   }
   $p[$key]=$val;
   
}*/

$this->log->info('listo todos los productos con descripcion de '.$this->table);
 return $producto;
}


public function deleteProducto($valor){
   //$valor es el valoor del id que voy a eliminar
   //creo un array para editar esos valores pasados como parametro al update
   $col = ["estado"=>"0",
         "idProductos"=>$valor   
      ];
      $this->log->info("DELETE logico del producto $valor");
   return parent::update($this->table,$col,$this->primaryKey);
   

}

public function insertProducto( $parameters){

   
        //falta descriminar si el producto ya esta cargado pero con estado 0

        $sentencia = $this->db->prepare("SELECT * FROM Productos WHERE $parameters = :valor");
        $sentencia->execute(compact('valor'));
        $this->log->info('Consulta el id '.$variable.' de '.$table);
        return $sentencia->fetch();

        //return parent::findId($this->primaryKey,'6',$this->table);
    

}
//valor es el filtro del where
public function productoItem($valor){
   $stmt = $this->db->prepare("SELECT idProductos, nombre, PrecioVenta, tipo_publico, imagen, Cantidad FROM Producto 
   INNER JOIN Stock on Producto.idProductos = Stock.Producto_idProducto
   where idProductos= :valor and estado=1 ");
   
   $stmt->execute(compact('valor'));
   $arr = $stmt->fetchAll();
   if($arr){
      $stmt2 = $this->db->prepare("UPDATE Producto SET visitas = visitas +1 where idProductos= :valor");
      $stmt2->execute(compact('valor'));
      $this->log->info("UPDATE de visitas en el producto $valor ");
   }else{
      return false;
   }
   $this->log->info("SELECT del producto $valor ");
    
  
   return  $arr;
}

private function agregarPath($arg){

   foreach ($arg as $key => $value) {
      
         if($value['imagen'] !=""){
           //agrego la foto al elemento
            
               //agregao en el campo imagen la ruta de la imagen
               $value['imagen']=("view/".$value['imagen']);
               
           
         
         }
      
   }
   return $arg;
}

public function busquedap($arg){
   if(array_key_exists('pag',$arg)){// si existe la pagina me muevo a la pagina elegida 
      $pmax = $arg*10;
      $pmin=$pmax-10;
   }else{//muestro los primero articulos
      $pmax = 10;
      $pmin=0;
   }
   $search = "%$arg[search]%";
   $stmt = $this->db->prepare("SELECT * FROM Producto WHERE nombre LIKE ? and estado=1 ");
  //busca para contar cantidad total
   $stmt->execute([$search]);
   $count = strval($stmt->rowcount());
 //limita la busqueda--- mejorar de alguna forma esta consulta con la anterior
   $stmt= $this->db->prepare("SELECT * FROM Producto WHERE nombre LIKE ? and estado=1 LIMIT $pmin,$pmax");
   $stmt->execute([$search]);

   $arr = $stmt->fetchAll();
   $arr=$this->agregarPath($arr);
   if(!$arr){
      $this->log->info("BUSQUEDA del los producto que contienen $search no exitosa ");
      return false;
   } //exit('No rows');
   //agrego la cantidad de resultados
  
   $arr[] =['resultados'=>$count];
   $this->log->info("BUSQUEDA del los producto que contienen $search con $count elementos");
return $arr;

}

}