jQuery(function ($) {
	
	/************************* 
	Variables (tamaños editables)
	**************************/
	
	var browserwidth;
	var largewidth = 1024; // resolución mínima desktop
	var mediumwidth = 767; // resolución mmedia
	var smallwidth = 641; // resolución chica
	
	/************************* 
	Ejecución
	**************************/
	
	//Si no soporta archivos en formato SVG
	/*if (!Modernizr.svg) {
	  $(".logo img").attr("src", "wp-content/themes/nmycia-theme/images/logonmycia.png");
	  $('img[src$=".svg"]').hide();
	}*/
	
	// Obtiene anchura del browser 	
	function getbrowserwidth(){
		browserwidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || 0;
		//console.log(browserwidth);
		return browserwidth;
	}
	
	function onLoadAndResize(){  
		getbrowserwidth();
		homeGallery();
	}
	
	function homeGallery() {  
		
		$('#home-gallery').flexslider({
		    animation: "fade",
		    animationLoop: true,
		    controlNav: true,
		    directionNav: true,
		    smoothHeight: true,
		    start: function(slider){
			     $('#galery-intro').animate({
				   opacity: 1 
			    });
			    
			    if (!('.flexslider ul.slides li:only-child')){
				     $('#home-gallery .inner').delay(500).animate({
					   opacity: 1 
				    }, 400);
			    } else {
				      $('#home-gallery .inner').delay(700).animate({
					   padding: '0px 20px 0',
					   opacity: 1 
				    }, 400);

			    }
		    }
		});
		
		$('#page-gallery').flexslider({
		    animation: "fade",
		    animationLoop: true,
		    controlNav: true,
		    directionNav: true,
		    smoothHeight: true
		});
	}



	/************************* 
	Ejecución
	**************************/


	$(window).load(function() {
	   onLoadAndResize();
	});

	$(window).resize(function(){
		onLoadAndResize();
	});
	
	// si tiene foundation
	//$(document).foundation({});

});
