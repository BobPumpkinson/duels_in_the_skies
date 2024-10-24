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
			button {
				color: white;
				background-color: #1a75ff;
				border: none;
				margin-top: 10px;
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
			<div class="container m-5">
				<?php
					$result = mysqli_query($conn, "SELECT * FROM aircraft WHERE aircraft.id='".$_GET['id']."';")
					or die("Błąd w zapytaniu do bazy");
					
					echo '<form action="modyfikacja.php" method="post">';
					echo '<fieldset>';
					echo '<legend>Edytuj samolot</legend>';
					
					$row = mysqli_fetch_array($result);
					echo 'Producent: '.'<input type="text" name="new_company" value="'.$row['company'].'"><br>';
					echo 'Model: '.'<input type="text" name="new_model" value="'.$row['model'].'"><br>';
					echo 'Kraj: '.'<input type="text" name="new_country" value="'.$row['country'].'"><br>';
					echo 'Prędkość maksymalna (km/h):'.'<input type="text" name="new_speed" value="'.$row['speed'].'"><br>';
					echo 'Zasięg (km): '.'<input type="text" name="new_range" value="'.$row['combat_range'].'"><br>';
					echo 'Pułap (m): '.'<input type="text" name="new_ceiling" value="'.$row['ceiling'].'"><br>';
					echo 'Wznoszenie (m/min): '.'<input type="text" name="new_climb" value="'.$row['climb'].'"><br>';
					echo 'Obciążenie powierzchni nośnej (kg/m<sup>2</sup>): '.'<input type="text" name="new_wing_l" value="'.$row['wing_loading'].'"><br>';
					echo 'Uzbrojenie: '.'<input type="text" name="new_armament" value="'.$row['armament'].'"><br>';
					echo '<input type="hidden" name="new_id" value="'.$row['id'].'">';
					echo '<button type="submit">Edytuj</button>';
					echo '</fieldset>';
					echo '</form>';
				?>
			</div>
		</article>
		
		<div class="container-fluid p-3 footer">
			<a href="bibliografia.html">Bibliografia</a>
			<p>&#169; Michał Rybicki 2024</p>
		</div>
	</body>
</html>