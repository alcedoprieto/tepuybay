<?PHP 
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  date_default_timezone_set("America/Caracas");
  session_start();
  if (!isset($_SESSION['user_email'])) {
      header('Location: login.php');
  }
  include('conexion.php');
    $boton=$_POST["boton"];
    $mrid= $_SESSION['ID'];

    $sql = "SELECT * FROM wp_wc_customer_lookup WHERE user_id ='$mrid' ";
    $busqueda = $obj_conexion -> query($sql);
    if($registro=mysqli_fetch_array($busqueda)){
      $first_name = $registro['first_name'];
      $last_name = $registro['last_name'];
      $customer_id = $registro['customer_id'];
      $city = $registro['city'];
    }

if($boton=="Editar"){
            $consulta1="UPDATE wp_wc_customer_lookup SET first_name =$first_name, last_name =$last_name, city =$city  WHERE customer_id='$customer_id'";
            $resultado1 = $obj_conexion -> query($consulta1)|| die("Error");
            if($resultado1)
        {
            echo "<script>alert('Edición Exitosa');</script>";
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

                        <div class="row m-t-25">
                             <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-header">Datos de Usuario</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Editar Datos de Usuario <?php echo $mruser; ?></h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Nombre de Usuario</label>
                                                <input id="cc-pament" name="first_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?PHP echo $first_name;?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Apellido de Usuario</label>
                                                <input id="cc-pament" name="last_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?PHP echo $last_name;?>">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Ciudad</label>
                                                <input id="cc-name" name="city" type="text" class="form-control cc-name valid" data-val="true" value="<?PHP echo $city;?>">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div>
                                                <input type="submit" value="Editar" name="boton" class="au-btn au-btn--green m-b-20"> 
                                                <button id="payment-button" type="submit" name="boton" value="Editar" class="au-btn au-btn--green m-b-20">
                                                Regresar
                                                    <span id="payment-button-sending" style="display:none;">Editar Datos</span>
                                                </button>
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
