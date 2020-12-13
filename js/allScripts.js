
$(document).ready(function(){
  $('.modifier').on('click',function(){
    $('.alert').remove();
    $('.form-control').val("");




  });

  /*script pour inserer un prof*/
  var form=$('#insertProf');
  $(form).on('submit',function(e){
    e.preventDefault();
    $('.alert').remove();
    var data=$(this).serialize();
    alert(data);
    $.ajax({
      method:"POST",
      url: "../Ajax_traitement/Ajax_inserer_professeurs.php",
      data:data,
      dataType:"html",
      success:function(data){
        console.log(data);



        var data=JSON.parse(data);

        if(data.errors){


          $(form).prepend("<div id='errors' class='alert alert-danger'></div>");



          $.each(data.errors,function(index,value){

            console.log(value);
            $('<p>'+value+'</P>').appendTo('#errors');

          });
        }
        else if(data.succes){
          console.log("casa");
          $(form).prepend("<div id='success' class='alert alert-success'></div>");
          $('<p>'+data.succes+'</P>').appendTo('#success');


        }







      }


    });



  });

  /*   script d inscription d etudiants*/
  $("#insertEtud").on('submit',function(e){

    e.preventDefault();
    $('.alert').remove();
    var data=$(this).serialize();
    alert(data);
    $.ajax({
      method:"POST",
      url: "../Ajax_traitement/Ajax_inserer_etudiants.php",
      data:data,
      dataType:"html",
      success:function(data){
        console.log(data);



        var data=JSON.parse(data);

        if(data.errors){
          console.log("casa");

          $('#insertEtud').prepend("<div id='errors' class='alert alert-danger'></div>");



          $.each(data.errors,function(index,value){

            console.log(value);
            $('<p>'+value+'</P>').appendTo('#errors');

          });
        }
        else if(data.succes){
          $('#insertEtud').prepend("<div id='success' class='alert alert-success'></div>");
          $('<p>'+data.succes+'</P>').appendTo('#success');


        }







      }


    });



  });
/*
script de  dependent select */

$("#anne").on('change',function(){

  var change=$(this).val();



  if(change) {

    alert(change);
    $.ajax({
      method:"POST",
      url: "../Ajax_traitement/Ajax-dependent-select.php",
      data: {changeEtud:change},
      dataType:"html",
      success:function(data){
        console.log(data);
        $("#classes").html(data);


      }


    });
  }
  else {
    $('#classes').html("<option/>sleect a sat</option>");
  }

});
/*
script:  infos d etudiants*/

$(".editEtud").on("click",function(){
 $('#classe option').remove(); 

 var modif_id=$(this).attr("id");

 $.ajax({
  method:"POST",
  url: "../Ajax_traitement/Ajax_info_etudiants.php",
  data: {modif_id:modif_id},
  dataType:"html",
  success:function(data){
    console.log(data);


    var data=JSON.parse(data);
    console.log(data["nom_classe"]);

     $("#mailEtudiant").val(data['email']);
    $("#idEtudiant").val(data['username']);
    $("#nom").val(data['nom']);
    $("#prenom").val(data['prenom']);
   $("#email").attr("placeholder", data['email']);
    $("#mdp").val(data['mdp']);

    for (i = 0; i < data["nom_classe"].length; i++) {
      $('<option value='+data["nom_classe"][i]+'>'+data["nom_classe"][i]+'</option> ').appendTo('#classe');

    }
     $('#classe option[value='+data["nom_classe2"]+']').prop('selected', true);






  }


});

});

/*  script de  modification d etudiants*/
$("#changeEtud").on('submit',function(e){

  e.preventDefault();
  $('.alert').remove();
  var data=$(this).serialize();
  alert(data);
  $.ajax({
    method:"POST",
    url: "../Ajax_traitement/Ajax-modifier-etudiants.php",
    data:data,
    dataType:"html",
    success:function(data){
      console.log(data);



      var data=JSON.parse(data);

      if(data.errors){
        console.log("casa");

        $('#changeEtud').prepend("<div id='errors' class='alert alert-danger'></div>");

        

        $.each(data.errors,function(index,value){

          console.log(value);
          $('<p>'+value+'</P>').appendTo('#errors');

        });
      }
      else if(data.succes){
        $('#changeEtud').prepend("<div id='success' class='alert alert-success'></div>");
        $('<p>'+data.succes+'</P>').appendTo('#success');


      }







    }


  });



});
/*
script : LES INFOS de compte professeur*/

$(".editProf").on("click",function(){


 var modif_id=$(this).attr("id");

 $.ajax({
  method:"POST",
  url: "../Ajax_traitement/Ajax_info_Professeur.php",
  data: {modif_id:modif_id},
  dataType:"html",
  success:function(data){
    console.log(data);


    var data=JSON.parse(data);



    $("#mailProfesseur").val(data['email']);

    $("#idProfesseur").val(data['username']);
    $("#nom").val(data['nom']);
    $("#prenom").val(data['prenom']);
    $("#email").attr("placeholder", data['email']);
    $("#mdp").val(data['mdp']);
   






  }


});

});
/*  script de  modification professeurs*/
$("#changeProf").on('submit',function(e){

  e.preventDefault();
  $('.alert').remove();
  var data=$(this).serialize();
  alert(data);
  $.ajax({
    method:"POST",
    url: "../Ajax_traitement/Ajax-modifier-professeur.php",
    data:data,
    dataType:"html",
    success:function(data){
      console.log(data);



      var data=JSON.parse(data);

      if(data.errors){
        console.log("casa");

        $('#changeProf').prepend("<div id='errors' class='alert alert-danger'></div>");

        

        $.each(data.errors,function(index,value){

          console.log(value);
          $('<p>'+value+'</P>').appendTo('#errors');

        });
      }
      else if(data.succes){
        $('#changeProf').prepend("<div id='success' class='alert alert-success'></div>");
        $('<p>'+data.succes+'</P>').appendTo('#success');


      }







    }


  });



});

});
