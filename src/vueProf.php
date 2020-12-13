<?php
session_start(); 


if (!$_SESSION['professeurLogedIn']) {
  header('location: ../index.php');
}

$username_prof="";
$username_prof=$_SESSION['pUsername'];

?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>Bienvennue</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    	<link
	    rel="stylesheet"
	    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
	  />
		<link href="../assets/styles/prof.css" rel="stylesheet" type="text/css" />

		<script src="https://cdn.jsdelivr.net/npm/easyqrcodejs@4.0.0/src/easy.qrcode.js" type="text/javascript" charset="utf-8"></script>


	</head>

	<body>
		<div id="body">
			<a id="decon" href="../index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Déconnexion</a>
 			<h1>Veuillez selectionner la matière et la classe</h1>
			<div class="select">
  				<select name="slct" id="slct">
				   
  				</select>
			</div>
		</div>

		<div id="mainFunctions" >
		<div class="cover-container d-flex h-100 p-5 flex-column mx-auto" >
			<nav>
				 
				<div class="nav nav-tabs d-flex bd-highlight" id="nav-tab" role="tablist">
			    	<a class="nav-link active" id="nav-seance-tab" data-toggle="tab" href="#nav-seance" role="tab" aria-controls="nav-seance" aria-selected="true"><h5>Nouvelle séance</h5></a>
			    	<a class="nav-link" id="nav-precedente-tab" data-toggle="tab" href="#nav-precedente" role="tab" aria-controls="nav-precedente" aria-selected="false"><h5>Séances précedentes</h5></a>
			    	<a class="nav-link" id="nav-recap-tab" data-toggle="tab" href="#nav-recap" role="tab" aria-controls="nav-recap" aria-selected="false"><h5>Table récapulative</h5></a>
			   
				    <button id="fermer" type="button" class="close ml-auto p-2 bd-highlight" aria-label="Close">
					  <span id="cross" aria-hidden="true" class="mx-auto w-100 h-100">&times;</span>
					</button>
			    
			    </div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
			  <div  class="tab-pane fade show active" id="nav-seance" role="tabpanel" aria-labelledby="nav-seance-tab">
			  	<div class="d-flex-row">
			  		<div ><button id="generation" class="btn btn-primary mt-2">Créer le QrCode de la séance</button></div>
			  		<div class="mt-2 mb-2"><button type="button" class="btn btn-danger" id="cancel" >Annuler la séance</button></div>
					<div class="qr pl-3" id="qrcode"></div><br>
				</div>

				<div id="listePresence" >


					<p class="mb-2 mt-2 ml-4"><h6>Vérifier la liste et&nbsp;&nbsp;&nbsp; <button id="confirmerListe" class="btn btn-outline-success">Confirmer</button></h6></p>
					<div id="tb" class="liste ml-4 mt-4" >
						<table id="example" class="table table-striped table-bordered mt-2" >
        					<thead>
            					<tr >
            						<th data-searchable= false>username_etd</th>
                					<th>Nom</th>
					                <th>Prénom</th>
					                <th>Coeficient de précision</th>
					                <th data-sortable="false">Supprimer</th>					                
							    </tr>
							</thead>
							<tbody >
							</tbody>
						</table>
					</div>
					<div class="form-inline pl-3 pt-3" >
							<input type="text" id="nom_etd" name="nom_etd" placeholder="Nom" class="form-control">
							<input type="text" id="prenom_etd" name="prenom_etd" placeholder="Prénom" class="form-control ml-3">
							<button id="add_std" class="btn"><img src="../assets/pictures/plus.png"></button>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="nav-precedente" role="tabpanel" aria-labelledby="nav-precedente-tab">
			  	<div id="dt" class="mx-auto mt-4">
				  <div id="dtdiv" >
				    <label for="bday"><h5>Veuillez saisir la date de la séance :</h5></label>
				    <input type="date" id="dateSeance" name="dateSeance" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				    <button id="getStudentsByDate" class="btn btn-success ml-2" >Envoyer</button>
				  </div>
				</div>

				<div id="listeByDateDiv" class="mx-auto mt-3">
				  	<table id="listeByDate" class="table table-striped table-bordered mx-auto">
	        			<thead>
	            			<tr>
	                			<th>Nom</th>
						        <th>Prénom</th>   
							</tr>
						</thead>
						<tbody>
						</tbody>
					
					</table>
			  </div>

			</div>
			  <div class="tab-pane fade" id="nav-recap" role="tabpanel" aria-labelledby="nav-recap-tab">
			  	<div id="listeRecapulativeDiv" class="mx-auto mt-4">
				  	<table id="listeRecapulative" class="table table-striped table-bordered mx-auto">
	        			<thead>
	            			<tr>
	                			<th>Nom Prénom</th>
						        <th>Nombre de séances assistées</th>
						        <th>Pourcentage</th>
						                
							</tr>
						</thead>
						<tbody>
						</tbody>
					
					</table>
			    </div>
			 </div>
		</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	</body>
</html>
<script type="text/javascript">var username_prof="<?= $username_prof?>"</script>
<script src="../assets/scripts/prof.js" type="text/javascript" charset="utf-8"></script>
