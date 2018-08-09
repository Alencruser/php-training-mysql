<?php
$pdo = new PDO('mysql:host=localhost;dbname=reunion_island','root','toor');
$pdo->query("DELETE FROM hiking WHERE id='".$_POST["id"]."'");
header('location:read.php');
?>