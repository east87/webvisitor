$(document).ready(function () {

    $('a#load-more').on('click', function (event){
      
        event.preventDefault;
//        event.stopPropagation;
       
        var urls = window.location.href+'/loadMore';
        var _curpage = $(this).attr('data-curpage');
        var _limit = $(this).attr('data-limit');
        var _total = $(this).attr('data-total');
        var start = parseInt(_curpage);
        var next = start * parseInt(_limit);
         //var next = '4';
       
            $.ajax({
            type : "POST",
            url : urls,
            data: {next: next, limit: _limit},
                //dataType: 'html',
                timeout: 2000
            })
            
            .done(function(result) {
                //alert(result);
                $("#content_load").append(result).fadeIn('slow');
                //app.pageLoad();
                $("#load-more").attr('data-curpage', parseInt(_curpage)+1 );
                $("#load-more").html("LOAD MORE<br>["+ $("#load-more").attr('data-curpage') + "/" + _total + "]");
                if ( parseInt(_curpage)+1 >= _total) $("#load-more-container").fadeOut('fast').remove();
                swipper();
            })
            
            .fail(function(msg) {
                console.log('Ajax error');
                console.log(msg);
            });

            

        return false;

    });

    // BEST SCROLLER: http://stackoverflow.com/a/15382570
    var _throttleTimer = null;
    var _throttleDelay = 800;
    var $window = $(window);
    var $document = $(document);

    $document.ready(function () {

        $window
            .off('scroll', ScrollHandler)
            .on('scroll', ScrollHandler);

    });

    function ScrollHandler(e) {
        //throttle event:
        clearTimeout(_throttleTimer);
        _throttleTimer = setTimeout(function () {
            console.log('scroll');

            //do work
            if ($(window).scrollTop() >= $(".container-fluid").height() - 200 ) {
                   console.log('Click triggered');
                   setTimeout(function(){
                    $('a#load-more').trigger('click');
                   }, 100);
            }

        }, _throttleDelay);
    }

    function swipper(){
           var swiperFull = new Swiper('.swiper-full-screen', {
        loop: true,
        slidesPerView: 1,
        preventClicks: false,
        allowTouchMove: true,
          effect: 'cube',
      grabCursor: true,
      cubeEffect: {
        shadow: true,
        slideShadows: true,
        shadowOffset: 20,
        shadowScale: 0.94,
      },
        pagination: {
            el: '.swiper-full-screen-pagination',
            clickable: true
        },
        autoplay: {
            delay: 5000
        },
        keyboard: {
            enabled: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        on: {
            resize: function () {
                swiperFull.update();
            }
        }
    });
    }
    


});
