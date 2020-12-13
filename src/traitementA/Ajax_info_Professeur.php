<?php 
session_start(); 
include ("../functions/db.php");
$bdd=bdd();
extract($_POST);
$connexion=$bdd->prepare("SELECT * FROM professeur WHERE username_prof=? ");
$connexion->execute([$modif_id]);
$connexions=$connexion->fetch();

$reponse=array("username"=>$connexions["username_prof"],
	"email"=>$connexions["email_prof"],
	"mdp"=>$connexions["mdp_prof"],
	"nom"=>$connexions['nom_prof'],
	"prenom"=>$connexions['prenom_prof'],
	

);

echo json_encode($reponse);




?>