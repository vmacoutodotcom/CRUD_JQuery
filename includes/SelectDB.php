<?php
// Este archivo contiene todas las funciones de pedidos (query's) a la base de datos
/*
    Cabecera de la pagina utilizada para debujar la primera línea de la TABLA
    llamada tanto por SelectReservas como por SelectReservas24
*/
function encabezado(){
	$slcencabezado="<table id='tabreservas' class='table table-bordered table-striped text-center container-fluid' >
	<tr><th class='text-center'>Nombre / Apellidos</th>
	<th class='text-center'>Teléfono</th>
	<th class='text-center'>Fecha / Hora</th>
	<th class='text-center'>Comensales</th>
    <th class='text-center'>Ver</th>
    <th class='text-center'>Editar</th>
    <th class='text-center'>Borrar</th>
    </tr>";
    return $slcencabezado;
}

/*
    SelectReservas selecciona de la base de datos todas las reservas futuras y las imprime en una tabla
    Retorna ya toda la tabela HTML montada con los resultados
*/
function selectReservas(){
    include("conexion.php");
    // Llamamos la funcion encabezado que nos devuelve la primera línea de la tabla
    $slcencabezado=encabezado();
    // Montamos la consulta
	$query="SELECT *  FROM reservas  WHERE fecha>NOW() ORDER BY fecha";
	// lanzamos la consulta
	$result=$mysqli->query($query)or die($mysqli->error);
    // Empezamos añadiendo el encabezado de la tabla
    $slcreserva=$slcencabezado;
    // Bucle que imprime los resultados en cada línea
	while ($row=$result->fetch_assoc())
	{
        // separamos la fecha del tiempo para poder personalizar su presentación
        $formatfecha=date_create($row['fecha']);
        $formatdia=date_format($formatfecha,"d/m/Y");
        $formathora=date_format($formatfecha,"H:i");
        // Se aplica un ID para que se puede identificar y cambiar con Jquery
    	$slcreserva.="<tr id='".$row['id']."'><td>".$row['nombre']." ".$row['apellidos']."</td>";
    	$slcreserva.="<td>".$row['telefono']."</td>";
    	$slcreserva.="<td>".$formatdia." a las ".$formathora." horas</td>";
    	$slcreserva.="<td>".$row['comensales']."</td>";
    	$slcreserva.="<td><a class=\"ver ancho btn btn-info btn-sm\"";
    	$slcreserva.=" href=\"ver.php?id=".$row['id']."\"";
        $slcreserva.=">Ver</a></td>";
    	$slcreserva.="<td><a class=\"editar ancho btn btn-warning btn-sm\"";
    	$slcreserva.=" href=\"formulario.php?id=".$row['id']."\"";
    	$slcreserva.=">Editar</a></td>";
    	$slcreserva.="<td><a class=\"borrar ancho btn btn-danger btn-sm\"";
    	$slcreserva.=">Borrar</a>";
    	$slcreserva.="</td></tr>";
	}
	$slcreserva.="</table>";
    return $slcreserva;
}

/*
    SelectReservas24 selecciona de la base de datos solo las reservas de las próximas 24 horas y las imprime en una tabla
    Retorna ya toda la tabela HTML montada con los resultados
*/
function selectReservas24(){
    include("conexion.php");
    $slcencabezado=encabezado();
    // La consulta es lo único que cambia aqui
    $query="SELECT *, TIMESTAMPDIFF(SECOND, NOW(),fecha) FROM reservas WHERE (fecha>NOW()) AND (TIMESTAMPDIFF(SECOND, NOW(),fecha)<86400) ORDER BY fecha";
    $result24=$mysqli->query($query)or die($mysqli->error);
    $slcreserva24=$slcencabezado;
    // detectamos que dia es hoy
    $hoy=date('d');
    while ($row=$result24->fetch_assoc())
	{
        // separamos la fecha del tiempo para poder personalizar su presentación
        // tambien obtenemos por separado el dia de cada reserva
        $formatfecha=date_create($row['fecha']);
        $formatdia=date_format($formatfecha,"d/m/Y");
        $formathora=date_format($formatfecha,"H:i");
        $fechares=date_format($formatfecha,"d");
        // Se aplica un ID para que se puede identificar y cambiar con Jquery
    	$slcreserva24.="<tr id='".$row['id']."'><td>".$row['nombre']." ".$row['apellidos']."</td>";
    	$slcreserva24.="<td>".$row['telefono']."</td>";
        // Dentro de lo que son las próximas 24 horas detectamos si la reserva es para hoy o para mañana
        if($fechares == $hoy)
        { $slcreserva24.="<td id='hoy'><b> Hoy ".$formatdia." a las ".$formathora."</b></td>"; }
        else
        { $slcreserva24.="<td id='manana'> Mañana ".$formatdia." a las ".$formathora."</td>"; }
    	$slcreserva24.="<td>".$row['comensales']."</td>";
    	$slcreserva24.="<td><a class=\"ver ancho btn btn-info btn-sm\"";
    	$slcreserva24.=" href=\"ver.php?id=".$row['id']."\"";
    	$slcreserva24.=">Ver</a></td>";
    	$slcreserva24.="<td><a class=\"editar ancho btn btn-warning btn-sm\"";
    	$slcreserva24.=" href=\"formulario.php?id=".$row['id']."\"";
    	$slcreserva24.=">Editar</a></td>";
    	$slcreserva24.="<td><a class=\"borrar ancho btn btn-danger btn-sm\"";
    	$slcreserva24.=">Borrar</a>";
    	$slcreserva24.="</td></tr>";
	}
	$slcreserva24.="</table>";
    return $slcreserva24;
}

/*
    Esta funcion es llamada a cada minuto para ver si hay reservas en las proximas 24 horas o no
    Tiene la lisma query que la funcion SelectReservas24 pero pero retorna simplemente
    un booleano True o false. En este caso un 0 o 1.
*/
function boton24(){
    include("conexion.php");
    $query="SELECT *, TIMESTAMPDIFF(SECOND, NOW(),fecha) FROM reservas WHERE (fecha>NOW()) AND TIMESTAMPDIFF(SECOND, NOW(),fecha)<86400 ORDER BY fecha";
    $result24=$mysqli->query($query)or die($mysqli->error);
    if ($result24->num_rows)
    { $boton24=1; } else { $boton24=0; }
    return $boton24;
}

/*
    Esta función es llamada para sacar todos los detalles de una reserva existente cuando se
    quiere ver los detalles de la misma
*/
function Detalle($id_URL){
    include("conexion.php");
    $query="SELECT * FROM reservas WHERE id=".$id_URL;
    $result=$mysqli->query($query);
    $linea=$result->fetch_assoc();
    return $linea;
}

/*
    Esta es la función llamada cuando se pretende editar una reserva existente
    recibimos el id de la reserva y retornamos todos los datos
*/
function Editar($id_URL){
    include("conexion.php");
	// En esta consulta deparamos los elementos que componen lo fecha
    $query="SELECT *,
	YEAR(fecha) AS ano,
	MONTH(fecha) AS mes,
	DAY(fecha) AS dia,
	HOUR(fecha) AS hora,
	MINUTE(fecha) AS minutos
	FROM `reservas` WHERE id=".$id_URL;
	$result=$mysqli->query($query)or die($mysqli->error);
	$row=$result->fetch_assoc();
	$Nombre=$row['nombre'];
	$Apellidos=$row['apellidos'];
	$Tlf=$row['telefono'];
	$year=$row['ano'];
	$Mes=$row['mes'];
	$Dia=$row['dia'];
	$Hora=$row['hora'];
	$Minutos=$row['minutos'];
	$Comensales=$row['comensales'];
	$Comentarios=$row['comentarios'];
    header('Content-Type: application/json');
    $datos = array('Nombre' => $Nombre,'Apellidos' => $Apellidos, 'ano' => $year,'Mes' => $Mes,'Dia' => $Dia,'Hora' => $Hora,'Minutos' => $Minutos,'Tlf' => $Tlf,'Comensales' => $Comensales,'Comentarios'=> $Comentarios);
    return $datos;
}

/*
    Esta función es la utilizada para verificar si hay reservas repetidas en la base de datos
*/
function verificar($Nombre, $Apellidos, $Tlf, $ano, $Mes, $Dia, $Hora, $Minuto){
    include("conexion.php");
    $query="SELECT COUNT(*) FROM reservas WHERE nombre='$Nombre' AND apellidos='$Apellidos' AND telefono='$Tlf' AND YEAR(fecha)='$ano' AND MONTH(fecha)='$Mes' AND DAY(fecha)='$Dia' AND HOUR(fecha)='$Hora' AND MINUTE(fecha)='$Minuto'";
    $result=$mysqli->query($query)or die($mysqli->error);
	$row=$result->fetch_assoc();
    return $row;
}

/*
    Funcion llamada para inserir en la base de datos una reserva nueva
*/
function inserir($Nombre, $Apellidos, $Tlf, $Fecha, $Comensales , $Comentarios){
    include("conexion.php");
    $query="INSERT INTO reservas
    (id, nombre , apellidos , telefono , fecha , comensales , comentarios) VALUES
    (NULL, '$Nombre', '$Apellidos', '$Tlf', '$Fecha', '$Comensales' , '$Comentarios')";
    $result=$mysqli->query($query)or die($mysqli->error);
    echo $result;
}

/*
    Funcion llamada para actualizar en la base de datos una reserva existente
*/
function actualizar($ID_URL, $Nombre, $Apellidos, $Tlf, $Fecha, $Comensales , $Comentarios){
    include("conexion.php");
    $query= "UPDATE reservas SET nombre='$Nombre',apellidos='$Apellidos',telefono='$Tlf',
    fecha='$Fecha', comensales='$Comensales' , comentarios='$Comentarios'  WHERE id=".$ID_URL;
    $result=$mysqli->query($query)or die($mysqli->error);
}

/*
    Funcion llamada para borrar de la base de datos una reserva existente
*/
function borrar($ID_URL){
    include("conexion.php");
    $query="DELETE FROM reservas WHERE reservas.id=" .$ID_URL;
	$result=$mysqli->query($query)or die($mysqli->error);
}
?>
