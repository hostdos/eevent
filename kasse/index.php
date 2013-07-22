<!DOCTYPE html>

<html>
	<head>
		<title>Eevent Kasse</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="UTF-8">


  		<script src="js/jquery-1.9.1.js"></script>

		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<script src="bootstrap/js/bootstrap.min.js"></script>
  		<link href="css/style.css" rel="stylesheet" />
		<script src="js/tillManager.js"></script>
	</head>
	<body>
		<div id="content">
			<h1>Eevent Kasse</h1>
			<div id="loginpanel">
				<input id="key" value="" type="password" /><br />
				<p>Bitte beachte dass die Seite vollständig ohne Neu laden funktioniert. <br />Daher unterlasse das laden der Seite und den zurück Button ausser du willst dich <br />neu einloggen/die Bestellung stornieren/es ist ein Fehler aufgetreten</p>
				<div id="tillselection">
					<input class="btn" type="button" value="Küche" />
					<input class="btn" type="button" value="Checkin" />
					<input class="btn" type="button" value="Bar" />
				</div>
			</div>
			<div id="till">
				<div id="tillbuttons"></div>
				<div class="well" id="tilldisplay"><ul class="unstyled"></ul>
					<button id="summarize" disabled class="btn btn-inverse">Summieren</button><br />
					<button id="ec" class="btn btn-success" rel="popover">EC Zahlung</button>  
					<button href="#" id="bar" class="btn btn-success">Barzahlung</button><br />  
					<button href="#" id="finish" class="btn btn-info">Bestellung abschliessen</button> 
					<input type="text" id="in"></input>
					<button id="calculate" class="btn btn-warning">Rückgeld berechnen</button>
					<p id="out"></p>
					<button id="reset" class="btn btn-danger">Abbrechen</button>
				</div>
			</div>

		</div>
	</body>
</html>