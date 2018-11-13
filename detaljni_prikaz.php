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
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
<?php require_once 'connection.php'; ?>
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
						<li><a href="index.php">Prijava</a></li>
						<li class="active"><a href="lista.php">Lista prijava <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>


		<div class="container">
			<h1 class="text-center">Detaljni prikaz prijave</h1>
			<p class="text-center">Na ovoj stranici prikazuju se detaljni podaci odabrane prijave.</p>
			
			
			<table class="table table-striped" >
<?php 
	if (isset($_GET['dp'])) {
			 		$dp = $_GET['dp'];
			 		$query = "SELECT * FROM `zadatak_php` WHERE `zadatak_php`.`kod` LIKE'".$dp."' ORDER BY `zadatak_php`.`vrijeme_prijave` DESC";
					$result= $dbc-> query($query);

	if ($result->num_rows>0) {
		$br=1;
		while ($row=$result->fetch_assoc()) {
			echo '
				<tr>
					<th>Vrijeme prijave</th>
					<td>'.$row['vrijeme_prijave'].'</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>'.$row['email'].'</td>
				</tr>
				<tr>
					<th>PHP verzija</th>
					<td>'.$row['php_verzija'].'</td>
				</tr>
				<tr>
					<th>Kod</th>
					<td>'.$row['kod'].'</td>
				</tr>
				<tr>
					<th>Kratak opis</th>
					<td>'.chunk_split($row['kratak_opis'],50).'</td>
				</tr>
				';
			$br++;
		}
	}
	else{echo '<p class="p-er text-center">Odabrali ste nepostojeću prijavu!</p>';}
	}
 ?>
				 <div class="button text-center">
				<a class="btn btn-success" href="lista.php">Povratak</a>
				</div>	
			</table>
		</div>
			
			 
	</body>
</html>