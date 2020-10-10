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

                        <div class="row m-t-25">
                             <div class="col-lg-12">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-account-calendar"></i>Bienvenido <?php echo $mruser; ?></h3>
                                    </div>
                                
                                    <div class="au-message__item unread">
                                                    <div class="au-message__item-inner">
                                                        <div class="au-message__item-text">
                                                            <div class="avatar-wrap">
                        
                                                            </div>

                                                            <div class="col-md-12">
                                                        
                                                                <?php

                                                                
                                                                    include('conexion.php');

                                                                    $query = "SELECT * FROM wp_report_tepuy";
                                                                    $result = mysqli_query($obj_conexion, $query);

                                                                    ?>

                                                                    <div class="table-responsive">
                                                                        <table class="table table-top-campaign">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Id de Compra</th>
                                                                            <th>Codigo Producto</th>
                                                                            <th>Nombre Producto</th>
                                                                            <th>Fecha de Compra</th>
                                                                            <th>Nro Transferencia</th>
                                                                            <th>Banco</th>
                                                                            <th>Status</th>    
                                                                            <th>Nro Guia</th>                                                              
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        
                                                                        while($row = mysqli_fetch_array($result))
                                                                        {
                                                                            $tepuy_id = $row["tepuy_id"];  
                                                                            $product_id = $row["product_id"];
                                                                            $product_name = $row["product_name"];
                                                                            $product_date  = $row["product_date"];
                                                                            $banco_transfer  = $row["banco_transfer"];
                                                                            $banco_nombre  = $row["banco_nombre"];
                                                                            $status_id  = $row["status_id"];
                                                                            $seguimiento_id  = $row["seguimiento_id"];
                                                                           
                                                                        ?>
                                                                        <tr>
                                                                        <td class=""><a href="guia.php?tepuy_id=<?php echo $row["tepuy_id"]; ?>"><?php echo $row["tepuy_id"]; ?></a></td>
                                                                        <td class=""><?php echo $row["product_id"]; ?></td>
                                                                        <td class=""><?php echo $product_name; ?></td>
                                                                        <td class=""><?php echo $row["product_date"]; ?></td>
                                                                        <td class=""><?php echo $row["banco_transfer"]; ?></td>
                                                                        <td class=""><?php echo $row["banco_nombre"]; ?></td>     
                                                                        <td class=""><?php echo $row["status_id"]; ?></td>
                                                                        <td class=""><?php echo $seguimiento_id; ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        </tbody>
                                                                        </table>

                                                                </div>
                                                        </div>
                                                        
                                                    </div>
                                         </div>
                                        <div class="au-task-list js-scrollbar3">

                                        </div>
                                        <div class="au-task__footer">
                                            <button class="au-btn au-btn--green m-b-20">Actualizar Datos</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
