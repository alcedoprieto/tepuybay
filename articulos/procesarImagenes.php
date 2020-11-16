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

    //
    if(isset($_FILES['file']['name'])){
        $fileName = $_FILES['file']['name'];
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $uploadFileDir = './uploaded_files/';
        $dest_path = $uploadFileDir . $fileName;
        move_uploaded_file($fileTmpPath, $dest_path);

        $fileNameCmps = explode(".", $fileName);
        $codigoVendedor = $fileNameCmps[0];
    
        $id_woo = findIdWoo($codigoVendedor,$idVendedor);
        $url = URL_STORE."/panel/articulos/uploaded_files/".$fileName;
        if($id_woo){
            $res = addImage($id_woo,$url);
            $arr = array('status' => 'ok', 'dataIndex' => $_POST['dataIndex'], 'data' => $res);
        } else {
            $arr = array('status' => 'err', 'dataIndex' => $_POST['dataIndex'], 'id_woo' => $id_woo);
        }


    } else if(isset($_POST['fileName'])){
        $fileName = $_POST['fileName'];
        $fileNameCmps = explode(".", $fileName);
        $codigoVendedor = $fileNameCmps[0];
    
        $idLocal = findProduct($codigoVendedor,$idVendedor);
        logMessage($idLocal);
        if ($idLocal){
            $arr = array('status' => 'ok', 'dataIndex' => $_POST['dataIndex']);
            
        } else {
            $arr = array('status' => 'err', 'dataIndex' => $_POST['dataIndex']);
            
        }
    } else {
        $arr = array('status' => 'err');
    }

    echo json_encode($arr);



//echo json_encode($_FILES['file']['name']);