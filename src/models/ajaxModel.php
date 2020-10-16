<?php namespace App\Models;

/* LOS MODELOS del MVC retornaran unicamente arrays PHP sin serializar*/

class ajaxModel extends conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function getAliados(){
        $query = "
        SELECT 
            CODIGO,
            RTRIM(CODIGO_ECCOMERCE) as CODIGO_ECCOMERCE,
            NOMBRE
        FROM KAO_wssp.dbo.INV_ECOMM_EMPRESA
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
            SELECT CODIGO, RTRIM(NOMBRE) as NOMBRE FROM INV_MARCAS
        ";
        
        $stmt = $this->instancia->prepare($query); 
      
            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getTallas(){
        $query = "
            SELECT CODIGO, NOMBRE FROM INV_TALLAS
        ";
        
        $stmt = $this->instancia->prepare($query); 
      
            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getColores(){
        $query = "
            SELECT CODIGO, NOMBRE FROM INV_COLORES
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
        SELECT 
            CODIGO,
            RTRIM(NOMBRE) as NOMBRE
        FROM KAO_wssp.dbo.INV_ECOMM_TIPOS_VARIANTES
            
        ";
        
        $stmt = $this->instancia->prepare($query); 
      
            if($stmt->execute()){
                return $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getInfoProducto($busqueda) {
       
        $query = " 
            SELECT 
                RTRIM(INV_ARTICULOS.CODIGO) as CODIGO, 
                RTRIM(INV_ARTICULOS.NOMBRE) as NOMBRE, 
                RAPPI_ARTICULOS.Descripcion as DESCRIPCION,
                MARCA.CODIGO as CODIGOMARCA,
                RTRIM(MARCA.NOMBRE) as MARCA,
                CONVERT(DECIMAL(10,2),INV_ARTICULOS.PrecA * 1.12) as PRECIO,
                INV_ARTICULOS.PESO as PESO,
                INV_ARTICULOS.CodAlt as SKU,
                INV_ARTICULOS.TIPOARTICULO as TIPOARTICULO,
                RTRIM(INV_ARTICULOS.TipoIva) as TIPOIVA,
                RTRIM(IVA.VALOR) as VALORIVA
            FROM 
                dbo.INV_ARTICULOS
                INNER JOIN dbo.INV_IVA AS IVA on IVA.CODIGO = INV_ARTICULOS.TipoIva
                LEFT JOIN dbo.INV_MARCAS AS MARCA on MARCA.CODIGO = INV_ARTICULOS.Marca
                LEFT JOIN IMPORKAO_V7.dbo.Rappi_articulos AS RAPPI_ARTICULOS ON RAPPI_ARTICULOS.codigo = INV_ARTICULOS.CODIGO
                        
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

        }catch(\PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }

    public function getAllProductos_Rappi() {
        /* Los nombres de los alias deben conincidir con el modelo del producto en VUE para que se auto bindeen */
        $query = " 
        SELECT  
            refAliado as refaliado,
            codigo_winfenix as codigo,
            Nombre as nombre,
            Descripcion as descripcion,
            Precio as precio,
            RTRIM(Marca) as marca,
            sku,
            Categoria_Producto_1 as categoria1,
            Categoria_Producto_2 as categoria2,
            Categoria_Producto_3 as categoria3,
            Categoria_Producto_4 as categoria4,
            Imagen_de_Producto as imagen,
            Categoria_Combinacion as tipoVariante,
            Nombre_Combinacion as valorVariante,
            aplicaVariante
        FROM 
            KAO_wssp.dbo.rappi_products_parcial
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

    public function postAddProducto($producto) {

        try{

            $this->instancia->beginTransaction();
         
                $query = " 
                    INSERT INTO KAO_wssp.dbo.rappi_products_parcial 
                                (refAliado, 
                                codigo_winfenix, 
                                sku, 
                                Nombre, 
                                Descripcion, 
                                Precio,
                                Marca, 
                                Categoria_Producto_1, 
                                Categoria_Producto_2, 
                                Categoria_Producto_3, 
                                Categoria_Producto_4, 
                                Imagen_de_Producto, 
                                Categoria_Combinacion, 
                                Nombre_Combinacion)
                    VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                "; 

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(1, $producto->refaliado); 
                $stmt->bindParam(2, $producto->codigo); 
                $stmt->bindParam(3, $producto->sku); 
                $stmt->bindParam(4, $producto->nombre); 
                $stmt->bindParam(5, $producto->descripcion); 
                $stmt->bindParam(6, $producto->precio); 
                $stmt->bindParam(7, $producto->marca);
                $stmt->bindParam(8, $producto->categoria1);  
                $stmt->bindParam(9, $producto->categoria2);  
                $stmt->bindParam(10, $producto->categoria3);  
                $stmt->bindParam(11, $producto->categoria4);  
                $stmt->bindParam(12, $producto->imagen); 
                $stmt->bindParam(13, $producto->tipoVariante); 
                $stmt->bindParam(14, $producto->valorVariante);  
                $stmt->execute();
           
            
            $commit = $this->instancia->commit();
            $response = array('status' => 'success', 'mensaje'=> 'Registro correcto en la base de datos.', 'commit' => $commit );
            return $response;
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }
   
    public function postUpdateProducto($producto) {

        try{

            $this->instancia->beginTransaction();
         
                $query = " 
                    UPDATE KAO_wssp.dbo.rappi_products_parcial 
                            SET
                                refAliado = :refAliado, 
                                sku = :sku, 
                                Nombre = :Nombre, 
                                Descripcion = :Descripcion, 
                                Precio = :Precio,
                                Marca = :Marca, 
                                Categoria_Producto_1 = :Categoria_Producto_1, 
                                Categoria_Producto_2 = :Categoria_Producto_2, 
                                Categoria_Producto_3 = :Categoria_Producto_3, 
                                Categoria_Producto_4 = :Categoria_Producto_4, 
                                Imagen_de_Producto = :Imagen_de_Producto, 
                                Categoria_Combinacion = :Categoria_Combinacion, 
                                Nombre_Combinacion = :Nombre_Combinacion,
                                aplicaVariante = :aplicaVariante
                    WHERE codigo_winfenix = :codigo_winfenix
                "; 

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':refAliado', $producto->refaliado); 
                $stmt->bindParam(':sku', $producto->sku); 
                $stmt->bindParam(':Nombre', $producto->nombre); 
                $stmt->bindParam(':Descripcion', $producto->descripcion); 
                $stmt->bindParam(':Precio', $producto->precio); 
                $stmt->bindParam(':Marca', $producto->marca);
                $stmt->bindParam(':Categoria_Producto_1', $producto->categoria1);  
                $stmt->bindParam(':Categoria_Producto_2', $producto->categoria2);  
                $stmt->bindParam(':Categoria_Producto_3', $producto->categoria3);  
                $stmt->bindParam(':Categoria_Producto_4', $producto->categoria4);  
                $stmt->bindParam(':Imagen_de_Producto', $producto->imagen); 
                $stmt->bindParam(':Categoria_Combinacion', $producto->tipoVariante); 
                $stmt->bindParam(':Nombre_Combinacion', $producto->valorVariante); 
                $stmt->bindParam(':aplicaVariante', $producto->aplicaVariante); 
                $stmt->bindParam(':codigo_winfenix', $producto->codigo); 
                $stmt->execute();
           
            
            $commit = $this->instancia->commit();
            $response = array('status' => 'success', 'mensaje'=> 'Registro actualizado en la base de datos.', 'commit' => $commit );
            return $response;
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }

    public function postAddProductos($productos) {

        try{

            $this->instancia->beginTransaction();
         
            foreach ($productos as $producto) {
            
                // 1rst Transaction para el master 
                $query = " 
                    INSERT INTO KAO_wssp.dbo.rappi_products_parcial 
                                (refAliado, 
                                codigo_winfenix, 
                                sku, 
                                Nombre, 
                                Descripcion, 
                                Precio,
                                Marca, 
                                Categoria_Producto_1, 
                                Categoria_Producto_2, 
                                Categoria_Producto_3, 
                                Categoria_Producto_4, 
                                Imagen_de_Producto, 
                                Categoria_Combinacion, 
                                Nombre_Combinacion)
                    VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                "; 

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(1, $producto->refaliado); 
                $stmt->bindParam(2, $producto->codigo); 
                $stmt->bindParam(3, $producto->sku); 
                $stmt->bindParam(4, $producto->nombre); 
                $stmt->bindParam(5, $producto->descripcion); 
                $stmt->bindParam(6, $producto->precio); 
                $stmt->bindParam(7, $producto->marca);
                $stmt->bindParam(8, $producto->categoria1);  
                $stmt->bindParam(9, $producto->categoria2);  
                $stmt->bindParam(10, $producto->categoria3);  
                $stmt->bindParam(11, $producto->categoria4);  
                $stmt->bindParam(12, $producto->imagen); 
                $stmt->bindParam(13, $producto->tipoVariante); 
                $stmt->bindParam(14, $producto->valorVariante);  
                $stmt->execute();
           
            }
            
           
            $commit = $this->instancia->commit();
            $response = array('status' => 'success', 'mensaje'=> 'Registro correcto en la base de datos.', 'commit' => $commit );
            return $response;
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }
}



   
    
