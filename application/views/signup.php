<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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
		body{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-signup.jpg');
			background-size: cover;
		}

		.login-wrap{
			margin-top: 50px;
			margin-bottom: 50px;
		}

		.proofn-icon-login{
			margin-top: 50px;
		}

		.font-grey{		

			color: rgb(117, 117, 117);
		}

		.btn-rounded{
			border-radius: 30px;
			padding: 5px 20px 5px 20px;
			border: none;
		}

		.login-section{
			margin-top: 120px;
		}

		.footer{
			margin-bottom: 30px;
		}

		.bg-darknavy{
			background-color: rgb(77, 84, 117);
		}

		.bg-tangerine{
			background-color: rgb(253,140, 46);
		}




	</style>
</head>
<body>

	<!-- The Modal -->
<div class="modal fade" id="notifModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pemberitahuan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
			<?php if($this->session->flashdata('login_report') == TRUE) : ?>
									
				<div class="text-danger">	
					<p><?= $this->session->flashdata('login_report') ?></p>
				</div>

			<?php endif; ?>

			<?php if($this->session->flashdata('signin_report') == TRUE) : ?>
									
				<div class="text-danger">	
					<p><?= $this->session->flashdata('signin_report') ?></p>
				</div>

			<?php endif; ?>

    	  </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<a href="#!" class="btn bg-tangerine text-white" data-dismiss="modal">Tutup</a>
      </div>

    </div>
  </div>
</div>


	<div class="col-lg-12 proofn-icon-login">
		<div class="col-lg-2 offset-lg-5">	
			<div class="container">	
				<a href="<?= site_url() ?>/beranda/"><img  src="<?= base_url() ?>/asset/images/icon/proofn-invert-icon.png" class="img-fluid"></a>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="col-lg-10 offset-lg-1 login-wrap">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 login-section">
							<div class="container">
								<h1>LOGIN</h1>
								<p>Masuk menggunakan akun anda</p>

								<br>	

								<?= form_open('signup/login'); ?>

								<input type="text" name="username" class="form-control" placeholder="Masukan Username Anda">
								<br>
								<input type="password" name="password" class="form-control" placeholder="Masukan Password Anda">
								<br>
								<button type="submit" name="submit-login" class="form-control btn btn-success btn-rounded bg-tangerine">Login</button>
								</form>

							</div>
						</div>

						<div class="col-lg-6">
							<div class="container">
								<h1 class="text-right">DAFTAR</h1>
								<p class="text-right">Bergabung bersama pengguna Proofn</p>
								<br>

								<br>	

								<?= form_open('signup/daftar/'); ?>

								<input type="text" name="new-username" class="form-control" placeholder="Tentukan Username"> <br>
								<input type="password" name="new-password" class="form-control" placeholder="Tentukan Password"> <br>
								<input type="email" name="new-email" class="form-control" placeholder="Masukan Email"> <br>

								<div class="row">

									<div class="col-lg-6">
										<span class="font-grey">Jenis Kelamin Anda</span>
										<br> <br>
										<select name="new-gender" class="form-control">
											<option value="pria">Pria</option>
											<option value="wanita">Wanita</option>
										</select>
									</div>

									<div class="col-lg-6">
										<span class="font-grey">Tanggal Lahir Anda</span>
										<br> <br>
										<input type="date" name="new-birthdate" class="form-control">
									</div>

								</div>
								<br>
								<span class="font-grey">Bio Singkat Tentang Anda</span>
								<br> <br>
								<textarea class="form-control" name="new-bio" rows="5"></textarea>
								<br>
								<button type="submit" name="submit-signin" class="btn btn-info btn-rounded bg-darknavy">Daftar</button>			
								</div>

							</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 text-center footer">
			<p>&copy Internship <b>	SMKN 3 Bandung</b> </p>
		</div>

		<script>
			$(document).ready(function(){
				var notif =  '<?= is_null($this->session->flashdata("login_report")) ?>';
				var signupStatus = '<?= is_null($this->session->flashdata("signin_report")) ?>';
				console.log(signupStatus);
				if( notif == '' || signupStatus == ''){
					$('#notifModal').modal('show');
				}
			});
		</script>



</body>
</html>