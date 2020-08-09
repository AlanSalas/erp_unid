(function(){
	var actualizarHora = function(){
		
		var fecha = new Date(),
			horas = fecha.getHours(),
			ampm,
			minutos = fecha.getMinutes(),
			segundos = fecha.getSeconds(),
			diaSemana = fecha.getDay(),
			dia = fecha.getDate(),
			mes = fecha.getMonth(),
			year = fecha.getFullYear();

	
		var pHoras = document.getElementById('horas'),
			pAMPM = document.getElementById('ampm'),
			pMinutos = document.getElementById('minutos'),
			pSegundos = document.getElementById('segundos'),
			pDiaSemana = document.getElementById('diaSemana'),
			pDia = document.getElementById('dia'),
			pMes = document.getElementById('mes'),
			pYear = document.getElementById('year');

		
		var semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
		pDiaSemana.textContent = semana[diaSemana];

		pDia.textContent = dia;

		var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
		pMes.textContent = meses[mes];
		pYear.textContent = year;


		if (horas >= 12) {
			horas = horas - 12;
			ampm = 'pm';
		} else {
			ampm = 'am';
		}

		if (horas == 0 ){
			horas = 12;
		}

		pHoras.textContent = horas;
		pAMPM.textContent = ampm;

		if (minutos < 10){ minutos = "0" + minutos; }
		if (segundos < 10){ segundos = "0" + segundos; }

		pMinutos.textContent = minutos;
		pSegundos.textContent = segundos;
	};

	actualizarHora();
	var intervalo = setInterval(actualizarHora, 1000);
}())

$(document).ready(function(){
	$('#register-btn').click(function(event){
		let button = event.target;
		let numero = $('input[name=user]').val();
		const timezoneOffset = (new Date()).getTimezoneOffset() * 60000;
		const date = (new Date(Date.now() - timezoneOffset))
		.toISOString()
		.substring(0, 19)
		.replace('T', ' ');
		let solofecha = date.split(' ');
		let obj = {
			accion: 'registro-asistencia',
			number: numero,
			fecha_hora: date,
			fecha: solofecha[0]
		};
		$.ajax({
			url: './funciones_asistencias.php',
			type: 'POST',
			dataType: 'json',
			data: obj,
			success: (r) => {
				if(r.status == 1 || r.status == "1"){
					$('#mensaje').text('Registro completado');
				} else {
					$('#mensaje').text('El número ingresado es incorrecto');
				}
			}
		});
	});
	$('#register-salida').click(function(){
		let button = event.target;
		let numero = $('input[name=user]').val();
		const timezoneOffset = (new Date()).getTimezoneOffset() * 60000;
		const date = (new Date(Date.now() - timezoneOffset))
		.toISOString()
		.substring(0, 19)
		.replace('T', ' ');
		let solofecha = date.split(' ');
		let obj = {
			accion: 'registro-salida',
			number: numero,
			fecha_hora: date,
			fecha: solofecha[0]
		};
		$.ajax({
			url: './funciones_asistencias.php',
			type: 'POST',
			dataType: 'json',
			data: obj,
			success: (r) => {
				if(r.status == 1 || r.status == "1"){
					$('#mensaje').text('Salida completada');
				} else {
					$('#mensaje').text('El número ingresado es incorrecto');
				}
			}
		});
	});
});