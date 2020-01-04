<!DOCTYPE html>
<html>
<head>
	<title><?= $pageTitle ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/proofn.css">


	<script src="<?= base_url() ?>/asset/js/jquery.js"></script>
	<script src="<?= base_url() ?>/asset/js/bootstrap.js"></script>
	<script src="<?= base_url() ?>/asset/js/animatescroll.js"></script>
	<script src="<?= base_url(); ?>asset/plugin/ckeditor/ckeditor.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.bg-forum{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-forum.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			padding: 40px 0px 40px 0px; ;
		}

		body{
			background-color: #fbfbfb;
		}

		.color-grey{
			color: grey;
		}

		.forum-category:first-child{
			margin-top: 0px;
			margin-bottom: 20px;
		}

		.forum-category{
			margin-top: 50px;
			margin-bottom: 20px;
		}

		.light-shadow{
			box-shadow: 0px 1px 1px 0px #00000029;
		}

		.menu-wrapper{
			padding: 10px 0px 10px 0px;
			background-color: #fdfdfd;
		}

		.menu-link{
			margin-right: 30px;
			color: inherit;
		}

		.menu-link:hover{
			text-decoration: none;
		}

		.content-wrapper{
			padding-top: 30px;
		}

		.forum-wrapper{
			padding: 20px 0px 20px 0px;
			border: solid 1px;
			border-left: none;
			border-right: none;
			border-top-color: #00000021;
			border-bottom-color: #00000021;
			max-height: 400px;
			overflow: auto;
		}

		.forum-list:first-child{
			margin-top: 0px;
			margin-bottom: 10px;
		}

		.forum-list{
			margin-top: 10px;
		}


		.card-soft{
			border-radius: 20px;
			background-color: white;
			padding: 20px;
			padding: 40px 0px 40px 0px;
			margin-bottom: 40px;
		}

		.profile-pic{
			border-radius: 200px;
			overflow: hidden;
			padding: 80px;
			background-size: cover;
			background-position: center;
			background-color: #f9f9f9;
			border: solid 1px rgba(0,0,0,0.1);
		}

		.conversation{
			padding: 30px;
		}

		.btn-proofn{
			background-color: rgb(253, 141, 46);
			color: white;
			transition: 0.5s;
		}

		.btn-proofn:hover{
			background-color: white;
			color: rgb(253, 141, 46);
		}

		.btn-navy{
			background-color: rgb(77, 84, 117);
			color: white;
			transition: 0.5;
		}

		.btn-navy:hover{
			background-color: white;
			color: rgb(77, 84, 117);
			transition: 0.5;
		}

		.orange-proofn{
			color: rgba(253, 141, 46, 1);
		}



	</style>
</head>
<body>

	<div class="col-lg-12 bg-forum">
		<div class="container">
			<div class="row">
				<div class="col-lg-1 offset-lg-4">
					<img src="<?= base_url() ?>asset/images/icon/proofn-invert-icon.png" class="img-fluid">
				</div>
				<div class="col-lg-6">
					<h1 class="text-white"><b>Proofn</b> Forums</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 light-shadow menu-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<a href="<?= site_url() ?>/beranda/" class="menu-link">Beranda</a>
					<a href="<?= site_url() ?>/forum/" class="menu-link">Forum</a>

					<?php if( $this->session->has_userdata('userinfo') ) : ?>

					<a href="<?= site_url() ?>/forum/member/id/<?= $this->session->userdata('userinfo')['id'] ?>/<?= $this->session->userdata('userinfo')['username'] ?>" class="menu-link">Profile Saya</a>

					<a href="<?= site_url() ?>/forum/mythread/" class="menu-link">Thread Saya</a>

					<?php else : ?>

					<a href="<?= site_url() ?>/signup/" class="menu-link">Daftar Akun</a>

					<?php endif; ?>

					
				</div>

				<div class="col-lg-3 offset-lg-3">
					<a href="<?= site_url() ?>/forum/member/id/<?= $this->session->userdata('userinfo')['id'] ?>/<?= $this->session->userdata('userinfo')['username'] ?>" class="menu-link"><?= strtoupper($this->session->userdata('userinfo')['username']) ?></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12 content-wrapper">
		<div class="container">