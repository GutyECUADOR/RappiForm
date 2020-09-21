<?php namespace App\Controllers;

use App\Models\ajaxModel;

class ajaxController  {

    public $defaulDataBase;
    public $ajaxModel;
   
    public function __construct() {
        $this->defaulDataBase = (!isset($_SESSION["empresaAUTH".APP_UNIQUE_KEY])) ? DEFAULT_DBName : $_SESSION["empresaAUTH".APP_UNIQUE_KEY];
        $this->ajaxModel = new ajaxModel();
        $this->ajaxModel->setDbname($this->defaulDataBase);
        $this->ajaxModel->conectarDB();

    }

    /* Datos de inicio del formulario*/
    public function getInfoInitForm(){
        $aliados = $this->ajaxModel->getAliados();
        $marcas = $this->ajaxModel->getMarcas();
        $categorias1 = $this->ajaxModel->getCategorias('1');
        $categorias2 = $this->ajaxModel->getCategorias('2');
        $categorias3 = $this->ajaxModel->getCategorias('3');
        $categorias4 = $this->ajaxModel->getCategorias('4');
        $tiposVariantes = $this->ajaxModel->getTiposVariantes();
        return array('aliados'=> $aliados, 
                    'marcas'=> $marcas, 
                    'categorias1'=> $categorias1, 
                    'categorias2'=> $categorias2, 
                    'categorias3'=> $categorias3, 
                    'categorias4'=> $categorias4,
                    'tiposVariantes'=> $tiposVariantes);
    }

    /* Informacion del Producto */
     public function getInfoProducto($busqueda){
        $producto = $this->ajaxModel->getInfoProducto($busqueda);
        return $producto;
    }

    /* Informacion del Producto */
    public function getValoresVariantes($busqueda){
        switch ($busqueda->tipo) {
           case 'COLOR':
                $resultset = $this->ajaxModel->getColores();
                break;
           
           default:
                $resultset = $this->ajaxModel->getTallas();
                break;
        }
        return $resultset;
    }


    /* Retorna la respuesta del modelo ajax*/
    public function getAllProductos_Rappi(){
        $response = $this->ajaxModel->getAllProductos_Rappi();
        return $response;
    }

    /* Retorna la respuesta del modelo ajax*/
    public function postAddProductos($productos){
        $response = array('status' => 'error', 'mensaje'=> 'No se ha podido registrar los items. Error en base de datos');
        $response = $this->ajaxModel->postAddProductos($productos);
        return $response;
    }

   


}
