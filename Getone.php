<?php 
require 'config.php'; 
$query = $bdd->query("SELECT * FROM tweets ORDER BY id DESC LIMIT 1;");
$task = $query->fetch(PDO::FETCH_ASSOC);
echo json_encode($task); 
?>