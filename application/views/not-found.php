<!DOCTYPE html>
<html>
<head>
	<title>404 - Not Found</title>
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
			background-image: url('<?= base_url() ?>/asset/images/background/bg-notfound.jpg');
			background-size: cover;
			background-repeat: no-repeat;
		}


		.text-grey{
			color: grey;
		}

		.text-orange{
			color: rgb(253,141,46);
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

		.wrapper{
			margin-top: 150px;
		}

		.desc h1{
			font-size: 75px;
			line-height: 65px;
		}

	</style>
</head>
<body>

<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-1 notfound-ill">
				<img src="<?= base_url() ?>/asset/images/illustration/notfound-illustration.png" class="img-fluid">
			</div>
			<div class="col-lg-5 desc mt-4">
				<h1>OOPS! Halaman</h1>
				<h2>Tidak Ditemukan</h2>
				<p class="text-grey">
					Alamat yang anda akses masukan tidak sesuai atau alamat yang anda tuju rusak.
				</p>
				<a href="<?= site_url() ?>/beranda/" class="btn btn-proofn"><b>Kembali Ke Beranda</b></a>
			</div>
		</div>
	</div>
</div>

</body>
</html>