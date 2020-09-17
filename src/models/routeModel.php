<?php namespace App\Models;

class routeModel {
    
    public function actionCatcherModel($action){
        switch ($action) {
            case 'inicio':
                $contenido = "views/modulos/inicioView.php";
                break;
                
            case 'pedidoaMatriz':
                $contenido = "views/modulos/pedidoMatrizView.php";
                break;    

            case 'login':
            $contenido = "views/modulos/loginView.php";
                break;    
         
            case 'logout':
            $contenido = "views/modulos/cerrarSesion.php";
                break; 

            default:
                $contenido = "views/modulos/inicioView.php";
                break;
        }
        
       
        return $contenido;
        
    }
}
