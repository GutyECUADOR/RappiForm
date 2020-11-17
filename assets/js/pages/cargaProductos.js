const app = new Vue({
    el: '#app',
    data: {
      titulo: 'Carga de productos Rappi por Excel',
      productos: [],
      nuevoProducto: new Producto(),
      productoEditado: new Producto(),
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
        checkDuplicatedValue() {
          let varianteDuplicada = null;
          let productoDuplicado = null

          let revisionIndividual = (producto) => {
            let arrayDuplicados = producto.variantes.map(item => { 
                return producto.variantes.filter(variante => {
                  return variante.talla == item.talla && variante.color == item.color;
              });
            }); 
           
            return arrayDuplicados.some((item, index) => {
              productoDuplicado = producto;
              varianteDuplicada = index;
             
              return item.length > 1
            }); // Some retorna true si algun item del array cumple con la condicion
          }

          let respuesta = { isDuplicado: this.productos.some((revisionIndividual)), productoDuplicado: productoDuplicado, varianteDuplicada: varianteDuplicada, }
          return respuesta;
          
        },
        validateExcelFile(event){
            this.productos = [];
            let files = event.target.files;
            if (files) { //Comprobar que existen archivo seleccionado

              let fileReader = new FileReader();
              let archivo = files[0];
              fileReader.readAsArrayBuffer(archivo);
              fileReader.onload = (event) => {
                let data = new Uint8Array(fileReader.result);
                let workbook = XLSX.read(data, { type: 'array' });

                /* DO SOMETHING WITH workbook HERE */
                let hojaExcel = workbook.SheetNames[4];
                /* Get worksheet */
                let worksheet = workbook.Sheets[hojaExcel];
                let rows = (XLSX.utils.sheet_to_json(worksheet, { raw: true }));


                try {
                  rows.forEach((rowExcel) => {
                   
                    let newProducto = new Producto();
                    newProducto.codigo = rowExcel['SKU INTERNO'];
                    newProducto.sku = rowExcel['EAN'];
                    newProducto.nombre = rowExcel['name'];
                    newProducto.refaliado = '3405';
                    newProducto.descripcion = rowExcel['Descripcion'];
                    newProducto.marca = rowExcel['Trademark (marca del producto)'];
                    newProducto.precio = rowExcel['price'];
                    newProducto.categoria1 = rowExcel['Parent'];
                    newProducto.categoria2 = rowExcel['Categoria 1'];
                    newProducto.categoria3 = rowExcel['Categoria 2'];
                    newProducto.categoria4 = rowExcel['Categoria 3'];
                    newProducto.tipoVariante = '';
                    newProducto.valorVariante = '';
                    newProducto.aplicaVariante = 0;
                   
                    this.productos.push(newProducto);
                  });
                  
                  console.log(this.productos);

                } catch (error) {
                  document.getElementById('formExcel').reset();
                  alert(`Formato de archivo invalido. ${error}`);
                  this.productos = [];
                  console.log(error);
                  return false;
                }

                

              }
            }
         
        },
        editarProducto(producto){
          this.productoEditado = producto;
          console.log(this.productoEditado);
          this.getTiposVarianteEditar(this.productoEditado.tipoVariante);
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
        getTiposVarianteEditar(tipo){
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
            alert('Cargue un archivo de Excel con el formato requerido antes de registrar.');
            return
          }

          let checkDuplicatedValue = this.checkDuplicatedValue();
          console.log(checkDuplicatedValue);
          if (checkDuplicatedValue.isDuplicado) {
            alert(`El producto ${checkDuplicatedValue.productoDuplicado.nombre}, posee la variante # ${(checkDuplicatedValue.varianteDuplicada)+1} duplicada, corrija talla o color y reintente.`);
            return;
          }

          console.log('Productos', this.productos);

          let formData = new FormData();
          formData.append('productos', JSON.stringify(this.productos));

          fetch(`./views/modulos/ajax/api.php?action=postAddNewProducto_Shopy_Master`, {
            method: 'POST',
            body: formData
          })
            .then(response => {
              return response.json();
            })
            .then(data => {
              console.log('Producto Actalizado', data);
              if (data.status == 'success') {
                this.producto = new Producto();
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



