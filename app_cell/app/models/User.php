<?php
namespace App\Model;
use App\Model\Validations;
use App\Model\Session;
class User  extends Persona {

  //Seteo la tabla 
 
   private $table = "user";
   private $primaryKey= "nro_doc";
   private $session ;
   private $mensaje;
   private $rol;
  
public function __construct(\PDO $db){
   $validations = new Validations();
   parent::__construct($db);
}

public function findAll(){
   return parent::findAlll($this->table);

    
}

public function find($id){
   
   return parent::findId($this->primaryKey,$id,$this->table);
}

public function deleteUser($valor){
   return parent::delete($this->table,$this->primaryKey,$valor);


}



public function insertUser($params){

   if($this->validations->ValidUser($params['username'],$params['password'],$params['email'],$params['rol'])){
      $params['password'] = password_hash($params['password'],PASSWORD_DEFAULT);
      return parent::insert($this->table,$params);
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

private function hashLogin($user,$pass){
   ///  hashBD se usan para verificar la contraseña
   //$hashUser = password_hash($pass,PASSWORD_DEFAULT);
  
   $sentencia = $this->db->prepare("SELECT password, rol FROM user WHERE username = :user or email = :user");
   $sentencia->execute(compact('user'));
   $result = $sentencia->fetch();
   $this->rol = $result['rol'];
//verifica el pass extraido de la base de datos y compara 
   if(password_verify($pass,$result['password'])){
     
      return true;
  }else{

   return false;
  }
   
}

public function login($params){

if($this->validations->ValidLogin($params['user'], $params['password'])){
 
  if( $this->hashLogin($params['user'], $params['password'])){//usuario y password validos
      $this->session = new Session();
      $this->session->setSession('user',$params['user']); //guardo el ususario en la session
      $this->session->setSession('rol',$this->rol); //agrego el rol a la clase para luego usarlo en la variable sesion
      return  "Session iniciada con el usuario: ".$this->session->getSession('user');
  }
}else{
   //los parametros del usuario son incorrecto
   return $this->validations->getMensaje();
}

   
}
//metodo que cierra la sesion
public function logout(){
   $this->session = new Session();
   //si haya sesion iniciada cierra la sesion, sino envia un mensaje
   if($this->session->exist('user')){
      $this->session->closeSession();
      $this->mensaje['mensaje'] = "sesion cerrada " ;
      
   }else{
      $this->mensaje['mensaje'] = "sesion no iniciada";
      
   }
   return $this->mensaje;
}
}