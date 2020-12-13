
<?php



function afficher_prof(){
	global $bdd;
	$employe=$bdd->query("SELECT * FROM professeur ORDER BY username_prof DESC");
	$employe=$employe->fetchAll();

	return $employe;


}
function afficher_etudiant(){
	global $bdd;
	$employe=$bdd->query("SELECT * FROM etudiant ORDER BY username_etd DESC ");
	$employe=$employe->fetchAll();

	return $employe;

}
function rechercher_prof(){

	global $bdd;
	extract($_POST);
	if(!empty($rechercher)){

	
	

	$recherche=$bdd->prepare("SELECT * FROM professeur  WHERE username_prof=:cherche OR email_prof=:cherche");
	$recherche->execute(["cherche"=>$rechercher]);
	$recherche=$recherche->fetchAll();
	return $recherche;


}
}

function recherche_etudiant(){



	global $bdd;
	extract($_POST);
	if(empty($rechercher)and $classes==""){
		$etud=$bdd->query("SELECT * FROM etudiant ORDER BY username_etd DESC ");
		$etud=$etud->fetchAll();

		return $etud;
	}

	if($classes!='' and empty($chercher)){
          var_dump($classes);
		$recherche=$bdd->prepare("SELECT * FROM etudiant WHERE nom_classe =:classe");
		$recherche->execute(["classe"=>$classes]);
		$recherche=$recherche->fetchAll();
		return $recherche;
	}
	if(!empty($rechercher)){

		$recherche=$bdd->prepare("SELECT * FROM etudiant WHERE username_etud=:cherche OR email=:cherche");
		$recherche->execute(["cherche"=>$rechercher]);
		$recherche=$recherche->fetchAll();
		return $recherche;

	}



}