<?php
namespace App\Model;

class Validations {

private  $mesnaje;


public function __construct(){
	

}
public function getMensaje(){
	return $this->mesnaje;
}


//Validar documento
public function ValDoc($doc){
	if(!isset($doc)|| ($doc =="") || (strlen($doc)>16)){
		$this->mesnaje['Error'] = "documento incorrecto";
		return false;
	}
	return isset($doc);
}
//Validar nombre
public function ValidNombre($nombre){
	if(!isset($nombre)|| ($nombre =="")){
		$this->mesnaje['Error'] = "Nombre incorrecto";
		return false;
	}
	return isset($nombre);
}

//Validar nombre
public function ValidApellido($apellido){
	if(!isset($apellido)|| ($apellido =="")){
		$this->mesnaje['Error'] = "Apellido incorrecto";
		return false;
	}
	return isset($apellido);
}
//validar domicilio
public function ValidDomicilio($domicilio){
	if(!isset($domicilio)|| ($domicilio =="")){
		$this->mesnaje['Error'] = "Domicilio incorrecto";
		return false;
	}
	return isset($domicilio);
}


//Validar email
public function ValidEmail($email){
	$valid = false;
	if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
		$valid = true;
	}else {
		$this->mesnaje['Error'] = "Email incorrecto";
	}
	return $valid;
}


//Validar tel
public function ValidTel($tel){
	if(!isset($tel)|| ($tel =="")){
		$this->mesnaje['Error'] = "Telefono incorrecto";
		return false;
	}
	return isset($tel);
}

//Validar ValidEstado
public function ValidEstado($estado){
//completar validacion
	return is_numeric($estado);
}

//Validar nacim (fecha nacimiento)
public function ValidNacim($nacim){

	if (isset($nacim) && $nacim < date("Y-m-d")&& ($nacim!="") ){
		return true;
	
	} else {
	
		$this->mesnaje['Error'] = "Fecha Nacimiento incorrecto";	
		
		return false;
	}
}


//Validar tipo documento 
public function TypeDoc($type){
	$typelist = array ("dni", "carnet ext.", "ruc", "pasaporte", "p. nac.","otros");
	if (in_array($type, $typelist)){
		return true;
	} else {
		$this->mesnaje['Error'] = "tipo documento incorrecto";	
		return false;
	}
}

//validar user
public function ValUser($user){
	if(!isset($user)|| ($user =="")){
		$this->mesnaje['Error'] = "User incorrecto";
		return false;
	}
	return isset($user);

}

//validar user
public function ValPass($pass){
	if(!isset($pass)|| ($pass =="")){
		$this->mesnaje['Error'] = "Password incorrecto";
		return false;
	}
	return isset($pass);

}

//Validar tipo rol 
public function ValidRol($rol){
	$rollist = array ("gremio", "general", "administrador", "");
	if (in_array($rol, $rollist)){
		return true;
	} else {
		$this->mesnaje['Error'] = "Rol incorrecto";	
		return false;
	}
}
//Validar imgSubida
public function ValidImg($imgSubida){
	$valid = false;
	if ($imgSubida["error"] == 4){ 	//No es obligatorio subir una img. En caso de error #4...
		$valid = true;				//... es que no se ha subido una img; se debe continuar.
	} else {
		$imgExt = $imgSubida['type'];
		$validExt = ["image/jpeg", "image/png"];
  		if (in_array($imgExt, $validExt)) {
  			$valid = true;
  		}
  	}
  	return $valid;
}
//funcion que restringe el tamaño del archivo
public function imgSize($img){
	if($img['size']<80000000){
		return true;
	}else{
		return false;
	}

}

//Valido todos los parametros de persona al mismo tiempo en una sola funcion
public function ValidPersona($doc ,$nombre,$apellido, $typeDoc,$fechaNac,$domicilio, $email, $tel, $estado) {
	//if ($this->ValDoc($doc) && $this->ValidNombre($nombre) && $this->ValidApellido($apellido)&& $this->TypeDoc($typeDoc) && $this->ValidNacim($fechaNac) && $this->ValidDomicilio($domicilio)  && $this->ValidEmail($email) && $this->ValidTel($tel) && $this->ValidEstado($estado) ) {
		if ($this->ValDoc($doc) && $this->ValidNombre($nombre) && $this->ValidApellido($apellido)&& $this->TypeDoc($typeDoc) && $this->ValidNacim($fechaNac) && $this->ValidDomicilio($domicilio)  && $this->ValidEmail($email) && $this->ValidTel($tel) && $this->ValidEstado($estado) ){

		return true;
	} else {
		return false;
	}
}

public function ValidUser($user,$pass,$email,$rol){
	if($this->ValUser($user)&&$this->ValPass($pass)&& $this->ValidEmail($email)&& $this->ValidRol($rol)){
		return true;
	} else {
		return false;
	}
}
public function ValidLogin($user,$pass){
	if($user!=null){	
		if(stristr("@",$user)===false){
			if($this->ValUser($user)&&$this->ValPass($pass)){
				return true;
			} else {
				$this->mesnaje['Error'] = "User o Password incorrecto";
				return false;
			}
		}else{
			if($this->ValPass($pass)&& $this->ValidEmail($email)){
				return true;
			} else {
				$this->mesnaje['Error'] = "Email o Password incorrecto";
				return false;
			}
		}
	}else{
		$this->mesnaje['Error'] = "User incorrecto";
		return false;
	}
}
//Almacena una img valida y devuelve el path relativo de la misma
//En el archivo README.md hay una explicacion con mayor detalle de lo que contiene cada variable
public function saveImg($imgSubida){
	 $imgFolderPath = "app_cell/image/"; //Path de la carpeta donde se guardan las imgs
	 $imgName = basename($imgSubida['name']); 			//nombreImg.extension
	 $imgExt = substr($imgName,strrpos($imgName,'.')+0);//Extension de la img con el punto
	 $theTime = time();
	 $hashedName = hash("sha256" , $imgSubida['tmp_name'] . $theTime . rand(1,1000000)) . $imgExt;
	 $imgFileName = $imgFolderPath . $hashedName;//Path completo a la img (con nombre hasheado)
	 $imgRelName = "";

	 if (move_uploaded_file($imgSubida['tmp_name'], $imgFileName)) {
	 	$imgRelName = "app_cell/images/" . $hashedName;//path relativo a la img
	 }

	 return ($imgRelName);

	}

}





?>