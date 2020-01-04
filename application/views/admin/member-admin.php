	
<div class="col-lg-12 mb-3">
	<div class="row">
		<div class="col-lg-12">
			<h3>Member</h3>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-7 ml-4 b-shadow pt-3" style="min-height: 500px; max-height: 501px; overflow: auto;">
			<h5>Daftar Member</h5>
			<p class="text-grey">Berikut adalah daftar member yang telah bergabung</p>
			
			<div class="col-lg-12">
				<div class="row member-list">
					
				</div>
			</div>
		</div>


		<div class="col-lg-4 ml-3 b-shadow" id="detail-member" style="overflow: auto; max-height: 502px;">
	
		</div>

</div>


<script>

	// Utility

		// Change Date Format

		function changeDate(date){
			let newDate;
			let month;
			let resultDate;
			let monthList = {'01' : 'Januari',
						 '02' : 'Februari',
						 '03' : 'Maret',
						 '04' : 'April',
						 '05' : 'Mei',
					     '06' : 'Juni',
					     '07' : 'Juli',
						 '08' : 'Agustus',
						 '09' : 'September',
						 '10' : 'Oktober',
						 '11' : 'November',
						 '12' : 'Desember',}
			
			newDate = date.split('-');
			month = monthList[newDate[1]];
			resultDate =  newDate[2] + ' ' + month + ' ' +  newDate[0];

			return resultDate;
					

		}

	
	// Getting Information

		// Get All Member List

		function getAllMemberData(){
			$.post({
				url : '<?= site_url() ?>/admin/getmember/all/'
			}, function(data){
				data = JSON.parse(data);
				let result = data.result;

				$.each(result, function(i, data){



					// Storing Information Into Table
					$('.member-list').append(`
						
						<div class="col-lg-4">
						<div class="card">
						<a href="#!" class="btn-card detail-member" target-id="` + data.id +  `">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-9 mx-auto d-block">
										<div class="profile-pic" style="background-image: url('` + data.profile_picture + `'); padding: 55px 10px 55px 10px;">
										</div>
									</div>

									<div class="col-lg-12 text-center mt-3">
										<h5 class="mt-1">` + data.username + `</h5>
										<p class="small mt-1"><b>Bergabung Pada</b> <br> ` + changeDate(data.join_date) + ` </p>
									</div>
								</div>
							</div>
						</a>
						</div>
					</div>

					`);

				});

				// End Foreach 

			});

		}


		// Get Member Detail

		$(document).on('click', '.detail-member', function(){
			let id = $(this).attr('target-id');
			$.post({
				url : '<?= site_url() ?>/admin/getDetailMember/',
				data : { 'id' : id }
			}, function(data){
				let dataParse = JSON.parse(data);
				$.each(dataParse.result, function(i, data){
				
				$('#detail-member').html('');

				$('#detail-member').append(
				`<div class="row">
					<div class="col-lg-12  mt-5">
						<div class="row">
							<div class="col-lg-4 offset-lg-1">
								<div class="profile-pic" style="background-image: url('` + data.profile_picture + `'); padding: 52px 10px 52px 10px;">
								</div>
							</div>

							<div class="col-lg-6 mt-3">
								<h3>` + data.username + `</h3>
								<p class="small">` + data.email + `</p>
							</div>
						</div>

						<div class="row mt-4">
							<div class="container">
								<div class="row mt-2">
									
									<div class="col-lg-10 offset-lg-1">
										<h3 class="small"><b>Biodata Akun</b></h3>
									</div>

									<div class="col-lg-10 offset-lg-1">
										<div class="row mt-2">
											<div class="col-lg-6">
												<h3 class="small mb-0">Tanggal Lahir</h3>
												<span class="text-orange small"><b>` + changeDate(data.birthdate) + `</b></span>
											</div>

											<div class="col-lg-6">
												<h3 class="small mb-0">Jenis Kelamin</h3>
												<span class="text-orange small"><b>` + data.gender + `</b></span>
											</div>

											<div class="col-lg-12 mt-3">
												<h3 class="small">Bio</h3>
												<span class="small text-orange"><b><i>` + data.bio + `</b></i></span>
											</div>

										</div>
									</div>

								</div>
							</div>
						</div>`);



					});
			});



			

			
		});

		getAllMemberData();

</script>



					


						<div class="row mt-1 mb-5">
							<div class="container">
								<div class="row">
									<div class="col-lg-10 offset-lg-1">
										<h3 class="small mt-3"><b>Aktivitas Feedback</b></h3>
									</div>

									<div class="col-lg-10 offset-lg-1">
										<div class="row">
											<div class="col-lg-5">
												<h5 class="small"><b class="text-orange">50 </b>Saran</h5>
											</div>
											<div class="col-lg-7">
												<h5 class="small"><b class="text-orange">30 </b>Laporan Error</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
			</div>