<?php
    header('Content-Type: application/json');
    session_start();

    if (!isset($_SESSION['user_email']) && !isset($_SESSION['ID'])) {
        die('Error en sesion');
    } else {
        $idVendedor = $_SESSION['ID'];
    }

    require_once ('../functions.php');

    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT id FROM `productos` WHERE id_woo is Null AND id_vendedor = $idVendedor";
    
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $id = false;
    } else {
        while ($data = $result->fetch_assoc()) {
            $id = $data['id'];
            $sql = "SELECT post_id FROM wp_postmeta WHERE meta_value ='$id'";
            logMessage($sql);
            $resultado = $obj_conexion->query($sql);
            $fila = $resultado->fetch_assoc();
            
            $sql = "UPDATE productos SET id_woo = ".$fila['post_id']." WHERE id = '$id'";
            logMessage($sql);
            $resultado = $obj_conexion->query($sql);
            logMessage(serialize($resultado));
        }
    }
    $obj_conexion->close();
    return $id;