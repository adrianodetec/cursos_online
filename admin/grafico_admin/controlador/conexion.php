<?php

function conectarse()
{
$servidor="localhost";
$usuario = "root";
$password="";
$bd = "detec";

$conectar = new mysqli($servidor,$usuario,$password,$bd) or die("No se pudo conectarse a la BD");
return $conectar;

}
$conexion = conectarse();

?>

