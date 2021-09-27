<?php
    require_once (__DIR__ .'/../functions.php');

    for($i = 0; $i <= 10; ++$i) {
        $pila = searchBashAdd();
        $pilaAdd = array();
        $pilaUpdate = array();
        if($pila){
            while($row = mysqli_fetch_array($pila)) {             
                $producto = [
                    'name' => $row['nombre'],
                    'type' => 'simple',
                    'sku'  => $row['id'],
                    'regular_price' => number_format($row['precio_final'], 2, '.', ''),
                    'final_price' => number_format($row['precio_final'], 2, '.', ''),
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
                    updateId_Woo($arr["create"][$i]->id,$arr["create"][$i]->sku,null);
                }
                
            }
        }

        $pila = searchBashUpdate();
        if($pila){
            while($row = mysqli_fetch_array($pila)) {             
                $producto = [
                    'id' => $row['id_woo'],
                    'name' => $row['nombre'],
                    'type' => 'simple',
                    'sku'  => $row['id'],
                    'regular_price' => number_format($row['precio_final'], 2, '.', ''),
                    'final_price' => number_format($row['precio_final'], 2, '.', ''),
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
                    updateId_Woo($arr["update"][$i]->id,$arr["update"][$i]->sku,null);
                }
                
            }
        }   
    }