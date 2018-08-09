<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="" placeholder="00:00:00">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<div>
			<label for="available">Disponible</label>
			<SELECT name="available"><option value="Oui">Oui</option><option value="Non">Non</option></SELECT>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<?php
	$pdo = new PDO('mysql:host=localhost;dbname=reunion_island','root','toor',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	$request="INSERT INTO hiking (name,difficulty,distance,duration,height_difference,available) VALUES (:name,:difficulty,:distance,:duration,:height_difference,:available)";

	$idk=$pdo->prepare($request) ;

	if(!empty($_POST["name"]) && !empty($_POST["distance"]) && !empty($_POST["duration"]) && !empty($_POST["height_difference"])){
		try {
			$idk->execute(array(
				'name'=>htmlspecialchars($_POST['name']),
				'difficulty'=>htmlspecialchars($_POST['difficulty']),
				'distance'=>htmlspecialchars($_POST['distance']),
				'duration'=>htmlspecialchars($_POST['duration']),
				'height_difference'=>htmlspecialchars($_POST['height_difference']),
				'available'=>htmlspecialchars($_POST['available'])));
			echo "Vous avez bien ajouté votre demande !<br>";
		}catch(PDOException $e){
			echo "Erreur : ".$e->getMessage()."<br>";
			echo "Vos informations n'ont pas été envoyées dû à une erreur.";
			die();
		}finally {
			$pdo=null;
		}
	}
	?>
</body>
</html>
