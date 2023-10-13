<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>¡Piedra, papel, tijera!</h1>
    <p>Actualice la página para mostrar otra partida.</p>

    <?php

        //pintar dibujitos
        define ('PIEDRA1',  "&#x1F91C;");
        define ('PIEDRA2',  "&#x1F91B;");
        define ('TIJERAS',  "&#x1F596;");
        define ('PAPEL',    "&#x1F91A;");

        //Mensaje resultado
        $mensaje=[  "¡Empate!",
                    "GANADOR: jugador 1",
                    "GANADOR: jugador 2"];

        
        //función al cargar página 
        function jugar($num1, $num2){

            $ganador=0; //ganador empate

            if ($num1 == $num2 ){
                return $ganador;
            }
                
            switch($num1){
                case PIEDRA1: $ganador = ($num2 == TIJERAS) ? 1:2; //si num1=piedra --> gana num2=tijeras
                    break;        
                case PAPEL: $ganador = ($num2 == PIEDRA2) ? 1:2;  //si num1=papel --> gana num2=piedra
                    break;  
                case TIJERAS: $ganador = ($num2 == PAPEL) ? 1:2;  //si num1=tijeras --> gana num2=papel
                    break;
              
            }

                return $ganador;
        }

        //visualizar los dibujos
        $mano =[PIEDRA1,PAPEL,TIJERAS];
        $n1=rand(0,2);
        $n2=rand(0,2);
        $jugador1=$mano[$n1];
        $jugador2=$mano[$n2];
        
            
    ?>

    <table style="font-size:2rem">
        <tr>
            <td>Jugador 1:<br><?php echo $jugador1 ?></td>
            <!--Debido a que $mano solo dispone de PIEDRA1, en el momento en el jugador2 valga PIEDRA1, alteramos para que pinte PIEDRA2-->
            <td>Jugador 2:<br><?php echo $jugador2 == PIEDRA1 ? PIEDRA2:$jugador2 ?></td>
        </tr>
        <tr>
            <!--Visualizar mensaje ganador-->
            <td colspan="2"><?php print_r($mensaje[jugar($jugador1,$jugador2)]);?></td>
        </tr>
    </table>

    <style>
        table{
            text-align: center;
        }
    </style>

</body>
</html> 
