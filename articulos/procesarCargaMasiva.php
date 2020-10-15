<?php
    session_start();
    ini_set('max_execution_time', 3000);
    set_time_limit(3000);
    if (!isset($_SESSION['user_email'])) {
        header('Location: ../login.php');
    }
    $user_id = $_SESSION['ID'];
    require_once ('../functions.php');


if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName = $_FILES['excel_file']['name'];
    $fileSize = $_FILES['excel_file']['size'];
    $fileType = $_FILES['excel_file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $uploadFileDir = './uploaded_files/';
    $dest_path = $uploadFileDir . $newFileName;
    
    if(move_uploaded_file($fileTmpPath, $dest_path))
    {
        $archivo = $uploadFileDir.$newFileName;
        $data = readExcel($archivo);
        $pilaUpdate = array();
        $pilaAdd = array();
        for($i = 2; $i <= count($data); ++$i) {
            $codigoVendedor = $data[$i]['0'];
            $id_vendedor = $user_id;
            $nombrePro = $data[$i]['1'];
            $descripPro = $data[$i]['2'];
            $precioPro = $data[$i]['3'];
            $existPro = $data[$i]['4'];
            if(!empty($codigoVendedor) && !empty($id_vendedor) && !empty($nombrePro) && !empty($descripPro) && !empty($precioPro) && !empty($existPro)){
                $idLocal = findProduct($codigoVendedor,$id_vendedor);

                if ($idLocal > 0){
                    $id_woo = updateProduct($idLocal,$codigoVendedor,$nombrePro,$descripPro,$precioPro,$existPro);
                    $producto = [
                        'id' => $id_woo,
                        'name' => $nombrePro,
                        'type' => 'simple',
                        'sku'  => $idLocal,
                        'regular_price' => number_format($precioPro, 2, '.', ''),
                        'description' => $descripPro,
                        'short_description' => $codigoVendedor,
                        'categories' => [
                            [
                                'id' => 119
                            ]
                        ],
                    ];
                    array_push($pilaUpdate, $producto);
                } else {
                    $idLocal = addProduct($codigoVendedor,$nombrePro,$descripPro,$precioPro,$existPro,$id_vendedor);
                    if(is_int($idLocal)){
                        $producto = [
                            'name' => $nombrePro,
                            'type' => 'simple',
                            'sku'  => $idLocal,
                            'regular_price' => number_format($precioPro, 2, '.', ''),
                            'description' => $descripPro,
                            'short_description' => $codigoVendedor,
                            'categories' => [
                                [
                                    'id' => 119
                                ]
                            ],
                        ];
                        array_push($pilaAdd, $producto);
                    } //Fin If
                }
            } // Fin if Verifica existencia de contenido
        } // Fin For
        
        if(count($pilaAdd) > 0){
            $tmp = addBashProduct($pilaAdd); 
            $arr = (array) $tmp;
               
            for($i = 0; $i <= count($arr["create"]); ++$i) {
                if(!empty($arr["create"][$i]->id) && !empty($arr["create"][$i]->sku)){
                    updateId_Woo($arr["create"][$i]->id,$arr["create"][$i]->sku);
                }
                
            }
            echo count($pilaAdd)." Productos agregado <br>";            
        }
        if(count($pilaUpdate) > 0){
            $tmp = updateBashProduct($pilaUpdate); 
            $arr = (array) $tmp;
               
            for($i = 0; $i <= count($arr["update"]); ++$i) {
                if(!empty($arr["update"][$i]->id) && !empty($arr["update"][$i]->sku)){
                    updateId_Woo($arr["update"][$i]->id,$arr["update"][$i]->sku);
                }
                
            }
            echo count($pilaUpdate)." Productos actualizados <br>"; 
        }
        
        echo "<br>Fin";
    }
    else
    {
        echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
    }

} else {
    echo "No se recibió archivo";
}

