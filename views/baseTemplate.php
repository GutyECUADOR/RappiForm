<?php

  use App\Controllers\routeController;
  $routeController = new routeController();

?>

<!DOCTYPE html>
<html lang="es">

  <head>
      <!-- Disable cache -->
      <meta http-equiv="Expires" content="0">
      <meta http-equiv="Last-Modified" content="0">
      <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
      <meta http-equiv="Pragma" content="no-cache">

      <meta charset="UTF-8">

      <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
      
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>  

      <!-- CSS Bootstrap -->
      
      <link rel="stylesheet" href='assets\css\bootstrap.min.css'>
      
      <!-- Librerias-->
      <link rel="stylesheet" href="assets\css\sweetalert2.min.css">
      <link rel="stylesheet" href="assets\css\font-awesome.min.css">
     
      <!-- CSS Propios -->
      <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets\css\styles.css">
      <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets\css\loaders.css">
      <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets\css\pnotify.custom.min.css">
       
      <!-- CSS Paginas -->

      <title><?php echo APP_NAME; ?></title>

  </head>

  <body>
    
    <?php
        $routeController->actionCatcherController();
    ?>
      
     
  </body>
</html>


