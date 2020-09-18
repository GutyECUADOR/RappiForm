
const app = new Vue({
    el: '#app',
    data: {
      titulo: 'Productos de Rappi KAO',
      productos: [],
      nuevoProducto: new Producto(),
      aliados: [],
      marcas: [],
      categorias1: [],
      categorias2: [],
      categorias3: [],
      categorias4: [],
      tiposVariantes: []
     
    },
    methods:{
        init(){
            fetch(`./api/index.php/api.php?action=getInfoInitForm`)
                .then( response => {
                return response.json();
                })
                .then( result => {
                console.log('InitForm', result.data);
                this.aliados = result.data.aliados;
                this.marcas = result.data.marcas;
                this.categorias1 = result.data.categorias1;
                this.categorias2 = result.data.categorias2;
                this.categorias3 = result.data.categorias3;
                this.categorias4 = result.data.categorias4;
                this.categorias4 = result.data.categorias4;
                this.tiposVariantes = result.data.tiposVariantes
            }).catch( error => {
                console.error(error);
            });  
        },

        buscarProducto(){
            let codigo = document.querySelector('#inputNuevoCodProducto').value;
            let busqueda = JSON.stringify({codigo});
            fetch(`./api/index.php/api.php?action=getInfoProducto&busqueda=${ busqueda }`)
                .then( response => {
                return response.json();
                })
                .then( result => {
                    console.log(result)
                    if (result.data) {
                        let producto = result.data;
                        this.nuevoProducto.codigo = producto.CODIGO;
                        this.nuevoProducto.nombre = producto.NOMBRE;
                    }
            }).catch( error => {
                console.error(error);
            });  
        },
        addProductToList(){
            let existeInArray = this.productos.findIndex( (productoEnArray) => {
                return productoEnArray.codigo === this.nuevoProducto.codigo;
            });

            if (existeInArray === -1) { 
                this.productos.push(this.nuevoProducto);
                this.nuevoProducto = new Producto();
            } else {
                alert('El item ' + this.nuevoProducto.codigo + ' ya existe en la lista');
            }
            console.log(this.productos)
        },
        deleteProductToList(producto) {

            let index = this.productos.findIndex(function (productoEnArray) {
                return productoEnArray.codigo === producto.codigo;
            });

            this.productos.splice(index, 1);
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
      
    },
    mounted(){
        this.init();
      }
  })



