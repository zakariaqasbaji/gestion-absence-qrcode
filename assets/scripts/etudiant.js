var longitude_etd='';
var latitude_etd='';

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition,function(objErreur) {
                var strErreur = '';
                switch(objErreur.code) {
                    case objErreur.PERMISSION_DENIED:
                        strErreur = "Vous devez donné la permission de déterminer votre position.";
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
          latitude_etd=position.coords.latitude;
          longitude_etd=position.coords.longitude;
        }



        //HTML video component for web camera
        var videoComponent = $("#webcameraPreview");
        //HTML select component for cameras change
        var webcameraChanger = $("#webcameraChanger");
        var options = {};
        //init options for scanner
        options = initVideoObjectOptions("webcameraPreview");
        var cameraId = 0;
        var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

        var student = document.getElementById('student_id');
        var qrtxt = document.getElementById('qrtxt_id');
        var longitude = document.getElementById('longitude_etd');
        var latitude = document.getElementById('latitude_etd');


        initScanner(options);

        initAvaliableCameras(
            webcameraChanger,
            function () {
                cameraId = parseInt(getSelectedCamera(webcameraChanger));
            }
        );


        scanStart(function (data){
            alert("Veuillez attendre un instant...");
            $.ajax({
             url:'traitementS/scanner.php',
             data:'username_etd='+username_etd+'&qrcode='+data+'&longitude_etd='+longitude_etd+'&latitude_etd='+latitude_etd,
             type:'post',
            success:function(res){

                alert(res);
            }
            


        });
        });


        function nCamera() {
            

                    Instascan.Camera.getCameras().then(function (cameras) {
                        
                        if(iOS){
                            initCamera(0);
                        }
                        else
                        {
                             switch(cameras.length) {
                              case 1:
                                initCamera(0);
                                break;
                              case 2:
                                initCamera(1);
                                break;
                              case 3:
                                initCamera(2);
                                break;
                              case 4:
                                initCamera(3);
                                break;
                              case 5:
                                initCamera(4);
                                break;
                              case 6:
                                initCamera(5);
                                break;

                              default:
                                alert('impossible d\'accès à la camera');
                            }
                        }


                    });
                }
nCamera();













