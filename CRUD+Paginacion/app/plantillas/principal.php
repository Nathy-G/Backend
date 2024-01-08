<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CLIENTES PAGINADO</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/funciones.js"></script>
</head>
<body>
    <div id="container" >
        <div id="header">
            <h1>LISTADO DE CLIENTES</h1>
        </div>
        <div id="content">
            <form>
                <button name="orden" value="Nuevo"> Nuevo cliente </button><br>
            </form>
            <?= $contenido ?>
            <form>
                <button name="orden" value="Primero"> << </button>
                <button name="orden" value="Anterior"> < </button>
                <button name="orden" value="Siguiente"> > </button>
                <button name="orden" value="Ultimo"> >>  </button>
            </form>
        </div>
    </div>
</body>