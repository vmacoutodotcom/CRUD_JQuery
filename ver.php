<?php
    // Esta página es solicitada junto con el ID del id de la reserva en el URL (ver.php?id="numero reserva")
    // obtenemos el id de la reserva
    $id_URL=$_GET['id'];
    include("includes/SelectDB.php");
    // llamamos la funcion detalle que nos devuelve los datos de la reserva obtenida anteriormente
    $linea=Detalle($id_URL);
    // atribuimos los valores devueltos por la función a variables
    $Nombre=$linea['nombre'];
    $Apellidos=$linea['apellidos'];
    $Tlf=$linea['telefono'];
    $Fecha=$linea['fecha'];
    $Comensales=$linea['comensales'];
    $Comentarios=$linea['comentarios'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Vitor_Couto_PWA_PRACTICA</title>
        <!-- Importamos las librerias pertinentes -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Importamos el libro de estilos personalizado -->
        <link rel="stylesheet" href="css/estilos.css">
        <script src="js/jquery-3.2.0.min.js"></script>
        <!-- Importamos los Javascripts personalizados -->
        <script type="text/javascript" src="js/otrasfunciones.js"></script>
        <script type="text/javascript" src="js/formulario.js"></script>
    </head>
    <body>
        <header>
    		<div class="row text-center">
                <a class="btn btn-success btn-lg " href="index.php">Todas las reservas</a>
                <!-- El id 24h será automaticamente actualizado -->
                <a id="24h"></a>
                <a class="btn btn-success btn-lg" href="formulario.php">Nueva reserva</a>
    	    </div><br>
    	</header>
        <div class="container form">
            <!-- Imprimimos el título con el numero de la reserva -->
            <h1><b>Reserva Número:<?php echo $id_URL; ?></b></h1>
            <!-- Espacio para las diferentes notificaciones que eventualmente saldrán -->
            <div id="alerta"></div>
            <!-- Criamos la tabla e imprimimos los detalles de la reserva -->
            <table class="table ver table-bordered text-center container-fluid tableinfo">
                <tr>
                    <th><h4>Nombre</h4></th><td><h4><b><?php echo $Nombre; ?></b></h4></td>
                </tr>
                <tr>
                    <th><h4>Apellidos</h4></th><td><h4><b><?php echo $Apellidos; ?></b></h4></td>
                </tr>
                <tr>
                    <th><h4>Telefono</h4></th><td><h4><b><?php echo $Tlf; ?></b></h4></td>
                </tr>
                <tr>
                    <th><h4>Fecha</h4></th><td><h4><b><?php echo $Fecha; ?></b></h4></td>
                </tr>
                <tr>
                    <th><h4>Comensales</h4></th><td><h4><b><?php echo $Comensales; ?></b></h4></td>
                </tr>
                <tr>
                    <th><h4>Comentarios</h4></th><td><h4><b><?php echo $Comentarios; ?></b></h4></td>
                </tr>
                <tr>
                    <!-- Añadimos el botón de editar esta reserva -->
                    <td colspan="2" class="one"><h4><a class="one btn btn-warning btn-lg" href="formulario.php?id=<?php echo $id_URL; ?>">Editar</a></h4></td>
                </tr>
            </table>
    		<div class="form-group">
                   <!-- Añadimos el botón de volver -->
    		       <a class="one btn btn-primary btn-lg" href="index.php">Volver</a>
    		</div>
        </div>
    </body>
</html>
