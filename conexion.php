<?PHP 
  error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
  date_default_timezone_set("America/Caracas");
  $usuario="prietslt_wp675";
  $contrase«Ða="p4(S346Sz!";
  $basedatos="prietslt_wp675";
  $servidor="208.91.199.146";
  $obj_conexion = mysqli_connect($servidor,$usuario,$contrase«Ða,$basedatos);
  
  if ($obj_conexion) {
    mysqli_set_charset($obj_conexion,"utf8");
    return $obj_conexion;
}
else{
    return null;
}

?>