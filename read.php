<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Randonnées</title>
  <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
  <h1>Liste des randonnées</h1>
  <table>
    <tr>
      <th>Nom</th>
      <th>Difficulté</th>
      <th>Distance (Km)</th>
      <th>Durée (hh:mm:ss)</th>
      <th>Dénivelé (Mètres)</th>
    </tr>
    <?php 
    try {
      $pdo = new PDO('mysql:host=localhost;dbname=reunion_island','root','toor',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
      foreach($pdo->query('SELECT * FROM hiking') as $v){
        ?> 
        <tr>
          <td>
            <?php 
            echo $v["name"];
            ?>
          </td>
          <td>
            <?php 
            echo $v["difficulty"];
            ?>
          </td>
          <td>
            <?php 
            echo $v["distance"];
            ?>
          </td>
          <td>
            <?php 
            echo $v["duration"];
            ?>
          </td>
          <td>
            <?php 
            echo $v["height_difference"];
            ?>
          </td>
        </tr>
        <?php 
      }
    }catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
  }

  ?>
  <!-- Afficher la liste des randonnées -->
</table>
</body>
</html>
