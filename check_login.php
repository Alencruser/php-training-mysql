<?php
session_start();
require "logsql.php";
try {
	if(isset($_POST["username"]) && isset($_POST["password"])){
foreach($pdo->query("SELECT password FROM users WHERE login = '".htmlspecialchars($_POST["username"])."'") as $v){
	if($v["password"]==htmlspecialchars($_POST["password"])){
		$_SESSION["login"]="blbl";
		header('location:read.php');
	}else {
		header('location:login.php');
	}
}}
}catch(PDOException $e){
	echo "Erreur : ".$e->getMessage();
}