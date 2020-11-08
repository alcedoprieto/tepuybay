<?php
    session_start();
    ini_set('max_execution_time', 3000);
    set_time_limit(3000);
    header('Content-Type: application/json');
    if (!isset($_SESSION['user_email'])) {
        header('Location: ../login.php');
    }
    $codigo = $_SESSION['codigo'];
    $user_id = $_SESSION['ID'];
    require_once ('../functions.php');


if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName = $_FILES['excel_file']['name'];
    $fileSize = $_FILES['excel_file']['size'];
    $fileType = $_FILES['excel_file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    if(!empty($_POST['filas']) && is_numeric($_POST['filas']) ){
        $filas = $_POST['filas'];
    } else {
        $filas = 1;
    }

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $uploadFileDir = './uploaded_files/';
    $dest_path = $uploadFileDir . $newFileName;
    
    if(move_uploaded_file($fileTmpPath, $dest_path))
    {
        $archivo = $uploadFileDir.$newFileName;
        $data = readExcel($archivo,$filas);
        $pilaUpdate = array();
        $pilaAdd = array();
        for($i = 2; $i <= count($data); ++$i) {
            $codigoVendedor = trim($data[$i]['0']);
            $id_vendedor = $user_id;
            $nombrePro = trim($data[$i]['1']);
            $descripPro = trim($data[$i]['2']);
            $precioPro = trim($data[$i]['3']);
            $existPro = trim($data[$i]['4']);
            if(!empty($codigoVendedor) && !empty($id_vendedor) && !empty($nombrePro) && !empty($descripPro) && !empty($precioPro) && !empty($existPro)){
                $idLocal = findProduct($codigoVendedor,$id_vendedor);
                logMessage($idLocal);
                if ($idLocal){
                    $id_woo = updateProduct($idLocal,$codigoVendedor,$nombrePro,$descripPro,$precioPro,$existPro);
                    $producto = [
                        'id' => $id_woo,
                        'name' => $nombrePro,
                        'type' => 'simple',
                        'sku'  => $idLocal,
                        'regular_price' => number_format($precioPro, 2, '.', ''),
                        'description' => $descripPro,
                        'short_description' => $codigoVendedor,
                        'manage_stock' => true,
                        'stock_quantity' => $existPro,
                        'categories' => [
                            [
                                'id' => 69
                            ]
                        ],
                    ];
                    array_push($pilaUpdate, $producto);
                } else {
                    $idLocal = getSKU($codigo,$id_vendedor);
                    addProduct($idLocal,$codigoVendedor,$nombrePro,$descripPro,$precioPro,$existPro,$id_vendedor);

                        $producto = [
                            'name' => $nombrePro,
                            'type' => 'simple',
                            'sku'  => $idLocal,
                            'regular_price' => number_format($precioPro, 2, '.', ''),
                            'description' => $descripPro,
                            'short_description' => $codigoVendedor,
                            'manage_stock' => true,
                            'stock_quantity' => $existPro,
                            'categories' => [
                                [
                                    'id' => 69
                                ]
                            ],
                        ];
                        array_push($pilaAdd, $producto);
                } //Fin Else
            } // Fin if Verifica existencia de contenido
        } // Fin For
        $arr = array('add' => $pilaAdd, 'update' => $pilaUpdate);
        echo json_encode($arr);
    }
    else
    {
        echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
    }

} else {
    echo "No se recibió archivo";
}

