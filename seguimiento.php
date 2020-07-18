<?PHP 
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  date_default_timezone_set("America/Caracas");

    session_start();
    if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
    }
    include('conexion.php');
    $mruser = $_SESSION['user_login'];
    $mrmail = $_SESSION['user_email'];
    $mrlevel = $_SESSION['user_status'];
    $mrreg = $_SESSION['user_registered'];
    $mrid= $_SESSION['ID'];

    $sql = "SELECT * FROM wp_wc_customer_lookup WHERE user_id ='$mrid' ";
    $busqueda = $obj_conexion -> query($sql);
    if($registro=mysqli_fetch_array($busqueda)){
      $first_name = $registro['first_name'];
      $last_name = $registro['last_name'];
      $customer_id = $registro['customer_id'];
      $city = $registro['city'];
      $country = $registro['country'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

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
                    <h5 class="heading-title">Pedido #2423422 Pastilla de frenos</h5>
                    <div class="row" style="padding-left: 30px;border-left: 8px solid #585448;margin-left: 75px;">
                      <div class="col">
                        <section >
                          <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;">12 May 2013</span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span><div class="card">
                                    <div class="card-header"><h3>Pedido realizado</h3></div>
                                    <div class="card-body">Datos del pedido:
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
                                        <form action="" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                                                <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Name on card</label>
                                                <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Card number</label>
                                                <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                                        <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY"
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Security code</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code"
                                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-share-square"></i>&nbsp;
                                                    <span id="payment-button-amount">Enviar</span>
                                                   
                                                </button>
                                                </div>
                                                <div class="col">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"data-toggle="modal" data-target="#mediumModal">
                                                    <i class="fa fa-share-square"></i>&nbsp;
                                                    <span id="payment-button-amount">Enviar</span>
                                                   
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
                            <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                There are three species of zebras: the plains zebra, the mountain zebra and the Grévy's zebra. The plains zebra and the mountain
                                zebra belong to the subgenus Hippotigris, but Grévy's zebra is the sole species of subgenus Dolichohippus. The latter
                                resembles an ass, to which it is closely related, while the former two are more horse-like. All three belong to the
                                genus Equus, along with other living equids.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Confirm</button>
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
