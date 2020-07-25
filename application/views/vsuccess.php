<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Success check in | Vania</title>
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
            <div class="">
               <h5 class="txt-center p-b-4">
               Anda sudah check out
               <br>
            </h5>
            <p class="txt-center m2-txt1 p-b-67">
               Terima kasih atas kunjungannya
            </p>
            
            <div class="col-md-12 col-12 p-0">
               <a href="<?=BASE_URL?>" class="btn bnt-checkout btn-mini btn-block text-uppercase" title="Exit">Exit</a>
            </div>
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
      $(document).ready(function () {
            // Handler for .ready() called.
            window.setTimeout(function () {
                location.href = "<?=BASE_URL?>";
            },8000);
        });
      </script>
   </body>
</html>