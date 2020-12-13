<!DOCTYPE html>
<html lang="en">
<?php 
session_start();?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>index</title>

	<!--  fonts -->
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/styles/style2.css">

	<!-- styles -->
	<link href="../../assets/styles/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar && topbar-->
		<?php include("includes/slidebar.php") ?>




		




		<!-- le debut de page -->
		<header class="bg text-white padding-150" id="home">
    <div class="container h-100">

        <!-- 
            1. : présentation
            
        -->
        <div class="row" id="start">

            <div class="col-md-7">
                <h1>New Age is an app landing page that will help you beautifully showcase your new mobile app, or anything else!</h1>
                <br>
                <a href="#download" class="btn btn-outline-warning btn-lg">Learn More >></a>
            </div>

            <div class="col-md-5 my-auto">
                    <div class="device-container">
                    <div class="iphone-mockup white">
                        <div class="device">
                            <div class="screen">
                                <img src="../../assets/pictures/img.png" class="img-fluid" alt=""> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

        </div>
        <!-- fin de ligne-->
    </div>

</header>

		<section id="services" class="bg-cloud text-dark" >
		
				
			<div class="container  text-center">

				<h2 class="font-60" style="color:rgba(51,90,228,1) ">Services</h2>

				<hr><br>

				<div class="row">
					<div class="col-sm-4">
						<div class="card" style="width: 100%;">

							<img
							src="../../assets/pictures/img.png"
							class="card-img-top"
							alt="..."
							/>
                         <!--    card-prof -->
							<div class="card-body">
								<h5 class="card-title">PROFESSEUR</h5>
								<p class="card-text">Some quick example text to build on the card title and .</p>
								<br>
								<a href="ajouter_professeur.php"  name="edit" value="modifier" class="btn btn-primary modifier"  style="margin-bottom: 3px">ajouter</a>
								<a href="modifier_professeur.php" class="btn btn-primary modifier"  >modifier</a>

							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="card" style="width: 100%;">

							<img
							src="../../assets/pictures/img.png"
							class="card-img-top"
							alt="..."
							/>
							<!-- card-etudiant -->
							<div class="card-body">
								<h5 class="card-title">ETUDIANT</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
											<a href="ajouter_etudiant.php" class="btn btn-primary modifier" id="hassan"   >ajouter</a>
								<a href="modifier_etudiant" class="btn btn-primary">modifier</a>
							</div>
						</div>

					</div>

					<div class="col-sm-4">
						<div class="card" style="width: 100%;">

							<img
							src="../../assets/pictures/img.png"
							class="card-img-top"
							alt="..."
							/>
							<!-- card-classe -->
							<div class="card-body">
								<h5 class="card-title">CLASSE</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="chercher_classes.php" class="btn btn-primary ">chercher</a>
								<a href="ajouter_classe.php" class="btn btn-primary">ajouter</a>
							</div>
						</div>
					</div>


				</div>
			</div>

		</section>

		<!-- Footer -->
		<?php include('includes/footer.php') ?>;
		<!-- fin Footer -->

	</div>
	

</div>

<!--fin Wrapper -->


<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!--  scripts pour tous les pages-->
<script src="../../js/sb-admin-2.min.js"></script>
<script src="../../js/allScripts.js"></script>



<?php include("includes/lougout_modal.php")?>


</body>

</html>
