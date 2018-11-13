<!DOCTYPE html>
<?php require_once 'connection.php';
	if (isset($_GET['del'])) 
		{
			$del = $_GET['del'];
			$query = "DELETE FROM `zadatak_php` WHERE `zadatak_php`.`kod` LIKE '".$del."'";
			$result= $dbc->query($query);
			header("Location:lista.php");
		}
?>
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
						<li><a href="index.php">Prijava</a></li>
						<li class="active"><a href="lista.php">Lista prijava <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<?php 
			$query = "SELECT * FROM `zadatak_php` ORDER BY `zadatak_php`.`vrijeme_prijave` DESC";
			$result= $dbc-> query($query);
		 ?>
		<div class="container">
			<h1>Lista prijava</h1>
			<p>Na ovoj stranici se trebaju prikazati prijave korisnika.</p>
			<p>
				Prvu stupac je redni broj.<br>
				Vrijeme prijave se treba prikazivati u formatu u kojem je u tablici.<br>
				Email i PHP verzija su unešeni podaci.<br>
				Kod je jednistveni kod koji se sastoji od 8 alfanumeričkih znakova.<br>
				Kratak opis prikazuje samo 50 prvih znakova unešenog texta.<br>
				Brisanje je link koji briše prijavu iz baze. Nakon brisanja prijave, ponovno se treba prikazati ova stranica.<br>
				Prijave trebaju biti sortirane prema vremenu unosa, silazno.
			</p>
			
			<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Vrijeme prijave</th>
					<th>Email</th>
					<th>PHP verzija</th>
					<th>Kod</th>
					<th>Kratak opis</th>
					<th>Brisanje</th>
					<th>Detaljni prikaz</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				if ($result->num_rows>0) {
					$br=1;
					while ($row=$result->fetch_assoc()) {
						echo '<tr>
							<td>'.$br.'</td>
							<td>'.$row['vrijeme_prijave'].'</td>
							<td>'.$row['email'].'</td>
							<td>'.$row['php_verzija'].'</td>
							<td>'.$row['kod'].'</td>
							<td>'.mb_substr($row['kratak_opis'],0,50).'</td>
							<td><a class="btn btn-danger" href="lista.php?del='.$row['kod'].'">Brisanje</a></td>
							<td><a class="btn btn-primary" href="detaljni_prikaz.php?dp='.$row['kod'].'">Detaljni prikaz</a></td>
							</tr>';
						$br++;
					}
				}
			?>		
			</tbody>
			</table>
		</div>
		
	</body>
</html>