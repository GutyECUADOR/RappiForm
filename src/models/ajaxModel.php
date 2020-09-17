<?php namespace App\Models;

/* LOS MODELOS del MVC retornaran unicamente arrays PHP sin serializar*/

class ajaxModel extends conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function getAllProductos_Shopy_Master() {

        $query = " 
            SELECT TOP 100 * FROM dbo.INV_ARTICULOS_SHOPIFYMASTER
        "; 

        try{
            $stmt = $this->instancia->prepare($query); 
    
                if($stmt->execute()){
                    $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
                    
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(\PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }

   
    public function postActualizaProducto_Shopy_Master($producto) {

        $query = " 
            UPDATE dbo.INV_ARTICULOS_SHOPIFYMASTER
            SET DESCRIPCION = :descripcion
            WHERE CODIGO = :codigo
        ";  

        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':descripcion', $producto->DESCRIPCION); 
        $stmt->bindParam(':codigo', $producto->CODIGO); 

        try{
            return $stmt->execute();
            
         }catch(\PDOException $exception){
             return array('status' => 'error', 'mensaje' => $exception->getMessage() );
         }
   
    }
}



   
    
