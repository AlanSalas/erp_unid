<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reloj Checador</title>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="contenedor">
		<div class="caja">
			<div class="fecha">
				<p id="diaSemana" class="diaSemana"></p>
				<p id="dia" class="dia"></p>
				<p>de </p>
				<p id="mes" class="mes"></p>
				<p>del </p>
				<p id="year" class="year"></p>
			</div>

			<div class="reloj">
				<p id="horas" class="horas"></p>
				<p>:</p>
				<p id="minutos" class="minutos"></p>
				<p>:</p>
				<div class="caja-segundos">
					<p id="ampm" class="ampm"></p>
					<p id="segundos" class="segundos"></p>
				</div>
			</div>
		</div>

		<form class="login100-form">
					<span class="login100-form-title">
						Bienvenido
					</span>
					<div class="wrap-input100">
						<input class="input100" type="text" name="user" placeholder="Nº Colaborador">
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="margin-bottom: 1rem;" type="button" id="register-btn">
							Registrar entrada
						</button>
						<button class="login100-form-btn" type="button" id="register-salida">
							Registrar salida
						</button>
					</div>
					<div style="text-align: center; color: black;">
						<div id="mensaje"></div>
					</div>
				</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="main.js"></script>
</body>

</html>