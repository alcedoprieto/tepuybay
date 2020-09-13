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
                        <div class="card-header">Crear Articulo Individual</div>
                        <div class="card-body">

                            <div class="row">
							  	<div class="col-8">
								  	<div class="row">
									    <input type="text" class="form-control" placeholder="Nombre">
									</div>
								  	<div class="row">
									    <input type="text" class="form-control" placeholder="Descripción Corta">
									</div>
								  	<div class="row">
									    <textarea class="form-control" aria-label="With textarea" placeholder="Descripción Larga"></textarea>
									</div>
							  	</div>
							  	<div class="col-4">
								  	<div class="row">
										<div class="card" style="width: 18rem;">
										  <img class="card-img-top" src="http://repuestos.prieto.ec/wp-content/plugins/wc-frontend-manager/includes/libs/upload/images/Placeholder.png" alt="Card image cap">
										  <div class="card-body">
										    <div class="input-group mb-3">
											  <div class="custom-file">
											    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
											    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
											  </div>
											</div>
										  </div>
										</div>
									</div>
									<div class="row">
										
									</div>
							  	</div>
							  	<button type="button" class="btn btn-primary">Primary</button>
							</div>
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
<?php //echo json_encode($woocommerce->get('products/categories',['page' => '2'])); ?>
