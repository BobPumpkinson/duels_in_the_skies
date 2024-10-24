<?php
	include 'autoryzacja.php';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
	or die('Błąd połączenia z serwerem: ' . mysqli_error($conn));
	
	mysqli_query($conn, 'SET NAMES utf8');
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
				padding-top: 0;
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
			form {
				overflow: hidden;
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
							<a class="nav-link active" href="osiagi.php">Osiągi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="oserwisie.html">O serwisie</a>
						</li>
					</ul>
				</div>
				<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="modyfikacja.php">Administrator</a>
						</li>
					</ul>
				</div>
		  </div>
		</nav>
	
		<article>
			<div class="container my-5 text-center">
				<h2><b>Osiągi myśliwców amerykańskich i niemieckich</b></h2>
			</div>
			
			<div class="container m-5">
				<form action="" method="post">
					<fieldset>
						<legend>Wyszukaj myśliwiec</legend>
						<input type="text" name="model">
						<button type="submit">Szukaj</button>
						<button onclick="location.href='osiagi.php'">Powrót</button>
					</fieldset>
				</form>
			</div>
			
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
						if(!empty($_POST['model'])) {
							$result = mysqli_query($conn, "SELECT * FROM aircraft
							WHERE aircraft.model REGEXP '".$_POST['model']."' OR aircraft.company REGEXP '".$_POST['model']."';")
							or die("Błąd w zapytaniu do bazy");
						}
						else {
							$result = mysqli_query($conn, "SELECT * FROM aircraft;")
							or die("Błąd w zapytaniu do bazy");
						}
						
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
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			
			<div class="container m-5">
				<form action="" method="post">
					<fieldset>
						<legend>Porównaj myśliwce</legend>
						<?php
							$result1 = mysqli_query($conn, "SELECT * FROM aircraft;")
							or die("Błąd w zapytaniu do bazy");
							
							echo 'Myśliwiec 1: '.'<select name="plane1">';
							while($row1 = mysqli_fetch_array($result1)) {
								echo '<option value="'.$row1['id'].'">'.$row1['model'].'</option>';
							}
							echo '</select><br>';
							
							$result2 = mysqli_query($conn, "SELECT * FROM aircraft;")
							or die("Błąd w zapytaniu do bazy");
							
							echo 'Myśliwiec 2: '.'<select name="plane2">';
							while($row2 = mysqli_fetch_array($result2)) {
								echo '<option value="'.$row2['id'].'">'.$row2['model'].'</option>';
							}
							
							echo '</select><br>';
						?>
						<button type="submit">Porównaj</button>
					</fieldset>
				</form>
			</div>

			<div class="container center">
				<?php
					$result3 = mysqli_query($conn, "SELECT * FROM aircraft;")
					or die("Błąd w zapytaniu do bazy");
					
					while($row3 = mysqli_fetch_array($result3)) {
						if(!empty($_POST['plane1']) and !empty($_POST['plane2'])) {
							if($row3['id'] == $_POST['plane1']) {
								$model1 = $row3['model'];
								$speed1 = $row3['speed'];
								$range1 = $row3['combat_range'];
								$ceiling1 = $row3['ceiling'];
								$climb1 = $row3['climb'];
								$wing_loading1 = $row3['wing_loading'];
							}
							if($row3['id'] == $_POST['plane2']) {
								$model2 = $row3['model'];
								$speed2 = $row3['speed'];
								$range2 = $row3['combat_range'];
								$ceiling2 = $row3['ceiling'];
								$climb2 = $row3['climb'];
								$wing_loading2 = $row3['wing_loading'];
							}
						}
					}
					
					if(!empty($_POST['plane1']) and !empty($_POST['plane2'])) {
						echo '<div class="alert alert-info">';
						echo '<h3>Prędkość maksymalna</h3>';
						echo '<p>Prędkość samolotu zależy od wysokości. Niektóre myśliwce mają różny spadek lub wzrost osiągów na innych wysokościach. 
						Poniższe dane przedstawiają największą prędkość, jaką dany myśliwiec może osiągnąć na optymalnej dla siebie wysokości.</p>';
						echo '</div>';
						if($speed1 > $speed2) {
							echo '<div class="row">';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model1.':</b> '.$speed1.' km/h</div>';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model2.':</b> '.$speed2.' km/h</div>';
							echo '</div>';
						}
						elseif($speed1 < $speed2) {
							echo '<div class="row">';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model1.':</b> '.$speed1.' km/h</div>';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model2.':</b> '.$speed2.' km/h</div>';
							echo '</div>';
						}
						else {
							echo '<div class="row">';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model1.':</b> '.$speed1.' km/h</div>';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model2.':</b> '.$speed2.' km/h</div>';
							echo '</div>';
						}
						
						echo '<div class="alert alert-info">';
						echo '<h3>Zasięg</h3>';
						echo '<p>Zasięg zależy od ustawień silnika. Poniżej podany został przybliżony zasięg bez dodatkowych zbiorników z paliwem.</p>';
						echo '</div>';
						if($range1 > $range2) {
							echo '<div class="row">';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model1.':</b> '.$range1.' km</div>';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model2.':</b> '.$range2.' km</div>';
							echo '</div>';
						}
						elseif($range1 < $range2) {
							echo '<div class="row">';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model1.':</b> '.$range1.' km</div>';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model2.':</b> '.$range2.' km</div>';
							echo '</div>';
						}
						else {
							echo '<div class="row">';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model1.':</b> '.$range1.' km</div>';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model2.':</b> '.$range2.' km</div>';
							echo '</div>';
						}
						
						echo '<div class="alert alert-info">';
						echo '<h3>Pułap</h3>';
						echo '<p>Pułap to najwyższa wysokość, na której dany samolot może operować.</p>';
						echo '</div>';
						if($ceiling1 > $ceiling2) {
							echo '<div class="row">';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model1.':</b> '.$ceiling1.' m</div>';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model2.':</b> '.$ceiling2.' m</div>';
							echo '</div>';
						}
						elseif($ceiling1 < $ceiling2) {
							echo '<div class="row">';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model1.':</b> '.$ceiling1.' m</div>';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model2.':</b> '.$ceiling2.' m</div>';
							echo '</div>';
						}
						else {
							echo '<div class="row">';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model1.':</b> '.$ceiling1.' m</div>';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model2.':</b> '.$ceiling2.' m</div>';
							echo '</div>';
						}
						
						echo '<div class="alert alert-info">';
						echo '<h3>Wznoszenie</h3>';
						echo '<p>Wznoszenie samolotu zależy od wysokości.
						Poniższe dane obrazują najlepsze wznoszenie dla danego myśliwca na optymalnym pułapie.</p>';
						echo '</div>';
						if($climb1 > $climb2) {
							echo '<div class="row">';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model1.':</b> '.$climb1.' m/min</div>';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model2.':</b> '.$climb2.' m/min</div>';
							echo '</div>';
						}
						elseif($climb1 < $climb2) {
							echo '<div class="row">';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model1.':</b> '.$climb1.' m/min</div>';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model2.':</b> '.$climb2.' m/min</div>';
							echo '</div>';
						}
						else {
							echo '<div class="row">';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model1.':</b> '.$climb1.' m/min</div>';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model2.':</b> '.$climb2.' m/min</div>';
							echo '</div>';
						}
						
						echo '<div class="alert alert-info">';
						echo '<h3>Obciążenie powierzchni nośnej</h3>';
						echo '<p>Obciążenie powierzchni nośnej to stosunek masy samolotu do powierzchni jego skrzydeł. 
						Małe obciążenie pozwala myśliwcowi wystartować przy mniejszej prędkości, 
						a często też zataczać ostrzejsze skręty, choć nie jest to zasada, bo zwrotność zależy od prędkości oraz umiejętności pilota.</p>';
						echo '</div>';
						if($wing_loading1 < $wing_loading2) {
							echo '<div class="row">';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model1.':</b> '.$wing_loading1.' kg/m<sup>2</sup></div>';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model2.':</b> '.$wing_loading2.' kg/m<sup>2</sup></div>';
							echo '</div>';
						}
						elseif($wing_loading1 > $wing_loading2) {
							echo '<div class="row">';
							echo '<div class="alert alert-danger col-sm-6"><b>'.$model1.':</b> '.$wing_loading1.' kg/m<sup>2</sup></div>';
							echo '<div class="alert alert-success col-sm-6"><b>'.$model2.':</b> '.$wing_loading2.' kg/m<sup>2</sup></div>';
							echo '</div>';
						}
						else {
							echo '<div class="row">';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model1.':</b> '.$wing_loading1.' kg/m<sup>2</sup></div>';
							echo '<div class="alert alert-warning col-sm-6"><b>'.$model2.':</b> '.$wing_loading2.' kg/m<sup>2</sup></div>';
							echo '</div>';
						}
					}
				?>
			</div>
			
		</article>
		
		<div class="container-fluid p-3 footer">
			<a href="bibliografia.html">Bibliografia</a>
			<p>&#169; Michał Rybicki 2024</p>
		</div>
	</body>
</html>