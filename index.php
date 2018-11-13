<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<title>Zahtjevi za server</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<?php 
		require_once 'connection.php'; 
		include 'functions.php';
		?>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Zahtjevi za server</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Prijava <span class="sr-only">(current)</span></a></li>
						<li><a href="lista.php">Lista prijava</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1>Prijava</h1>
			<p>Ovo je stranica za prijavu korisnika za korištenje servera.</p>
			<p>
				Podatke koji se ovdje ispune treba spremiti u bazu po izboru (MySQL, SQLite...)<br>
				Uz podatke iz forme, u bazu treba spremiti i vrijeme prijave.<br>
				Svaka prijava mora imati i jednistveni kod koji se sastoji od 8 alfanumeričkih znakova (npr: '68as4xfr').<br>
				Nakon uspješne prijave posjetitelj treba preusmjeriti na stranicu s listom prijava (template: lista.html).>
			</p>
			<form action="" method="post">
				<div class="form-group">
					<label for="email">Email adresa</label>
					<input type="email" class="form-control" name="email" id="email">
				</div>
				<div class="form-group">
					<label for="php">PHP verzija</label>
					<select class="form-control" name="php">
						<option></option>
						<option>7.0</option>
						<option>7.1</option>
						<option>7.2</option>
					</select>
				</div>
				<div class="form-group">
					<label for="mysql">Kratak opis</label>
					<textarea maxlength="200" class="form-control" name="short-desc" rows="3"></textarea>
					<p class="help-block">Do 200 znakova.</p>
				</div>
				<button type="submit" name="submit" class="btn btn-info">Submit</button>
			</form>
		</div>
		<?php 
		if (isset($_POST['submit'])) {

			if($_POST['email'] == "")
			{
				echo 'Niste unijeli e-mail!';
			}
			elseif($_POST['php'] == "")
			{
				echo 'Niste unijeli PHP verziju!';
			}
			else
			{
				$email = $_POST['email'];
				$php = $_POST['php'];
				$opis = $_POST['short-desc'];
				date_default_timezone_set("Europe/Zagreb");
				$time = date('d.m.Y. H:i', time());
				$kod = unique_code(8);
				$query = "INSERT INTO `zadatak_php` (`email`, `php_verzija`, `kratak_opis`, `vrijeme_prijave`, `kod`) VALUES ('$email', '$php', '$opis', '$time', '$kod');";
				$result = $dbc-> query($query);
				header('location:lista.php');
			}
		}
		?>


	</body>
</html>