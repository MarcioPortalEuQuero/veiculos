jQuery(document).ready(function($) {


//clica para abrir as fotos


	$('.car-text').click(function(){

		var id = $(this).data('id');

        $("#car-active").data('id', id);

        $('#car-full-desc-' + id).css('display','block');

    });



    $('.close-bt').click(function(){

        var id = $(this).data('id');

        $("#car-active").data('id', '');

        $('#car-full-desc-' + id).css('display','none');

    });



    var prev = $('.prev');

    var next = $('.next');

    var allSlides = 0;



    function nextSlide(id = null) {

        if (id == null) {

            var id = $(this).data('id');

        } else {

            var id = $("#car-active").data('id');

        }

        var currentSlide = $('#' + id).data('current');

        slide = $('#' + id).find('.car-pics-' + id);

        allSlides = $('#' + id).find('.car-pics-' + id).length - 1; // index start from 0



        if(currentSlide < allSlides) {

        

            slide.eq(currentSlide).fadeOut(1);      

            slide.eq(currentSlide + 1).fadeIn(1);

        

            currentSlide+=1;

            $('#' + id).data('current', currentSlide);

        }



    }

    

    function prevSlide(id = null) {

        if (id==null) {

            var id = $(this).data('id');

        } else {

            var id = $("#car-active").data('id');

        }

        var currentSlide = $('#' + id).data('current');

        slide = $('#' + id).find('.car-pics-' + id);

        allSlides = $('#' + id).find('.car-pics-' + id).length - 1; // index start from 0

        

        if(currentSlide > 0) {

        

            slide.eq(currentSlide).fadeOut(1);      

            slide.eq(currentSlide - 1).fadeIn(1);

      

            currentSlide-=1;

            $('#' + id).data('current', currentSlide); 

        }

    }

  

    next.on('click', nextSlide);

    prev.on('click', prevSlide);



    $(document).keyup(function(e){

        var id = $("#car-active").data('id');

        if(e.which == 37){

            prev.on('click', prevSlide(id));

        }

        if(e.which == 39){

            next.on('click', nextSlide(id));

        }

        if(e.which == 27){

            $('.view-car').css('display','none');

            $("#car-active").data('id', '');

        }



    })

});



$("#search-car").on('keyup', function(){

    var matcher = new RegExp($(this).val(), 'gi');

    $('.car-descript').show().not(function(){

        return matcher.test($(this).find('.car-text, img').text())

    }).hide();

});