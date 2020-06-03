/*
    Este archivo es importado en las páginas principales para controlar que a cada minuto
    se vuelva a verificar si hay reservas que ya entran dentro de las 24h seguientes
    - A través del evento document.ready ejecuta esta verificación
    La otra funcion que tiene es borrar
*/

/*
    En este evento nos interesa ejecutar así que el documento esté listo, la función de verificación de las reservas
    en las próximas 24horas
*/
$(document).ready(function()
{
    // Funcion que verifica a traves de una consulta Ajax si ha reservas en las próximas 24h
    function verifica24()
    {
       // se inicia la petición de los datos donde se utiliza:
       // url: el archivo que ejecuta la peticion,
       // type: el tipo de petición, Post, Get, etc
	   $.ajax({
            url: "includes/verifica24.php",
            type: "POST",
            success: function(respuesta)
            {
                // si la respuesta es exitosa nos devuelve un valor numérico
                // 0 si no existen reservas en las próximas 24 horas, o otro numero si existen
                if (respuesta == 0)
                {
                    // Si no hay reservas en las próximas 24 horas, el botón de reservas en las próximas 24 horas será color
                    // naranja/warning, estará desabilitado y dirá "Sin reservas Próx. 24 horas"
                    $('#24h').html("<a class='btn btn-warning btn-lg disabled' href='index24.php'>Sin reservas Próx. 24 horas</a>");
                } else {
                    // Si tiene reservas, se activa en botón, se cambia su texto y estilo
                    $('#24h').html("<a class='btn btn-success btn-lg' href='index24.php'>Con reservas próx. 24 horas</a>");
                    // Cómo pedía en el enunciado, le añadí este link en caso de que hayan reservas en las proximas 24 horas
                    $("#info24").html("<h5><a class='center' href='index24.php'><strong>Existen reservas en las próximas 24 horas</strong></a></h5>");
                }
            },
			error: function(jqXHR,status)
            {
                // Si hay un error en la petición se advierte con una ventana emergente
            	alert ('Han habido errores al realizar la consulta de datos.');
			}
       })
    }
    // llamamos la funcion que de entrada verifica si hay reservas en las próximas 24 horas o no
	verifica24();
    // volvemos a executar la función a cada minuto (60000 millisegundos)
	setInterval(function() { verifica24();}, 60000);

    // Este evento se ejecutará cuando se detecte que se ha clicado en el botón borrar una reserva
	$(document).on('click','td a.borrar', function()
    {
		// obtenemos el id de la fila de la tabla para borrarla
		var fila_id=($(this).parent().parent().attr('id')); //recogemos el atributo id para utilizar el metodo remove
		// una ves que tenemos el id se componen los datos que se pasarán por la petición
		var datos="opcion=BORRAR&id="+fila_id;
        // se inicia la petición de los datos donde se utiliza:
        // url: el archivo que ejecuta la peticion,
        // type: el tipo de petición, Post, Get, etc
        // data: los datos a pasar a la peticion
		$.ajax({
			url: 'includes/procesar.php',
			type: 'POST',
			data:datos,
			success: function(respuesta)
            {
                // Removemos de la tabla la línea que corresponde a la reserva borrada
                $('#'+fila_id).remove();
                // Si la respuesta es exitosa imprimimos esa información
                $("#informacion").addClass('alert alert-success row').html('<strong>¡Reserva borrada con Exito!</strong>');
                // Removemos el mensaje al final de 3 segundos
                setInterval(function() { $('#informacion').remove();}, 3000);
			},
			error: function(jqXHR,status)
            {
                // Si hay un error en la petición se advierte con una ventana emergente
        		alert ('Han habido errores al realizar la transferencia de datos.');
			}
	    });
	});
 });
