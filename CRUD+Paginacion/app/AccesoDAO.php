<?php
include_once "config.php";
include_once "Cliente.php";

class AccesoDAO {
    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDAO();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_clientes  = $this->dbh->prepare("Select * from Clientes limit :primero ,:cuantos ");
    }
        

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Clientes
    public function getClientes (int $primero, int $cuantos):array {
        $tcliente = [];
        $this->stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_clientes->bindParam(":cuantos",$cuantos,PDO::PARAM_INT);
        $this->stmt_clientes->bindParam(":primero",$primero,PDO::PARAM_INT);
        if ( $this->stmt_clientes->execute() ){
             $tcliente = $this->stmt_clientes->fetchAll();
        }
        return $tcliente;
    }

    public function totalClientes ():int{
        $resu = $this->dbh->query(" Select Count(*) from Clientes");
        $valor = $resu->fetch();
        return ($valor[0]); 
    }
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
     public function __clone()
     { 
         trigger_error('La clonación no permitida', E_USER_ERROR); 
     }

    //NUEVAS FUNCIONES

    // Devuelvo un cliente o false
    public function getCliente (String $id) {
        $cliente = false;
        $stmt_cliente   = $this->dbh->prepare("select * from Clientes where id=:id");
        $stmt_cliente->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $stmt_cliente->bindParam(':id', $id);
        if ( $stmt_cliente->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_cliente->fetch()){
                $cliente= $obj;
            }
        }
        return $cliente;
    }

    //INSERT
    public function addCliente($cliente):bool{
        $stmt_creacliente  = $this->dbh->prepare("insert into Clientes (id,first_name,last_name,email,gender,ip_address,telefono) Values(?,?,?,?,?,?,?)");
        $stmt_creacliente->execute( [$cliente->id, $cliente->first_name, $cliente->last_name, $cliente->email, $cliente->gender, $cliente->ip_address, $cliente->telefono]);
        $resu = ($stmt_creacliente->rowCount () == 1);
        return $resu;
    }
    
    //DELETE
    public function borrarCliente(String $id):bool {
        $stmt_borcliente = $this->dbh->prepare("delete from Clientes where id =:id");
        $stmt_borcliente->bindValue(':id', $id);
        $stmt_borcliente->execute();
        $resu = ($stmt_borcliente->rowCount () == 1);
        return $resu;
    }
    
    // UPDATE
    public function modCliente($cliente):bool{

        $stmt_modcliente   = $this->dbh->prepare("update Clientes set first_name=:first_name, last_name=:last_name, email=:email, gender=:gender, ip_address=:ip_address, telefono=:telefono where id=:id");
        $stmt_modcliente->bindValue(':id',$cliente->id);
        $stmt_modcliente->bindValue(':first_name',$cliente->first_name);
        $stmt_modcliente->bindValue(':last_name',$cliente->last_name);
        $stmt_modcliente->bindValue(':email',$cliente->email);
        $stmt_modcliente->bindValue(':gender',$cliente->gender);
        $stmt_modcliente->bindValue(':ip_address',$cliente->ip_address);
        $stmt_modcliente->bindValue(':telefono',$cliente->telefono);
        $stmt_modcliente->execute();
        // El número de filas modificadas debe ser 1
        $resu = ($stmt_modcliente->rowCount () == 1);
        return $resu;
    }
 

}