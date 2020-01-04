	

	$(document).ready(function(){


		$(document).scroll(function(){

			if( $(document).scrollTop() > 400 ){

				
				if( $(window).width() <= 425 ){

					$('.navbar-wrapper').hide();

				} else {

				$('.navbar-wrapper').css({'background-color' : '#FD8D2E', 'box-shadow' : 'rgba(0, 0, 0, 0.33) -2px 5px 19px 0px'});

				}

			if( $(document).scrollTop() > 300 ){


				$('#feedback').animate({ opacity: '1'});

			}

			if( $(document).scrollTop() > 1000 ){


				$('#usermanual').animate({ opacity: '1'});

			}


			if( $(document).scrollTop() > 1600 ){


				$('#community').animate({ opacity: '1'});

			}



			}

			if( $(document).scrollTop() < 400 ){


				if( $(window).width() <= 425 ){

					$('.navbar-wrapper').hide();


				$('#feedback').animate({ opacity: '1'});

				$('#usermanual').animate({ opacity: '1'});

				$('#community-section').animate({ opacity: '1'});



				} else {

				$('.navbar-wrapper').css({'background-color' : 'rgba(0,0,0,0)', 'box-shadow' : 'none'});

				}

			}


		});	

	});