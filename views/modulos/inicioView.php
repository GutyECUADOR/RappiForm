<?php
if (!isset($_SESSION["usuarioRUC".APP_UNIQUE_KEY])){
    header("Location:index.php?&action=login");  
 }   

?>
 
 <?php include 'sis_modules/header_main.php'?>

    <div id="app" class="container card">
        <!-- Hidden Inputs-->
        <input id="hiddenBodegaDefault" type="hidden" value="<?php echo $_SESSION["bodegaDefault"]?>">

        <!-- Row de cabecera-->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="text-center">
                        <h3>{{ titulo }}</h3>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- agregar productos-->
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <!-- Default panel contents -->
            
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Item</h4>
                    
                </div>
                                     
                <div class="panel-body">
                    <div class="responsibetable">     
                        <table id="tablaAgregaNuevo" class="table table-bordered tableExtras">
                            <thead>
                            <tr>
                                <th style="min-width: 170px;" class="text-center">Codigo Winfenix</th>
                                <th style="min-width: 200px;" class="text-center">Nombre del Articulo</th>
                                <th style="min-width: 110px;"  class="text-center">Ref. Aliado</th>
                                <th style="min-width: 110px;" class="text-center">Descripcion Rappi</th>
                                <th style="min-width: 130px;" class="text-center">SKU</th>
                                <th style="min-width: 100px;" class="text-center">Marca</th>
                                <th style="min-width: 110px;" class="text-center">Categoria1</th>
                                <th style="min-width: 110px;" class="text-center">Categoria2</th>
                                <th style="min-width: 110px;" class="text-center">Categoria3</th>
                                <th style="min-width: 110px;" class="text-center">Categoria4</th>
                                <th style="min-width: 120px;" class="text-center">Tipo Variante</th>
                                <th style="min-width: 120px;" class="text-center">Valor de la Variante</th>
                                <th style="min-width: 120px;" class="text-center">Imagen</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                        <input type="text" id="inputNuevoCodProducto" v-on:keyup="buscarProducto" class="form-control text-center input-sm" placeholder="Cod Producto...">
                                        <span class="input-group-btn">
                                            <button id="btnSeachProductos" class="btn btn-default input-sm" type="button" data-toggle="modal" data-target="#modalBuscarProducto">
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                        </div><!-- /input-group -->
                                    </td>
                                    <td>
                                        <input type="text" v-model='nuevoProducto.nombre' class="form-control text-center input-sm" readonly>
                                    </td>
                                    <td>
                                        <select id="aliados" v-model='nuevoProducto.refaliado' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="aliado in aliados" :value="aliado.CODIGO_ECCOMERCE">
                                            {{aliado.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                        <input type="text" id='descripcion' class="form-control text-center input-sm" readonly>
                                        <span class="input-group-btn">
                                            <button id="btnDetallePromo" class="btn btn-default input-sm" type="button" data-toggle="modal" data-target="#modalAddExtraDetail">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" v-model='nuevoProducto.sku' class="form-control text-center input-sm" readonly>
                                    </td>
                                    <td>
                                        <select id="marcas" v-model='nuevoProducto.marca' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="marca in marcas" :value="marca.CODIGO">
                                            {{marca.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="categoria1" v-model='nuevoProducto.categoria1' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="categoria in categorias1" :value="categoria.CODIGO">
                                                {{categoria.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <select id="categoria2" v-model='nuevoProducto.categoria2' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="categoria in categorias2" :value="categoria.CODIGO">
                                                {{categoria.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="categoria3" v-model='nuevoProducto.categoria3' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="categoria in categorias3" :value="categoria.CODIGO">
                                                {{categoria.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="categoria4" v-model='nuevoProducto.categoria4' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="categoria in categorias4" :value="categoria.CODIGO">
                                                {{categoria.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="tiposVariantes" v-model='nuevoProducto.tipoVariante'  @change="getTiposVariante($event)" class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="variante in tiposVariantes" :value="variante.NOMBRE">
                                            {{variante.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="tiposVariantes" v-model='nuevoProducto.valorVariante' class="form-control input-sm">
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="variante in valoresVariantes" :value="variante.NOMBRE">
                                            {{variante.NOMBRE}}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                        <input type="text" id='imagen' class="form-control text-center input-sm" readonly>
                                        <span class="input-group-btn">
                                            <button  class="btn btn-default input-sm" type="button" data-toggle="modal" data-target="#modalAddImagenDetail">
                                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                        </div>
                                    </td>
                                   
                                </tr>

                                
                                
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" @click='addProductToList'><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Agregar item</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- items en lista-->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                
                    <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Items a publicar en Rappi</h4>
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
                                    <th style="min-width: 110px;"  class="text-center">Ref. Aliado</th>
                                    <th style="min-width: 110px;" class="text-center">Descripcion Rappi</th>
                                    <th style="min-width: 130px;" class="text-center">SKU</th>
                                    <th style="min-width: 100px;" class="text-center">Marca</th>
                                    <th style="min-width: 110px;" class="text-center">Categoria1</th>
                                    <th style="min-width: 110px;" class="text-center">Categoria2</th>
                                    <th style="min-width: 110px;" class="text-center">Categoria3</th>
                                    <th style="min-width: 110px;" class="text-center">Categoria4</th>
                                    <th style="min-width: 120px;" class="text-center">Tipo Variante</th>
                                    <th style="min-width: 120px;" class="text-center">Valor de la Variante</th>
                                    <th style="min-width: 50px;" class="text-center">Eliminar</th>
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
                                            <select id="aliados" v-model='producto.refaliado' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="aliado in aliados" :value="aliado.CODIGO_ECCOMERCE">
                                                {{aliado.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                            <input type="text" id='descripcion' class="form-control text-center input-sm" readonly>
                                            <span class="input-group-btn">
                                                <button id="btnDetallePromo" class="btn btn-default input-sm" type="button" data-toggle="modal" data-target="#modalAddExtraDetail">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </button>
                                            </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" v-model='producto.sku' class="form-control text-center input-sm" readonly>
                                        </td>
                                        <td>
                                            <select id="marcas" v-model='producto.marca' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="marca in marcas" :value="marca.CODIGO">
                                                {{marca.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="categoria1" v-model='producto.categoria1' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="categoria in categorias1" :value="categoria.CODIGO">
                                                    {{categoria.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        
                                        <td>
                                            <select id="categoria2" v-model='producto.categoria2' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="categoria in categorias2" :value="categoria.CODIGO">
                                                    {{categoria.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="categoria3" v-model='producto.categoria3' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="categoria in categorias3" :value="categoria.CODIGO">
                                                    {{categoria.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="categoria4" v-model='producto.categoria4' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="categoria in categorias4" :value="categoria.CODIGO">
                                                    {{categoria.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="tiposVariantes" v-model='producto.tipoVariante' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="variante in tiposVariantes" :value="variante.NOMBRE">
                                                {{variante.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="tiposVariantes" v-model='producto.valorVariante' class="form-control input-sm">
                                                <option value="">Seleccione por favor</option>
                                                <option v-for="variante in valoresVariantes" :value="variante.NOMBRE">
                                                {{variante.NOMBRE}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" @click="deleteProductToList(producto)" class="btn btn-danger btn-sm btn-block" ><span class="glyphicon glyphicon-trash"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row extraButton">
            <div class="col-md-12">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-lg" @click="saveProducts"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Registrar</button>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-danger btn-lg" id="btnCancel"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Cancelar</button>
                    </div>
               
                </div>
            </div>
        </div>    

        <!-- Modal Info sesion -->
        <?php require_once 'modals/modal_info_session.php'?>

        <!-- Modal Info sesion -->
        <?php require_once 'modals/modal_producto.php'?>

        <!-- Modal Info sesion -->
        <?php require_once 'modals/modalAddExtraDetail.php'?>

         <!-- Modal Info sesion -->
         <?php require_once 'modals/modalAddImagenDetail.php'?>
         
     
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
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\pages\app.js"></script>
