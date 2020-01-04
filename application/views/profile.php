<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/proofn.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/material-icons.css">
	<script src="<?= base_url() ?>/asset/js/jquery.js"></script>
	<script src="<?= base_url() ?>/asset/js/bootstrap.js"></script>
	<script src="<?= base_url() ?>/asset/js/animatescroll.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>

    	.proofn-icon{
    		margin-right: 20px;
    	}

    	.popup{
    		position: fixed;
    		display: none;
    		z-index: 2;
    		width: 100%;
    		height: 100%;
    		background-color: rgba(0,0,0,0.1);
    	}

    	.card-popup{
    		margin-top: 150px;
    		padding: 20px;
    	}

    	.btn-orange-transparent{
    		color: rgb(253, 141, 46);
    		background-color: rgba(0,0,0,0);
    		transition: 0.5s;
    	}

    	.btn-orange-transparent:hover{
    		color: rgb(255, 46, 46);
    		text-decoration: none;
    	
    	}


    	.bg-profile{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-profile.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			padding-top: 100px;
			padding-bottom: 200px;
		}

		.profile-pic{
			border-radius: 200px;
			overflow: hidden;
			padding: 60px;
			background-size: cover;
			background-position: center;
			background-color: #f9f9f9;
			border: solid 1px rgba(0,0,0,0.5);
		}

		.offset-c1{
			margin-left: 30%;
		}

		.content{
			margin-top: -140px;
		}

		.card-custom{
			padding: 0;
			margin: 0;
		}

		.box-orange{
			padding: 40px 10px 40px 10px;
		}

		.text-grey{
			color: grey;
		}

		.bg-orange{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-orange.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
		}

		.text-orange{
			color: rgb(253,141,46);
		}

		.lb-success {
			border-left-color: #59f549;
			border-left-width: 5px;
			border-radius: 0;
		}

		.lb-warning{
			border-left-color: #f5f249;
			border-left-width: 5px;
			border-radius: 0;
		}

		.hide{
			display: none;
		}

		.btn-proofn{
			background-color: rgb(253,141,46);
			color: white;
			transition: 0.5s;
		}

		.btn-proofn:hover{
			background-color: white;
			color: rgb(253,141,46);
		}

	</style>
</head>
<body>


	<div class="modal fade" id="popup-ubahakun">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">Ubah Informasi Akun</h4>
					<button href="#!" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					
					<div class="container">

					<?php if( $this->session->flashdata('valid_result') == TRUE ) : ?>

						<div class="text-danger">
							<p><?= $this->session->flashdata('valid_result') ?></p>
						</div>

						<br>
						
					<?php endif; ?>

					<?= form_open_multipart(site_url() . 'profile/updateInfo/'); ?>
					<p class="color-grey">Email</p>
					<input type="email" name="email" class="form-control" placeholder="Perbarui Email Anda" value="<?= $userData['email'] ?>"> <br>
					<p class="color-grey">Jenis Kelamin</p>
					<select class="form-control" name="gender">
						<?php if( $userData['gender'] == 'pria' ) : ?>
							<option value="pria" selected>Pria</option>
							<option value="wanita">Wanita</option>
						<?php else : ?>
							<option value="pria">Pria</option>
							<option value="wanita" selected>Wanita</option>
						<?php endif; ?>
					</select> <br>
					<p class="color-grey">Bio Tentang Anda</p>
					<textarea class="form-control" name="bio" rows="10"><?= $userData['bio'] ?></textarea>
					<br>
					<div class="row">
					<div class="col-lg-2">
						<div class="profile-pic" style="padding: 50%; background-image: url('<?= $userData['profile_picture'] ?>"></div>
					</div>
					<div class="col-lg-8 mt-4">
						<p class="color-grey">Ubah Foto Profile Anda</p>
						<input type="file" name="profile-pic"> <br> <br>
					</div>
					</div>
					
				</div>

				</div>

				<div class="modal-footer">
					<button type="submit" name="submit" class="btn btn-proofn">Simpan Perubahan</button>
					<a href="#!" class="btn btn-navy" data-dismiss="modal">Kembali</a>
					</form>
				</div>

			</div>
		</div>
	</div>

	<div class="col-lg-12 bg-profile text-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-1 offset-c1">
					<div class="profile-pic" style="background-image: url('<?= $userData['profile_picture'] ?>"></div>
				</div>
				<div class="col-lg-4 offset-lg-1">
					<div class="row">
						<div class="col-lg-12 mt-2">
							<h1><b><?= $userData['username'] ?></b></h1>
						</div>

						<div class="col-lg-12">
							<p>Bergabung Pada <br> <b><?= date('d M Y', strtotime($userData['join_date'])) ?></b></p>
						</div>
					</div>
				</div>
				<div class="col-lg-12 text-center mt-4">
					<div class="row">
						<div class="col-lg-2 offset-lg-4">
							<p>Gender <b><?= strtoupper($userData['gender']) ?></b></p>
						</div>
						<div class="col-lg-2">
							<p>Usia <b>
								<?php if( date('m') >= date('m', strtotime($userData['birthdate'])) ){
											echo date('Y') - date('Y', strtotime($userData['birthdate']));
										}else{
											echo ( date('Y') - date('Y', strtotime($userData['birthdate'])) ) - 1;
										}  ?>		
							</b></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="row">

	<div class="col-lg-6">
		<div class="content">
			<div class="row">
				<div class="col-lg-9 offset-lg-3 card">
					<div class="card-body">
						<h4>Informasi Selengkapnya</h4>
						<p class="text-grey">
							Berikut ini adalah informasi selengkapnya mengenai akun anda
						</p>

						<br><br>

						<h6>EMAIL</h6>
						<p><?= $userData['email'] ?></p>

						<br>

						<h6>TANGGAL LAHIR</h6>
						<p><?= $userData['birthdate'] ?></p>

						<br> <br>

						<h6>TENTANG SAYA</h6>
						<p><?= $userData['bio'] ?></p>
						<br>

						<a href="#!" data-toggle="modal" data-target="#popup-ubahakun" class="btn-orange-transparent"><b>Ubah Profile Anda</b></a>

						<br> 

					</div>
				</div>

				<div class="col-lg-9 offset-lg-3 card mt-4">
					<div class="card-body">
						<h4>Setting Akun</h4>
						<p class="text-grey">Pengaturan akun</p>

						<a href="<?= site_url() ?>/logout/" class="btn-orange-transparent"><b>Logout</b></a>
					</div>
				</div>

			</div>
		</div>
	</div>


	<div class="col-lg-6">
		<div class="content">
				<div class="col-lg-9">
					<div class="row">

						<!-- Forum Info -->

						<div class="col-lg-12 card card-custom">
							<div class="card-body">
								<h4>Informasi <span class="text-orange"><b>Forum</b></span></h4>
								<p class="text-grey">
									Informasi mengenai aktivitas forum anda
								</p>
							</div>
							<div class="bg-orange box-orange text-white">
								<div class="row">
									<div class="col-lg-5 mr-3">
										<div class="row">
											<div class="col-lg-12 offset-lg-6">
												<img src="<?= base_url() ?>/asset/images/icon/topic-icon.png" class="img-fluid">
											</div>
											<div class="col-lg-6 offset-lg-6 text-center mt-3">
												<p class="mb-0 mr-1"><?= $forumData['num-thread'] ?> <b>TOPIK</b></p>
											</div>
										</div>
									</div>
									<div class="col-lg-6 ml-3">
										<div class="row"> 
											<div class="col-lg-11 offset-lg-1">
												<img src="<?= base_url() ?>/asset/images/icon/reply-icon.png" class="img-fluid">
											</div>
											<div class="col-lg-7 text-center mt-3">
												<p class="mb-0"><?= $forumData['num-post'] ?> <b>BALASAN</b></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<a href="<?= site_url() ?>/forum/" class="btn-orange-transparent">
									<b>Kunjungi Forum</b>
								</a>
								<br>
								<span class="text-grey">
									Untuk informasi selengkapnya
								</span>
							</div>
						</div>

						<!-- End Of Forum Info -->



						<!-- Feedback info -->
						<div class="col-lg-12 card card-custom mt-4 mb-4" id="feedbackStatus">
							<div class="card-body">
								<h4>Informasi <span class="text-orange"><b>Feedback</b></span></h4>
								<p class="text-grey">
									Informasi mengenai status feedback anda
								</p>
							</div>

							<div class="bg-orange box-orange text-white" >
								<div class="row">

									<div class="col-lg-4">
										<div class="row">
											<div class="col-lg-7 offset-lg-3 mb-2">
												<img src="<?= base_url() ?>/asset/images/icon/sent-icon.png" class="img-fluid">
											</div>
											<div class="col-lg-11 mt-2 text-right">
												<p class="mb-0"><?= $feedData['num-feed'] ?> <b>TERKIRIM</b></p>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="row"> 
											<div class="col-lg-6 offset-lg-3 mb-1">
												<img src="<?= base_url() ?>/asset/images/icon/pending-icon.png" class="img-fluid">
											</div>
											<div class="col-lg-12 mt-3 text-center">
												<p class="mb-0"><?= $feedData['num-pending'] ?> <b>PENDING</b></p>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="row"> 
											<div class="col-lg-5 offset-lg-3 mb-2">
												<img src="<?= base_url() ?>/asset/images/icon/checklist-icon.png" class="img-fluid">
											</div>
											<div class="col-lg-12 mt-2">
												<p class="mb-0"><?= $feedData['num-success'] ?> <b>DITANGGAPI</b></p>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="card-body">
								
								<?php if( empty($feedData['data-suggest']) AND empty($feedData['data-errorReport']) ) : ?>

									<div class="col-lg-12">
						
										<p class="text-grey">Belum Ada Feedback </p>

									</div>	

								<?php else : ?>

									<div class="row">

									<div class="col-lg-12">
										<p class="text-grey">Status Saran Terkirim</p> <hr>
									</div>

									<?php foreach( $feedData['data-suggest'] as $suggest ) : ?>

									<div class="col-lg-12 mt-2">

										<?php if( $suggest['status_feedback'] > 0 ) : ?>

										<div class="lb-warning card">
											<div class="card-body">

												<div class="row">
													<div class="col-lg-2">
														<img src="<?= base_url() ?>/asset/images/icon/pendingcircle-icon.png" class="img-fluid">
													</div>
													<div class="col-lg-10">
														<div class="row">
															<div class="col-lg-10">
																<h4>Saran dan Masukan</h4>
																<p>Feedback anda masih dalam antrian.</p>

										<?php else : ?>

											<div class="lb-success card">
											<div class="card-body">

												<div class="row">
													<div class="col-lg-2">
														<img src="<?= base_url() ?>/asset/images/icon/success-icon.png" class="img-fluid">
													</div>
													<div class="col-lg-10">
														<div class="row">
															<div class="col-lg-10">
																<h4>Saran dan Masukan</h4>
																<p>Feedback anda telah kami tanggapi.</p>


										<?php endif; ?>

																<div id="detail-suggest-<?= $suggest['id'] ?>" class="hide">
																	<p><?= $suggest['feed_description'] ?></p>
																</div>
																<a href="#!" class="btn-orange-transparent feed-more" data-target="detail-suggest-<?= $suggest['id'] ?>">Lihat Selengkapnya</a>
															</div>
															<div class="col-lg-2">
																<h5><b><?= date( 'd', strtotime($suggest['date']) ) ?></b></h5>
																<p><?= date( 'M', strtotime($suggest['date']) ) ?></p>
																<hr>

															</div>
														</div>
													</div>
												</div>


											</div>
										</div>
									</div>





									<?php endforeach; ?>

								</div>
							</div>


								<div class="card-body">

									<div class="col-lg-12">
										<p class="text-grey">Status Error Dilaporkan</p> <hr>
									</div>
								
								<div class="row">

									<?php foreach( $feedData['data-errorReport'] as $errReport ) : ?>

									<?php if( $errReport['status_feedback'] > 0 ) : ?>

									<div class="col-lg-12">
										<div class="lb-warning card">
											<div class="card-body">

												<div class="row">
													<div class="col-lg-2">
														<img src="<?= base_url() ?>/asset/images/icon/pendingcircle-icon.png" class="img-fluid">
													</div>
													<div class="col-lg-10">
														<div class="row">
															<div class="col-lg-10">
																<h4>Error Reporting</h4>
																<p>Feedback anda masih dalam antrian.</p>

									<?php else :  ?>

									<div class="col-lg-12">
										<div class="lb-success card">
											<div class="card-body">

												<div class="row">
													<div class="col-lg-2">
														<img src="<?= base_url() ?>/asset/images/icon/success-icon.png" class="img-fluid">
													</div>
													<div class="col-lg-10">
														<div class="row">
															<div class="col-lg-10">
																<h4>Error Reporting</h4>
																<p>Feedback anda telah kami tanggapi.</p>

									<?php endif; ?>

																<div id="detail-err-<?= $errReport['id'] ?>" class="hide">
																	<p><b><?= strtoupper($errReport['device_brand']) ?></b> <br>
																		<?= $errReport['brand_model'] ?> - <?= $errReport['os_version'] ?></p>

																	<p><?= $errReport['feed_description'] ?></p>
																</div>

																<a href="#!" class="btn-orange-transparent feed-more" data-target="detail-err-<?= $errReport['id'] ?>">Lihat Selengkapnya</a>
															</div>
															<div class="col-lg-2">
																<h5><b><?= date( 'd', strtotime($errReport['date']) ) ?>
																</b></h5>
																<p><?= date( 'M', strtotime($errReport['date']) ) ?>
																</p>
																<hr>
															</div>
														</div>
													</div>
												</div>


											</div>
										</div>
									</div>

									<?php endforeach; ?>

								<?php endif; ?>

								</div>



						</div>

						<!-- End Of Feedback Info -->

						<script>
							$(document).ready(function(){

								var notif = '<?= is_null($this->session->flashdata('valid_result')) ?>';
								if( notif == ''){
									$('#popup-ubahakun').modal('show');
								}

								$('.feed-more').click(function(){
									var target = $(this).attr('data-target');
									$('#' + target).toggle(500);

									if( $('#' + target).attr('class') == 'hide' ){

										$('#' + target).removeClass('hide');
										$('#' + target).addClass('show');
										$(this).html('Lebih Sedikit');
								
									} else {

										$('#' + target).removeClass('show');
										$('#' + target).addClass('hide');
										$(this).html('Lihat Selengkapnya');

									}
								});
							});
						</script>


					</div>
				</div>
			</div>
		</div>

			</div>
		</div>

</body>
</html>