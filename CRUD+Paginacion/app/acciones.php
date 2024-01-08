<?php
include_once "Cliente.php";
include_once 'AccesoDAO.php';

function accionBorrar ($id){    
    $db = AccesoDAO::getModelo();
    $tclientes = $db->borrarCliente($id);
}

function accionTerminar(){
    AccesoDAO::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}
 
function accionAlta(){
    $cliente = new Cliente();
    $cliente->first_name  = "";
    $cliente->last_name  = "";
    $cliente->email   = "";
    $cliente->gender   = "";
    $cliente->ip_address = "";
    $cliente->telefono = "";
    $orden= "Nuevo";
    include_once "plantillas/formulario.php";
}

function accionDetalles($id){
    $db = AccesoDAO::getModelo();
    $cliente = $db->getCliente($id);
    $orden = "Detalles";
    include_once "plantillas/formulario.php";
}


function accionModificar($id){
    $db = AccesoDAO::getModelo();
    $cliente = $db->getCliente($id);
    $orden="Modificar";
    include_once "plantillas/formulario.php";
}

function accionPostAlta(){
    $cliente = new Cliente();
    $cliente->id  = $_POST['id'];
    $cliente->first_name  = $_POST['first_name'];
    $cliente->last_name   = $_POST['last_name'];
    $cliente->email   = $_POST['email'];
    $cliente->gender   = $_POST['gender'];
    $cliente->ip_address = $_POST['ip_address'];
    $cliente->telefono = $_POST['telefono'];
    $db = AccesoDAO::getModelo();
    $db->addCliente($cliente);
    
}

function accionPostModificar(){
    
    $cliente = new Cliente();
    $cliente->id = $_POST['id'];
    $cliente->first_name  = $_POST['first_name'];
    $cliente->last_name   = $_POST['last_name'];
    $cliente->email  = $_POST['email'];
    $cliente->gender   = $_POST['gender'];
    $cliente->ip_address = $_POST['ip_address'];
    $cliente->telefono = $_POST['telefono'];

    $db = AccesoDAO::getModelo();
    $db->modCliente($cliente);
}

