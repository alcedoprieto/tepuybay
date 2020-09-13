<?php
session_start();
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
                            <form method="post" action="procesarCargaMasiva.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                        <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="excel_file" aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                        <input type="submit" name="Upload" value="Upload" />
                                        <button type="button" class="btn btn-primary">Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
             
                 </div>
            </div>

        </div>
    </div>
</div>
            <!-- FIN AREA DE TRABAJO-->
            <script type="text/javascript">

            </script>
            <!-- END PAGE CONTAINER-->
<?php include("../layouts/bottomLayout.php"); ?>

