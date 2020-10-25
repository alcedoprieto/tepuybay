<?php
    session_start();
    ini_set('max_execution_time', 3000);
    set_time_limit(3000);
    header('Content-type: application/json; charset=utf-8');
    if (!isset($_SESSION['user_email']) && !isset($_SESSION['ID'])) {
        header('Location: ../login.php');
    } else {
        $idVendedor = $_SESSION['ID'];
    }

    require_once ('../functions.php');

    $jsondata = array();
    $pilaAdd = array();
    $pilaUpdate = array();

    if( isset($_GET['add']) && count($_GET['add']) > 0 ) {
        $pila = $_GET['add'];
        $pila = substr($pila, 1, -1);
        $pila = searchPila($pila);
        //$pilaAdd = searchPila(json_decode($_GET['add'],true));
        if($pila){
            while($row = mysqli_fetch_array($pila)) {             
                $producto = [
                    'name' => $row['nombre'],
                    'type' => 'simple',
                    'sku'  => $row['id'],
                    'regular_price' => number_format($row['precio'], 2, '.', ''),
                    'description' => $row['descripcion'],
                    'short_description' => $row['codigo'],
                    'manage_stock' => true,
                    'stock_quantity' => $row['existencia'],
                    'categories' => [
                        [
                            'id' => 69
                        ]
                    ],
                ];
                array_push($pilaAdd, $producto);
            } 
            $tmp = addBashProduct($pilaAdd); 
            $arr = (array) $tmp;
                
            for($i = 0; $i <= count($arr["create"]); ++$i) {
                if(!empty($arr["create"][$i]->id) && !empty($arr["create"][$i]->sku)){
                    updateId_Woo($arr["create"][$i]->id,$arr["create"][$i]->sku,$idVendedor);
                }
                
            }
    
            $jsondata['success'] = true;
            $jsondata['number'] = count($pilaAdd);
            $jsondata['message'] = count($pilaAdd)." Productos agregado";
            echo json_encode($jsondata);
        }   
    } else if( isset($_GET['update']) && count($_GET['update']) > 0 ){
        $pila = $_GET['update'];
        $pila = substr($pila, 1, -1);
        $pila = searchPila($pila);
        
        if($pila){
            while($row = mysqli_fetch_array($pila)) {             
                $producto = [
                    'id' => $row['id_woo'],
                    'name' => $row['nombre'],
                    'type' => 'simple',
                    'sku'  => $row['id'],
                    'regular_price' => number_format($row['precio'], 2, '.', ''),
                    'description' => $row['descripcion'],
                    'short_description' => $row['codigo'],
                    'manage_stock' => true,
                    'stock_quantity' => $row['existencia'],
                    'categories' => [
                        [
                            'id' => 69
                        ]
                    ],
                ];
                array_push($pilaUpdate, $producto);
            } 
            $tmp = updateBashProduct($pilaUpdate); 
            $arr = (array) $tmp;
               
            for($i = 0; $i <= count($arr["update"]); ++$i) {
                if(!empty($arr["update"][$i]->id) && !empty($arr["update"][$i]->sku)){
                    updateId_Woo($arr["update"][$i]->id,$arr["update"][$i]->sku,$idVendedor);
                }
                
            }
    
            $jsondata['success'] = true;
            $jsondata['number'] = count($pilaUpdate);
            $jsondata['message'] = count($pilaUpdate)." Productos actualizados";
            echo json_encode($jsondata);
        }   
    }