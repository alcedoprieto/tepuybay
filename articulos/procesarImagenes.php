<?php
    header('Content-Type: application/json');
    session_start();

    if (!isset($_SESSION['user_email']) && !isset($_SESSION['ID'])) {
        die('Error en sesion');
    } else {
        $idVendedor = $_SESSION['ID'];
    }

    require_once ('../functions.php');

    //$requestBody = @file_get_contents('php://input');
    //logMessage(json_encode($requestBody));
    logMessage(json_encode($_POST));
    logMessage(json_encode($_FILES));

    $fileName = $_FILES['file']['name'];
    $fileNameCmps = explode(".", $fileName);
    $codigoVendedor = $fileNameCmps[0];

    $idLocal = findProduct($codigoVendedor,$idVendedor);
    logMessage($idLocal);
    if ($idLocal){
        $arr = array('status' => 'ok', 'dataIndex' => $_POST['dataIndex']);
        
    } else {
        $arr = array('status' => 'err', 'dataIndex' => $_POST['dataIndex']);
        
    }

    echo json_encode($arr);



//echo json_encode($_FILES['file']['name']);