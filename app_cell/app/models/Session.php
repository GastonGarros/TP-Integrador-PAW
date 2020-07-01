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
//get de los valores de la session
    public function getSession($name,$value){

        $_SESSION[$name]=$value;
    }
//finaliza la session
    public function closeSession(){
        session_unset();
        session_destroy();
    }

}
