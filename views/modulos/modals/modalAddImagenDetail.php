 <!-- Modal agregar fotos y detalles extra -->
 <div class="modal fade" id="modalAddImagenDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Imagen Rappi </h4>
                </div>
                <div class="modal-body">
                    
                <form method="post" name="fileinfo">
                   
                    <div class="form-group">
                        <label for="comment">Direccion de la imagen URL:</label>
                        <textarea v-model='nuevoProducto.imagen' class="form-control" rows="5"></textarea>
                    </div>

                </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>