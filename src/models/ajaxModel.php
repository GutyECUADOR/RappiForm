<?php namespace App\Models;

/* LOS MODELOS del MVC retornaran unicamente arrays PHP sin serializar*/

class ajaxModel extends conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function getAliados(){
        $query = "
            SELECT * FROM KAO_wssp.dbo.INV_ECOMM_EMPRESA
        ";
        
        $stmt = $this->instancia->prepare($query); 
      
            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getMarcas(){
        $query = "
            SELECT CODIGO, NOMBRE FROM INV_MARCAS
        ";
        
        $stmt = $this->instancia->prepare($query); 
      
            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getCategorias($categoria='1'){
        $query = "
            SELECT * FROM KAO_wssp.dbo.INV_ECOMM_CATEGORIAS
            WHERE tipo = :categoria
        ";
        
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':categoria', $categoria); 

            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getTiposVariantes(){
        $query = "
            SELECT * FROM KAO_wssp.dbo.INV_ECOMM_TIPOS_VARIANTES
        ";
        
        $stmt = $this->instancia->prepare($query); 
      
            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getInfoProducto($busqueda, $tipoPrecio='A', $bodega='B01') {
        $tipoPrec = 'Prec'.$tipoPrecio; // Determina el tipo de precio que se devolvera segun el cliente
        $query = " 
        SELECT 
            RTRIM(INV_ARTICULOS.CODIGO) as CODIGO, 
            RTRIM(INV_ARTICULOS.NOMBRE) as NOMBRE, 
            MARCA.NOMBRE as MARCA,
            INV_ARTICULOS.PrecA as PRECIO,
            INV_ARTICULOS.PESO as PESO,
            INV_ARTICULOS.TIPOARTICULO as TIPOARTICULO,
            RTRIM(INV_ARTICULOS.TipoIva) as TIPOIVA,
            RTRIM(IVA.VALOR) as VALORIVA
        FROM 
            dbo.INV_ARTICULOS
            INNER JOIN dbo.INV_IVA AS IVA on IVA.CODIGO = INV_ARTICULOS.TipoIva
            LEFT JOIN dbo.INV_MARCAS as MARCA on MARCA.CODIGO = INV_ARTICULOS.Marca
                    
                            
        WHERE INV_ARTICULOS.Codigo='$busqueda->codigo'  
            
            ";  // Final del Query SQL 


        try{
            $stmt = $this->instancia->prepare($query); 
    
                if($stmt->execute()){
                    $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
                    
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
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



   
    
