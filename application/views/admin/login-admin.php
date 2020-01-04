<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
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
			background-image: url("<?= base_url() ?>/asset/images/background/bg-admin-login.jpg");
			background-position: top;
			background-size: cover;
		}

		.admin-panel{
			padding: 30px;
		}

		.admin-panel input{
			margin-bottom: 15px;
		}

		.admin-panel button{
			margin-top: 20px;
			border-radius: 20px;
			background-color: rgb(253,141,46);
			color: white;
		}

		.admin-panel button:hover{
			background-color: white;
			color: rgb(253,141,46);
		}


		.admin-wrapper{
			margin-top: 130px;
		}

		.btn-inherit{
			color: inherit;
		}
	</style>
</head>
<body>

	<?php //var_dump($this->session->flashdata('login_status')); ?>
	<div class="container admin-wrapper">
		<div class="row">
			<div class="col-lg-6">
				<img src="<?= base_url() ?>/asset/images/illustration/admin-illustration.png" class="img-fluid">
			</div>
			<div class="col-lg-5">
				<div class="card ml-5 mt-5">
					<div class="card-body admin-panel">
						<h3>Selamat Datang <b>Admin</b></h3>
						<p>Silahkan Login Terlebih Dahulu</p>
						<br>
						<?= form_open( site_url() . 'admin/login_auth/' ); ?>
						<input type="text" name="username" class="form-control form-control-sm" placeholder="Masukan Username " required>
						<input type="password" name="password" class="form-control form-control-sm" placeholder="Masukan Password" required>
						<button type="submit" name="submit" class="form-control btn"> Masuk </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>