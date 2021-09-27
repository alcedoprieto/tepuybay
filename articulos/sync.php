<?php
    require_once (__DIR__ .'/../functions.php');
    $totalProducts = getTotalProducts()[2]->total;

    $j=0;
    for ($i = 0; $i <= $totalProducts; $i = $i + 99) {
        $j++;
        $list = getListProducts($j);
        print_r($list);
        echo PHP_EOL;
    }