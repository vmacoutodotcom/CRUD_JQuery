/*
    Esta función obtiene el número de días del mes según el mes y el año seleccionado en el formulario
*/
function diasenelMes(month, year)
{
    var diasmes = new Date(year, month, 0).getDate();
    return diasmes;
}

/*
    Creamos un objecto con la fecha de hoy. La hice cómo una función porque la llamo desde 2 diferentes stios.
*/
function fechadehoy()
{
    var fechadehoy = new Date();
    return fechadehoy;
}

/*
    Esta función es llamada por el formulario ( onchange ) més y día,
    para actualizar el número de días del mes actualmente seleccionado
*/
function updatediasmes()
{
    /*
        DÍA
    */
    // Leemos el valor de los campos Mes y año actuales en el formulario
    var mesescojido = $('#month').val();
    var anoescojido = $('#year').val();
    // llamamos la funcion que nos devuelve el numero de días según el mes y el año
    var numdias = diasenelMes(mesescojido, anoescojido);
    // obtenemos la fecha de hoy
    var fechahoy = fechadehoy();
    // obtenemos el día de hoy
    var diaactual = fechahoy.getDate();
    // Si el día actual es el último dia del mes, el proximo día es 1 dl mes siguiente
    // sino se suma 1. Esto para facilitar y que en el formulário por defecto nos enseñe la fecha
    // de 24h y 2 minutos más de la hora y fecha actuales
    if(diaactual == numdias)
    { diaactual=1; }else{ diaactual=diaactual+1; }
    // limpiamos el contenido anterior
    document.getElementById('day').innerHTML = "";
    // bucle que llena las opciones del dia, desde el actual hasta el numeros de día del mes
    for (var i=diaactual;i<=numdias;i++)
    { $('#day').append("<option>"+i+"</option>"); }
    // Bucle que añade al final del mes, los días restantes desde el día 1 hasta el dia actual
    for (var i=1;i<=(diaactual-1);i++)
    { $('#day').append("<option>"+i+"</option>"); }
}

/*
    Esta funcion autocompleta la fecha en el formulario con la fecha y hora actuales + 24 horas y 2 Minutos.
    Cómo no se puede hacer reservas con menos de 24 horas, y para ser más cómodo para el $usuario
    le he añadido por defecto ese tiempo.
*/
function FechaForm ()
{
    /*
        MES
    */
    // array con los 12 meses del año
    var mes=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    // se obtiene la mecha de hoy
    var fechahoy = fechadehoy()
    // Se obtiene el mes actual (numerico)
    var mesactual = fechahoy.getMonth();
    // Se añaden los meses en el formulario por defecto (de entrada) desde el mes actual hasta Diciembre
	for (var i=(mesactual);i<mes.length;i++)
    { $('#month').append("<option value='"+(i+1)+"'>"+mes[i]+"</option>"); }
    // Se añaden los restantes meses desde Enero hasta el mes anterior al actual
    for (var i=0;i<mesactual;i++)
    { $('#month').append("<option value='"+(i+1)+"'>"+mes[i]+"</option>"); }
    /*
        AÑO
    */
    // se obtiene el año actual
    var anoactual = fechahoy.getFullYear();
    // Se añaden las opciones desde el año actual hasta 2 años más
	for (var i=anoactual;i<=(anoactual+2);i++)
    { $('#year').append("<option>"+i+"</option>"); }

    // De entrada se llama la función que rellenas los días según el dia y mes actuales
    updatediasmes();
    /*
        HORA
    */
	// se obtiene la hora actual
    var horaactual = fechahoy.getHours();
    // se añaden las opciones desde la hora actuales hasta las 11 de la noche
	for (var i=horaactual;i<=23;i++)
    { $('#hour').append("<option>"+i+"</option>"); }
    // se añaden las restantes horas desde las 0 horas hasta la hora actual menos una
    for (var i=0;i<=(horaactual-1);i++)
    { $('#hour').append("<option>"+i+"</option>"); }
    /*
        MINUTOS
    */
    // se obtienen los minutos actuales
    var minutoactual = fechahoy.getMinutes();
    // Se añade al formulario los minutos actuales +2 por cuestion de dar tiempo de rellenar el formulario
	for (var i=(minutoactual+2);i<=59;i++)
    { $('#minute').append("<option>"+i+"</option>"); }
    // Se añaden los restantes minutos
    for (var i=0;i<=(minutoactual+1);i++)
    { $('#minute').append("<option>"+i+"</option>"); }
}

/*
    En esta función se comprueba si la fecha de la reserva sea posterior a la fecha y horas actuales más 24 horas
*/
function comprobarfecha(ano,mes,dia,hora,minuto)
{
    // Obtenemos la fecha actual
    var hoy = fechadehoy()
    // creamos un nuevo objecto con la fecha del formulario
    var reserva=new Date(ano,(mes-1),dia,hora,minuto)
    // restamos las dos fechas y la comparamos con 86400000 ms (que corresponde a 24 horas)
    if ((reserva.getTime()-hoy.getTime()) < 86400000)
    {
        // Si es inferior, entonces se enseña el mensaje de error
        $("#informacion").addClass('alert alert-danger row').html('<strong>¡No se acceptan reservas con menos de 24h de antelación!</strong>');
        // Se cambia el DIV donde esta la fecha al color de error
        $('#divfecha').addClass('alert alert-danger row');
        // Se mueve el focus a la línes de la fecha
    	$('#day').focus();
    }
    else
    {
        // Si la fecha es superior se asegura que no haya mensaje escrito y que no haya ningún color de error
    	$("#informacion").removeClass('alert alert-danger row').empty();
    	$('#divfecha').removeClass('alert alert-danger row');
    	return true;
    }
}

/*
    En esta función se revisan los comensales
*/
function clientes(comensales)
{
	// verificamos que el número de comensales sea numérico, superior a 0 y menor o igual a 10
	if ((!isNaN(comensales)) && (comensales > 0) && (comensales <=10))
    {
        // Si el numero de comensales esta bien, se asegura que no haya mensaje escrito y que no haya ningún color de error
		$("#informacion").removeClass('alert alert-danger row').empty();
		$('#Comensales').removeClass('alert alert-danger row');
		return true;
	}
	else
    {
		// Si no esta bien, entonces se enseña el mensaje de error
        $("#informacion").addClass('alert alert-danger row').html('<strong>El número de comensales tiene ser entre 1 y 10.</strong>');
        // Se cambia el input comensales al color de error
        $('#Comensales').addClass('alert alert-danger row');
        // Se mueve el focus a la línes de comensales
		$('#Comensales').focus();
    }
}

/*
    En esta función leemos del url si viene con un número de reserva u otras variables
*/
function leerGet()
{
    // Obtenemso la URL
    var url = document.location.href;
	// comprobamos si existen variables
    // Se si, obtenemos la parte a la derecha del ?
	if(url.indexOf('?')>0)
    { id_recuperada = url.split('?')[1]; return id_recuperada; }
}

/*
    Una vez definidas la funciones anteriores, empezamos el evento documento.ready
*/
$(document).ready(function()
{
	// De entrada llamamos la función que llena los datos por defecto en la fecha del formulario
	FechaForm ();

    /*
        Determinamos a través del resultado de la funcion leerGet si hay un
        número de reserva en el url o no.
        - Se no, significa que se trata de la creación de una nueva reserva
        y solo se escribe el título de la página de acorde
        - Se si, significa que se trata de una edición/modificación de una reserva existente
        así que se coje el numero de la reserva para obtener la informacion de la reserva
    */
    //
	if (typeof(leerGet())=="undefined")
    { $("#titulo").html('<b>Nueva Reserva</b>'); }
    else
    {
        // se inicia la petición de los datos donde se utiliza:
        // url: el archivo que ejecuta la peticion,
        // type: el tipo de petición, Post, Get, etc
        // data: los datos a pasar a la peticion
    	$.ajax({
            url: 'editar.php',
    		type: 'POST',
    		data:leerGet(),
    		success: function(respuesta)
            {
                // Si la respuesta es exitosa entonces escribe el título
        		$("#titulo").html('<b>Editar Reserva N. ('+ leerGet().split('=')[1]+')</b>');
        		// actualizamos el id de la reserva para la futura petición de actualizacion
        		$("#id").val(leerGet().split('=')[1]);
        		// actualizamos el valor de la petición para ser identificada como actualización de una reserva y no una reserva nueva
        		$("#opcion").val('ACTUALIZAR');
        		// atribuimos a cada input del formulário el valor retornado por la petición para ser editado
				$("#Nombre").val(respuesta.Nombre);
				$("#Apellidos").val(respuesta.Apellidos);
				$("#Telefono").val(respuesta.Tlf);
				$("#Comensales").val(respuesta.Comensales);
				$("#Comentarios").val(respuesta.Comentarios);
				$("#year").val(respuesta.ano);
				$("#month").val(respuesta.Mes);
				$("#day").val(respuesta.Dia);
				$("#hour").val(respuesta.Hora);
				$("#minute").val(respuesta.Minutos);
			},
			error: function(jqXHR,status)
            {
                // Si hay un error en la petición se advierte con una ventana emergente
                alert ('Hubo un error al realizar el pedido  de datos.');
			}
		});
	}

    /*
        Función que llamaremos para inserir los datos de una nueva reserva
    */
    function inserir(datos)
    {
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
                // Si la respuesta es exitosa imprimimos esa información
                $("#informacion").addClass('alert alert-success row').html('<strong>El registro se ha almacenado correctamente en el sistema!</strong>');
                // cómo enseña la información al principio de la página y nos situamos al final del formulario
                // nos deslocalos hacia el topo de la página
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                // Removemos el mensaje al final de 3 segundos
                setInterval(function() {$('#informacion').removeClass().html('');}, 3000);
        	},
        	error: function(jqXHR,status)
            {
                // Si hay un error en la petición se advierte con una ventana emergente
        		alert ('Han habido errores al realizar la transferencia de datos.');
        	}
        });
    }

    /*
        Evento que ocurrirá cuando se submete el formulario
    */
    $("form").submit(function(event)
    {
    	event.preventDefault();
    	// obtenemos los datos del formulário
        var opcion=$('#opcion').val();
        var id = $('#id').val();
        var nombre = $('#Nombre').val();
        var apellidos = $('#Apellidos').val();
        var telefono = $('#Telefono').val();
    	var ano = $('#year').val();
    	var mes =$('#month').val();
    	var dia =$('#day').val();
    	var hora=$('#hour').val();
    	var minuto=$('#minute').val();
    	var comensales = $('#Comensales').val();
        var comentarios = $('#Comentarios').val();
        var fecha = ano+'-'+mes+'-'+dia+' '+hora+' '+minuto+' '+00;
        // nos aseguramos de comprobar la fecha y los comensales antes de proseguir
    	if (comprobarfecha(ano,mes,dia,hora,minuto) && clientes(comensales) )
        {
            // Hacemos la serialización de los datos tal y como nos lo ha devuelto el formulario
            var datos=$("form").serialize();
            // Hacemos una serialización manual cambiando el valor opcion, para en cualquier caso
            // sea inserir un nuevo registro o una alteracion, que no exista ningun registro repetido.
            // Se confirmará que no existe una otra reserva con el mismo nombre, apellido, telefono a la misma hora
            var datosverificar="opcion=VERIFICAR&id="+id+"&Nombre="+nombre+"&Apellidos="+apellidos+"&Telefono="+telefono+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&hora="+hora+"&minuto="+minuto+"&comensales="+comensales+"&comentarios="+comentarios
            // se inicia la petición de los datos donde se utiliza:
            // url: el archivo que ejecuta la peticion,
            // type: el tipo de petición, Post, Get, etc
            // data: los datos a pasar a la peticion
            $.ajax({
    			url: 'includes/procesar.php',
    			type: 'POST',
    			data: datosverificar,
    			success: function(respuesta)
                {
                    // si la respuesta es exitosa nos devuelve un valor numérico
                    // 0 si no existe una reserva duplicada, o, 1 si ya existe una reserva igual
                    if (respuesta == 0)
                    {
                        // procedemos a llamar la función que añadirá los datos de la nueva reserva
                        inserir(datos);
                    }
                    else
                    {
                        //  si ya existe una reserva de la misma persona en la misma fecha y hora, lo imprimimos
                        $("#informacion").addClass('alert alert-danger row').html("¡Ya tiene reservada una mesa para esta hora!");
                        // cómo enseña la información al principio de la página y nos situamos al final del formulario
                        // nos deslocalos hacia el topo de la página
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                        // Removemos el mensaje al final de 3 segundos
                        setInterval(function() {$('#informacion').removeClass().html('');}, 3000);
                    }
    			},
    			error: function(jqXHR,status)
                {
                    // Si hay un error en la petición se advierte con una ventana emergente
            		alert ('Han habido errores al realizar la transferencia de datos.');
    			}
    		});
	    }
    });
});
