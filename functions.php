<?php

require_once ('conexion.php');

require_once __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

function logMessage($mensaje){
        $date = date("F j, Y, g:i a");
        $myfile = fopen("logs-".date('m-Y').".log", "a") or die("Unable to open file!");
        //fwrite($myfile, $date."\t".$_SERVER['SCRIPT_NAME']."\t->\t".$mensaje."\n");
        fwrite($myfile,"\t->\t".$mensaje."\n");
        fclose($myfile);
        return("true");
}


function addBashProduct($pila){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3','timeout' => 600]);
    $data = [
        'create' => $pila
    ];
    logMessage(serialize($data));
    $tmp = $woocommerce->post('products/batch', $data);  
    logMessage(serialize($tmp));
    return $tmp;
    /*
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
    */
}

function updateBashProduct($pila){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3' ]);
    $data = [
        'create' => [],
        'update' => $pila
    ];
    return $woocommerce->post('products/batch', $data);  
    /*
    if(count($pila) <= 100){
        $data = [
            'create' => [],
            'update' => $pila
        ];
        //print_r($data); exit();
        return $woocommerce->post('products/batch', $data);        
    }
    */
}

function addSingleProduct($sku,$nomPro,$prePro,$desPro,$codPro,$catPro){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3']);
    
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
function getSKU($codigo,$id_vendedor){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT CONCAT('$codigo',COUNT(e.id) + 1) AS id FROM productos e where id_vendedor = '$id_vendedor' ORDER BY 1 desc limit 0,1 ";
    $result = $obj_conexion->query($sql);
    $data = $result->fetch_assoc();
    $id = $data['id'];
    $obj_conexion->close();
    return $id;
}

function addProduct($idLocal,$codigo,$nombre,$descripcion,$precio,$existencia,$id_vendedor){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }
    $codigo      = $obj_conexion->real_escape_string($codigo);
    $nombre      = $obj_conexion->real_escape_string($nombre);
    $descripcion = $obj_conexion->real_escape_string($descripcion);
    $precio      = floatvalue(trim($precio));
    $existencia  = trim($existencia);

    $sql = "INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`,`existencia`, `id_woo`, `id_vendedor`, `create_at`, `update_at`,`estado`) VALUES ('$idLocal', '$codigo', '$nombre', '$descripcion', '$precio','$existencia', NULL, '$id_vendedor',current_timestamp(),NULL,'pend_add')";
    logMessage($sql);
    if ($obj_conexion->query($sql)) {
        logMessage($obj_conexion->affected_rows);
        $obj_conexion->close();
        return $idLocal;
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

    $sql = "SELECT id FROM productos WHERE codigo = '$codigo' AND id_vendedor = $id_vendedor";
    logMessage($sql);
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $id = false;
    } else {
        while ($data = $result->fetch_assoc()) {
            $id = $data['id'];
        }
    }
    $obj_conexion->close();
    return $id;

}

function updateProduct($id,$codigo,$nombre,$descripcion,$precio,$existencia){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }
    $codigo      = $obj_conexion->real_escape_string($codigo);
    $nombre      = $obj_conexion->real_escape_string($nombre);
    $descripcion = $obj_conexion->real_escape_string($descripcion);
    $precio = floatvalue(trim($precio));
    $existencia = trim($existencia);
    $sql = "UPDATE `productos` SET  `codigo` = '$codigo', `nombre` = '$nombre', `descripcion` = '$descripcion', `precio` = '$precio',`existencia` = '$existencia', `update_at` = current_timestamp(), `estado` = 'pend_update' WHERE `id` = '$id'";
    logMessage($sql);
    if ($obj_conexion->query($sql)) {
        $sql = "SELECT * FROM productos WHERE `id` = '$id'";
        $result = $obj_conexion->query($sql);
        $data = $result->fetch_assoc();
        $obj_conexion->close();
        return $data['id_woo'];
    } else  {
        print_r("Error: " . $sql . "<br>" . $obj_conexion->error); exit;
        $obj_conexion->close();
        return false;
    }
}

function readExcel($archivo,$filas){
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
    $row = $filas;
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

function updateId_Woo($id_woo,$idLocal,$idVendedor){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "UPDATE `productos` SET `id_woo` = '$id_woo', `estado` = 'syncing' WHERE `id` = '$idLocal'";

    if ($obj_conexion->query($sql)) {
        $id = $obj_conexion ->affected_rows;

        if(!$idVendedor){
            $sql = "SELECT id_vendedor FROM `productos` WHERE `id` = '$idLocal'";
            $resultado = $obj_conexion->query($sql);
            $data = $resultado->fetch_assoc();
			$idVendedor = $data['id_vendedor'];
        }

        $sql = "UPDATE `wp_posts` SET `post_author` = '$idVendedor' WHERE `wp_posts`.`ID` = '$id_woo'";
        $obj_conexion->query($sql);
        $obj_conexion->close();
        return $id;
    } else  {
        print_r("Error: " . $sql . "<br>" . $obj_conexion->error);
        $obj_conexion->close();
        return false;
    }
}

function searchPila($list){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT * FROM productos WHERE id IN ($list)";
    logMessage($sql);
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $data = false;
    } else {
        $data = $result;
    }
    $obj_conexion->close();
    return $data;
}

function addImage($id_woo,$url){
    $woocommerce = new Client(URL_STORE, CK_STORE ,CS_STORE,[ 'wp_api' => true, 'version' => 'wc/v3']);
    
    $data = [
        'images' => [
            [
                'src' => $url
            ]
        ],

    ];
    return $woocommerce->post("products/$id_woo", $data);
}

function findIdWoo($codigo,$id_vendedor){

    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT id_woo FROM productos WHERE codigo = '$codigo' AND id_vendedor = $id_vendedor";
    
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $id = false;
    } else {
        while ($data = $result->fetch_assoc()) {
            $id = $data['id_woo'];
        }
    }
    $obj_conexion->close();
    return $id;

}

function searchBashAdd(){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT * FROM `productos` WHERE estado = 'pend_add' LIMIT 99 ";
    logMessage($sql);
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $data = false;
    } else {
        $data = $result;
    }
    $obj_conexion->close();
    return $data;
}

function searchBashUpdate(){
    $obj_conexion = mysqli_connect(SERVER, USERDB, PASSDB, DATABASE);
    if (!$obj_conexion) {
        die('Error de conexión: ' . mysqli_connect_error(). ' ' .mysqli_connect_errno() );
    }

    $sql = "SELECT * FROM `productos` WHERE estado = 'pend_update' LIMIT 99 ";
    logMessage($sql);
    $result = $obj_conexion->query($sql);

    if ($result->num_rows == 0) {
        $data = false;
    } else {
        $data = $result;
    }
    $obj_conexion->close();
    return $data;
}