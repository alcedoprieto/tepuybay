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

    $strQuery4= "SELECT * FROM wpck_usermeta WHERE (user_id = '$mrid') AND (meta_key = 'wpck_capabilities')";
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
    <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Tepuy Shop</a>                                
                        </li>
<<<<<<< HEAD

=======
                        <?php
                            if ($statusNivel == "Cliente")
                            {
                        ?>
>>>>>>> 438bf15b2cb13fb54a89cf5a19a03e18213aa4cc
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Editar Datos</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="editar_contraseè´–a.php">Contraseè´–a</a>
                                </li>
                                <li>
                                    <a href="editar_datos.php">Datos de Usuario</a>
                                </li>
                            </ul>
                        </li>
<<<<<<< HEAD

=======
                        <?php
                            }
                        ?>
>>>>>>> 438bf15b2cb13fb54a89cf5a19a03e18213aa4cc
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>Reclamos</a>
                        </li>
                        <?php
<<<<<<< HEAD
                            if ($meta_value == 'a:1:{s:6:"seller";b:1;}')
=======
                            if ($statusNivel == "Vendedor")
>>>>>>> 438bf15b2cb13fb54a89cf5a19a03e18213aa4cc
                            {
                        ?>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Vendedores</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="listado_productos.php">Listados</a>
                                </li>
                               
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                        <li>
                            <a href="logout.php">
                                <i class="fas fa-map-marker-alt"></i>Salir</a> 
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>