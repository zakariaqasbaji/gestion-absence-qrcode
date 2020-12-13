	<?php
	
	include ("../functions/db.php");
	$bdd=bdd();
	if(isset($_POST['changeEtud']) and !empty($_POST['changeEtud'])){
		$id= (int) $_POST['changeEtud'];
		
		$connexion=$bdd->prepare("SELECT nom_classe FROM classe WHERE anne=? ");
		$connexion->execute([$id]);
		
		while( $connexions=$connexion->fetch()){
			echo '<option value='.$connexions['nom_classe'].'>'.$connexions["nom_classe"].'</option> ';
			
		}
	}
	

	
	else{
		echo '<h1> '.$_POST['changeEtud'].' </h1>';}
		?>