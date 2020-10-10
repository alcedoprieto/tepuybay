<?PHP 
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  date_default_timezone_set("America/Caracas");

  session_start();
    if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
    }
    include('conexion.php');
    $tepuy_id = $_GET['tepuy_id'];
    $seguimiento_id = $_GET['seguimiento_id'];
    $status_id = $_GET['status_id'];
    $boton=$_GET["boton"];
  
    if($boton=="Enviar"){
        $consulta1="UPDATE wp_report_tepuy SET status_id='$status_id', seguimiento_id='$seguimiento_id'  WHERE tepuy_id='$tepuy_id'";
        $resultado1 = $obj_conexion -> query($consulta1)|| die("Error");
        if($resultado1)
        {
            echo "<script>alert('Guía Registrada');</script>";
           echo "<script>location.href='listado_productos.php';</script>";
        }
        else
        {
            echo "<script>alert('Datos Errados');</script>";
        }
    
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
                    <h5 class="heading-title">Nro de Pedido <?php echo $tepuy_id; ?> </h5>
                    <div class="row" style="padding-left: 30px;border-left: 8px solid #585448;margin-left: 75px;">
                      <div class="col">
                        <section >
                          <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;"><?php echo $date_created; ?></span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span>
                        </section>
                        <div class="row">
                            <div class="col">
                                <section>
                                    <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;"></span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span>


                        
                        <div class="row">
                            <div class="col">
                                <section >
                                    <div class="card-body text-secondary"><span style="margin-top: -10px; top: 50%; left: -158px;font-size: 0.95em;line-height: 20px;position: absolute;"></span>
                            <span style="margin-top: -10px;top: 50%;left: -58px;width: 20px;height: 20px;background: #343a40;border: 5px solid #fff;border-radius: 50%;display: block;position: absolute;">
                                
                            </span><div class="card">
                                    <div class="card-header"><h3>Datos del Envio</h3></div>
                                    <div class="card-body">
                                    
                                    <form action="" method="get">
                                    <input id="cc-number" name="tepuy_id" type="tel" class="form-control cc-number identified visa" 
                                                    autocomplete="cc-number" value="<?php echo $tepuy_id; ?> " hidden>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Numero de Guia</label>
                                                <input id="cc-number" name="seguimiento_id" type="tel" class="form-control cc-number identified visa" 
                                                    autocomplete="cc-number" >
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Status</label>
                                                <select name="status_id" id="" class="form-control cc-number identified visa">
                                                    <option value="En Proceso">En Proceso</option>
                                                    <option value="Guía Enviada">Guía Enviada</option>
                                                    <option value="Procesado">Procesado</option>
                                                    <option value="Cancelado">Cancelado</option>
                                                </select>
                                               
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
