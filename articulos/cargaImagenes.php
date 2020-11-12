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
          <section>
            <div class="row">
              <div class="col-md-12 mx-auto">
                <div class="card card-signin my-5">
                  <div class="card-body text-center">
                    <h5 class="card-title display-55">Cargar Imágenes de Articulos</h5>
                    <hr class="bg-primary" />
          <section role="main">
            <div class="uploader__box js-uploader__box l-center-box">
                
            </div>
          </section>
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
    var options = {
      instructionsCopy: "Seleccione las images de sus artículos",
      submitButtonCopy: "Enviar Imagenes",
      furtherInstructionsCopy: "",
      selectButtonCopy: "Agrege Imagenes",
      secondarySelectButtonCopy: "Agrege mas Imagenes",
      badFileTypeMessage: "Tipo de archivo inválido",
      ajaxUrl: "procesarImagenes.php"
    };
    $('.js-uploader__box').uploader(options);
</script>
<!-- END PAGE CONTAINER-->
<?php include("../layouts/bottomLayout.php"); ?>