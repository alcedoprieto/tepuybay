<?php
    require_once (__DIR__ .'/../functions.php');
    $totalProducts = getTotalProducts()[2]->total;

    $j=0;
    for ($i = 0; $i <= $totalProducts; $i = $i + 99) {
        $j++;
        $list = getListProducts($j);

        $itemsId = [];
        foreach ($list as $item) {
            $itemsId[] = $item->id;
        }
        $itemsId = implode(",", $itemsId);
        updateStateProduct($itemsId);
    }