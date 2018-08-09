<?php session_start();
if($_SESSION["login"]){
 ?>
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
	<form action="update.php" method="post">
		<div>
			<?php 
			require "logsql.php";
			try {
			foreach($pdo->query("SELECT * FROM hiking WHERE id='".$_POST["id"]."'") as $v){
				?>
				<label for="name">Name</label>
				<input type="text" name="name" value="<?php echo $v['name']; ?>">
			</div>

			<div>
				<label for="difficulty">Difficulté</label>
				<select name="difficulty">
					<option <?php if($v["difficulty"]=="très facile"){?>selected <?php } ?> value="très facile">Très facile</option>
					<option <?php if($v["difficulty"]=="facile"){?> selected <?php } ?> value="facile">Facile</option>
					<option <?php if($v["difficulty"]=="moyen"){?> selected <?php } ?> value="moyen">Moyen</option>
					<option <?php if($v["difficulty"]=="difficile"){?> selected <?php } ?> value="difficile">Difficile</option>
					<option <?php if($v["difficulty"]=="très difficile"){?> selected <?php } ?> value="très difficile">Très difficile</option>
				</select>
			</div>

			<div>
				<label for="distance">Distance</label>
				<input type="text" name="distance" value=<?php echo $v["distance"]; ?>>
			</div>
			<div>
				<label for="duration">Durée</label>
				<input type="duration" name="duration" value=<?php echo $v["duration"]; ?>>
			</div>
			<div>
				<label for="height_difference">Dénivelé</label>
				<input type="text" name="height_difference" value=<?php echo $v["height_difference"]; ?>>
			</div>
			<div>
				<label for="available">Disponible</label>
				<select name="available">
					<option <?php if($v["available"]=="oui"){ ?>selected <?php } ?> value="oui">Oui</option><!-- a finir -->
					<option <?php if($v["available"]=="non"){ ?>selected <?php } ?> value="non">Non</option>
				</select>
			</div>
			<input type="hidden" name="id" value=<?php echo $_POST['id'] ?>>
			<button type="submit" name="button">Envoyer</button>
		</form>
		<?php 
		$pdo=null;
	}}catch(PDOException $e){
		echo "Erreur : ".$e->getMessage();
		die();
	}
		try {
			if(isset($_POST)){
				$pdo = new PDO('mysql:host=localhost;dbname=reunion_island','root','toor',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$pdo->query("UPDATE hiking SET name = '".htmlspecialchars($_POST['name'])."', difficulty = '".htmlspecialchars($_POST['difficulty'])."', distance = '".htmlspecialchars($_POST['distance'])."', duration = '".htmlspecialchars($_POST['duration'])."', height_difference = '".htmlspecialchars($_POST['height_difference'])."', available = '".htmlspecialchars($_POST['available'])."' WHERE id = ".htmlspecialchars($_POST['id'])."");
				$pdo=null;
			}
		}catch(PDOException $e){
			echo "Erreur : ".$e->getMessage();
			die();
		}
		?>
	</body>
	</html>
<?php } else {
	header('location:read.php');
} ?>