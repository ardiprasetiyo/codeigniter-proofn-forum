	</div>
</div>
</div>


	
	<script>
			
	$(document).ready(function(){


		function cookieSearching(cookieName){

		var cookie = document.cookie;
		var splitCookie = cookie.split(';');
		var index = 0;
		var value;

			for( i = 0; i < splitCookie.length; i++ ){

				 if(splitCookie[i].split('=')[0] == cookieName || splitCookie[i].split('=')[0] == ' ' + cookieName){
				 	return {'index' : i, 'value' : splitCookie[i].split('=')[1]}; 
				 }

				 if( i + 1 == splitCookie.length ){
				 	return false;
				 }
			}
		}



		if( cookieSearching('last-visit').value == 'dashboard' ){
			$('#main-content').load('<?= site_url() ?>/admin/dashboard');
		} else if( cookieSearching('last-visit').value == 'feedback' ){
			$('#main-content').load('<?= site_url() ?>/admin/feedback');
		} else if( cookieSearching('last-visit').value == 'member' ){
			$('#main-content').load('<?= site_url() ?>/admin/member');
		} else {
			$('#main-content').load('<?= site_url() ?>/admin/dashboard');
		}

		
		$('#home-button').click(function(){
			$('#main-content').fadeOut();
			$('#main-content').load('<?= site_url() ?>/admin/dashboard');
			document.cookie="last-visit=dashboard";
			$('#main-content').fadeIn(300);
		});

		$('#feedback-button').click(function(){
			$('#main-content').fadeOut();
			$('#main-content').load('<?= site_url() ?>/admin/feedback');
			document.cookie="last-visit=feedback";
			$('#main-content').fadeIn(300);


		});


		$('#member-button').click(function(){
			$('#main-content').fadeOut();
			$('#main-content').load('<?= site_url() ?>/admin/member');
			document.cookie="last-visit=member";
			$('#main-content').fadeIn(300);


		});


	});


	

	</script>


</body>
</html>