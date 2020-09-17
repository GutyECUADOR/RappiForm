<?php namespace App\Controllers;

use App\Models\loginModel;

class loginController  {

    public $loginModel;

    public function __construct()
    {
        $this->loginModel = new loginModel();
    }

    public function actionCatcherController(){
        if (isset($_POST['login_username']) && isset($_POST['login_password']) && isset($_POST['select_empresa']) ) {
                $codigoDB = $_POST['select_empresa']; // recuperamos el codigo del select
                $arrayDatos = array("usuario"=>$_POST['login_username'],"password"=>$_POST['login_password']);

                //$dataBaseName = $this->loginModel->getDBNameByCodigo($codigoDB); // Obtenemos nombre de la DB segun codigo, retorno de un array
                $arrayResultados = $this->loginModel->validaIngreso($arrayDatos, $codigoDB); // Validamos info del usuario en esa DB
               
                //Funcion validar acceso retorna array de resultados
                    if (!empty($arrayResultados)) {
                        session_start();
                        $_SESSION["usuarioRUC".APP_UNIQUE_KEY] =  trim($arrayResultados['Codigo']) ;
                        $_SESSION["usuarioNOMBRE".APP_UNIQUE_KEY] =  trim($arrayResultados['Nombre']);
                        $_SESSION["bodegaDefault".APP_UNIQUE_KEY] = trim($arrayResultados['bodegaDefault']);
                        $_SESSION["nombreBodega".APP_UNIQUE_KEY] = trim($arrayResultados['nombreBodega']);
                        $_SESSION["documentoDefault".APP_UNIQUE_KEY] = trim($arrayResultados['documentoDefault']);
                        $_SESSION["empresaAUTH".APP_UNIQUE_KEY] = $codigoDB;
                    
                        header("Location: index.php?&action=inicio");
                           
                    }else{
                        
                        echo '
                            <div class="alert alert-danger text-center">
                                No se ha podido ingresar con el usuario <strong>'.$arrayDatos['usuario'].' </strong>, reintente.
                        
                            </div>
                        ';
                    }
        }
    }

   
   
    /*Crea elementos HTML opcion button para ser listados en el select*/
    public function getAllDataBaseList(){
        $opciones = $this->loginModel->getAllDataBaseList();

        foreach ($opciones as $opcion) {
            $codigo = $opcion['NameDatabase'];
            $texto = $opcion['Nombre'];
            echo "<option value='$codigo'>$texto</option>";
    
        }
    }
}
