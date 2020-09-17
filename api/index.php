<?php
use App\Controllers\ajaxController;

date_default_timezone_set('America/Lima');
header('Content-Type: application/json');
session_start();
require_once '../vendor/autoload.php';

class ajax{
  private $ajaxController;
   
    public function __construct() {
      $this->ajaxController = new ajaxController();
    }

    public function getAllProductos_Shopy_Master() {
      return $this->ajaxController->getAllProductos_Shopy_Master();
    }

    public function postActualizaProducto_Shopy_Master($producto) {
      return $this->ajaxController->postActualizaProducto_Shopy_Master($producto);
    }

}

  /* Cuerpo del API */

  try{
    $ajax = new ajax(); //Instancia que controla las acciones

    if (isset($_GET["action"])) {
      $HTTPaction = $_GET["action"];
    }else{
      throw new Exception("Solicitud sin action");
      
    }
    

    switch ($HTTPaction) {

        case 'getAllProductos_Shopy_Master':
          if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            $respuesta = $ajax->getAllProductos_Shopy_Master();
            $rawdata = array('status' => 'success', 'mensaje' => 'respuesta correcta', 'productos' => $respuesta);
          }else{
            $rawdata = array('status' => 'error', 'mensaje' => 'No se ha indicado parámetros.');
          }
          
          echo json_encode($rawdata);

        break;

        case 'postActualizaProducto_Shopy_Master':
          if (isset($_POST['producto'])) {
            $producto = json_decode($_POST['producto']);
            $respuesta = $ajax->postActualizaProducto_Shopy_Master($producto);
            $rawdata = array('status' => 'success', 'mensaje' => 'Producto Actualizado Correctamente', 'producto' => $producto, 'respuesta' => $respuesta);
          }else{
            $rawdata = array('status' => 'error', 'mensaje' => 'No se ha indicado parámetros.');
          }
          
          echo json_encode($rawdata);

        break;


        default:
            $rawdata = array('status' => 'error', 'mensaje' =>'El API no ha podido responder la solicitud, revise el tipo de action');
            echo json_encode($rawdata);
        break;
    }
    
  } catch (Exception $ex) {
    //Return error message
    $rawdata = array();
    $rawdata['status'] = "error";
    $rawdata['mensaje'] = $ex->getMessage();
    echo json_encode($rawdata);
  }


