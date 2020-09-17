
const app = new Vue({
    el: '#app',
    data: {
      titulo: 'Productos de Rappi KAO',
      productos: [],
      nuevoProducto: null
    },
    methods:{
        getAllProductos(codigo=''){
            fetch(`./api/index.php?action=getAllProductos_Shopy_Master&codigo=${ codigo }`)
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log('Productos', data);
                this.productos = data.productos;  
            }).catch(function(error) {
                console.error(error);
            });  
        },
        showModalDetail(producto){
            console.log(producto);
            this.producto_activo = producto.CODIGO;

            $('#producto_nombre').val(producto.NOMBRE);
            $('#producto_etiquetas').val(producto.ETIQUETAS);
            $('#producto_grupos').val(producto.GRUPO);
            tinymce.get('producto_descripcion').setContent(producto.DESCRIPCION);
            $('#modal_productoDetail').modal('show');
        },
        actualizarProducto(){
            let newContent =  tinymce.get('producto_descripcion').getContent();
            let index = this.productos.findIndex( producto => {
                return producto.CODIGO == this.producto_activo;
            });

            if (index == -1){ 
                alert('No se encontro el codigo de producto para actualizar.');
                return; 
            }
            
                this.productos[index].DESCRIPCION = newContent;

                let formData = new FormData();
                formData.append('producto', JSON.stringify(this.productos[index]));  

                fetch(`./api/index.php?action=postActualizaProducto_Shopy_Master`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    console.log('Producto Actalizado', data);
                    this.getAllProductos();
                    alert(data.mensaje)
                }).catch(function(error) {
                    console.error(error);
                });  

           
            
            
        }
    },
    mounted(){
        this.getAllProductos();
      }
  })



