<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Visitor | Vania</title>
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
      <!-- Bootstrap CSS -->
      <?php include 'include/icon.php';?>
      <link rel="stylesheet" type="text/css" media="screen" href="<?= FRONTEND_BASE_URL; ?>/css/main.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?= FRONTEND_BASE_URL; ?>/css/forms.css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <?php //include 'include/analytics.php';?>
   </head>
   <body class="">
      <?php //include 'include/tagmanager.php';?>
      <?php include 'include/vheader.php';?>
      <div class="container-image-height-flex">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12 col-md-7 col-lg-5 mx-auto">
                  <div class="home-background-white">
                     <div class="home-background-text-container">
                        <h1 class="text-center home-background-black-text" style="padding-top: 2ch;">
                           Visitor Access Vania
                        </h1>
                        <div class="card-signin" style="padding-top: 1ch;">
                           <form class="form-signin"  id="form-signin">
                               <input type="hidden" readonly="" name="showroom_id" value=""  id="showroom_id">
                               <div class="form-label-group" id="locations">
                                 
                                </div> 
                               <div class="form-label-group">
                                   <select disabled="" name="quest_type" id="quest_type" class="">
                                    <option value="">--Type--</option>
                                    <option value="1">Kurir</option>
                                    <option value="2">ID</option>
                                    <option value="3">End user</option>
                                    <option value="4">Contractor</option>
                                    <option value="5">Furniture maker</option>
                                    <option value="6">Project owner</option>
                                 </select>
                              </div>
                                
                           
                              <div class="form-label-group">
                                  <input disabled="" value="" type="text" name="quest_name" id="quest_name" class="form-control" placeholder="Name" required autofocus>
                                 <label for="quest_name">Name</label>
                              </div>
                               
                              <div class="form-label-group">
                                  <input disabled="" value="" type="text" name="quest_id" id="quest_id" class="form-control" placeholder="Id Card" required autofocus>
                                 <label for="quest_id">Id Card</label>
                                 <span style="color:#333; font-size: 80%;"><i>No ktp / sim / passport</i></span>
                              </div>
                              <div class="form-label-group">
                                  <input disabled="" value="" type="text" name="quest_phone" id="quest_phone" class="form-control" placeholder="No Telp" required autofocus>
                                 <label for="quest_phone">No Hp</label>
                              </div>
                              <div class="form-label-group">
                                  <input disabled="" value="" type="email" name="quest_email" id="quest_email" class="form-control" placeholder="Email address" required autofocus>
                                 <label for="quest_email">Email address</label>
                              </div>
                              <div class="form-label-group">
                                  <input disabled="" value="" type="text" name="quest_temp" id="quest_temp" class="form-control" placeholder="Temp" required autofocus>
                                 <label for="quest_temp">Temp</label>
                                 <span style="color:#333; font-size: 80%;"><i>Suhu tubuh diambil dari saat scan di pintu masuk showroom</i></span>
                              </div>
                              <div class="form-label-group">
                                  <input disabled="" value="" type="text" name="quest_validation" id="quest_validation" class="form-control" placeholder="Validation" required autofocus>
                                 <label for="quest_validation">Validation Code</label>
                                 <span style="color:#333; font-size: 80%;"><i>Validation Code dapat saat scan di pintu masuk showroom</i></span>
                              </div> 
                              <div class="col-12">
                                 <div class="col-md-10">
                                    <input type="" name="recaptcha_response" id="recaptchaResponse">
                                    <span id='captcha_error' style='color:red;'></span>
                                 </div>
                              </div>
                               
                                <hr>
                              <button onclick="myFunctionFORM()" disabled id="btn-submit" class="btn btn-mini darkness btn-checkin btn-block text-uppercase" type="submit">Check In</button>
                           </form>
                            
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
       <!-- Modal -->
<?php include 'include/vmodal.php';?>
      <!-- Footer -->
      <div class="footer-container">
         <footer class="container-fluid">
            <div class="row">
               <div class="col-md-12 col-12 p-0 text-center">
                  <div class="footer-link"> 
                     ©  <?php echo @$today= date("Y"); ?> 
                     <a href="https://vania.id" class="footer-link"> 
                     Vania.id
                     </a>
                     all right reserved
                  </div>
               </div>
            </div>
         </footer>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
         crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
         crossorigin="anonymous"></script>
     
      <script src="<?= FRONTEND_BASE_URL; ?>/js/main.js"></script>
      <script src="<?php echo FRONTEND_BASE_URL?>/js/jquery.validate.min.js"></script>
      <script src="<?php echo FRONTEND_BASE_URL; ?>/js/scriptForm.js"></script>
      <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY;?>"></script>
      <script>
         grecaptcha.ready(function () {
             grecaptcha.execute('<?= SITE_KEY;?>', { action: 'homepage' }).then(function (token) {
                 var recaptchaResponse = document.getElementById('recaptchaResponse');
                 recaptchaResponse.value = token;
             });
         });
      </script>
<script>
        function getRecaptcha() {
          
	grecaptcha.ready(function() {
		grecaptcha.execute('<?= SITE_KEY;?>', {action: 'homepage'}).then(function(token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
                 recaptchaResponse.value = token;
		});
	});
    }
</script>
       <script>
      // A $( document ).ready() block.
    $( document ).ready(function() {
    setInterval(function (){ getRecaptcha();}, 120000);
     $("#myModal").modal({
        show: false,
        backdrop: 'static'
    });
    $('#myModal').modal('show');
  if (document.cookie.indexOf('visited=true') == -1){
    // load the overlay
    $('#myModal').modal({show:true});
    
//    var days = 24 * 60 * 60 * 1000;
//    
//    var expires = new Date((new Date()).valueOf() + days);
//    document.cookie = "visited=true;expires=" + expires.toUTCString();

  }
}); 


      </script>
       <script>
        var x = document.getElementById("locations");
        var showroomId = document.getElementById("showroomId");
        $(document).ready(function() {
         //   $("#myModal").modal('show');
           setTimeout(function(){  getLocation(); 
            x.innerHTML = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>Showroom detection..';       
            }, 1000);
           
          }); 
        function getLocation() {
            if (navigator.geolocation) {
                 x.innerHTML = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>Showroom detection..';   
             navigator.geolocation.getCurrentPosition(showPosition,showError);
            } else { 
              x.innerHTML = "Geolocation is not supported by this browser.";
            }
          }

        function showPosition(position) {
            console.log(position.coords);
        var lati = position.coords.latitude;
        var longi= position.coords.longitude;
        var lat= Number.parseFloat(lati).toFixed(8);
         var long= Number.parseFloat(longi).toFixed(8);
        console.log(lat);
         var urls = 'https://localhost/vaniaqr/checkin/getLocations';
        $.ajax({
        type: 'POST',
        url: urls,
        dataType: 'json',
        data: {lat:lat,long:long },
        beforeSend: function() {
            var btnSend = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>Loading..';
            $("#btn-submit").html(btnSend);
        },
        success: function(result) {
            
            if (result != "") {
               var showroom_id =window.btoa(result[0].showroom_id);
               var showroom_name =result[0].showroom_name;
               var showroom_address =result[0].showroom_address;
                //alert(showroom_address);
                $("#showroom_id").val(showroom_id);
                locations.innerHTML = "Check In from: <b>" + showroom_name +"</b> &nbsp;(" + showroom_address + ")";
               $("#btn-submit").html("&nbsp;Check In");
               $("#btn-submit").attr("disabled", false);
              $("input").removeAttr('disabled');
              $("select").removeAttr('disabled');
           
            
            } else {
                 $("#btn-submit").attr("disabled", true);
                 $("input").attr('disabled','disabled');
                 $("select").attr('disabled','disabled');
                x.innerHTML = "<i class='error text-error'>Location information is unavailable.</i>\n\
                 <a href='#' class='btn-mini' onclick='getLocation()'><i class='fa fa-refresh' aria-hidden='true'></i></a>";
            }
           
        }
    });
    return false;
        
        
        
          
        }

        function showError(error) {
        console.log(error);
          switch(error.code) {
            case error.PERMISSION_DENIED:
              x.innerHTML = "<i class='error text-error'>User denied the request for Geolocation.</i>\n\
                 <a href='#' class='btn-mini' onclick='getLocation()'><i class='fa fa-refresh' aria-hidden='true'></i></a>";
              break;
            case error.POSITION_UNAVAILABLE:
              x.innerHTML = "<i class='error text-error'>Location information is unavailable.</i>\n\
                 <a href='#' class='btn-mini' onclick='getLocation()'><i class='fa fa-refresh' aria-hidden='true'></i></a>";
              break;
            case error.TIMEOUT:
              x.innerHTML = "<i class='error text-error'>The request to get user location timed out.</i>\n\
                 <a href='#' class='btn-mini' onclick='getLocation()'><i class='fa fa-refresh' aria-hidden='true'></i></a>";
              break;
            case error.UNKNOWN_ERROR:
              x.innerHTML = "<i class='error text-error'>An unknown error occurred.</i>\n\
                 <a href='#' class='btn-mini' onclick='getLocation()'><i class='fa fa-refresh' aria-hidden='true'></i></a>";
              break;
          }
        }
      </script>
   </body>
</html>