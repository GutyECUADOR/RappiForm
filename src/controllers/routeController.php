<?php namespace App\Controllers;
use App\Models\routeModel;

class routeController {
    
    public $mainmodel;
    
    public function __construct()
    {
        $this->mainmodel = new routeModel();
    }
    
    public function loadtemplate(){
        include 'views/baseTemplate.php';
    }
    
    public function actionCatcherController(){
        if (isset($_GET['action'])){
           $action = $_GET['action'];
           $modulo = $this->mainmodel->actionCatcherModel($action);
           
           include $modulo; 
        }else{
           $action = 'default';
           $modulo = $this->mainmodel->actionCatcherModel($action);
           include $modulo; 
        }
       
    }
}
