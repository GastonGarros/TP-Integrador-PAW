<?php
namespace App\Model;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class Producto  extends Base {

   private $table = "Producto";
   private $primaryKey = "idProductos";
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
para una breve descripcion del producto
*/
   $sql = sprintf(
      'select %s from %s ',
      implode(', ',array_values($this->columns)),
      $this->table
      
  );
  $table=$this->table;
  $sql = sprintf(
   'select * from %s  where %s= %s',
   $table,
   implode('=, ', array_keys($parameters)),
   $filtro,
   $parameters[$filtro]
);

    $sentencia = $this->db->prepare($sql);
   $sentencia->execute();
   
  
  
   $producto = $sentencia->fetchAll();

//agrego la imagen al resultado de la consulta
  $p=array();
  foreach($producto as $key => $val) {
   //print "$key = $val <br>";
   if($val['imagen']!=""){
      //agregao en el campo imagen la foto en base64 segun la ruta de la imagen
      $val['imagen']=base64_encode(file_get_contents("../".$val['imagen']));
         
   }
   $p[$key]=$val;
   
}

$this->log->info('listo todos los productos con descripcion de '.$this->table);
 return $p;
}

public function find($id){
   $producto = parent::findId($this->primaryKey,$id,$this->table);
 
  //agrego la foto al elemento
    if($producto['imagen']!=""){
       //agregao en el campo imagen la foto en base64 segun la ruta de la imagen
       $producto['imagen']=base64_encode(file_get_contents("../".$producto['imagen']));
       
   }

   $this->log->info('Muestra el prodcuto'.$this->table." id ".$id );

   return $producto;
}

public function deleteProducto($valor){
   //$valor es el valoor del id que voy a eliminar
   $col = ["estado"=>"0",
         "idProductos"=>$valor   
      ];
   return parent::update($this->table,$col,$this->primaryKey);
   

}

public function insertProducto( $parameters){

   
        //falta descriminar si el producto ya esta cargado pero con estado 0

        $sentencia = $this->db->prepare("SELECT * FROM Productos WHERE $variable = :valor");
        $sentencia->execute(compact('valor'));
        $this->log->info('Consulta el id '.$variable.' de '.$table);
        return $sentencia->fetch();

        return parent::findId($this->primaryKey,'6',$this->table);
    

}

public function busquedap($arg){
   $search = "%$arg%";
   $stmt = $this->db->prepare("SELECT * FROM Producto WHERE nombre LIKE ?");
   $stmt->execute([$search]);
   $arr = $stmt->fetchAll();
   if(!$arr){
      return false;
   } //exit('No rows');
   
return $arr;

/*
$inArr = [1, 3, 5];
$clause = implode(',', array_fill(0, count($inArr), '?')); //create 3 question marks
$stmt = $pdo->prepare("SELECT * FROM myTable WHERE id IN ($clause)");
$stmt->execute($inArr);
$resArr = $stmt->fetchAll();
if(!$resArr) exit('No rows');
var_export($resArr);
$stmt = null;
*/
}

}