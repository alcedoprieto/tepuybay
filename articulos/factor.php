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

/*use Automattic\WooCommerce\Client;
$woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3','timeout' => 600, 'verify_ssl' => false]);
echo $woocommerce->get('products'); */
//echo json_encode($articulos);
include("../layouts/topLayout.php"); 
?>
            <!-- AREA DE TRABAJO-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="card-body text-secondary">
                                    <div class="card">
                                        <div class="card-header"><h3>Actualización de Precios</h3></div>
                                            <div class="card-body">
                                                <form action="" method="POST">
                                                    <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <p class="card-text">Factor actual: 1</p>
                                                            <div class="form-group">
                                                                <label for="cc-number" class="control-label mb-1">Factor de cambio</label>
                                                                <input id="cc-number" name="seguimiento_id" type="tel" class="form-control cc-number identified visa" 
                                                                    autocomplete="cc-number" >
                                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                                            </div>                                   
                                                            <a href="#" class="btn btn-primary">Simular</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="card">
                                                        <div class="card-body">
                                                            <p class="card-text">Tasa BCV: 1.821.534,67</p>
                                                            <div class="form-group">
                                                                <label for="cc-number" class="control-label mb-1">Actualización Automatica</label>
                                                                <select name="status_id" id="" class="form-control cc-number identified visa">
                                                                    <option value="0">Desactivada</option>
                                                                    <option value="1">Activada</option>
                                                                </select>
                                                            
                                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                                            </div>
                                                            <a href="#" class="btn btn-primary">Establecer</a>
                                                        </div>
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