<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include ('../traitementA/fonctions.php');
$classes = fetchAllClasses();

if (count($_POST)) {
	if (isset($_POST['profSubmit'])){
		header('location: V_adminProfs.php');
	}
	if (isset($_POST['classeSubmit'])){
		header('location: V_adminClasses.php');
	}
}
?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>chercher classe</title>

	<!--  fonts  -->
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!--  styles -->
	<link href="../../assets/styles/sb-admin-2.min.css" rel="stylesheet">

	<!-- styles  pour la table-->
	<link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<?php include("includes/slidebar.php") ?>
		<!-- fin Topbar -->

		<!-- debut de  Contenu -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-2 text-gray-800">CLASSE</h1>
			<br>
			<br>
		

			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">tableau des classes</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
							<thead class="thead-dark">
								<tr>
									<th>Nom</th>
									<th>Classe/prof</th>
									
								</tr>
							</thead>
							<tfoot  class="thead-dark">
								<tr>
									<th>Nom</th>
									<th>Classe/Prof</th>
									
								</tr>
							</tfoot> 
							
							<tbody>
								<?php foreach($classes as $classe) : ?>
									<tr>
										<td class="table-light"   style=""><a href=""><?=$classe['nom_classe']?></a></td>
										<td colspan="5">
											<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" colspan="5">
												<caption> Nombre d'étudiants : <?=$classe['nb_eleves']?></caption>
												<tr >
													<th class="table-secondary">Matières</th>
													<?php $matieres = fetchMatiereParClasse($classe['nom_classe']); 
													foreach($matieres as $matiere) : ?>
														<td><?=$matiere['nom_matiere']?></td>
													<?php endforeach ?>
												</tr>
												<tr>
													<th class="">Professeurs</th>
													<?php foreach($matieres as $matiere) : ?>
														<td><?=fetchProfesseurs($matiere['nom_matiere'], $classe['nom_classe'])[0]?></td>
													<?php endforeach ?>
												</tr>
											</table>
										</td>
									</tr>
								<?php endforeach ?>


								
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- fin Contenu -->

	<!-- Footer -->
		<?php include('includes/footer.php') ?>;
	<!-- End of Footer -->

</div>
<!-- fin Wrapper -->

</div>
<!--  fin Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php include('includes/lougout_modal.php') ?>;

<!-- Bootstrap core JavaScript-->
<?php include("includes/includes.php")?>

</body>

</html>
