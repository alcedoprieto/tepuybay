<?php
session_start();
require_once ('../conexion.php');

$sql ="SELECT * FROM `wpzz_posts` WHERE post_author =".$_SESSION['ID'];

$result = $obj_conexion -> query($sql);
while($row = mysqli_fetch_array($result))
{
	$articulos[] = $row;
}
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
                                    <div class="card-header">Articulos del Usuario</div>
                                    <div class="card-body">
	                                    <table class="table table-borderless table-data3" id="tablaProductos">
	                                        <thead>
	                                            <tr>
	                                                <th>date</th>
	                                                <th>type</th>
	                                                <th>description</th>
	                                                <th>status</th>
	                                                <th>price</th>
	                                            </tr>
	                                        </thead>
	                                        <form action=""id="actualizarCuentas" name="cuenta"  method="POST">
	                                            
	                                            <tbody>
	                                            </tbody>
	                                        </form>
	                                    </table>
                                    </div>
                                </div>
                         
                             </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- FIN AREA DE TRABAJO-->
            <script type="text/javascript">
            	var articulos = <?php echo json_encode($articulos); ?>;
            	            //Llenado de tabla
	            //tmp = JSON.parse(json_object);
	            $("#tablaProductos thead tr").remove();
	            $("#tablaProductos tbody tr").remove();
	            $("#tablaProductos thead").append('<tr></tr>');
	            $.each(articulos[0],function(index, value){
	                    $("#tablaProductos thead tr").append('<th>'  + index + '</th>');
	            });
	            for(var k in articulos) {
	                $("#tablaProductos tbody").append('<tr id='+k+'></tr>');
	                $.each(articulos[k],function(index, value){
	                    $("#"+k).append('<td>'  + value + '</td>');
	                   
	                });
	            }
            </script>
            <!-- END PAGE CONTAINER-->
<?php include("../layouts/bottomLayout.php"); ?>