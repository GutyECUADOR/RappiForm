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

    public function getInfoInitForm() {
      return $this->ajaxController->getInfoInitForm();
    }

    public function getInfoProducto($busqueda) {
      return $this->ajaxController->getInfoProducto($busqueda);
    }

    public function getValoresVariantes($busqueda) {
      return $this->ajaxController->getValoresVariantes($busqueda);
    }

    public function getAllProductos_Rappi() {
      return $this->ajaxController->getAllProductos_Rappi();
    }

    public function postAddProducto($producto) {
      return $this->ajaxController->postAddProducto($producto);
    }

    public function postUpdateProducto($producto) {
      return $this->ajaxController->postUpdateProducto($producto);
    }

    public function postAddProductos($productos) {
      return $this->ajaxController->postAddProductos($productos);
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

      case 'getInfoInitForm':
        $respuesta = $ajax->getInfoInitForm();
        $rawdata = array('status' => 'success', 'mensaje' => 'respuesta correcta', 'data'=> $respuesta);
        echo json_encode($rawdata);

      break;

      case 'getInfoProducto':

        if (isset($_GET['busqueda']) ) {
          $busqueda = json_decode($_GET['busqueda']);
          $respuesta = $ajax->getInfoProducto($busqueda);
          $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'busqueda'=> $busqueda, 'data' => $respuesta);
        }else{
          $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
        }
        
      
        echo json_encode($rawdata);

      break;

      case 'getValoresVariantes':

        if (isset($_GET['busqueda']) ) {
          $busqueda = json_decode($_GET['busqueda']);
          $respuesta = $ajax->getValoresVariantes($busqueda);
          $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'busqueda'=> $busqueda, 'data' => $respuesta);
        }else{
          $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
        }
        
      
        echo json_encode($rawdata);

      break;

      case 'getAllProductos_Rappi':
          $respuesta = $ajax->getAllProductos_Rappi();
          $rawdata = array('status' => 'success', 'mensaje' => 'respuesta correcta', 'productos' => $respuesta);
         
        echo json_encode($rawdata);

      break;

      case 'postAddProducto':
        if (isset($_POST['producto'])) {
          $producto = json_decode($_POST['producto']);
          $rawdata = $ajax->postAddProducto($producto);

        }else{
          $rawdata = array('status' => 'error', 'mensaje' => 'No se ha indicado parámetros.');
        }
        
        echo json_encode($rawdata);

      break;

      case 'postUpdateProducto':
        if (isset($_POST['producto'])) {
          $producto = json_decode($_POST['producto']);
          $rawdata = $ajax->postUpdateProducto($producto);

        }else{
          $rawdata = array('status' => 'error', 'mensaje' => 'No se ha indicado parámetros.');
        }
        
        echo json_encode($rawdata);

      break;

      case 'postAddProductos':
        if (isset($_POST['productos'])) {
          $productos = json_decode($_POST['productos']);
          $rawdata = $ajax->postAddProductos($productos);

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


