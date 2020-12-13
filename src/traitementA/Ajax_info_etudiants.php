<?php 
session_start(); 
include ("../functions/db.php");
$bdd=bdd();
extract($_POST);
$connexion=$bdd->prepare("SELECT * FROM etudiant WHERE username_etd=? ");
$connexion->execute([$modif_id]);
$connexions=$connexion->fetch();
$list=$bdd->prepare(" SELECT nom_classe FROM classe WHERE anne = (select anne from classe  where nom_classe=?)  order by nom_classe");
$list->execute([$connexions["nom_classe"]]);



$nom=[];
while ($class = $list->fetch()){


	$nom[]=$class["nom_classe"];

}


$reponse=array("username"=>$connexions["username_etd"],
	"email"=>$connexions["email_etd"],
	"mdp"=>$connexions["mdp_etd"],
	"nom"=>$connexions['nom_etd'],
	"prenom"=>$connexions['prenom_etd'],
	"nom_classe2"=>$connexions['nom_classe'],
	
	"nom_classe"=>$nom,

);

echo json_encode($reponse);




?>