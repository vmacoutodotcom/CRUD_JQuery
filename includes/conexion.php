
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
mb_internal_encoding("UTF-8");


//    Definimos los datos de acceso a la base de datos
$servidor="localhost" ;
$usuario="root";
$password="";
$db="restauranteuoc";

// Creamos la conexion
$mysqli = new mysqli($servidor, $usuario, $password, $db);
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno)
{
    // Si hay un error se imprime
    die('Error en la Conexion : ' . $mysqli->connect_errno);
}
?>
