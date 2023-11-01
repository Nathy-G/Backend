<?php
function usuarioOk($usuario, $contraseña) :bool {

   if(strlen($usuario) < 8 || strlen($contraseña) < 8){
      return false;
   } 
   
   $revesUsuario=strrev($usuario);

   if($contraseña != $revesUsuario){
      return false;
   }

   return true;
    
}

function comentarioOK($comentario) :bool {

   if (strlen($comentario) > 300 || strlen($comentario) == 0){
      return false;
   }

   return true;

}

function contPalabras($comentario) :int{

   if(strlen($comentario) == 0){
      return 0;
   }

   //array 
   //usamos explode para partir entre palabras
   $palabras = explode(" ", $comentario);

   $numPalabras=sizeof($palabras);

   return $numPalabras;
}

function repeLetra($comentario) :string{

   if(strlen($comentario) == 0){
      return " ";
   }

   $letras= str_split($comentario);

   //se necesita un array
   $cont=array_count_values($letras); //cuenta los valores en el array y devuelve un array asociativo

   arsort($cont); //ordena de mayor a menor el array letras

   $clave=array_keys($cont); //obtiene un array de letras

   $repeLetras=" ";
   if(sizeof($clave) > 0){
      $repeLetras=$clave[0]; //nos quedamos solo con la clave que guarda la letra con + repeticiones
   }

   return $repeLetras;

}

function repePalabra($comentario) :string{
   
   if(strlen($comentario) == 0){
      return 0;
   }

   $palabras = explode(" ", $comentario);

   $cont=array_count_values($palabras); 
   
   arsort($cont); 

   $clave=array_keys($cont); 

   $repePalabra=" ";
   if(sizeof($clave) > 0){
      $repePalabra=$clave[0]; 
   }

   return $repePalabra;

}
