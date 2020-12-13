<?php
function bdConnexion(){
 	try {
	     $bdd=new PDO('mysql:host=localhost;dbname=qrcode3;charset=utf8','root','');
	     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $pe) {
    	echo "hold up";
    	die('ERREUR:'.$pe->getMessage() );
    }
 	return $bdd ;
}

//Extraire toutes les classes, page V_adminMain
function fetchAllClasses(){
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT * FROM classe');
    $query = $prepare->execute();
    $final = $prepare->fetchAll();
    return $final;
}

function fetchNomAllClasses(){
//Extraire le nom des classes, page V_adminClasses

	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT nom_classe FROM classe');
    $query = $prepare->execute();
    $final = $prepare->fetchAll(PDO::FETCH_COLUMN);
    return $final;

}


function fetchMatiereParClasse($nom_classe){
//Extraire les matières d'une classe donnée, page V_adminMain
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT nom_matiere FROM matiere NATURAL JOIN prof_matiere_classe NATURAL JOIN classe WHERE nom_classe = ?');
	$query = $prepare->execute([$nom_classe]);
	$final = $prepare->fetchAll();
	return $final;
}


function fetchProfesseurs($nom_matiere, $nom_classe){
//Extraire les professeurs d'une matière et classe données, page V_adminMain
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT username_prof, nom_prof, prenom_prof FROM professeur NATURAL JOIN prof_matiere_classe WHERE (nom_matiere = ? AND nom_classe = ?)');
	$query = $prepare->execute([$nom_matiere, $nom_classe]);
	$final = $prepare->fetch();
	return $final;
}


function fetchAllProfesseurs(){
//Extraire tous les champs de tous les professeurs, page V_adminProfs
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT * FROM professeur');
    $query = $prepare->execute();
    $final = $prepare->fetchAll();
    return $final;
}


function fetchAllProfesseurs2(){
//Extraire usernames, noms et prenoms de tous les professeurs, page V_adminClasses
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT username_prof, nom_prof, prenom_prof FROM professeur');
    $query = $prepare->execute();
    $final = $prepare->fetchAll(PDO::FETCH_NUM);
    return $final;
}


function fetchMatiereParProf($username_prof){
//Extraire les matières enseignés par un professeur donné, page V_adminProfs
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT DISTINCT nom_matiere FROM prof_matiere_classe WHERE username_prof = ?');
	$query = $prepare->execute([$username_prof]);
	$final = $prepare->fetchAll();
	return $final;

}

 
function fetchAllMatieres(){
//Extraire les intitilés de toutes les matières, page V_adminClasses
	$bd = bdConnexion();
	$prepare = $bd->prepare('SELECT nom_matiere FROM matiere');
	$query = $prepare->execute();
	$final = $prepare->fetchAll(PDO::FETCH_NUM);
	return $final;
}


function insertMatieres($nom){
//Inserer de nouvelles matières, page V_adminClasses
	$bd = bdConnexion();
	try{
		$prepare = $bd->prepare('INSERT INTO matiere VALUES ( ? )');
		$prepare->execute([$nom]);
	}
	catch(PDOException $pe){
		die('ERREUR:'.$pe->getMessage());
	}
}


function insertClasses($nom, $nombre_etudiants){
//Inserser de nouvelles classes, page V_adminClasses
	$bd = bdConnexion();
	try {
		$prepare = $bd->prepare('INSERT INTO classe VALUES (?, ?)');
		$insertion = $prepare->execute([$nom, $nombre_etudiants]);
		return $insertion;

	}catch(PDOException $e){
		die('ERREUR:'.$e->getMessage());
	}
}


function insertProfMatiereClasse($prof, $matiere, $classe){
//Inserer dans la table prof_matiere_classe, page V_adminClasses

	$bd = bdConnexion();
	
	try {
		$prepare = $bd->prepare('INSERT INTO prof_matiere_classe VALUES (?, ?, ?)');
		$prepare->execute([$prof, $matiere, $classe]);

	}catch(PDOException $e) {
		die('ERREUR:'.$e->getMessage());
	}
}

		


function integrityViolation($prof, $matiere, $classe){
//Fonction utlisée avant l'insertion dans prof_matiere_classe pour verifier la duplicata, V_adminClasses.php
	$bd = bdConnexion();
	$prepare0 = $bd->prepare('SELECT * FROM prof_matiere_classe WHERE username_prof = ? AND nom_matiere = ? AND nom_classe = ? ');
	$prepare0->execute([$prof, $matiere, $classe]);
	
	if($prepare0->fetchColumn() == False){

		return True;
	}
	else {
		
		return False;
	}
	
}

function deleteClasse($classe){
//Supression de classes, V_adminClasses.php et V_adminMain.php

	$bd = bdConnexion();
	
	try {
		$prepare = $bd->prepare('DELETE FROM classe WHERE nom_classe = ?');
		$prepare->execute([$classe]);

	}catch(PDOException $e) {
		die('ERREUR:'.$e->getMessage());
	}
}

?>