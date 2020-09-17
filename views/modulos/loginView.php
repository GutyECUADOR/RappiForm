<?php 

use App\Controllers\loginController;

    if (isset($_SESSION["usuarioRUC"])){
        header('location:index.php?action=inicio');  
    }
    
    $login = new loginController();
    
?>

<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets\css\signin.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets\css\sticky-footer-navbar.css">

    <div class="container">          
   
        <form class="form-signin" method="POST" autocomplete="off"  class="formulario" name="formulario_registro">
            <img class="logo text-center" src="<?php echo LOGO_NAME?>" alt="Logo">
           
            <h2 class="form-signin-heading text-center"><?php echo APP_NAME; ?></h2>
            <?php $login->actionCatcherController(); ?>
            
            <select class="form-control" name="select_empresa" id="select_empresa" required autofocus>
                <option value=''>Seleccione Empresa</option>
                <?php
                    $login->getAllDataBaseList();
                ?>
            
            </select>

            <input type="text" class="form-control" name="login_username" id="inputuser" maxlength="30" placeholder="Usuario del Sistema o RUC" required>
            <input type="password" class="form-control" name="login_password" id="inputpass" placeholder="Contraseña" maxlength="50" required >
        
            <div class="btn-group btn-group-justified">
                
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-log-in" ></span> Ingresar</button>
                </div>

                <div class="btn-group" role="group">
                    <a href="../" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-back"></span> Regresar</a>
                  
                </div>
               
            </div>
           
        </form>

    </div> <!-- /container -->

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Todos los derechos reservados © 2017 - <?php echo date("Y")?>, Ver <?php echo APP_VERSION ?></p>
      </div>
    </footer>
      
