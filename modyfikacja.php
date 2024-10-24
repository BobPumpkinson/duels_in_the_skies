<?php
	include 'autoryzacja.php';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
	or die('Błąd połączenia z serwerem: ' . mysqli_error($conn));
	
	mysqli_query($conn, 'SET NAMES utf8');


	session_start();
	
	if(!isset($_SESSION['loggedIn']) or $_SESSION['loggedIn'] !== true) {
		header("Location: login.html");
		exit;
	}
	
	if(isset($_GET['id'])) {
		mysqli_query($conn, "DELETE FROM aircraft WHERE id='".$_GET['id']."';");
	}
	if(isset($_POST['model'])) {
		mysqli_query($conn, "INSERT INTO aircraft(company, model, country, speed, combat_range, ceiling, climb, wing_loading, armament) 
		VALUES ('".$_POST['company']."','".$_POST['model']."','".$_POST['country']."','".$_POST['speed']."','".$_POST['combat_range']."','".$_POST['ceiling']."','".$_POST['climb']."','".$_POST['wing_loading']."','".$_POST['armament']."');");
	}
	if(isset($_POST['new_company']) and isset($_POST['new_model']) and isset($_POST['new_country']) and isset($_POST['new_speed']) and isset($_POST['new_range']) and isset($_POST['new_ceiling']) and isset($_POST['new_climb']) and isset($_POST['new_wing_l']) and isset($_POST['new_armament'])) {
		mysqli_query($conn, "UPDATE aircraft SET company='".$_POST['new_company']."', model='".$_POST['new_model']."', country='".$_POST['new_country']."', speed='".$_POST['new_speed']."', combat_range='".$_POST['new_range']."', ceiling='".$_POST['new_ceiling']."', climb='".$_POST['new_climb']."', wing_loading='".$_POST['new_wing_l']."', armament='".$_POST['new_armament']."' WHERE id='".$_POST['new_id']."';");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>USAAF kontra Luftwaffe</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="styles.css">
		<meta charset="UTF-8">
		<style>
			article {
				margin: 0;
				padding: 50px;
				overflow: hidden;
			}
			table {
				margin-left: auto;
				margin-right: auto;
				text-align: center;
				overflow: hidden;
			}
			.row {
				margin-left: 0;
				margin-right: 0;
			}
			.button {
				font-size: 120%;
				color: white;
				background-color: #1a75ff;
				width: 30vw;
				cursor: pointer;
				margin: 40px;
			}
			button {
				color: white;
				background-color: #1a75ff;
				border: none;
			}
			@media all and (max-width:700px) {
				article {
					padding: 0;
				}
			}
		</style>
	</head>
	<body>
		<!-- Pasek nawigacji -->
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.html">Strona Główna</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="historia.html">Historia</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="mysliwce.html">Myśliwce</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="osiagi.php">Osiągi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="oserwisie.html">O serwisie</a>
						</li>
					</ul>
				</div>
				<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Wyloguj</a>
						</li>
					</ul>
				</div>
		  </div>
		</nav>
	
		<article>
			<div class="button p-3 text-center" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'" onclick="location.href='dodaj.php'">Dodaj nowy samolot</div>
		
			<div class="table-responsive m-5">
				<table class="table table-bordered table-striped align-middle">
					<thead class="align-middle">
						<tr>
							<th>Producent</th>
							<th>Model</th>
							<th>Kraj</th>
							<th>Prędkość maksymalna (km/h)</th>
							<th>Zasięg (km)</th>
							<th>Pułap (m)</th>
							<th>Wznoszenie (m/min)</th>
							<th>Obciążenie powierzchni nośnej (kg/m<sup>2</sup>)</th>
							<th>Uzbrojenie</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$result = mysqli_query($conn, "SELECT * FROM aircraft;")
						or die("Błąd w zapytaniu do bazy");
						
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>".$row['company']."</td>";
							echo "<td>".$row['model']."</td>";
							echo "<td>".$row['country']."</td>";
							echo "<td>".$row['speed']."</td>";
							echo "<td>".$row['combat_range']."</td>";
							echo "<td>".$row['ceiling']."</td>";
							echo "<td>".$row['climb']."</td>";
							echo "<td>".$row['wing_loading']."</td>";
							echo "<td>".$row['armament']."</td>";
							echo '<td><a href="edytuj.php?id='.$row['id'].'"><button>Edytuj</button></td>';
							echo '<td><a href="modyfikacja.php?id='.$row['id'].'"><button>Usuń</button></a></td>';
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</article>
		
		<div class="container-fluid p-3 footer">
			<a href="bibliografia.html">Bibliografia</a>
			<p>&#169; Michał Rybicki 2024</p>
		</div>
	</body>
</html>