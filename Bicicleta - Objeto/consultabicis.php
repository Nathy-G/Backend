<?php 

    include_once 'BiciElectrica.php';


    // devuelve una cadena con la tabla html de bicis operativas
    function mostrartablabicis($tabla){

        echo "<table>";
        echo "<th>Id</th><th>CoordX</th><th>CoordY</th><th>Bateria</th>";
        foreach($tabla as $bicicleta) {
            echo "<tr>";
            echo "<td>$bicicleta->id</td>";
            echo "<td>$bicicleta->coordx</td>";
            echo "<td>$bicicleta->coordy</td>";
            echo "<td>$bicicleta->bateria</td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    
    //Devuelve la bici con menor distancia a las coordenadas de usuario.
    //dada unas coordenadas, nos dice cuál es la más cercana
    function bicimascercana($coordX, $coordY, $tabla){

        $min = 0;

        for($i = 0; $i < sizeof($tabla); $i++) {

            if ($i == 0) {

                $min = $tabla[$i]->distancia($coordX, $coordY);
                $biciMasCercana = $tabla[$i]; 
            } else {

                $distancia = $tabla[$i]->distancia($coordX, $coordY);

                if ($min > $distancia) {
                    $min = $distancia;
                    $biciMasCercana = $tabla[$i]; 
                }
            }
        }

        return $biciMasCercana;
    }

    
    //Carga la tabla de bicis disponibles 
    function cargabicis(){

        $fichero = fopen("Bicis.csv", 'r');

        if(!$fichero) {
            die("Error al abrir fichero");
        }

        $arrayBicicletas = [];

        while($linea = fgets($fichero)) {

            $biciCampos = explode(",", $linea);

            if (intval($biciCampos[4] == 1)) {

                $biciNueva = new Bicicleta($biciCampos[0], $biciCampos[1], $biciCampos[2], 
                    $biciCampos[3], $biciCampos[4]);

                array_push($arrayBicicletas, $biciNueva);
            }            
        }

        return $arrayBicicletas;
    }


    // Programa principal
    $tabla = cargabicis();
    if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
        $biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
    }

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MOSTRAR BICIS OPERATIVAS</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1> Listado de bicicletas operativas </h1>
        <?= mostrartablabicis($tabla); ?>
        <?php if (isset($biciRecomendada)) : ?>
    <h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
        <button onclick="history.back()"> Volver </button>
        <?php else : ?>
    <h2> Indicar su ubicación: <h2>
        <form>
            Coordenada X: <input type="number" name="coordx"><br>
            Coordenada Y: <input type="number" name="coordy"><br>
            <input type="submit" value=" Consultar ">
        </form>
    <?php endif ?>
</body>

</html>