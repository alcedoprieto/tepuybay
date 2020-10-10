<?PHP 
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  date_default_timezone_set("America/Caracas");
session_start();
    if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
    }
  
    include('conexion.php');
    $tepuy_id = $_GET['tepuy_id'];
    $banco_transfer = $_GET['banco_transfer'];
    $banco_nombre = $_GET['banco_nombre'];
    $banco_fecha = $_GET['banco_fecha'];
    $product_net_revenue = $_GET['product_net_revenue'];
    $boton=$_GET["boton"];

    $sql = "SELECT * FROM wpck_wc_order_product_lookup WHERE order_item_id = '$tepuy_id' ";
    $busqueda = $obj_conexion -> query($sql);
    if($registro=mysqli_fetch_array($busqueda)){
      $date_created = $registro['date_created'];
      $product_id = $registro['product_id'];
      $product_qty = $registro['product_qty'];
      $product_net_revenue = $registro['product_net_revenue'];
    }
        $sql1 = "SELECT * FROM wpck_posts WHERE id = '$product_id'";
        $busqueda1 = $obj_conexion -> query($sql1);
        if($registro1=mysqli_fetch_array($busqueda1)){
        $post_title = $registro1['post_title'];
        }
    if($boton=="Guardar"){
        $consulta="INSERT INTO wp_report_tepuy (tepuy_id, product_name, product_id, product_date, banco_nombre, banco_transfer, banco_fecha, status_id, banco_monto) 
        VALUES ('$tepuy_id', '$post_title', '$product_id', '$date_created', '$banco_nombre', '$banco_transfer', '$banco_fecha', 'En Proceso', '$product_net_revenue')";
        $resultado = $obj_conexion -> query($consulta)|| die("Error Transferencia");
        if($resultado)
        {
            echo '<script>setTimeout(function(){swal({title:"Buen trabajo!!!",text:"Transferencia Registrada",type:"success"},
            function(isConfirm){location.href="index.php";});}, 100);</script>';
        }
        else
        {
            echo '<script>setTimeout(function(){swal({title:"Error en Registro!!!",text:"Falla al Registrarse",type:"warning"});}, 100);</script>';
        }
    }



?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
    <!-- Required meta tags-->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>.: TepuyBay :.</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">


    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBIL-->
        <?php include("headermobil.php"); ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php include("aside.php"); ?>
        <!-- END MENU SIDEBAR-->

        <!-- CONTENIDO DE PAGINA-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include("header.php"); ?>
            <!-- HEADER DESKTOP-->

            <!-- AREA DE TRABAJO-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                  <div class="container-fluid">
                    <h5 class="heading-title">Nro de Pedido <?php echo $tepuy_id; ?> </h5>
                    <div class="row" style="padding-left: 30px;border-left: 8px solid #585448;margin-left: 75px;">
                      <div class="col">
                        <section >
                          <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;"><?php echo $date_created; ?></span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span><div class="card">
                                    <div class="card-header"><h3>Pedido realizado</h3></div>
                                    <div class="card-body"><h5>Datos del pedido:</h5> <?php echo $product_id; ?>  <?php echo $post_title; ?>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" data-toggle="modal" data-target="#largeModal">
                                                    <i class="fa fa-check-square"></i>&nbsp;
                                                    <span id="payment-button-amount">Siguiente paso</span>
                                                </button>
                                            </div>


                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row">
                            <div class="col">
                                <section>
                                    <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;">12 May 2013</span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span><div class="card">
                                    <div class="card-header"><h3>Datos de la Transferencia</h3></div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Llena todos los campos</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="get" novalidate="novalidate">
                                        <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Id de Producto</label>
                                                <input id="cc-pament" name="tepuy_id" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $tepuy_id; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Monto de Transferencia</label>
                                                <input id="cc-pament" name="product_net_revenue" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $product_net_revenue; ?>" readonly>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Nombre del Banco</label>
                                                <select class="form-control cc-name valid" name="banco_nombre" >
                                                    <option value="Seleccione Banco">Seleccione Banco</option>
                                                    <option value="Provincial">Provincial</option>
                                                    <option value="Mercantil">Mercantil</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Numero de Transferencia</label>
                                                <input id="cc-number" name="banco_transfer" type="tel" class="form-control cc-number identified visa"  value="<?php echo $banco_transfer; ?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Fecha de Transferencia</label>
                                                        <input id="cc-exp" name="banco_fecha" type="date" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY"
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                <input type="submit" value="Guardar" name="boton" class="btn btn-lg btn-info btn-block"> 
                                                </div>
                                                <div class="col">
                                                <button type="button" class="btn btn-lg btn-info btn-block" data-toggle="modal" data-target="#mediumModal">
                                                    <i class="fa fa-check-square"></i>&nbsp;
                                                    <span id="payment-button-amount">Siguiente paso</span>
                                                   
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div></div>
                                </section>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <section >
                                    <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;">12 May 2013</span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span><div class="card">
                                    <div class="card-header"><h3>Datos del Envio</h3></div>
                                    <div class="card-body">
                                    <form action="" method="get" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Numero de Guia</label>
                                                <input id="cc-number" name="seguimiento_id" type="tel" class="form-control cc-number identified visa" 
                                                    autocomplete="cc-number" readonly>
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Status</label>
                                                <input id="cc-number" name="status_id" type="tel" class="form-control cc-number identified visa" 
                                                    autocomplete="cc-number" readonly>
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">

                                                <div class="col">
                                                <input type="submit" value="Enviar" name="boton" class="btn btn-lg btn-info btn-block"> 
                                                    <i class="fa fa-check-square"></i>&nbsp;
                                                    <span id="payment-button-amount">Siguiente Paso</span>
                                                   
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                </section>
                            </div>
                        </div>
                      </div>
                      



                    </div>
                   </div>
                  </div>  

            </div>

            <!-- PASO DOS-->

            <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Ultimo paso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Si ya enviaste tus datos de tranferencias haz culminado todo el proceso de compra.
                                A continuación tu información sera verificada y podras visualizar los datos de envio y link de seguimiento. 
                            </p>
                        </div>
                        <div class="modal-footer">
                            <h5>Si tienes dudas o problemas, enviamos un ticket y te asesoraremos</h5>
                        </div>
                    </div>
                </div>
            </div>








            <!-- PASO UNO-->

            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">Siguiente Paso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Si escogiste como metodo de pago Tranferencia Bancaria, para confirmar tu pago debes llenar el siguiente fomulario con los datos de la transferencias. 

                            </p>
                        </div>
                        <div class="modal-footer">Tienes un lapso de 12 hrs, sino tu pedido sera cancelado</div>
                    </div>
                </div>
            </div>
            <!-- FIN AREA DE TRABAJO-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
