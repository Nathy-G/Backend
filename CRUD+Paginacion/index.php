<?php
include_once "app/Cliente.php";
include_once  "app/AccesoDAO.php";
include_once 'app/acciones.php';
session_start();

if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}

define('FPAG', 10); // Número de clientes por página

$db = AccesoDAO::getModelo();
$total = $db->totalClientes();
 
// Calcula cual es la última posición
if ( $total % FPAG == 0){
    $posfin = $total - FPAG;
} else {
    $posfin = $total - $total % FPAG;
}


// Primer elemento a mostrar
$primero = $_SESSION['posini'];
if (isset($_GET['orden'])) {

    switch ($_GET['orden']) {
        case "Primero":
            $primero = 0;
            break;
        case "Siguiente":
            $primero += FPAG;
            if ($primero > $posfin) $primero = $posfin;
            break;
        case "Anterior":
            $primero -= FPAG;
            if ($primero < 0) $primero = 0;
            break;
        case "Ultimo":
            $primero = $posfin;
            break;
    }
    $_SESSION['posini'] = $primero;
}

//NUEVAS FUNCIONES

$contenido="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    if ( isset($_GET['orden'])){

        switch ($_GET['orden']) {    
            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
        limpiarArrayEntrada($_POST); //Evito la posible inyección de código
        
        echo "ORDEN_POST".$_POST['orden']."<br><br>";
        switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Detalles":; // No hago nada
         }
    }
}

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

$tclientes = $db->getClientes($primero, FPAG);

//TABLA PRINCIPAL
function mostrarDatos ($primero){
    
    $titulos = ["id", "first_name", "last_name", "email", "gender", "ip_address", "teléfono"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDAO::getModelo();
    $tclientes = $db->getClientes($primero, FPAG);

    foreach ($tclientes as $cliente) {
        $msg .= "<tr>";
        $msg .= "<td>$cliente->id</td>";
        $msg .= "<td>$cliente->first_name</td>";
        $msg .= "<td>$cliente->last_name</td>";
        $msg .= "<td>$cliente->email</td>";
        $msg .= "<td>$cliente->gender</td>";
        $msg .= "<td>$cliente->ip_address</td>";
        $msg .= "<td>$cliente->telefono </td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$cliente->first_name','$cliente->id');\" >Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$cliente->id\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$cliente->id\" >Detalles</a></td>\n";
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}


$contenido .= mostrarDatos($primero);
include_once "app/plantillas/principal.php";
