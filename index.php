<?php 
include "easybd.class.php";

$bd=new EasyBD("localhost","root","","concesionario2");
$resultado=$bd->consultarTodos(['MARCA']);
print_r($resultado);
echo "<hr>";
//if ($bd->insertar("MARCA",[10,'VOLVO'])) echo "insertado";
//else echo "NO insertado";

$resultado=$bd->consultarTodos(['MARCA']);
print_r($resultado);


 ?>