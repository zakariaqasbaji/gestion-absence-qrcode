<?php 


include '../db.php';
$db=bdd();


$prepare=$db->prepare('INSERT IGNORE INTO seance VALUES(?,?,?,?,?) ');
$query=$prepare->execute(array($_POST['qrcode'],date("Y/m/d"),$_POST['nom_matiere'],$_POST['username_prof'],$_POST['nom_classe']));

