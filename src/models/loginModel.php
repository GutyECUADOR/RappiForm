<?php namespace App\Models;

class loginModel extends conexion {
 
    public function __construct() {
        parent::__construct();
    }

    public function validaIngreso($arrayDatos, $dataBaseName='SBIOKAO'){

        $this->setDbname($dataBaseName);
        $this->conectarDB();
        
        $usuario = $arrayDatos['usuario'];
        $password = $arrayDatos['password'];

        $query = "
       
        SELECT TOP 1 
           *
        FROM 
            dbo.USUARIOS
        WHERE 
            USUARIOS.Codigo = :cedula
           
        ";
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':cedula', $usuario); 
        
    
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }

        return $resulset;
           
        
    }

    /* Retorna el nombre array con la clave NameDatabase y Codigo para el nombre de la instancia, para ser usada en la conexion*/ 
    public function getCodeinstanciaByName($nombreinstancia){
        $query = "SELECT TOP 1 NameDatabase, Codigo FROM SBIOKAO.instanciao.Empresas_WF WHERE NameDatabase = :NameDatabase"; 
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':NameDatabase', $nombreinstancia); 
    
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    /* Retorna el nombre array con la clave Codigo, Nombre para el nombre de la instancia, para ser usada en la conexion*/ 
    public function getAllDataBaseList(){
        $query = "SELECT * FROM SBIOKAO.dbo.Empresas_WF WHERE Codigo IN ('001','009')"; 
        $stmt = $this->instancia->prepare($query); 
     
            if($stmt->execute()){
                $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }
    
    
}
