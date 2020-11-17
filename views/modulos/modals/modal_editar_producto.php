<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edición de Item</h4>
        </div>

        <div class="modal-body">
            <form id='formEditarProducto'>
                
            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Codigo</span>
                <input type="text" v-model='productoEditado.codigo' class="form-control text-center input-sm" readonly>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">SKU</span>
                <input type="text" v-model='productoEditado.sku' class="form-control text-center input-sm" readonly>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Nombre del Producto</span>
                <input type="text" v-model='productoEditado.nombre' class="form-control text-center input-sm">
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Descripcion</span>
                <textarea v-model='productoEditado.descripcion' class="form-control" rows="3" ></textarea>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Referencia Aliado</span>
                <select id="aliados" v-model='productoEditado.refaliado' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="aliado in aliados" :value="aliado.CODIGO_ECCOMERCE">
                    {{aliado.NOMBRE}}
                    </option>
                </select>
            </div>

            

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Marca</span>
                <select id="marcas" v-model='productoEditado.marca' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="marca in marcas" :value="marca.NOMBRE">
                    {{marca.NOMBRE}}
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Categoria 1</span>
                <select v-model='productoEditado.categoria1' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="categoria in categorias1" :value="categoria.NOMBRE">
                        {{categoria.NOMBRE}}
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Categoria 2</span>
                <select v-model='productoEditado.categoria2' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="categoria in categorias2" :value="categoria.NOMBRE">
                        {{categoria.NOMBRE}}
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Categoria 3</span>
                <select v-model='productoEditado.categoria3' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="categoria in categorias3" :value="categoria.NOMBRE">
                        {{categoria.NOMBRE}}
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Categoria 4</span>
                <select v-model='productoEditado.categoria4' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="categoria in categorias4" :value="categoria.NOMBRE">
                        {{categoria.NOMBRE}}
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Tipo Variante</span>
                <select v-model='productoEditado.tipoVariante' @change="getTiposVariante($event)" class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="variante in tiposVariantes" :value="variante.NOMBRE">
                    {{variante.NOMBRE}}
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Valor Variante</span>
                <select v-model='productoEditado.valorVariante' class="form-control input-sm">
                    <option value="">Seleccione por favor</option>
                    <option v-for="variante in valoresVariantes" :value="variante.NOMBRE">
                    {{ variante.CODIGO }} ({{variante.NOMBRE}})
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Aplica Variante</span>
                <select v-model='productoEditado.aplicaVariante' class="form-control input-sm">
                    <option value="0">No posee variantes</option>
                    <option value="1">Si posee variantes</option>
                   
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon" style="min-width: 217px;">Imagen</span>
                <textarea v-model='productoEditado.imagen' class="form-control" rows="3" ></textarea>
            </div>
            

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" @click="updateProducto()" class="btn btn-primary">Actualizar Producto</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>