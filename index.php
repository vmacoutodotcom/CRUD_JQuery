<?php //Importamos el Select Data Base, porque hacemos una llamada a la función selectReservas()
include("includes/SelectDB.php"); ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Vitor_Couto_PWA_PRACTICA</title>
        <!-- Importamos las librerias pertinentes -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Importamos el libro de estilos personalizado -->
        <link rel="stylesheet" href="css/estilos.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.0.min.js"></script>
        <!-- Importamos los Javascripts personalizados -->
    	<script type="text/javascript" src="js/otrasfunciones.js"></script>
        <script type="text/javascript" src="js/formulario.js"></script>
    </head>
    <body>
        <header>
    		<div class="row text-center">
                <a class="btn btn-success btn-lg" href="index.php">Todas las reservas</a>
                <!-- El id 24h será automaticamente actualizado -->
                <a id="24h"></a>
                <a class="btn btn-success btn-lg" href="formulario.php">Crear nueva reserva</a>
    	    </div><br>
    	</header>
    	<div class="container">
    		<h1><b>Todas las Reservas</b></h1>
            <!-- Espacio para las diferentes notificaciones que eventualmente saldrán -->
    		<div id="info24" class="row" ></div>
            <div id="informacion" class="row"></div>
    		<div class="row">
                <!-- Hace una llamada a la seleccion de reservas e imprime la tabla con los resultados -->
                <?php $slreserva=selectReservas(); echo $slreserva;?>
            </div>
        </div>
    </body>
</html>
