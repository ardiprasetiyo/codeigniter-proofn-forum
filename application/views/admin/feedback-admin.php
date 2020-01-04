<!-- The Modal -->
<div class="modal fade mt-5" id="feedmodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-wrap: break-word; min-height: 400px; max-height: 401px; overflow: auto; text-align: justify;">
       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      
      </div>

    </div>
</div>
</div>




<div class="col-lg-12">
	<h3>Feedback</h3>
</div>

<div class="row mt-4">
	<div class="col-lg-4 feedback-mgmt">
		<div class="row">
			<div class="col-lg-5 ml-4 b-shadow bg-proofn-gradient p-2 text-white">
					<div class="row">
						<div class="col-lg-12 text-center mb-1">
							<span>Saran Masukan</span>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 offset-lg-2">
							<i class="material-icons mt-1 d-block" style="font-size:30px">chat</i>
						</div>
						<div class="col-lg-6">
							<h3 class="text-center"><?= $feed_suggest ?></h3>
						</div>
					</div>
			</div>
			<div class="col-lg-5 ml-3 b-shadow bg-proofn-gradient p-2 text-white">
				<div class="row">
						<div class="col-lg-12 text-center mb-1">
							<span>Laporan Kesalahan</span>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 offset-lg-2">
							<i class="material-icons mt-1 d-block" style="font-size:30px">error</i>
						</div>
						<div class="col-lg-6">
							<h3 class="text-center"><?= $feed_error ?></h3>
						</div>
					</div>
			</div>

			<div class="col-lg-12 mt-3">
				<div class="container">
					
					<h6 class="mb-3 mt-2 text-grey">Tambahkan Kategori Feedback</h6>
					<input type="text" name="new-category" id="cat-title" class="form-control form-control-sm" placeholder="Masukan judul kategori">
					<div class="row mt-2">
						<div class="col-lg-7">
							<select class="form-control form-control-sm" id="cat-priority">
								<option value="0">Tentukan Prioritas</option>
								<option value="rendah">Rendah</option>
								<option value="sedang">Sedang</option>
								<option value="tinggi">Tinggi</option>
							</select>
						</div>
						<div class="col-lg-5">
							<a href="#!" id="create-category" data-send="false" class="btn btn-proofn btn-sm float-right">Buat Kategori</a>
						</div>
					</div>
				</div>
			</div>


			<div class="col-lg-12 mt-1 mb-3">
				<div class="container">
					<div class="col-lg-12">
						<h6 class="mb-3 mt-4 text-grey">Kategori Feedback</h6>
					</div>
				</div>
			
				<div class="container b-shadow pt-2" id="categoriesContent" style="min-height: 230px; max-height: 231px; overflow: auto;">


				</div>
			</div>


		</div>
	</div>

	<div class="col-lg-8">
		<div class="row">

	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row">
						<div class="container">
							<h6 class="mt-2 mb-3 text-grey">Saran Masukan</h6>
						</div>

						<div class="col-lg-12 b-shadow pt-3 pb-3" id="suggestContent" style="min-height: 370px; max-height: 371px; overflow: auto">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	



	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-12">
				<div class="container">
					<div class="row">
						<div class="container">
							<h6 class="mt-2 mb-3 text-grey">Laporan Kesalahan</h6>
						</div>

						<div class="col-lg-12 b-shadow pt-3 pb-3" id="reportContent" style="min-height: 370px; max-height: 371px; overflow: auto">


						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="col-lg-12 mt-3">
			<div class="container">
					<h6 class="mt-2 mb-3 text-grey">Urutkan Berdasarkan</h6>
					<a href="#!" sort-property="asc" sort-target="date" class="btn btn-proofn btn-sm sort">Waktu</a>
					<a href="#!" sort-property="desc" sort-target="status_feedback" class="btn btn-proofn btn-sm sort">Status</a>
					<a href="#!" sort-property="desc" sort-target="priority" class="btn btn-proofn btn-sm sort">Prioritas</a>
				</div>
	</div>

	</div>

	</div>

	<div class="col-lg-4" style="background-color: green;"> </div>

</div>

</div>



<script>
	$(document).ready(function(){


		function deleteCategory(){

			// Delete Category

			$('.delete-category').click(function(){
				let id = $(this).attr('data-id');
				let status = $(this).attr('data-send');

				if( status == 'false' ){
					$(this).attr('data-send', 'true');
					$.post({
						url: "<?= site_url() ?>/admin/delete-category/id/" + id,
						data: {"id" : id}
					}, function(data){
						let result = JSON.parse(data);
						$('#categoriesContent').html('');
						$('#categoriesContent').html(getCategories());
						alert(result.status_msg);
					});
				} else if( status == 'true' ) {
					alert('Data Sedang Di Proses');
				}else {
					alert('Terjadi Kesalahan');
				}

			});
		}



		function getCategories(){

		// Get Categories

		let getCategories = $.getJSON('<?= site_url() ?>/admin/getCategories/all/', function(data){
			let result = data.result;

			if( result.length > 0 ){

			$.each(result, function(i, data){
				$('#categoriesContent').append(
					`<div class="row mb-3">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body p-3">
									<div class="row">
										<div class="col-lg-12">
											<span><b>` +  data.feed_categoryname + `</b></span>
										</div>
										<div class="col-lg-12">
											<span class="text-grey" style="font-size: 15px;">Prioritas <b>` + data.priority + `</b> </span>
											<a href="#!"  class="btn float-right p-0 delete-category" data-id ="` + data.id + `" data-send="false">
												<span><i class="material-icons">delete</i></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>`
				);
			});

			deleteCategory();

			} else {
				
			$('#categoriesContent').html(`

				<div class="col-lg-8 mt-4 offset-lg-2">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1">
								<img src="<?= base_url() ?>/asset/images/illustration/empty-box.png" class="img-fluid mx-auto d-block">
							</div>
							<div class="col-lg-12 mt-4">
								<h6 class="text-center text-grey">Belum Ada Apapun</h6>
							</div>
						</div>
					</div>
				</div>

			`);

			}

		}); 

	}







	// SUGGESTION FUNCTION



	function getSuggest(){

		// Get All Suggest

			let getSuggestion = $.getJSON('<?= site_url() ?>/admin/getSuggest/all/', function(data){
			let result = data.result;
			let username;

			if( result.length > 0 ){

			$.each(result, function(i, data){

				let feed_desc = data.feed_description;

				if( feed_desc.length > 46){
					feed_desc = feed_desc.substring(0, 42) + ' ...';
				}

				if( data.username == null ){
					username = "Guest";
				} else {
					username = data.username;
				}

				if( data.status_feedback == '1' ){

				$('#suggestContent').append(
					`<div class="card mb-3 lb-warning">
								<div class="card-body p-2">
									<div class="container">
										<div class="row">
											<div class="col">
												<span class="float-left"><b>` + username + `</b></span>
											</div>
											<div class="col">
												<span class="small float-right">` + data.date + `</span>
											</div>
										</div>


										<div class="row">
											<div class="col">
												<span class="small text-grey">Status <b>Pending</b></span>
											</div>
										</div>

										<div class="row">
											<div class="col mt-2 mb-2">
												<span class="text-grey small">` + feed_desc + `</span>
											</div>
										</div>

										<div class="row">
											<div class="col mt-1">
												<a href="#!" class="btn float-right suggest-detail" data-target="#feedmodal" data-toggle="modal" data-id="` + data.id + `"><i class="material-icons">fullscreen</i>
												</a>
											</div>
										</div>

									</div>
								</div>
					</div>`

				);

				} else {

					$('#suggestContent').append(
					`<div class="card mb-3 lb-success">
								<div class="card-body p-2">
									<div class="container">
										<div class="row">
											<div class="col">
												<span class="float-left"><b>` + data.username + `</b></span>
											</div>
											<div class="col">
												<span class="small float-right">` + data.date + `</span>
											</div>
										</div>


										<div class="row">
											<div class="col">
												<span class="small text-grey">Status <b>Ditanggapi</b></span>
											</div>
										</div>

										<div class="row">
											<div class="col mt-2 mb-1">
												<span class="text-grey small">` + feed_desc + `</span>
											</div>
										</div>

										<div class="row">
											<div class="col mt-1">
												<a href="#!" class="btn float-right suggest-detail" data-target="#feedmodal" data-toggle="modal" data-id="` + data.id + `"><i class="material-icons">fullscreen</i>
												</a>
											</div>
										</div>

									</div>
								</div>
					</div>`

				);

			}

			});

		} else {

			$('#suggestContent').html(`

				<div class="col-lg-12 mt-5">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1">
								<img src="<?= base_url() ?>/asset/images/illustration/empty-box.png" class="img-fluid mx-auto d-block">
							</div>
							<div class="col-lg-12 mt-4">
								<h6 class="text-center text-grey">Belum Ada Apapun</h6>
							</div>
						</div>
					</div>
				</div>

			`);
		}

		});
	}



			// Detail Suggestion

			$(document).on('click', '.suggest-detail', function(){
			let id = $(this).attr('data-id');
			let username;
			let profile_picture;
			$.getJSON('<?= site_url() ?>/admin/getSuggestDetail/id/' + id, function(data){

				console.log(data);

				if( data.result[0].username == null ){
					username = 'Guest';
				} else {
					username = data.result[0].username;
				}

				if( data.result[0].profile_picture == null ){
					profile_picture = "<?= base_url() . 'asset/images/profilepic/no-pic.png'?>";
				}

				$('.modal-title').html('Saran Dan Masukan');
				$('.modal-body').html(`
					<div class="container">
					<div class="row">
						<div class="col-lg-4 offset-lg-4">
							<div class="profile-pic" style="background-image: url('`+ profile_picture +`'); padding: 65px 10px 65px 10px"></div>
						</div>
						<div class="col-lg-12 mt-5">
							<h4 class="text-center">` + username  + `</h4>
						</div>

						<div class="col-lg-12 mt-2">
							<p class="text-center small">` + data.result[0].feed_description  + `</p>
						</div>

					</div>
					</div>
				`);

					if( data.result[0].link_file != null ){

						$('.modal-footer').html(`

							<a href="` + data.result[0].link_file + `" class="btn proofn-color" target="_blank"><i class="material-icons float-right">attachment</i></a>
							
						`);

					} else {

						$('.modal-footer').html(`

							<span><i class="material-icons mr-2 float-right text-grey">attachment</i></span>
						`);

					}

					if( data.result[0].status_feedback == '1' ){
						$('.modal-footer').append(`<a href="#!" class="update-res btn-sm btn proofn-color tanggapi" data-id="` + id + `" ><b>TANDAI DITANGGAPI</b></a>`);
					} else{
						$('.modal-footer').append(`<a href="#!" class="update-res btn-sm btn dark-blue urungkan" data-id="` + id + `" ><b>URUNGKAN TANDA</b></a>`);
					}
			});
			
		});


		// Update Suggest Status

		$(document).on('click', '.update-res', function(){
			let id = $(this).attr('data-id');

			$.post({
				url: '<?= site_url() ?>/admin/updateSuggestResponse/',
				data: {'id' : id}
			}, function(e){
				let result = JSON.parse(e);
			});
			$('#suggestContent').html('');
			getSuggest();

			if( $(this).hasClass('tanggapi') == true ){

				$(this).removeClass('tanggapi');
				$(this).removeClass('proofn-color');
				$(this).addClass('dark-blue');
				$(this).addClass('urungkan');
				$(this).html('<b>URUNGKAN TANDA</b>');

			} else {

				$(this).removeClass('urungkan');
				$(this).removeClass('dark-blue');
				$(this).addClass('proofn-color');
				$(this).addClass('tanggapi');
				$(this).html('<b>TANDAI DITANGGAPI</b>');

			}


		});



		// END OF SUGGESTION FUNCTION



		// FUNCTION ERROR REPORT


		function getErrReport(){

			// Get All Error Report

			$.getJSON('<?= site_url(); ?>/admin/getReport/all/', function(data){
				let result = data.result;
				let feedStats;
				let feedDesc;
				let feedStyle;
				let feedPriority;
				let username;

				if( result.length > 0 ){

				$.each(result, function(i, data){


					if( data.status_feedback > 0 ){
						// Translating Feedback Status
						feedStats = 'Pending'; 
						// Styling Div
						feedStyle = 'lb-warning';
					} else {
						feedStats = 'Ditanggapi';
						// Styling Div
						feedStyle = 'lb-success';
					}

					// Limiting Text

					if( data.feed_description.length > 46 ){
						feedDesc = data.feed_description.substring(0, 42) + ' ... ';
					} else {
						feedDesc = data.feed_description;
					}

					if( data.priority == null ){
						feedPriority = 'rendah';
					} else {
						feedPriority = data.priority;
					}

					// Guest Feedback If Not Member

					if( data.username == null ){
						username = 'Guest';
					} else {
						username = data.username;
					}


					$('#reportContent').append(`

						<div class="card mb-3 ` + feedStyle + `">
								<div class="card-body p-2">
									<div class="container">
										<div class="row">
											<div class="col">
												<span class="float-left"><b>` + username + `</b></span>
											</div>
											<div class="col">
												<span class="small float-right">` + data.date + `</span>
											</div>
										</div>


										<div class="row">
											<div class="col">
												<span class="small text-grey">Status <b>` + feedStats + `</b></span>
												<span class="small text-grey float-right">Prioritas <b>` + feedPriority + `</b></span>
											</div>
										</div>

										<div class="row">
											<div class="col mt-2 mb-2">
												<span class="text-grey small">` + feedDesc + `</span>
											</div>
										</div>

										<div class="row">
											<div class="col mt-1">
												<a href="#!" class="btn float-right report-detail" data-target="#feedmodal" data-toggle="modal" data-id="` + data.id + `"><i class="material-icons">fullscreen</i>
												</a>
											</div>
										</div>

									</div>
								</div>
					</div>

					`);
				}); 

				} else {

				$('#reportContent').html(`

				<div class="col-lg-12 mt-5">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1">
								<img src="<?= base_url() ?>/asset/images/illustration/empty-box.png" class="img-fluid mx-auto d-block">
							</div>
							<div class="col-lg-12 mt-4">
								<h6 class="text-center text-grey">Belum Ada Apapun</h6>
							</div>
						</div>
					</div>
				</div>

			`);

			}

			});

		}


			// Get Detail Report

			$(document).on('click', '.report-detail', function(){
				let id = $(this).attr('data-id');
				let username;
				let profile_picture;
				$.post({
					url: "<?= site_url() ?>/admin/getReportDetail/",
					data: {'id' : id}
				}, function(data){
					let result = JSON.parse(data).result[0];

					// Guest If Not A Member
					if( result.username == null ){
						username = 'Guest';
					} else {
						username = result.username;
					}

					// If Not A Member, Set To Default Profile Picture
					if( result.profile_picture == null ){
						profile_picture = "<?= base_url() . 'asset/images/profilepic/no-pic.png' ?>";
					} else {
						profile_picture = result.profile_picture;
					}

					// Showing Title To Modal
					$('.modal-title').html('Laporan Kesalahan');

					// Showing Report Information To Modal Body
					$('.modal-body').html(`
						<div class="container">
						<div class="row">
							<div class="col-lg-4 offset-lg-4">
								<div class="profile-pic" style="background-image: url('`+ profile_picture +`'); padding: 65px 10px 65px 10px"></div>
							</div>
							<div class="col-lg-12 mt-4">

								<h4 class="text-center">` + username  + `</h4>
							</div>

							<div class="col-lg-12 mt-3	">
								<h5 class="small text-center"><b>Deskripsi Kesalahan</b></h5>
								<p class="text-center small">` + result.feed_description  + `</p>
							</div>

							<div class="col-lg-12 mt-4">
								<div class="container">
									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-12">
													<h5 class="small"><b>Brand Perangkat</b> ` + result.device_brand + `</h5>
												</div>
												<div class="col-lg-12">
													<h5 class="small"><b>Seri Perangkat </b>` + result.brand_model + `</h5>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row">
												<div class="col-lg-12">
													<h5 class="small"><b>Versi Sistem Operasi</b> ` + result.os_version + `</h5>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>



						</div>
						</div>
					`);

					// Clearing Modal Footer

					$('.modal-footer').html('');


					// Placing Button To Modal Footer

					if( result.link_file == null ){
						$('.modal-footer').append(`
							<i class="material-icons text-grey">attachment</i>
						`);
					} else {
						$('.modal-footer').append(`
							<a href="` + result.link_file + `" class="btn proofn-color" target="_blank"><i class="material-icons">attachment</i></a>
						`);
					}

					// Udpating Status

					if( result.status_feedback > 0 ){
						$('.modal-footer').append(`<a href="#!" class="update-report btn-sm btn proofn-color tanggapi" data-id="` + result.id + `" ><b>TANDAI DITANGGAPI</b></a>`);
					} else {

					$('.modal-footer').append(`
						<a href="#!" class="update-report btn-sm btn dark-blue urungkan" data-id="` + result.id + `" ><b>URUNGKAN TANDA</b></a>
					`);

					}




				});
			
			});



		// Update Report Status

		$(document).on('click', '.update-report', function(){
			let id = $(this).attr('data-id');


			$.post({
				url: '<?= site_url() ?>/admin/updateReportResponse/',
				data: {'id' : id}
			}, function(e){
				let result = JSON.parse(e);
				$('#reportContent').html('');
				getErrReport();
			});

				if( $(this).hasClass('tanggapi') == true ){

				$(this).removeClass('tanggapi');
				$(this).removeClass('proofn-color');
				$(this).addClass('dark-blue');
				$(this).addClass('urungkan');
				$(this).html('<b>URUNGKAN TANDA</b>');

				} else {

				$(this).removeClass('urungkan');
				$(this).removeClass('dark-blue');
				$(this).addClass('proofn-color');
				$(this).addClass('tanggapi');
				$(this).html('<b>TANDAI DITANGGAPI</b>');

			}
		});



		// END OF ERROR REPORT FUNCTION





		// Calling Main Function

		getCategories();
		getSuggest();
		getErrReport();


		// Sorting 

		$('.sort').click(function(){
			let sortProperty = $(this).attr('sort-property');
			let sortTarget = $(this).attr('sort-target');

			
			// Saving Setting For Sort
			document.cookie = "sort-property = " + sortProperty;
			document.cookie = "sort-target = " + sortTarget;

			if( sortTarget == 'date' || sortTarget == 'status_feedback' ){
			
			// Set Content To Empty
			$('#suggestContent').html('');
			$('#reportContent').html('');

			// Get New Content
			getSuggest();
			getErrReport();

			} else {

			// Set Content To Empty
			$('#reportContent').html('');

			// Get New Content
			getErrReport();

			}

			if( sortProperty == 'asc' ){
				$(this).attr('sort-property', 'desc');
			} else {
				$(this).attr('sort-property', 'asc');	
			}

			

		})


		
		// Create Category

		$('#create-category').click(function(){
			let judulKategori = $('#cat-title').val();
			let prioritas = $('#cat-priority').val();
			let status = $(this).attr('data-send');

			if( status == 'false' ){
				$(this).attr('data-send', 'true');

				if( prioritas == '0' ){
					prioritas = 'rendah';
				}
				
				$.post({
				url: '<?= site_url() . "/admin/create-category/" ?>',
				data: {'cat-title' : judulKategori, 'priority' : prioritas}
				}, function(data){
					let result = JSON.parse(data);
					$('#categoriesContent').html('');
					$('#categoriesContent').html(getCategories());
					alert(result.status_msg);
				});

				$(this).attr('data-send', 'false');


			} else if( status == 'true' ){
				alert('Data Sedang Dikirim!');
			} else {
				alert('Terjadi Kesalahan');
			}

		});


	});

</script>