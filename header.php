<?php
session_start();
    if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
    }
    include('conexion.php');
  
    $meta_key = $_SESSION['meta_key'];
    $mruser = $_SESSION['user_login'];
    $mrmail = $_SESSION['user_email'];
    $mrlevel = $_SESSION['user_status'];
    $mrreg = $_SESSION['user_registered'];
    $mrid= $_SESSION['ID'];

    $strQuery4= "SELECT * FROM wp_usermeta WHERE (user_id = '$mrid') AND (meta_key = 'wpck_capabilities')";
    $strResultado4 = $obj_conexion->query($strQuery4);
    $strDatos4 = mysqli_fetch_array($strResultado4);
    $meta_key = $strDatos4['meta_key'];  
    $meta_value = $strDatos4['meta_value'];  
    if ($meta_value == 'a:1:{s:6:"seller";b:1;}'){
        $statusNivel = "Vendedor";
    } else {
        $statusNivel = "Cliente";
    }
?>
<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                
                            </form>
                            <div class="header-button">
                               
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/logo_lit.png" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $mruser; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/logo_lit.png" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $mruser; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $mrmail; ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Salir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>