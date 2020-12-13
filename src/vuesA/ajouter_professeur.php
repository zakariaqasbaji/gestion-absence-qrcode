<!DOCTYPE html>
<html lang="en">

<head>

 


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>ajouter professeur</title>

	<!-- fonts -->
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- styles -->
	<link href="../../assets/styles/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<?php include("includes/slidebar.php") ?>


		
	</div>
	<!-- debut de contenu -->
	<div class="container " style="padding: 0px">


		<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!--  Card Prof -->
				<div class="row ">
					<div class="col-lg-5 d-none d-lg-block"  id="card-background" style="background-color: #4e73df;

                    background-image: url('../../assets/pictures/img.png'); 
                      background-position: center;
                      background-repeat: no-repeat;"></div>
					<div class="col-lg-7">
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Creer un compte professeur</h1>
							</div>
							<form class="user " id="insertProf">
								<div class="form-group row">
									<div class="col-sm-12 mb-6 mb-sm-0">
										<input type="text" class="form-control form-control-user" id="prenom" name="prenom" placeholder="prenom">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12 mb-6 mb-sm-0">
										<input type="text" class="form-control form-control-user" id="nom" name="nom"  placeholder="nom" value="">
									</div></div>


									<div class="form-group row">
										<div class="col-sm-12 mb-6 mb-sm-0">
											<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="username" value="">
										</div>

									</div>

									<div class="form-group">
										<input type="email" class="form-control form-control-user " id="email" name="email"  placeholder="email" value="">
									</div>
									<div class="form-group">
										<input type="email" class="form-control form-control-user " id="emailconf" name="emailconf"  placeholder="emailconf" value="">
									</div>
									<hr>
								
							


							<input type="submit" id="button" name="button" class="btn btn-primary btn-user btn-block" value="submit" >

							<hr>
							<a href="ajouter_etudiant" class="btn btn-google btn-user btn-block">
								<i class="fas fa-user-graduate"></i>engister un etudiant
							</a>

						</form>
						<hr>
						<div class="text-center">
							<a class="small" href="">power by ensam </a>
						</div>
						<div class="text-center">
							<a class="small" href="">casa</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- fin:: Main Content -->

<!-- Footer -->
	<?php include('includes/footer.php') ?>;
<!-- fin Footer -->

</div>
<!-- fin Wrapper -->

</div>
<!-- fin: Wrapper -->

<!--  Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php include('includes/lougout_modal.php') ?>;

<?php include("includes/includes.php")?>




</body>

</html>
