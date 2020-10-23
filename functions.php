<?php

require_once ('conexion.php');

require_once __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;


function addBashProduct($pila){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3' ]);
    
    if(count($pila) <= 100){
        $data = [
            'create' => $pila
        ];
        
        return $woocommerce->post('products/batch', $data);        
    } else {
        $chunks = array_chunk($pila, 99);
        for($i = 0; $i <= count($chunks); ++$i) {
            $data = [
                'create' => $chunks[$i]
            ];
            array_push($res, $woocommerce->post('products/batch', $data));   
        }
        return $res;
    }

}

function updateBashProduct($pila){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3' ]);

    if(count($pila) <= 100){
        $data = [
            'create' => [],
            'update' => $pila
        ];
        //print_r($data); exit();
        return $woocommerce->post('products/batch', $data);        
    }
}

function addSingleProduct($sku,$nomPro,$prePro,$desPro,$codPro,$catPro){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3' ]);
    
    $data = [
        'name' => $nomPro,
        'type' => 'simple',
        'sku'  => $sku,
        'regular_price' => $prePro,
        'description' => $desPro,
        'short_description' => $codPro,
        'categories' => [
            [
                'id' => $catPro
            ]
        ],

    ];
    return $woocommerce->post('products', $data);
}

function addProduct($codigo,$nombre,$descripcion,$precio,$existencia,$id_vendedor){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $precio = floatvalue(trim($precio));
    $existencia = trim($existencia);

    $sql = "INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`,`existencia`, `id_woo`, `id_vendedor`, `create_at`, `update_at`) VALUES (NULL, '$codigo', '$nombre', '$descripcion', '$precio','$existencia', NULL, '$id_vendedor',current_timestamp(),NULL)";

    if ($obj_conexion->query($sql)) {
        $id = $obj_conexion->insert_id;
        $obj_conexion->close();
        return $id;
    } else  {
        print_r("Error: " . $sql . "<br>" . $obj_conexion->error);
        $obj_conexion->close();
        return false;
    }
}

function findProduct($codigo,$id_vendedor){

    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT * FROM productos WHERE codigo = '$codigo' AND id_vendedor = $id_vendedor";
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $id = 0;
    } else {
        $data = $result->fetch_assoc();
        $id = $data['id'];
    }
    $obj_conexion->close();
    return $id;

}

function updateProduct($id,$codigo,$nombre,$descripcion,$precio,$existencia){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $precio = floatvalue(trim($precio));
    $existencia = trim($existencia);
    $sql = "UPDATE `productos` SET  `codigo` = '$codigo', `nombre` = '$nombre', `descripcion` = '$descripcion', `precio` = '$precio',`existencia` = '$existencia', `update_at` = current_timestamp() WHERE `id` = $id";

    if ($obj_conexion->query($sql)) {
        $sql = "SELECT * FROM productos WHERE `id` = $id";
        $result = $obj_conexion->query($sql);
        $data = $result->fetch_assoc();
        $obj_conexion->close();
        return $data['id_woo'];
    } else  {
        print_r("Error: " . $sql . "<br>" . $obj_conexion->error);
        $obj_conexion->close();
        return false;
    }
}

function readExcel($archivo){
    require_once 'lib/PHPExcel/Classes/PHPExcel.php';
    
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();

    for($col = 'A'; $col < 'Z';){
        if (empty($sheet->getCell($col.'1')->getValue())){
            $col = 'Z';
        } else {
            $highestColumn = $col;
            $col++;
        }
        
    }
    $row = 1;
    $bandera = true;
    do{
        for ($col = 'A'; $col <= $highestColumn; $col++){
            $fila[$col] = $sheet->getCell($col.$row)->getValue(); 
        }
        $fila = array_filter($fila);
        if(count($fila) == 0) {
            $bandera = false;
            $row--;
        }else{
            $row++;
        }
    }while($bandera == true);

    $highestRow = $row;
    $idProduct = 'Id';

    for ($row = 1; $row <= $highestRow; $row++){
        if( !empty($sheet->getCell('A'.$row)->getValue()) &&  !empty($sheet->getCell('B'.$row)->getValue()) && !empty($sheet->getCell('C'.$row)->getValue()) && !empty($sheet->getCell('D'.$row)->getValue()) ){

            for($col = 'A'; $col <= $highestColumn; $col++){
                $pila[$row][] = $sheet->getCell($col.$row)->getValue();
            }

        }

    }
    return $pila;
}

function floatvalue($val){
               $val = str_replace(",",".",$val);
               $val = preg_replace('/\.(?=.*\.)/', '', $val);
               return floatval($val);
}

function updateId_Woo($id_woo,$idLocal){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "UPDATE `productos` SET `id_woo` = '$id_woo' WHERE `id` = $idLocal";

    if ($obj_conexion->query($sql)) {
        $id = $obj_conexion ->affected_rows;
        $obj_conexion->close();
        return $id;
    } else  {
        print_r("Error: " . $sql . "<br>" . $obj_conexion->error);
        $obj_conexion->close();
        return false;
    }
}
