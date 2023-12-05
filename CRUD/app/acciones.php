<?php
// --------BORRAR ELEMENTO DEL USUARIO DE LA TABLA & REORDENAR TABLA
function accionBorrar ($id){    

    if($_SESSION['tuser'][$id]){
        unset($_SESSION['tuser'][$id]);
        $msg="El usuario con login $id ha sido eleiminado";    
    } else {
        $msg="Error: El usuario con login $id no se encuentra";
    }
    
    $_SESSION['msg'] = $msg;
}

// ------- TERMINAR 
function accionTerminar(){

    volcarDatos($_SESSION['tuser']);
    session_destroy();
    $_SESSION['msg'] = "Todos los datos se han guardado";
}
 

// ------- DETALLES 
function accionDetalles($id){
    $login=$id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  = $usuario[0];
    $nombre   = $usuario[1];
    $comentario=$usuario[2];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

// ----- MODIFICAR
function accionModificar($id){
    $login=$id;
    $usuario    = $_SESSION['tuser'][$id];
    $clave      = $usuario[0];
    $nombre     = $usuario[1];
    $comentario = $usuario[2];
    $orden= "Modificar";
    include_once "layout/formulario.php";
    exit();
}

function accionPostModificar(){
    $id = $_POST['login'];
    $nuevovalor = [$_POST['clave'], $_POST['nombre'],$_POST['comentario']];
    $_SESSION['tuser'][$id]= $nuevovalor;  
    $_SESSION['msg'] = "Usuario con login $id actualizado";

}

// -------- NUEVO
function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

function accionRepetirAlta($msgformulario){
    $nombre  = $_POST['nombre'];
    $login   = $_POST['login'];
    $clave   = $_POST['clave'];
    $comentario = $_POST['comentario'];
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

        // Proceso los datos del formularios guardandolo en la sesión
        // Debe evitar que se puedan introducir dos usuarios con el mismo login
function accionPostAlta(){
    if(empty($_POST['nombre'])|| empty ($_POST['login']) || empty ($_POST['clave']) ||  empty ($_POST['comentario'])){
        $msgerror= "Todos los campos tienen que estar rellenados";    
        accionRepetirAlta($msgerror);
        return;
    }

    $id=$_POST['login'];
    if(isset($_SESSION['tuser'][$id])){
        $msgerror="El usuario con login $id ya existe";
        accionRepetirAlta($msgerror);
        return;
    }

    $id = $_POST['login'];
    $nuevo = [$_POST['clave'], $_POST['nombre'],$_POST['comentario']];
    $_SESSION['tuser'][$id]= $nuevo;  
    $_SESSION['msg'] = " Nuevo usuario añadido.";
}
