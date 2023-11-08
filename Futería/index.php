<html>
<head>
    <meta charset="UTF-8">
    <title>Frutería</title>
</head>
<body>
    <?php

    session_start();

    $compraRealizada="";

    if (isset($_GET["cliente"])){
        $_SESSION["cliente"]=$_GET["cliente"]; 
        $_SESSION["pedidos"]=[]; 
    } 

    if (!isset($_SESSION['cliente'])){
        require_once ('bienvenida.php');
        session_destroy();
        exit();
    }

    //pedido - COMPRA
    if(isset($_POST['accion'])){

        //anotar
        if($_POST['accion'] == "Anotar"){
            if (isset($_POST['fruta']) && isset($_POST['cantidad'])){
                if($_POST['cantidad'] > 0){
                    $fruta = $_POST['fruta'];
                    $cantidad = $_POST['cantidad'];
                    
                    if(isset($_SESSION['pedidos'][$fruta])){
                        //aumentar cantidad
                        $_SESSION['pedidos'][$fruta] += $cantidad;
                        
                    } else {
                        $_SESSION['pedidos'][$fruta] = $cantidad;
                    }
                }
            }
        }

        if($_POST['accion'] == "Quitar"){
            if (isset($_POST['fruta']) && isset($_POST['cantidad'])){
                if(isset($_POST['cantidad']) > 0){
                    $fruta = $_POST['fruta'];
                    $cantidad = $_POST['cantidad'];
                    
                    if(isset($_SESSION['pedidos'][$fruta]) && $cantidad > 0){
                        echo"existe la fruta: ";
                        if($_SESSION['pedidos'][$fruta] >= $cantidad){
                            //disminuir cantidad
                            $_SESSION['pedidos'][$fruta] -= $cantidad;
                        } else {
                            //unset destruye la variable
                            unset($_SESSION['pedidos']['fruta']);
                        }
                    }
                }
            }
        }

        $compraRealizada=htmlTablaPedidos($_SESSION['pedidos']);

        //terminar
        if($_POST['accion'] == "Terminar"){
            require_once ('despedida.php');
            session_destroy();
            exit();
        }
    }
     
    require_once("compra.php");

    function htmlTablaPedidos() :string {
        $msg = "Este es tu pedido: <br>";
        $msg .= '<table>';

        foreach ($_SESSION["pedidos"] as $key => $value) {
            $msg .= '<tr>';
            $msg .= "<td>$key</td>";
            $msg .= "<td>$value</td>";
            $msg .= '</tr>';
        }

        $msg .= '</table>';

        return $msg;

    }
        
    ?>
</body>
</html>
