
$( "#connectStudent" ).click(function() {
	$('#formProf').addClass('hide');
    $('#formStudent').toggleClass('hide');
 
});

$( "#connectProf" ).click(function() {
 	$('#formStudent').addClass('hide');
	$('#formProf').toggleClass('hide');
});





$(document).ready(function(){  
      $("#eSubmit").click(function(){


           if($('#eUsername').val()=='' || $('#eMdp').val()=='')  
           {  
                $('#responseE').html('<p>Tous les champs sont obligatoires!</p>');  
           }  
           else  
           {  
                $.ajax({  
                     url:"src/connect.php",  
                     method:"POST",  
                     data:$('#formStudent').serialize()+'&eSubmit='+$('#eSubmit').prop('checked')+'&eSouvenir='+$('#eSouvenir').prop('checked'),  
                     beforeSend:function(){  
                          $('#responseE').html('<img style="margin-top:5px;width: 40px; height:40px" src="assets/pictures/loading.gif" alt="loading"> ');  
                     },  
                     success:function(data){
                     if (data=="connected") {
                     	window.location.href = "src/vueStudent.php";
                     } else{
                          $('#eMdp').val('');  
                          $('#responseE').fadeIn().html(data);  

                          } 
                     }  
                });  
           }  
      }); 

      $("#pSubmit").click(function(){


           if($('#pUsername').val()=='' || $('#pMdp').val()=='')  
           {  
                $('#responseP').html('<p>Tous les champs sont obligatoires!</p>');  
           }  
           else  
           {  
                $.ajax({  
                     url:"src/connect.php",  
                     method:"POST",  
                     data:$('#formProf').serialize()+'&pSubmit='+$('#pSubmit').prop('checked')+'&pSouvenir='+$('#pSouvenir').prop('checked'),  
                     beforeSend:function(){  
                          $('#responseP').html('<img style="margin-top:5px;width: 40px; height:40px" src="assets/pictures/loading.gif" alt="loading"> ');  
                     },  
                     success:function(data){
                     if (data=="connected") {
                     	window.location.href = "src/vueProf.php";
                     } else{
                          $('#pMdp').val('');  
                          $('#responseP').fadeIn().html(data);  

                          } 
                     }  
                });  
           }  
      });  
 });


      

