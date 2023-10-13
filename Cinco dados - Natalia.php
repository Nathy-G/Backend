<?php

    define ('NUMDADOS',5);

    $dados = [
    1 => "&#9856;", 2=> "&#9857;",
    3 => "&#9858;", 4 => "&#9859;",
    5 => "&#9860;", 6 => "&#9861;"];

    function lanzarDados($num): array { //numero que pasaremos al valor de la cara
        //valor de la cara lanzada (numero)
        $valor=[];

        //recorremos las caras del dado
        for ($i=0; $i<$num; $i++){
            //lanzamiento de los dados => resultado random
            $valor[]=random_int(1,6);
        }

        return $valor;
    }
    
    function jugar(){
        //cada jugador lanza sus dados
        $rojo = lanzarDados(NUMDADOS);
        $azul = lanzarDados(NUMDADOS);

        //ordenamos los puntos de cada jugador
        sort($rojo);
        sort($azul);
        
        //descartamos la posición menor y la posición mayor
        $descarteR = array_slice($rojo, 1, 3);
        $descarteA = array_slice($azul, 1, 3);

        //sumamos los puntos de cada jugador
        $puntosRojo = array_sum($descarteR);
        $puntosAzul = array_sum($descarteA);

    }

    function resultado($totalR, $totalA) {

        $intR = intval($totalR);
        $intA = intval($totalA);

        //ganador
        if($intR > $intA){
            return "Ha ganado el Jugador 1 con $intR puntos"; 
        } else if($intA > $intR){
            return "Ha ganado el Jugador 2 con $intA puntos"; 
        } else{
            return "¡Empate! con $intR puntos"; 
        }
    }

?>


<html>
    <head>
        <style>
            table{
                text-align: center;
            }
            .jugadorR{
                background-color: red;
            }
            .jugadorA{
                background-color: blue;
            }
        </style>
    </head>

    <body>
        <table style="font-size:2rem">
        <tr><h1>Cinco dados</h1></tr>
        <tr><i>Actualice la página para mostrar una nueva tirada.</i></tr>
            <tr>
                <td>Jugador 1:</td> 
                <td class="jugadorR"> <!--Dados Rojo-->
                    <?php $rojo = lanzarDados(5);
                        foreach ($rojo as $dadoRojo):
                        echo $dados[$dadoRojo];?>
                        <?php endforeach; ?>
                </td>
                <td> <!--Puntos Rojo-->
                    <?php sort($rojo);
                        $descarteR = array_slice($rojo, 1, 3);
                        echo $puntosRojo = array_sum($descarteR) ." puntos"?>
                </td>
            </tr>

            <tr>
                <td>Jugador 2: </td>
                <td class="jugadorA"> <!--Dados Azul-->
                    <?php $azul = lanzarDados(5);
                        foreach ($azul as $dadoAzul):
                        echo $dados[$dadoAzul];?>
                        <?php endforeach; ?>
                </td>
                <td> <!-- Puntos Azul -->
                    <?php sort($azul);
                        $descarteA = array_slice($azul, 1, 3);
                        echo $puntosAzul = array_sum($descarteA) ." puntos"?>
                </td>
            </tr>
            <tr> <!-- Ganador -->
                <td colspan="3"><?php echo resultado($puntosRojo, $puntosAzul) ?></td>
            </tr>
        </table>
        
    </body>
</html>
