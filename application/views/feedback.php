<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/proofn.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/material-icons.css">
	<script src="<?= base_url() ?>/asset/js/jquery.js"></script>
	<script src="<?= base_url() ?>/asset/js/animatescroll.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.bg-feedright{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-feedback.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			min-height: 768px;
		}

		.left-side{
			margin-top: 20px;
		}

		.text-tangerine{
			color: rgb(253,140,46);
		}

		.tangerine{
			background-color: rgb(253,140,46);
		}

		.no-border{
			border: none;
		}

		.leftside-content{
			margin-top: 50px;	
			margin-bottom: 50px;
		}


		.no-link:hover{
			text-decoration: none;
			color: darkorange;
		}

		.no-link{
			color: inherit;
		}


		.andro-input{
			border-top: none;
			border-left: none;
			border-right: none;
			border-radius: 0px;
			margin-top: 10px;

		}

		.rightside{
			margin-top: 30px;
		}

		.feed-ill{
			margin-top: 50px;
		}

		.error-category{
			display: none;
		}

		.feed-input{
			width: 40px;
		}

		.hide{
			display: none;
		}

	</style>
</head>
<body>

		<?php $this->load->view('template/notif') ?>

	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-6 left-side">
				<div class="container">
				<div class="row">
					<div class="col-lg-2 ">
						<a href="beranda"><img src="<?= base_url() ?>/asset/images/icon/proofn-icon.png" class="img-fluid" width="60%"></a>
					</div>
					<div class="col-lg-4">
						<h3 class="text-tangerine"><b>Feedback</b></h3>
					</div>

				<div class="col-lg-9 offset-lg-1 leftside-content">
					<?php if( $this->session->flashdata('feed-notif') == TRUE ) : ?>
					<div class="text-danger"><?= $this->session->flashdata('feed-notif'); ?></div> <br>
					<?php endif; ?>

					<?= form_open_multipart('feedback/kirim'); ?>
					<span>Jenis Feedback</span>
					<br> <br>

					<div class="row">
						<div class="col-lg-6">
							<input type="radio" name="feed-type" id="suggest" value="1" checked> &nbsp
							<label for="suggest" >Saran dan Masukan</label>
						</div>

						<div class="col-lg-6">
							<input type="radio" name="feed-type" id="error-report" value="2"> &nbsp
							<label for="error-report"><i>Error Reporting</i></label>
						</div>
					</div>

					<div class="error-category">
						<br> <br>
						<p><i>Silahkan lengkapi beberapa form dibawah ini</i></p>
						<br>

						<span class="hide" id="label-device-brand">Masukan brand device yang anda gunakan. ( OPPO, Xiaomi, Samsung, iPhone )</span>
						<input type="text" name="device-brand" class="form-control andro-input" placeholder="Masukan brand device anda. ( OPPO, Xiaomi, Samsung, iPhone ) ">

						<br>

						<span class="hide" id="label-brand-model">Masukan jenis brand device anda  ( A3s, Redmi6Pro, S9, XS )</span>
						<input type="text" name="brand-model" class="form-control andro-input" placeholder="Masukan jenis brand device anda  ( A3s, Redmi6Pro, S9, XS )">

						<br>

						<span class="hide" id="label-os-version">Masukan versi Android/IOS anda ( Kitkat, Lolipop, iOS 11 ) </span>
						<input type="text" name="os-version" class="form-control andro-input" placeholder="Masukan versi Android/IOS anda ( Kitkat, Lolipop, iOS 11 ) ">

						<br> <br>
						<span>Error Seperti Apa Yang Anda Temukan?</span>
						<br> <br>

						<select name="err-category" class="form-control">
							<option value="0">Lainnya</option>
							<?php foreach( $category as $data ) : ?>
							<option value="<?= $data['id'] ?>"><?= $data['feed_categoryname'] ?></option>
							<?php endforeach; ?>
						</select>

						<br>

					</div>


					<script>
						$("[name*='feed-type']").click(function(){

							if( $(this).val() == 2 ){
								$('.error-category').show(200);
								$('.suggest-text').html("Saat membuka aplikasi proofn, saya hendak membuka fitur tambah kontak dengan mengklik icon kontak di pojok kanan bawah layar. Saat hendak memasukan periferal code tiba tiba aplikasi force close tanpa sebab");
							} else {
								$('.error-category').hide(200);
								$('.suggest-text').html("Saya harap adanya fitur videocall pada aplikasi proofn, karena hal itu merupakan ...")
							}
						});

						$('.andro-input').keyup(function(){
							var target = $(this).attr('name');
							$('#label-' + target).show(300);
						});

						$('.andro-input').focus(function(){

							if( $(this).val() != '' ){

							var target = $(this).attr('name');
							$('#label-' + target).show(300);
							
							}
						});

						$('.andro-input').focusout(function(){
							var target = $(this).attr('name');
							$('#label-' + target).hide(300);
						});

					</script>


					<br>
					<span>Jelaskan Kejadian / Saran</span>
					<br> <br>
					<i>Contoh:<br> <br>
					<span class="suggest-text">Saya harap adanya fitur videocall pada aplikasi proofn, karena hal itu merupakan ...  </i></span>
					<br> <br>
					<textarea class="form-control" name="feed-description" rows="5"></textarea>
					<br>

					<p>Masukan Screenshoot Gambar ( Opsional ) 	</p>

					<div class="row">
						<div class="col-lg-8">
							<input type="file" name="feed-attach" class="form-control">
						</div>
						<div class="col-lg-4">
							<button class="btn btn-danger tangerine  no-border">Kirim Tanggapan</button>
						</div>
					</div>
					</form>
				</div>

				</div>
			</div>
			</div>
			<div class="col-lg-6 bg-wrap bg-feedright">
				<div class="col-lg-12 text-right rightside text-white">
					<div class="row">
						<?php if( $this->session->has_userdata('userinfo') == TRUE ) : ?>
							<div class="col-lg-8 offset-lg-3">
								<h5><b><?= strtoupper($this->session->userdata('userinfo')['username']) ?></b></h5>
							</div>
						<?php else :  ?>

						<div class="col-lg-8 offset-lg-3">
							<a href="signup" class="no-link"><h5>SIGN-UP</h5></a>
						</div>

						<?php endif; ?>
						
						<div class="col-lg-1">
							<i class="material-icons">account_circle</i>
						</div>
					</div>
				</div>
				<div class="col-lg-7 offset-lg-2 feed-ill">
					<img src="<?= base_url() ?>/asset/images/illustration/feedback-illustration.png" class="img-fluid">
				</div>
			</div>
		</div>
	</div>

</body>
</html>