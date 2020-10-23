<?PHP 
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  date_default_timezone_set("America/Caracas");
  session_start();
  if (!isset($_SESSION['user_email'])) {
      header('Location: login.php');
  }
  include('../conexion.php');
    $boton=$_POST["boton"];
    $user_pass=$_POST["user_pass"];
    $mrmail = $_SESSION['user_email'];

    $sql = "SELECT * FROM wp_users WHERE user_email ='$mrmail' ";
    $busqueda = $obj_conexion -> query($sql);
    if($registro=mysqli_fetch_array($busqueda)){
      $user_email = $registro['user_email'];
      $user_status = $registro['user_status'];
      $user_registered = $registro['user_registered'];
      $ID = $registro['ID'];
      $user_login = $registro['user_login'];
    }
if($boton=="Editar"){
            $consulta1="UPDATE wp_users SET user_pass = md5('$user_pass')  WHERE ID='$ID'";
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
    include("../layouts/topLayout.php"); 
?>
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
                                                <label for="cc-payment" class="control-label mb-1">Identificador de Usuario</label>
                                                <input id="cc-pament" name="ID" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?PHP echo $ID;?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Nombre de Usuario</label>
                                                <input id="cc-pament" name="user_login" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?PHP echo $user_login;?>" readonly>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Correo Electronico</label>
                                                <input id="cc-name" name="user_email" type="text" class="form-control cc-name valid" data-val="true" value="<?PHP echo $user_email;?>" readonly>
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Contraseña</label>
                                                <input id="cc-number" name="user_pass" type="tel" class="form-control cc-number identified visa"value="<?PHP echo $user_pass;?>" data-val="true"              
                                                    autocomplete="cc-number" Placeholder="Ingrese la Contraseña">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Registrado Desde</label>
                                                <input id="cc-pament" name="user_registered" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?PHP echo $user_registered;?>" readonly>
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
    <?php include("../layouts/bottomLayout.php"); ?>
