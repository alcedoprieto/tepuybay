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
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row m-t-25">
                 <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">Crear Articulos por Lotes</div>
                        <div class="card-body">
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
                                                    <label class="custom-file-label" for="inputGroupFile01">Seleccione</label>
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
          <div class="table-responsive">
            <!-- Tabla -->
            <table id="artUpload" class="table table-hover table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio</th>
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
              $(document).ready(function () {
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
                              }
                              $.each(jsonRes.add, function(index, value){
                                  $("#artUpload tbody").append("<tr><th scope='row'>" + value.short_description + "</th><td>" + value.name + "</td><td>" + value.description + "</td><td>" + value.regular_price + "</td><td>" + value.stock_quantity + "</td></tr>");
                                  addArt.push(value.sku);

                                  //console.log(index);
                                  if(index == pivoteAdd || index == (jsonRes.add.length -1)){
                                    console.log("Add "+i);
                                    sendToWP(addArt,"add");
                                    i++;
                                    pivoteAdd = i * 100 - 1;
                                    addArt.length = 0;
                                  }
                              });
                              if(jsonRes.update.length < 100){
                                pivoteUp = jsonRes.update.length -1;
                              }
                              $.each(jsonRes.update, function(index, value){
                                $("#artUpload tbody").append("<tr><th scope='row'>" + value.short_description + "</th><td>" + value.name + "</td><td>" + value.description + "</td><td>" + value.regular_price + "</td><td>" + value.stock_quantity + "</td></tr>");
                                upArt.push(value.sku);
                                if(index == pivoteUp || index == (jsonRes.update.length -1)){
                                    console.log("Update "+i);
                                    sendToWP(upArt,"update" );
                                    j++;
                                    pivoteUp = j * 100 - 1;
                                    upArt.length = 0;
                                  }
                              });
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