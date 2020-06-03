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
        <div  class="container form">
            <!-- Título a ser personalizado con Jquery -->
            <h1 id="titulo"></h1>
            <!-- Espacio para las diferentes notificaciones que eventualmente saldrán -->
            <div id="informacion" class="row"></div><br>
            <!-- Empezamos el formulario de las reservas-->
            <form id="formulario">
    			<div class="form-group">
                    <input type="hidden" id="opcion" name="opcion" value="INSERTAR">
        			<input type="hidden" id="id" name="id" value="">
        			<label> Nombre :</label><input type="text" class="form-control" name ="Nombre" id = "Nombre" placeholder="Introduzca el nombre..." required >
        		</div>
        		<div class="form-group">
        			<label> Apellidos :</label><input type="text" class="form-control" name ="Apellidos"  id = "Apellidos"  placeholder="Introduzca el/los Apellido/s..." required>
        		</div>
        		<div class="form-group">
        			<label> Telefono :</label><input type="number" class="form-control" name ="Telefono"  id = "Telefono" placeholder="Introduzca el teléfono..." required >
        		</div>
        		<div id="divfecha" class="form-inline">
        			<label> Fecha (Minimo 24 horas posterior a la fecha y hora actuales) :</label><br>
			        <select class="form-control" id="day" name="dia" required></select>
                    <select class="form-control" id="month" name="mes" onchange="updatediasmes()" required></select>
					<select class="form-control" id="year" name="ano" onchange="updatediasmes()" required></select>
                    <select class="form-control" id="hour" name="hora" required> </select>
					<select class="form-control" id="minute" name="minuto" required></select><br>
        		</div><br>
    			<div class="form-group">
    			    <label> Comensales :</label><input type="number" class="form-control" name ="comensales"  id = "Comensales" value="0" min="0" max="10" placeholder="Número de comensales ( Máximo 10 )" required >
    			</div>
			    <div class="form-group">
			        <label> Comentarios :</label><textarea class="form-control" rows="2" cols="60" name ="comentarios"  id = "Comentarios"></textarea>
			    </div>
			    <div class="form-group">
			        <input class="one btn btn-primary btn-lg" type="submit" value="Guardar">
			    </div>
            </form>
	    </div>
    </body>
</html>
