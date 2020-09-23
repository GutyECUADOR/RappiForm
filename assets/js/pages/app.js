
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
      tiposVariantes: [],
      valoresVariantes: []
    },
    methods:{
        init(){
            fetch(`./api/index.php/api.php?action=getInfoInitForm`)
                .then( response => {
                return response.json();
                })
                .then( result => {
                console.log('InitForm', result.data);
                this.getAllProductos();
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
        getAllProductos(){
            fetch(`./api/index.php/api.php?action=getAllProductos_Rappi`)
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
                        this.nuevoProducto.descripcion = producto.DESCRIPCION;
                        this.nuevoProducto.sku = producto.SKU;
                        this.nuevoProducto.precio = producto.PRECIO;
                        this.nuevoProducto.marca = producto.CODIGOMARCA;
                    }
            }).catch( error => {
                console.error(error);
            });  
        },
        addProductToList(){
            console.log(this.nuevoProducto)
            if (this.nuevoProducto.refaliado && this.nuevoProducto.marca && this.nuevoProducto.categoria1
                && this.nuevoProducto.categoria2 && this.nuevoProducto.categoria3 && this.nuevoProducto.categoria4
                && this.nuevoProducto.imagen && this.nuevoProducto.tipoVariante && this.nuevoProducto.valorVariante 
                ) {
                   
                    let formData = new FormData();
                    formData.append('producto', JSON.stringify(this.nuevoProducto));
        
                    fetch(`./api/index.php/api.php?action=postAddProducto`, {
                    method: 'POST',
                    body: formData
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        console.log('Producto registrados', data);
                        if (data.status == 'success') {
                        this.nuevoProducto = new Producto();
                        document.querySelector('#inputNuevoCodProducto').value = '';
                        this.getAllProductos();
                        }
                        alert(data.mensaje)
                    }).catch(error => {
                        console.error(error);
                    });
                   
                }else{
                    alert('El producto esta incompleto. Revise que se ha ingresado toda la informacion.');
                }

           
        },
        deleteProductToList(producto) {

            let index = this.productos.findIndex(function (productoEnArray) {
                return productoEnArray.codigo === producto.codigo;
            });

            this.productos.splice(index, 1);
        },
        getTiposVariante(event){
           let tipo = event.target.value.trim();
           let busqueda = JSON.stringify({tipo});
           console.log(busqueda)
           fetch(`./api/index.php/api.php?action=getValoresVariantes&busqueda=${ busqueda }`)
                .then( response => {
                return response.json();
                })
                .then( result => {
                console.log('Valores Variantes', result.data);
                this.valoresVariantes = result.data
            }).catch( error => {
                console.error(error);
            });  
        },
        saveProducts() {
            if (this.productos.length <= 0) {
              alert('Agregue productos a la lista, antes de registrar.');
              return
            }
  
            console.log('Producto', this.productos);
  
            let formData = new FormData();
            formData.append('productos', JSON.stringify(this.productos));
  
            fetch(`./api/index.php/api.php?action=postAddProductos`, {
              method: 'POST',
              body: formData
            })
              .then(response => {
                return response.json();
              })
              .then(data => {
                console.log('Productos registrados', data);
                if (data.status == 'success') {
                  this.productos = [];
                }
                alert(data.mensaje)
              }).catch(error => {
                console.error(error);
              });
          }
      
    },
    mounted(){
        this.init();
      }
  })



