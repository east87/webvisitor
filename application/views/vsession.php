<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Session check in | Vania</title>
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
      <!-- Bootstrap CSS -->
      <?php include 'include/icon.php';?>
      <link rel="stylesheet" type="text/css" media="screen" href="<?= FRONTEND_BASE_URL; ?>/css/main.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="<?= FRONTEND_BASE_URL; ?>/css/forms.css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <?php include 'include/analytics.php';?>
   </head>
   <body>
      <?php include 'include/vheader.php';?>
      <div class="card-checkout bg-img1 overlay1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15">
         <div class="wsize1" id="info_checkin">
            <h4 class="l1-txt1 txt-center p-b-4">
               Selamat Datang
               <br>
            </h4>
            <h5 class="l1-txt1 txt-center p-b-4">
               <?=$quest_name;?>
            </h5>
            <p class="txt-center m2-txt1 p-b-67">
               Anda Check in dari : <?=$showroom_name.' - '. $showroom_address;?> <br>
               Pada <?= date('d-M-Y H:i:s', strtotime($checkin_date));?>
            </p>
            <p class="txt-center m2-txt1 p-b-67">
               Waktu berkunjung anda 
            </p>
            <br>
            <div class="countup" id="countup1">
               <span class="timeel hours">00</span>
               <span class="timeel timeRefHours">Jam</span>
               <span class="timeel minutes">00</span>
               <span class="timeel timeRefMinutes">Menit</span>
               <span class="timeel seconds">00</span>
               <span class="timeel timeRefSeconds">Detik</span>
            </div>
            <p class="col-md-12 text-center m2-txt2 about-desc">
               Silahkan klik Check Out atau Scan Barcode ketika keluar dari Vania!
            </p>
            <br>
            <div class="col-md-12 col-12 p-0">
               <a class="btn bnt-checkout btn-mini btn-block text-uppercase" title="Click to checkout" onclick="var answer = confirm('Are you sure to check out?'); if (answer){checkout();}">Check Out</a>
            </div>
         </div>
        
      </div>
      <div class="footer-container">
         <footer class="container-fluid">
            <div class="row">
               <div class="col-md-12 col-12 p-0 text-center">
                  <div class="footer-link"> 
                     ©  <?php echo @$today= date("Y"); ?> 
                     <a href="<?= BASE_URL; ?>" class="footer-link"> 
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
      <script>
         /*
         * Basic Count Up from Date and Time
         * Author: @mrwigster / https://guwii.com/bytes/count-date-time-javascript/
         */
         window.onload = function() {
         // Month Day, Year Hour:Minute:Second, id-of-element-container
         countUpFromTime("<?=$checkin_date;?>", 'countup1'); // ****** Change this line!
         };
         function countUpFromTime(countFrom, id) {
         countFrom = new Date(countFrom).getTime();
         var now = new Date(),
             countFrom = new Date(countFrom),
             timeDifference = (now - countFrom);
          
          
           
         var secondsInADay = 60 * 60 * 1000 * 24,
             secondsInAHour = 60 * 60 * 1000;
          
         days = Math.floor(timeDifference / (secondsInADay) * 1);
         hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
         mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
         secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);
         
        
         if(now.getHours()>20){
              checkout();
         }
         
        if (hours >= 8){
             checkout();
         }  
         
         var idEl = document.getElementById(id);
         //idEl.getElementsByClassName('days')[0].innerHTML = days;
         idEl.getElementsByClassName('hours')[0].innerHTML = hours;
         idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
         idEl.getElementsByClassName('seconds')[0].innerHTML = secs;
         
         clearTimeout(countUpFromTime.interval);
         
         
         
         countUpFromTime.interval = setTimeout(function(){ countUpFromTime(countFrom, id); }, 1000);
         }
         
         function checkout(){
             window.location.href = "<?=BASE_URL?>/checkout";
         }
      </script>
      <!--===============================================================================================-->
   </body>
</html>