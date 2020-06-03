<?php
    // Esta página es solicitada junto con el ID del id de la reserva en el URL (editar.php?id="numero reserva")
    // obtenemos el id de la reserva
	$id_URL=$_POST['id'];
    include("includes/SelectDB.php");
    // llamamos la funcion que nos devuelve los datos que van a llenar el formulario para poder ser editados
    $datos=Editar($id_URL);
    echo json_encode($datos, JSON_FORCE_OBJECT);
?>
