<form name='entrada' method="POST">
    <table>
        <tr>
            <td>Nombre:</td><td> <input type="text" name="nombre" minlength="8"
            value="<?=(isset($_REQUEST['nombre']))?$_REQUEST['nombre']:''?>"></td>
        </tr>
        <tr>
            <td>Contraseña: </td><td><input type="password" name="contraseña" minlength="8"
            value="<?=(isset($_REQUEST['contraseña']))?$_REQUEST['contraseña']:''?>"></td>
        </tr>
    </table>
    <input type="submit" name="orden" value="Entrar">
</form>