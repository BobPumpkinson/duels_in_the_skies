<?php
	include 'autoryzacja.php';
		
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
	or die('Błąd połączenia z serwerem: ' . mysqli_error($conn));

	mysqli_query($conn, 'SET NAMES utf8');
		
	
	session_start();

	if(isset($_POST['user']) and isset($_POST['pass'])) {
		$result = mysqli_query($conn, "SELECT * FROM login;")
		or die("Błąd w zapytaniu do bazy");

		$row = mysqli_fetch_array($result);
		if($_POST['user'] == $row['username'] and $_POST['pass'] == $row['password']) {
			$_SESSION['loggedIn'] = true;
			header("Location: modyfikacja.php");
			exit;
		}
		else {
			header("Location: login.html");
			exit;
		}
	}
	else {
		header("Location: login.html");
		exit;
	}
?>