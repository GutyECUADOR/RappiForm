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
                        <form id="formExcel">
                            <div class="input-group">
                                <span class="input-group-addon">Seleccione el archivo excel a cargar:</span>
                                <input type="file" name="excelFile" id="excelFile" @change="validateExcelFile" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
                            </div>
                        </form>
                        
                       
                    </div>

                  
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                
                    <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-upload" aria-hidden="true"></i> Items a cargar</h4>
                    <div class="btn-group pull-right">
                    </div>
                    </div>

                    <div class="panel-body">
                        <div class="responsibetable">        
                            <table class="table table-bordered tableExtras">
                                <thead>
                                    <tr>
                                    <th style="min-width: 100px;" class="text-center">Codigo Winfenix</th>
                                    <th style="min-width: 200px;" class="text-center">Nombre del Articulo</th>
                                    <th style="min-width: 200px;" class="text-center">Precio</th>
                                    <th style="min-width: 50px;" class="text-center">Editar</th>
                                </tr>
                                </thead>
                                <tbody id="tablaProductos">
                                    <tr v-for="producto in productos">
                                        <td>
                                            <input type="text" :value="producto.codigo" class="form-control text-center input-sm" readonly>
                                            
                                        </td>
                                        <td>
                                            <input type="text" v-model='producto.nombre' class="form-control text-center input-sm" readonly>
                                        </td>
                                        <td>
                                            <input type="text" v-model='producto.precio' class="form-control text-center input-sm" readonly>
                                        </td>
                                        <td>
                                            <button class="btn btn-default input-sm btn-block" @click="editarProducto(producto)" type="button" data-toggle="modal" data-target="#modalEditarProducto">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-group-justified" role="group">
                

                    <div class="btn-group" role="group">
                        <button type="button" @click="saveProducts()" class="btn btn-primary btn-lg" disabled><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Guardar</button>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Cancelar</button>
                    </div>
               
                </div>
            </div> 
            
        </div>
      
        <!-- Modal Info sesion -->
        <?php require_once 'modals/modal_info_session.php'?>

        <!-- Modal Info sesion -->
        <?php require_once 'modals/modal_editar_producto.php'?>
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
    
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\clases\producto.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\pages\cargaProductos.js"></script>
