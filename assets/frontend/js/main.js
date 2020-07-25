$(document).ready(function() {

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    



   $("body").append(`
    <a href="https://www.facebook.com/VaniaFabric"  target="_blank">
      <i class="facebook"></i>
    </a>`);
    $("body").append(`
    <a href="https://www.instagram.com/vania_interior_furnishings"  target="_blank">
      <i class="instagram"></i>
    </a>`);
    $("body").append(`
    <a href="https://www.instagram.com/vania_interior_furnishings"  target="_blank">
      <i class="instagram"></i>
    </a>`);
     $("body").append(`
    <a href="https://wa.me/628111298787"  target="_blank">
      <i class="whatsapp"></i>
    </a>`);
    $("body").append(`
    <a href="https://www.tokopedia.com/vaniajakarta"  target="_blank">
      <i class="tokped"></i>
    </a>`);
         $("body").append(`
    <a href="https://shopee.co.id/ecommerce.vania"  target="_blank">
      <i class="shopee"></i>
    </a>`);

});