jQuery( function( $ ){
	$(document).ready(function() {
			$('.product-slider').slick({
			  infinite: true,
			  slidesToShow: 4,
			  slidesToScroll: 1,
			  autoplay: false,
			  speed: 150,
			  responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				  }
				},
				{
				  breakpoint: 700,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				  }
				},
				{
				  breakpoint: 400,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
			]
		});
	});	  
});
