<?php

    class Bicicleta{
        private $id; 
        private $coordx; 
        private $coordy; 
        private $bateria; 
        private $operativa; 

        function __construct($beid, $becx, $becy, $beb, $beo)
        {
            $this->id = $beid;
            $this->coordx = $becx;
            $this->coordy = $becy;
            $this->bateria = $beb;
            $this->operativa = $beo;
        }

        //setter y getter mediante métodos mágicos
        function __get($name):string{
            if(property_exists($this,$name)){
                return $this->$name;
            }   
        }

        function __set($name,$value){
            if ( property_exists($name, $value)){
                $this->$name = $value;
            }    
        }
        
        //__ToString el id de la bicicleta y el estado de la batería.
        function __toString(){
            return "La id de la bici es $this->id y tiene $this->bateria de batería.";
        }
        
        //distancia(x,y)  - Devuelve la distancia entre las coordenadas pasadas como parámetro y las coordenados del la bicicleta aplicando la formula anterior.
        function distancia($coordx, $coordy){
            
            return $distanciaCercana = sqrt(pow($this->coordx - $coordx, 2) + pow($this->coordy - $coordy, 2));
        }
    }
?>
  