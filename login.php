<?php
    //error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
    //date_default_timezone_set("America/Caracas");
    session_start();
    require_once ('conexion.php');
    require_once('lib/PasswordHash.php');
    
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $user_login = $_POST['user_login'];
    $ID = $_POST['ID'];
    if ($_POST['boton'] != "") {  

    $sql = "SELECT * FROM wp_users AS a join wp_usermeta AS b ON (a.id = b.user_id) WHERE a.user_email='$user_email' AND b.meta_key = 'dokan_enable_selling' AND b.meta_value = 'yes' ";
    $busqueda = $obj_conexion -> query($sql);
    $registro=mysqli_fetch_array($busqueda);
    mysqli_close($obj_conexion);


    $wp_hasher = new PasswordHash( 8, true );


    if($wp_hasher->CheckPassword($user_pass, $registro["user_pass"])){
        
        $_SESSION['user_email'] = trim($registro["user_email"]);
        $_SESSION['user_status'] = trim($registro["user_status"]);
        $_SESSION['user_pass'] = trim($registro["user_pass"]);
        $_SESSION['user_login'] = trim($registro["user_login"]);
        $_SESSION['ID'] = trim($registro["user_id"]);
        $_SESSION['user_registered'] = trim($registro["user_registered"]);
        header('Location: index.php');
           }
        else { echo "<script>alert('Datos Errados');</script>;"; }
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
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input class="au-input au-input--full" type="email" name="user_email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="au-input au-input--full" type="password" name="user_pass" placeholder="Contraseña">
                                </div>
                                <div class="login-checkbox">
                                   

                                </div>
                                <button type="submit" name="boton" value="Ingresar" class="au-btn au-btn--block au-btn--green m-b-20">
                                    <i class="ace-icon glyphicon glyphicon-share-alt"></i>
                                    Acceder</button>

                                <div class="social-login-content">
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    No tienes una Cuenta?
                                    <a href="#">Registrarse áqui</a>
                                </p>
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