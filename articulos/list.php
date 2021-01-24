<?php
session_start();
require_once ('../conexion.php');
require_once ('../functions.php');
$sql ="SELECT id,post_excerpt,post_title,post_content FROM `wp_posts` WHERE post_status = 'publish' AND post_author =".$_SESSION['ID'];
logMessage($sql);
$result = $obj_conexion -> query($sql);
$articulos = array();
while($row = mysqli_fetch_array($result))
{
	$producto = [
		'id' => $row['id'],
		'codigo' => $row['post_excerpt'],
		'title' => $row['post_title'],
		'conten' => $row['post_content']
	];
	array_push($articulos, $producto);
}
//obtener el detalle de un producto por el api

use Automattic\WooCommerce\Client;
$woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3','timeout' => 600, 'verify_ssl' => false]);
echo $woocommerce->get('products'); 
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