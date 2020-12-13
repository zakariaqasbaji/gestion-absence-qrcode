<!DOCTYPE html>
<html lang="en">
<?php
/*
-Il est impossible d'ajouter une classe dèja éxistante
-Il est impossible d'ajouter une matière dèja éxistante avec le même professeur: si ça arrive, le processus d'insertion ne s'arrete pas, l'enregistrement en question est simplement ignoré, et l'admin en est averti par un message.
-Ajouter une matière deux fois pour des professeurs differents n'est pas encore discutée, mais permit jusqu'à présent.
 */
include '../traitementA/fonctions.php';
session_start();
if (isset($_SESSION['resultatInsertionClasse'])){
//Utilisation des sessions pour afficher les messages de succèe/échec, cette variable est initialisée lors du traitement de l'insertion

	echo $_SESSION['resultatInsertionClasse'];
	unset($_SESSION['resultatInsertionClasse']);

}

if (isset($_SESSION['warningInsertionClasse'])){
//Utilisation des sessions pour afficher le message d'avertissement en cas d'ajout de la même matière avec le même professeur, cette variable est initialisée lors du traitement de l'insertion

	echo $_SESSION['warningInsertionClasse'];
	unset($_SESSION['warningInsertionClasse']);

}


$matieres = fetchAllMatieres(); //Utilisée comme options du select du choix des matières
$professeurs = fetchAllProfesseurs2(); //Utilisée comme options du select du choix du professeur des matières
$classes = fetchNomAllClasses(); //Utilisée pour s'assurer que le nom de classe à ajouter n'éxiste pas dèja dans la base de donnée 



if (count($_POST)) {
	$data = $_POST; 

  $violation = False; //variable booléenne qui indique si, au cours des insertions des prof_matiere_classe, un enregistrement est répété plusieurs fois
  $nombreInsertions = 0; //variable qui compte le nombre d'insertions reussis (table prof_matiere_classe)

  if (insertClasses($data['intituleName'], $data['nbEtudiantsName'])){
  //inserer dans la table classe

  	for ($i = 1; $i <= $data['nombreMatieresName']; $i++){
    //Parcourir les champs remplis par l'admin

  		if (($data['matiereSelectName' . intval($i)]=="Autre...") AND (!empty($data['matiereInputName' . intval($i)]))){
      //Si l'admin choisit l'option "Autre" et décide d'écrire le nom d'une nouvelle matière

  			if (integrityViolation($data['profSelectName' . intval($i)], $data['matiereInputName' . intval($i)], $data['intituleName']) == 1){
        //Si l'enregistrement n'existe pas dèja dans la base de données, effectuer l'insertion

  				insertMatieres($data['matiereInputName' . intval($i)]);
  				insertProfMatiereClasse($data['profSelectName' . intval($i)], $data['matiereInputName' . intval($i)], $data['intituleName']); 
  				$nombreInsertions++;
  			}

  			else {
        //Si l'enregistrement existe dèja dans la base de donnée, la variable violation2 prend la valeur True

  				$violation = True;
  				
  			}
  		}

  		else if (($data['matiereSelectName' . intval($i)]!="Autre...") AND (empty($data['matiereInputName' . intval($i)]))) {
      //Si l'admin choisit une matière parmi celles dèja éxistantes dans la base de données et proposées dans les options du select

  			if (integrityViolation($data['profSelectName' . intval($i)], $data['matiereSelectName' . intval($i)], $data['intituleName']) == 1){
        //Si l'enregistrement n'existe pas dèja dans la base de données, effectuer l'insertion

  				insertProfMatiereClasse($data['profSelectName' . intval($i)], $data['matiereSelectName' . intval($i)], $data['intituleName']);
  				$nombreInsertions++;
  			}
  			else {
        //Si l'enregistrement existe dèja dans la base de donnée, la variable violation2 prend la valeur True

  				$violation = True;
  			}
  		}

  		else {
      //Si l'admin ne précise pas le nom d'une matière (choisit l'option Autre et n'écris pas le nom)

  			$violation = True;
  		}
  	}
  }

  if ($nombreInsertions > 0) {
  //Si le nombre d'insertions réussies est supérieur à 0, afficher une message de succès

  	$_SESSION['resultatInsertionClasse'] = "Succès, classe ajoutée avec " . $nombreInsertions . " matière(s).";

  }

  else {
  //Si le nombre d'insertions de matieres résussies est nul, afficher un message d'erreur et supprimer la classe de la base de donnée (pour ne pas avoir de classe vide de matières)
  	
  	deleteClasse($data['intituleName']);
  	$_SESSION['resultatInsertionClasse'] = "Classe non insérée.";

  }
  
  if ($violation) {
  //Si une insertion à échouer à cause d'une duplication ou laisse un champ vide, l'admin est averti

  	
  	$_SESSION['warningInsertionClasse'] = "Attention, vous avez commis une ou plusieurs erreurs au remplissage. Pour consulter les actions interdites, cliquez içi.";

  }
  
  header("Refresh:0");

}

?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Ajouter classe</title>

	<!-- fonts -->
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- styles -->
	<link href="../../assets/styles/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<?php include("includes/slidebar.php");?>

		<!-- debut de contenu -->
		<div class="container-fluid ">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800">CLASSE</h1>

			<div class="row justify-content-center ">

				<div class="col-lg-8 ">


				
					<div class="card shadow mb-4">



						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Classe</h6>
						</div>
						<div class="card-body">
							<form id="formId" method="POST" class="user " >
								<fieldset>
									<legend>Nouvelle classe</legend>
									<label>Intitulé de la classe</label>
									<div class="form-group row">
										<div class="col-sm-9 mb-6 mb-sm-0">
											<input type="text" id="intituleId" name="intituleName" class="form-control ">
										</div>
									</div>
									<label>Nombre d'étudiants</label>
									<div class="form-group row">
										<div class="col-sm-9 mb-6 mb-sm-0"><input type="text" id="nbEtudiantsId" name="nbEtudiantsName" class="form-control "> </div>
									</div>
									<input type="hidden" id="nombreMatieresId" name="nombreMatieresName">
								</fieldset>
							</form>

							
							<button id="suivant" onclick="suivant()"class="btn btn-primary">Suivant</button>

							
							<button class="btn btn-primary" id="ajouter" onclick="ajouter()" style="visibility: hidden">ajouter des matieres</button>
							
							<button  class="btn btn-primary" id="retirer" onclick="retirer()" style="visibility: hidden">supprimer une matiere</button>
							<br><br>
							<button  class="btn btn-danger " id="valider" onclick="valider()" style="visibility: hidden">  <i class="fas fa-check"></i></button>
							<button  class="btn btn-success" id="annuler" onclick="annuler()" style="visibility: hidden">  <i class="fas fa-trash"></i></button>

							
						</div>
					</div>

					
				</div>
			</div>

			<!-- /.container-fluid -->

		</div>
	</div>
	<!-- fin Contenu -->

	<!-- Footer -->
  <?php include('includes/footer.php') ?>;
	<!-- fin Footer -->

</div>
<!-- fin:  Wrapper -->

</div></div>
<!-- fin: Wrapper -->

<!--  Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>


<?php include('includes/lougout_modal.php') ?>;

<?php include('includes/includes.php')?>


<script type="text/javascript">
	var formC = (document.getElementById("formId").children)[0];
	var matiereOptions = <?php echo json_encode($matieres); ?>;
	matiereOptions.push("Autre...");
	var profOptions = <?php echo json_encode($professeurs); ?>;
	var classes = <?php echo json_encode($classes); ?>;
	
      //console.log(formC.children);

      

      
      function creer(){
      //Fonction pour créer le DOM des champs de matières

      var newSelect1 = document.createElement('select');
      var newSelect2 = document.createElement('select');
      var newInput = document.createElement('input');
      var newLabel1 = document.createElement('label');
      var newLabel3 = document.createElement('label');
      var newBr = document.createElement("br");
      newSelect1.classList.add("form-control");
      newSelect2.classList.add("form-control");


      newSelect1.id = "matiereSelectId"+i.toString();
      newSelect1.name = "matiereSelectName"+i.toString();
      newSelect1.number = i;
      newSelect2.id = "profSelectId"+i.toString();
      newSelect1.addEventListener('change', (event) => {
      	if (event.target.value == "Autre...") {
      		document.getElementById("matiereInputId"+(event.target.number).toString()).style.display = "inline";
      	}
      	else {
      		document.getElementById("matiereInputId"+(event.target.number).toString()).style.display = "none";
      	}
      });
      newSelect2.name = "profSelectName"+i.toString();
      newInput.type = "text";
      newInput.placeholder = "Tapez l'intitulé";
      newInput.id = "matiereInputId"+i.toString();
      newInput.name = "matiereInputName"+i.toString();
      newInput.style = "display: none;";
      newLabel1.id = "label1"+i.toString();
      newLabel1.innerHTML = "Matière "+i.toString()+" ";
      newLabel3.id = "label3"+i.toString();
      newLabel3.innerHTML = " Enseignée par : ";

      matiereOptions.forEach(function(element,key) {
      	newSelect1[key] = new Option(element,element);
      });
      profOptions.forEach(function(element,key) {
      	newSelect2[key] = new Option(element.slice(1,3),element[0]);

      });

      formC.appendChild(newLabel1);
      formC.appendChild(newSelect1);
      formC.appendChild(newInput);
      formC.appendChild(newLabel3);
      formC.appendChild(newSelect2);
      formC.appendChild(newBr);

  }


  
  function annuler(){
      //Fontion pour revenir au nom de la classe et nombre d'étudiants

        location.reload(); //ya salam dert lhacki lmalaki bhad lfonction hh

    }


    
    function suivant(){
      //Fonction pour afficher les 12 champs de matières et verifier si les 2 premiers champs on été remplis

      if ((document.getElementById("intituleId").value == "") || (document.getElementById("nbEtudiantsId").value == "")){
      	alert("Veuillez remplire tous les champs avant de procéder");
      }

      else if (!Number.isInteger(Number(document.getElementById("nbEtudiantsId").value))){
      	alert("Nombre d'élèves erroné");

      }

      else if (classes.includes(document.getElementById("intituleId").value)) {
      	alert("Cette classe éxiste dèja");
      }

      else {
      	document.getElementById("intituleId").readOnly = true;
      	document.getElementById("nbEtudiantsId").readOnly = true;

      	for (i = 1; i <= 2; i++) {
      		
      		creer();

      	}

      	document.getElementById("annuler").style.visibility = "visible";          
      	document.getElementById("ajouter").style.visibility = "visible";
      	document.getElementById("retirer").style.visibility = "visible";
      	document.getElementById("valider").style.visibility = "visible";
      	document.getElementById("suivant").remove();

      }
  }



  
  function ajouter(){
      //Fonction pour ajouter un champ de matière de plus, utilise la fonction creer() qui creer le DOM des enregistrements 

      creer();
      i++;

  }
  
  
  function retirer(){
      //Fonction pour retirer un champ de matière

      if (i == 2) {
      	alert("Action impossible");
      }
      else {
      	document.getElementById("matiereSelectId"+(i-1).toString()).remove();
      	document.getElementById("profSelectId"+(i-1).toString()).remove();
      	document.getElementById("matiereInputId"+(i-1).toString()).remove();
      	document.getElementById("label1"+(i-1).toString()).remove();
          document.getElementById("label3"+(i-1).toString()).previousSibling.remove(); //permet de liberer la place pour un autre champs
          document.getElementById("label3"+(i-1).toString()).remove();
          i--;

      }

  }

  
  function valider(){
      //Fonction pour soumettre le formulaire

      document.getElementById("nombreMatieresId").value = i-1;
      document.getElementById("formId").submit();
      
  }


  function retour(){

  	location.replace("V_adminMain.php");

  }

</script>

</body>

</html>
