<?php
    session_start();
    $session_hash = $_SESSION['session_hash'];
    $user_id = $_SESSION['ID'];

    ini_set('max_execution_time', 600000);
    set_time_limit(600000);

    if (!isset($_SESSION['user_email']) && !isset($_SESSION['ID'])) {
        header('Location: ../login.php');
    } else {
        $idVendedor = $_SESSION['ID'];
    }

    require_once ('../functions.php');

    $pilaDelete = array();
    $itemsId = [];

    if( isset($_POST['session_hash']) && $_POST['session_hash'] == $session_hash) {
        do{
            $sql ="SELECT id FROM `wp_posts` WHERE post_author = $user_id LIMIT 99";

            $result = $obj_conexion -> query($sql);
            $articulos = array();
            while($row = mysqli_fetch_array($result))
            {
                $producto = [
                    'id' => $row['id'],
                ];
                array_push($pilaDelete, $producto);
            }
            $tmp = delBashProduct($pilaDelete); 
            $arr = (array) $tmp;
            for($i = 0; $i <= count($arr["delete"]); ++$i) {
                if( !empty($arr["delete"][$i]->id) ){
                    $itemsId[] = $arr["delete"][$i]->id;
                }  
            }
            $itemsId = implode(",", $itemsId);
            $numItemsUpdate = deleteProduct($itemsId);
       }while(mysqli_num_rows($result));
    }
    header('Location: list.php');