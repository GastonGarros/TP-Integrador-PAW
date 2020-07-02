<?php


namespace App\Model;


class Session 
{
    public function __construct()
    {
        //creo la sesion   
        session_start();
    }
//setea los valores de la session 
    public function setSession($name,$value){

        $_SESSION[$name]=$value;
    }
    public function exist($name){
        return isset($_SESSION[$name]);
    }
//get de los valores de la session
    public function getSession($name){

       return $_SESSION[$name];
    }
//finaliza la session
    public function closeSession(){
        session_unset();
        session_destroy();
    }

}
