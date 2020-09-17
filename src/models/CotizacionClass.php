<?php namespace App\Models;

class CotizacionClass extends conexion {
    
    public function __construct(){
        parent::__construct();
    }

    
    public function getInfoEmpresa(){

        $query = "SELECT TOP 1 * FROM dbo.DatosEmpresa";  // Final del Query SQL 

        try{
            $stmt = $this->instancia->prepare($query); 
    
                if($stmt->execute()){
                    $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
                    
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(\PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
       
    }

    

}
