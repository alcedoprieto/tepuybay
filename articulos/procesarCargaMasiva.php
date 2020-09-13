<?php

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
        require_once '../lib/PHPExcel/Classes/PHPExcel.php';
        $archivo = $uploadFileDir.$newFileName;
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

        echo"Rows: $highestRow Cols: $highestColumn";
        echo("<table border=1>");
        for ($row = 1; $row <= $highestRow; $row++){
            echo ("<tr>");
            for($col = 'A'; $col <= $highestColumn; $col++){
                echo("<td>". $sheet->getCell($col.$row)->getValue() ."</td>");
            }
            echo ("</tr>");
        }
        echo("</table>");
    }
    else
    {
        echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
    }

} else {
    echo "No se recibió archivo";
}

