<?php
if (!isset($_SESSION["usuarioRUC".APP_UNIQUE_KEY])){
    header("Location:index.php?&action=login");  
 }   

?>
 
 <?php include 'sis_modules/header_main.php'?>

    <div id="app" class="container card">
       
        <!-- Row de cabecera-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="text-center">
                        <h3>{{ titulo }}</h3>
                    </div>
                    
            
                    <div class="input-group select-group">
                        <input type="text" id="inputBusquedaProducto" placeholder="Termino de busqueda..." class="form-control" value="" style="width: 75%;"/>
                        <select id="tipoBusquedaModalCliente" class="form-control input-group-addon" style="width: 25%;">
                            <option value="CODIGO">Codigo</option>
                            <option value="NOMBRE">Nombre</option>
                            
                        </select>
                        <div class="input-group-btn">
                            <button id="searchClienteModal" type="button" class="btn btn-primary" aria-label="Help">
                                <span class="glyphicon glyphicon-search"></span> Buscar
                            </button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-12">
            <table class="table table-striped table-sm" id="tbl_productos">
                <thead>
                    <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre de Producto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ultima Actualizacion</th>
                    <th scope="col" class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="producto in productos">
                        <th scope="row">{{ producto.CODIGO }}</th>
                        <td>{{ producto.NOMBRE }}</td>
                        <td>{{ producto.GRUPO }}</td>
                        <td>-</td>
                        <td class="text-right">
                            <button type="button" @click="showModalDetail(producto)" class="btn btn-primary btn-sm">Editar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            
        </div>

      
        <!-- Modal  -->
        <?php require_once 'sis_modules/modal_productoDetail.php'?>
     
    </div>


    <!-- USO JQUERY, y Bootstrap CDN-->
    <script src="assets\js\vue.js"></script>

    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\bootstrap-datepicker.js"></script>
   
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\popper.min.js"></script>
  
     <!-- JS Propio-->
    
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\pnotify.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\sweetalert2@8.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\bootstrap-datepicker.es.min.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=ubmvgme7f7n7likjbniglty12b9m92um98w9m75mdtnphwqp"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\tinymce.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\datepicker.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\xlsx.full.min.js"></script>
    
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\pages\app.js"></script>
