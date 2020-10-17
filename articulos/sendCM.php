<?php


if(count($pilaAdd) > 0){
    $tmp = addBashProduct($pilaAdd); 
    //print_r($tmp);
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