<?php
    session_start();
    if (!isset($_SESSION['user_email'])) {
        header('Location: ../login.php');
    }
require_once ('../conexion.php');

//obtener el detalle de un producto por el api
// echo json_encode($woocommerce->get('products/2000')); 
//echo json_encode($articulos);
include("../layouts/topLayout.php"); 
?>
<!-- AREA DE TRABAJO-->
<style>
   .spinner {
  margin: 100px auto 0;
  width: 70px;
  text-align: center;
}

.spinner > div {
  width: 18px;
  height: 18px;
  background-color: #dd9933;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% { 
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
}
</style>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row m-t-25">
                 <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">Crear Articulos por Lotes <div style="text-align: right;"><a href="uploaded_files\plantilla.xlsx"> plantilla de excel</a></div> </div>
                        <div class="card-body">
                           <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertCargaMasiva" style="display: none;">
                                 <strong>¡La carga masiva ha sido exitosa!</strong> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                             </button>
                                                </div>
                            <form id="formCargaMasiva" method="post" action="procesarCargaMasiva.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                          
                                            <div class="form-group">
                                              <label for="filas">Numero de Articulos</label>
                                              <input type="text" class="form-control" id="filas" name="filas" placeholder="Número de Filas">
                                            </div>
                                          
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="excel_file" aria-describedby="inputGroupFileAddon01">
                                                    <label  id="labelFile" class="custom-file-label" for="inputGroupFile01">Seleccione</label>
                                                    
                                                </div>
                                              </div>
                                          
                                        </div>
                                        <div class="row">
                                        <input id="btnEnviar" type="submit" name="Upload" value="Enviar" class="btn btn-primary" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
             
                 </div>
            </div>
    <hr>
    <p class="respuesta">

    <p>
<section>
  <div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body text-center">
          <h5 class="card-title display-55">Gestionar categorias</h5>
          <hr class="bg-primary" />
          <!-- Contenedor de la tabla -->
          <div class="table-responsive" style="overflow-x: auto;">
            <!-- Tabla -->
            <table id="artUpload" class="table table-hover table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio Final</th>
                  <th scope="col">Inventario</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
            <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        	  <div class="modal-dialog modal-dialog-centered" role="document">
        	    <div class="spinner">
        		  <div class="bounce1"></div>
        		  <div class="bounce2"></div>
        		  <div class="bounce3"></div>
        		</div>
        	  </div>
        	</div>
        	
        	<!-- Modal -->
            <div class="modal fade" id="modal-info-15" tabindex="-1" data-backdrop="false" data-keyboard="true" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¡Hola estas en Tepuybay!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-justify">Por lo que vemos quieres realizar el proceso de carga masiva, dicho proceso te servirá para cargar los artículos de tu inventario por primera vez y para actualizar los mismos. </p>
                    <p class="text-justify">Tepuybay le sumará un 15% al precio final de sus artículos de manera automática , esto para cubrir los gastos operativos y tener nuestro margen de ganancia por cada venta que se haga a través de nuestra plataforma.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
            <!-- FIN AREA DE TRABAJO-->
            <script type="text/javascript">
              var jsonRes; var tmp;
              var pivoteAdd = 99;
              var pivoteUp = 99;
              var i = 1;
              var j = 1;
              var addArt =  new Array();
              var upArt =  new Array();
              var pivoteUpMax = 0;
              var pivoteAddMax = 0;
              const inputFile = document.getElementById('inputGroupFile01');
              const labelFile = document.getElementById('labelFile');
              const alertCargaMasiva = document.getElementById('alertCargaMasiva');
              
              inputFile.addEventListener('change', () => {
                labelFile.innerText = inputFile.files[0].name;
              });
              
              $(document).ready(function () {
                  $('#modal-info-15').modal('show');
                  
                  $("#formCargaMasiva").bind("submit",function(){
                      // Capturamnos el boton de envío
                      var btnEnviar = $("#btnEnviar");
                      $.ajax({
                          type: $(this).attr("method"),
                          url: $(this).attr("action"),
                          data: new FormData(this),
                          contentType: false,
                          cache: false,
                          processData: false,
                          
                          //data:$(this).serializeArray(),
                          beforeSend: function(){
                              /*
                              * Esta función se ejecuta durante el envió de la petición al
                              * servidor.
                              * */
                              // btnEnviar.text("Enviando"); Para button 
                              btnEnviar.val("Enviando"); // Para input de tipo button
                              btnEnviar.attr("disabled","disabled");
                              $('#modal').modal('show');
                          },
                          complete:function(data){
                              /*
                              * Se ejecuta al termino de la petición
                              * */
                              btnEnviar.val("Enviar formulario");
                              btnEnviar.removeAttr("disabled");
                              tmp = data;
                              jsonRes = data.responseJSON;
                              if(jsonRes.add.length < 100){
                                pivoteAdd = jsonRes.add.length -1;
                              }else{
                                pivoteAddMax = jsonRes.add.length -1;
                              }
                              $.each(jsonRes.add, function(index, value){
                                  $("#artUpload tbody").append("<tr><th scope='row'>" + value.short_description + "</th><td>" + value.name + "</td><td>" + value.description + "</td>"+"<td>"+ value.final_price +"</td>"+"<td>" + value.stock_quantity + "</td></tr>");
                                  addArt.push(value.sku);

                                  //console.log(index);
                                  if(index == pivoteAdd || index == pivoteAddMax){
                                    console.log("Add "+i);
                                    sendToWP(addArt,"add");
                                    i++;
                                    pivoteAdd = i * 100 - 1;
                                    addArt.length = 0;
                                  }
                              });
                              if(jsonRes.update.length < 100){
                                pivoteUp = jsonRes.update.length -1;
                              }else{
                                pivoteUpMax = jsonRes.update.length -1;
                              }
                              $.each(jsonRes.update, function(index, value){
                                $("#artUpload tbody").append("<tr><th scope='row'>" + value.short_description + "</th><td>" + value.name + "</td><td>" + value.description + "</td><td>" + value.regular_price + "</td>"+ "<td>"+ value.final_price +"</td>"+"<td>" + value.stock_quantity + "</td></tr>");
                                upArt.push(value.sku);
                                if(index == pivoteUp || index == pivoteUpMax){
                                    console.log("Update "+i);
                                    sendToWP(upArt,"update" );
                                    j++;
                                    pivoteUp = j * 100 - 1;
                                    upArt.length = 0;
                                  }
                              });
                              
                              labelFile.innerText = 'Seleccione';
                              $('#modal').modal('hide');
                              alertCargaMasiva.style.display = 'block';
                          },
                          error: function(data){
                              /*
                              * Se ejecuta si la peticón ha sido erronea
                              * */
                              console.log(data);
                              alert("Problemas al tratar de enviar el formulario");
                          }
                      });
                      // Nos permite cancelar el envio del formulario
                      return false;
                  });
              });
              function sendToWP(jsonRes,met){
                //addLeng = jsonRes.add.length;
                //upLeng = jsonRes.update.length;
                if(met == "add"){
                  data= {"add": JSON.stringify(jsonRes)};
                } else {
                  data= {"update": JSON.stringify(jsonRes)};
                }
                    /*
                    $.post( "sendCM.php", data, function( response ) {
                      console.log( response ); 
                    });
                    */

                    $.getJSON( "sendCM.php", data )
                        .done(function( data, textStatus, jqXHR ) {
                            if ( console && console.log ) {
                                console.log( "La solicitud se ha completado correctamente." );
                            }
                        })
                        .fail(function( jqXHR, textStatus, errorThrown ) {
                            if ( console && console.log ) {
                                console.log( "Algo ha fallado: " +  textStatus );
                            }
                    });

                }
            </script>
            <!-- END PAGE CONTAINER-->
<?php include("../layouts/bottomLayout.php"); ?>