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


    /* Retorna la respuesta del modelo ajax*/
    public function getAllProductos_Shopy_Master(){
        $response = $this->ajaxModel->getAllProductos_Shopy_Master();
        return $response;
    }

    /* Retorna la respuesta del modelo ajax*/
    public function postActualizaProducto_Shopy_Master($producto){
        $response = $this->ajaxModel->postActualizaProducto_Shopy_Master($producto);
        return $response;
    }

   


}
