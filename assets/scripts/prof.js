var nom_classe='';
var nom_matiere='';
var longitude='';
var latitude='';
var getStudents=-1;
var selectMC=document.getElementById('body');
var mainFunctions=document.getElementById('mainFunctions');
var fermer=document.getElementById('fermer');
var slct=document.getElementById('slct');
var listePresenceTable=$('#example').DataTable();
var listeRecapulativeTable=$('#listeRecapulative').DataTable();
var listeByDateTable=$('#listeByDate').DataTable();
var generation=document.getElementById("generation");
var qrcodeImg= document.getElementById("qrcode");
var cancel=document.getElementById("cancel");
var listePresence=document.getElementById("listePresence");
var add_std= document.getElementById("add_std");
var recapList= document.getElementById("nav-recap-tab");
var getStudentsByDateButton=document.getElementById("getStudentsByDate");


$.ajax({
						url:'traitementP/getMatieresClasses.php',
						data:{username_prof:username_prof},
						type:'post',
						dataType: 'JSON',
						success:function(res){
							
							var len = res.length;
							var content="<option selected disabled>Choose an option...</option>"
			            for(var i=0; i<len; i++){

			            	content+='<option value="'+res[i].nom_matiere+'$'+res[i].nom_classe+'">'+res[i].nom_matiere+'-'+res[i].nom_classe+'</option>';

			            }

			            slct.innerHTML=content;



			        }});






slct.onchange=function(){ 
    
    selectMC.style.display='none';
    mainFunctions.style.display='block';
    var value = $(this).val();
    var tab=value.split("$");
    nom_classe=tab[1];
    nom_matiere=tab[0];
};

fermer.onclick=function(){ 
    
    location.reload();
};





if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition,function(objErreur) {
        var strErreur = '';
        switch(objErreur.code) {
            case objErreur.PERMISSION_DENIED:
                strErreur = "Vous devez donner la permission de determiner la position.";
                break;
            case objErreur.TIMEOUT:
            case objErreur.POSITION_UNAVAILABLE:
                strErreur = "Votre position n'a pas pu être déterminée."
                break;
            default:
                strErreur = "Erreur inconnue."
                break;
        };
        alert(strErreur);
    });
  } else {
   alert("Geolocation is not supported by this browser.");
  }


  function showPosition(position) {
  latitude=position.coords.latitude;
  longitude=position.coords.longitude;
}


listePresenceTable.column(0).visible(false);



$(document).ready(function() {
		    listePresenceTable;
			} );

			$(document).ready(function() {
		    listeRecapulativeTable;
			} );

			$(document).ready(function() {
		    listeByDateTable;
			});

function getListe(){

	


	$.ajax({
						url:'traitementP/ListePresence.php',
						data:{qrcode:qrtext},
						type:'post',
						dataType: 'JSON',
						success:function(res){
							
							var len = res.length;
							listePresenceTable.clear().draw();
			            for(var i=0; i<len; i++){
			            	var username_etd=res[i].username_etd;
			                var nom_etd = res[i].nom_etd;
			                var prenom_etd = res[i].prenom_etd;
			                var coef;
			                if (res[i].latitude_etd!='' && res[i].longitude_etd!='' && longitude!='' && latitude!='') {

			                	if(res[i].latitude_etd=='FROM_PROF' && res[i].longitude_etd=='FROM_PROF' ){
			                			coef=1;
			                	}else{
			                coef=1-1000*Math.sqrt((latitude-res[i].latitude_etd)*(latitude-res[i].latitude_etd)+(longitude-res[i].longitude_etd)*(longitude-res[i].longitude_etd));
			                
			                if (coef<0) {
			                	coef=0;
			                }
			                }}
			                else{
			                	coef='Géolocalisation désactivée.'
			                }
			                listePresenceTable.row.add( [username_etd,nom_etd, prenom_etd,coef,'<button class="btn del"><img src="../assets/pictures/cross.png"/></button>'
                        
                    ] ).draw(false);

						}
						

					}

					})






}





				generation.onclick = function() {
					qrcodeImg.style.visibility="visible";
					qrtext = Date.now()+username_prof;
					generation.style.display = "none";
					cancel.style.display = "block";
					qrcodeImg.innerHTML='';
					t=new QRCode(qrcodeImg, 
						{
							text: qrtext,

							width: 500,
							height: 500,
							colorDark: "#1f5793",
							colorLight: "#d3cfd2",

							PI: '#1f5793',

							correctLevel: QRCode.CorrectLevel.H, // L, M, Q, H
	                        dotScale: .8,
	                        logo:"../assets/pictures/ensam.png",
	                        logoBackgroundTransparent: true,
	                        version:1

						}
					);
					
					listePresence.style.display = "block";	

					


					 getStudents =setInterval(getListe,2500);



					cancel.onclick = function() {

						if(confirm("Etes-vous sûr(e) de vouloir supprimer la séance?")){
						listePresence.style.display = "none";
					
						alert('Séance annulée');
						qrtext="";
						qrcodeImg.style.visibility="hidden";
						generation.innerHTML = "Créer un nouvel Code";
						generation.style.display = "block";
						cancel.style.display = "none";
						clearInterval(getStudents);
						getStudents=-1;
						

					
					}}




					add_std.onclick = function() {

						if ($('#nom_etd').val() !='' && $('#prenom_etd').val()!='') {

							
							$.ajax({
							url:'traitementP/addStudent.php',
							data:{nom_etd:$('#nom_etd').val(),prenom_etd:$('#prenom_etd').val(),nom_classe:nom_classe,qrcode:qrtext},
							type:'post',
							dataType:'JSON',
							success:function(res){
								if(res=='') alert("Etudiant inexistant!");
								if (res=='[object Object]') {
								listePresenceTable.row.add( [res[0].username_etd,
		                        res[0].nom_etd,
		                        res[0].prenom_etd,'1','<button class="btn del"><img src="../assets/pictures/cross.png"/></button>'
                    ] ).draw(); 

								alert('Etudiant ajouté');

								document.getElementById('nom_etd').value='';
								document.getElementById('prenom_etd').value='';
								}
								else{
									alert("une erreur s'est produite réessayer plus tard...");
								}
							
						},
						error: function() {
					            alert("Désolé, aucun résultat trouvé.");
					        }


					})

					}else{
						alert("Veuillez saisir le nom et le prénom");
					}

					}
				}








				recapList.onclick = function() {


					document.getElementById('nav-seance').style.display='none';
					document.getElementById('nav-precedente').style.display='none';
					document.getElementById('nav-recap').style.display='block';


					$.ajax({
						url:'traitementP/getRecap.php',
						data:{nom_matiere:nom_matiere,nom_classe:nom_classe,username_prof:username_prof},
						dataType: 'JSON',
						type:'post',

						success:function(res){
							listeRecapulativeTable.clear().draw();
							var len = res.length;
				            for(var i=0; i<len; i++){
				                var nom_etd = res[i].nom_etd;
				                var prenom_etd = res[i].prenom_etd;
				                var nb = res[i].nb;
				                var score = res[i].score;

				               listeRecapulativeTable.row.add( [nom_etd +" "+prenom_etd,nb,score] ).draw( false );

							}
						}
						
					})

				}

getStudentsByDateButton.onclick = function() {

					if($('#dateSeance').val()==""){
						alert("Veuillez saisir la date!")
					}else{


					$.ajax({
						url:'traitementP/getStudentsByDate.php',
						data:{dateSeance:$('#dateSeance').val(),nom_matiere:nom_matiere,nom_classe:nom_classe,username_prof: username_prof},

						dataType: 'JSON',						
						type:'post',

						success:function(res){
							listeByDateTable.clear().draw();
							var len = res.length;
				            for(var i=0; i<len; i++){
				                var nom_etd = res[i].nom_etd;
				                var prenom_etd = res[i].prenom_etd;
				                listeByDateTable.row.add( [nom_etd,prenom_etd] ).draw( false );

							}
						}
						
					})
				}

				}








				document.getElementById('confirmerListe').onclick=function(){

						clearInterval(getStudents);
						getStudents=-1;
						
						var form_data = listePresenceTable.rows().data();

						

						$.ajax({
						url:'traitementP/confirmerListe.php',
						data:'dataTable='+JSON.stringify(form_data)+'&qrcode='+qrtext,
						type:'post',

						success:function(res){

							alert(res)
							
							if(res=="Liste de présence enregistrée avec succés"){
								listePresenceTable.clear().draw();
							$.ajax({

							url:'traitementP/saveSeance.php',
							data:'nom_matiere='+nom_matiere+'&qrcode='+qrtext+'&nom_classe='+ nom_classe+'&username_prof='+username_prof,
							type:'post',

							
						});
							qrtext="";
							listePresence.style.display = "none";
							qrcodeImg.style.visibility="hidden";
							generation.innerHTML = "Créer un nouvel Code";
							generation.style.display = "block";
							cancel.style.display = "none";

							}

							

							}

						
						
					})





				}






document.getElementById('nav-seance-tab').onclick=function(){


document.getElementById('nav-recap').style.display='none';
document.getElementById('nav-precedente').style.display='none';

document.getElementById('nav-seance').style.display='inline-flex';


}



document.getElementById('nav-precedente-tab').onclick=function(){


document.getElementById('nav-recap').style.display='none';
document.getElementById('nav-seance').style.display='none';
document.getElementById('nav-precedente').style.display='block';

}







		$('#example').on("click", ".del", function () {
		if(confirm("Etes-vous sûr(e) de vouloir supprimer cet étudiant de la liste?")){
			var table = $("#example").DataTable();
			var row=table.row($(this).parents('tr'));
			var u_etd=table.row($(this).parents('tr')).data()[0];
			$.ajax({
							url:'traitementP/removeStudent.php',
							data:{username_etd:u_etd,qrcode:qrtext},
							dataType: 'JSON',
							type:'post',

							success:function(res){
								alert(res)
								row.remove().draw(false);
							}
							
						});

			
		}
		});



