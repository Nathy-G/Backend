<div>
<b> Detalles:</b><br>
<table>
    <tr>
        <td>Longitud:          </td>    <td><?= strlen($_REQUEST['comentario']) ?></td>
    </tr>
    <tr>
        <td>Nº de palabras:    </td>    <td><?= contPalabras(($_REQUEST['comentario'])) ?></td>
    </tr>
    <tr>
        <td>Letra + repetida:  </td>    <td><?= repeLetra(($_REQUEST['comentario'])) ?></td>
    </tr>
    <tr>
        <td>Palabra + repetida:</td>    <td><?= repePalabra(($_REQUEST['comentario'])) ?></td>
    </tr>

</table>
</div>

