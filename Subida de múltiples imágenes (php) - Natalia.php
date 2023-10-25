<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida de ficheros</title>
</head>
<?=
    $mensaje = '';
    $nombreFichero = $_FILES['archivos']['name'];
    $fileSize=$_FILES['archivos']['size'];
    $temporalFichero = $_FILES['archivos']['tmp_name'];

//P4) El tamaño y el tipo de ficheros se tiene que controlar en el cliente y en el servidor.
//P3) Los ficheros tiene que ser o JPG o PNG no se admiten otros formatos.
    $errorExtension=false;
    $permitido = array('png', 'jpg');
    for($i=0; $i<sizeof($fileSize); $i++){
        $extensiones = pathinfo($nombreFichero[$i], PATHINFO_EXTENSION);
        if (!in_array($extensiones, $permitido)){
            $errorExtension=true;
        }
    }
    if($errorExtension==true){
        echo "Una extensión PHP evito la subida del archivo";
    } else {

//P1) El tamaño máximo de los ficheros no puede superar los 200 Kbytes cada uno y entre todos no mas de 300  Kbytes.
        //variable boolean para controlar que si el tamaño del fichero supere 200kb, salte error
        $errorTamanioFichero=false;
        echo "<br> - TAMAÑO INDIVIDUAL DE LOS FICHEROS <br>";
        for ($i=0; $i<sizeof($fileSize); $i++){
            if($fileSize[$i] > 200000){
                $errorTamanioFichero=true;
            }
        }

        if($errorTamanioFichero == true){
            echo "El tamaño del archivo excede el admitido por el cliente.<br>";
        } else {
            for($i=0; $i<sizeof($fileSize); $i++){
                echo "Nombre de fichero: $nombreFichero[$i]    Tamaño de fichero: $fileSize[$i] <br>";
            }
            $sumaFicheros=0;
            for ($i=0; $i<sizeof($fileSize); $i++){
                $sumaFicheros=$sumaFicheros+$fileSize[$i];
            }
    
            $tamanioArrayFicheros=sizeof($_FILES['archivos']['name']);
            echo " - NÚMERO DE FICHEROS: $tamanioArrayFicheros <br>";
    
//P2) Se puede enviar varios ficheros simultáneamente.
            echo " - TAMAÑO TOTAL DE LOS FICHEROS: $sumaFicheros <br>";
            if($sumaFicheros > 300000){
                echo "ERROR: El tamaño de los archivos excede el admitido por el servidor";
            } else {
                $directorioSubida = 'imgusers';

                if(!is_dir($directorioSubida)) {
                    mkdir($directorioSubida, 0777);
                }

                if(is_writable($directorioSubida)) {
                    for($i=0; $i<sizeof($fileSize); $i++){

//P5) La aplicación NO  debe permitir subir ficheros cuyo nombres ya exista en el directorio de imágenes.
                        if(file_exists($directorioSubida ."/".$nombreFichero[$i])){
                            echo "ERROR: Ya existe un fichero con el mismo nombre. <br>";                        
                        } else {
                            if (move_uploaded_file($temporalFichero[$i],  $directorioSubida .'/'. $nombreFichero[$i]) == true) {
                                echo "Archivo guardado en: $directorioSubida / $nombreFichero[$i] ";
                            } else {
                                $mensaje .= 'ERROR: Archivo no guardado correctamente <br />';
                            }

                        }
                    }
                }              
                
            }
    
        }
    }
    ?>
    <body>
        <p><a href="Subida de ficheros.html">Volver a la página de subida</a></p>
    </body>
</html>