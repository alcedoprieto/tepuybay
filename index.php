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

    $sql = "SELECT * FROM wpzz_wc_customer_lookup WHERE user_id ='$mrid' ";
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
                                                                <div class="avatar">
                                                                    <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                                </div>
                                                            </div>
                                                            <div class="text">
                                                                <h5 class="name">Reumen de Cuenta</h5>
                                                                <p>Usuario: <?php echo $mruser; ?></p>
                                                                <p>ID: <?php echo $mrid; ?></p>
                                                                <p>Correo Electronico: <?php echo $mrmail; ?></p>
                                                                <p>Perfil de Usuario: <?php echo $mrlevel; ?></p>
                                                                <p>Registrado desde: <?php echo $mrreg; ?></p>
                                                                <p>Nombre: <?php echo $first_name; ?></p>
                                                                <p>Apellido: <?php echo $last_name; ?></p>
                                                                <p>Ciudad: <?php echo $city; ?> <?php echo $country; ?></p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <small>Resumén de Productos Comprados(s)</small>
                                                                <?php

                                                                
                                                                    include('conexion.php');

                                                                    $query = "SELECT * FROM wpzz_wc_order_product_lookup WHERE customer_id ='$customer_id'";
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
                                                                            <th>Cantidad Comprada</th>
                                                                            <th>Precio</th>    
                                                                            <th>Status</th>                                                              
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        
                                                                        while($row = mysqli_fetch_array($result))
                                                                        {
                                                                            $order_item_id  = $row["order_item_id"];  
                                                                            $product_id = $row["product_id"];  
                                                                            $strQuery4= "SELECT * FROM wp_posts WHERE id = '$product_id'";
                                                                            $strResultado4 = $obj_conexion->query($strQuery4);
                                                                            $strDatos4 = mysqli_fetch_array($strResultado4);
                                                                            $nombrepro	 = $strDatos4['post_title'];  
                                                                            $date_created = $row["date_created"];  
                                                                            $product_qty = $row["product_qty"];  
                                                                            $product_net_revenue = $row["product_net_revenue"];  
                                                                        ?>
                                                                        <tr>
                                                                        <td class=""><?php echo $row["order_item_id"]; ?></td>
                                                                        <td class=""><?php echo $row["product_id"]; ?></td>
                                                                        <td class=""><?php echo $nombrepro; ?></td>
                                                                        <td class=""><?php echo $row["date_created"]; ?></td>
                                                                        <td class=""><?php echo $row["product_qty"]; ?></td>     
                                                                        <td class=""><?php echo $row["product_net_revenue"]; ?></td>
                                                                        <td class="">En Proceso</td>
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
