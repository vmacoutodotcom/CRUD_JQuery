<?php
include("SelectDB.php");
// Atribuimos los datos a variables
$opcion=$_POST['opcion'];
$ID_URL=$_POST['id'];
$Nombre=$_POST['Nombre'];
$Apellidos=$_POST['Apellidos'];
$Tlf=$_POST['Telefono'];
$ano=$_POST['ano'];
$Mes=$_POST['mes'];
$Dia=$_POST['dia'];
$Hora=$_POST['hora'];
$Minuto=$_POST['minuto'];
$Fecha="$ano-$Mes-$Dia $Hora:$Minuto:00";
$Comensales=$_POST['comensales'];
$Comentarios=$_POST['comentarios'];

/*
    Ejecutamos la opcion según el contenido de $opcion
*/
switch ($opcion)
{
    case "VERIFICAR":
        $resultado=verificar($Nombre, $Apellidos, $Tlf, $ano, $Mes, $Dia, $Hora, $Minuto);
        $res=implode(",", $resultado);
        echo $res;
        break;

    case "INSERTAR":
        inserir($Nombre, $Apellidos, $Tlf, $Fecha, $Comensales , $Comentarios);
        break;

	case "ACTUALIZAR":
        actualizar($ID_URL, $Nombre, $Apellidos, $Tlf, $Fecha, $Comensales , $Comentarios);
	    break;

	case "BORRAR":
        borrar($ID_URL);
	    break;

	default:
		echo "Error: Intentalo de nuevo...";
}
?>
