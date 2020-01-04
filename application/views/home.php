<?php

echo hash("SHA256", "ardi1234");

die;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/proofn.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/material-icons.css">
	<script src="<?= base_url() ?>/asset/js/jquery.js"></script>
	<script src="<?= base_url() ?>/asset/js/animatescroll.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		


		.bg-wrap-1{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-proofn-1.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			min-height: 1160px;
		}

		.bg-wrap-2{
			background-image: url('<?= base_url() ?>/asset/images/background/bg-proofn-2.jpg');
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			min-height: 1160px;
			padding-top: 50px;
		}

		.people-image{
			margin-top: 90px;
		}

		.proofn-welcome{
			margin-top: 220px;
			font-size: 60px;
		}

		.proofn-subwelcome{
			line-height: 35px;
		}

		.btn-gabung{
			background-color: rgb(255, 158, 74);
			padding: 10px;
			color: white;
		}

		.btn-gabung:hover{
			background-color: rgb(255, 255, 255);
			color: rgb(255, 158, 74);
		}

		.proofn-feedback{
			margin-top: 60px;
			font-size: 60px;

		}

		.proofn-subfeedback{
			line-height: 35px;
		}

		.btn-static-orange{

			color: rgb(253, 141, 46);
			transition: 1s;

		}

		.btn-static-orange:hover{
			color: #ff4030;
			text-decoration: none;
		}

		.proofn-with-features{
			margin-top: 250px;
		}

		.proofn-panduan{
			margin-top: 350px;
			font-size: 70px;
		}

		.proofn-subpanduan{
			line-height: 35px;
		}

		::-webkit-scrollbar{
   			width:8px;
    		height:15px;
   			background: rgb(250, 250, 250);
   		}

     	::-webkit-scrollbar-thumb:vertical{
   			 width:8px;
   			 background-color: rgb(253, 141, 46);
   			 border-radius: 20px;
    	}

    	.proofn-forum{
    		margin-top: 200px;
    		font-size: 60px;
    	}

    	.proofn-subforum{
    		line-height: 35px;
    	}

    	.navbar-wrapper{
    		position: fixed;
    		background-color: rgba(0,0,0,0);
    		padding: 20px;
    	}

    	.right-navbar a{
    		margin-left: 20px;
    		color: white;
    	}

    	.right-navbar a:first-child{
    		margin-left: 50px;
    	}

    	.left-navbar a:hover{
    		text-decoration: none;
    	}

    	.left-navbar a{
    		color: black;
    	}

    	.proofn-color{
    		color: rgb(253, 141, 46);
    	}

    	.right-navbar a:hover{
    		text-decoration: none;
    	}

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


	</style>
</head>
<body>

	<?php $this->load->view('template/notif'); ?>


	<div class="navbar-wrapper">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6 left-navbar">
					<a href=""><img src="<?= base_url() ?>asset/images/icon/proofn-icon.png" class="img-fluid proofn-icon" width="7%"><span class="proofn-color"><b>Proofn</b></span> Community</a>
				</div>
				<div class="col-lg-5 offset-lg-1 right-navbar">
					<a href="#header" class="scrolllink">Home</a>
					<a href="#feedback" class="scrolllink">Feedback</a>
					<a href="#guide" class="scrolllink">User Manual</a>
					<a href="#forum" class="scrolllink">Forum</a>

					<?php if( $this->session->has_userdata('userinfo') ) : ?>
						<a href="<?= site_url() ?>/profile/"><b>Akun Saya</b></a>
					<?php else :  ?>

						<a href="<?= site_url() ?>/signup/"><b>Daftar</b></a>

					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12 bg-wrap-1" id="header">
		<div class="row">
			<div class="col-lg-4">
				<div class="container">
					<h1 class="proofn-welcome">Komunitas <br> <b>Proofn</b></h1>
					<br>
					<h4 class="proofn-subwelcome">Terhubung dengan seluruh pengguna Proofn dalam satu komunitas.</h4>
					<br>
					<?php if( !$this->session->has_userdata('userinfo') ) : ?>
						<a href="<?= site_url() ?>/signup" class="btn btn-gabung"><b>GABUNG SEKARANG</b></a>
					<?php else : ?>
						<a href="<?= site_url() ?>/profile/" class="btn btn-gabung"><b>BUKA PANEL AKUN</b></a>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-lg-8">
				<img src="<?= base_url() ?>/asset/images/illustration/people-say-illustration.png" class="img-fluid people-image">
			</div>
		</div>
	</div>

	<div class="col-lg-12" id="feedback">
		<div class="row">
			<div class="col-lg-6">
				<img src="<?= base_url() ?>/asset/images/illustration/people-with-mail.png" class="img-fluid">
			</div>
			<div class="col-lg-4 offset-lg-1">
				<h1 class="proofn-feedback">Feedback</h1>
				<br>
				<h4 class="proofn-subfeedback">Berkontribusi membangun sistem komunikasi kami menjadi lebih baik melalui pengalaman anda dalam menggunakan aplikasi kami</h4>
				<br>
				<a href="<?= site_url() ?>/feedback" class="btn-static-orange"><b>KIRIM TANGGAPAN</b></a>
			</div>

		</div>
	</div>

	<div class="col-lg-12 bg-wrap-2" >
		<div class="row">
			<div class="col-lg-5 offset-lg-1" >
				<div class="container" id="guide">
					<h1 class="proofn-panduan">Panduan</h1>
					<br>
					<h4 class="proofn-subpanduan">Banyak fitur menarik yang bisa anda explorasi kami akan memandu anda untuk menggunakan berbagai fitur menarik pada aplikasi kami</h4>
					<br>
					<a href="" class="btn-static-orange"><b>BUKA PANDUAN</b></a>
				</div>
			</div>
			<div class="col-lg-4">
				<img src="<?= base_url() ?>/asset/images/illustration/proofn-with-features.png" class="img-fluid proofn-with-features">
			</div>
		</div>
	</div>

	<div class="col-lg-12" id="forum">
		<div class="row">
			<div class="col-lg-6">
				<img src="<?= base_url() ?>/asset/images/illustration/chat-popup.png" class="img-fluid">
			</div>
			<div class="col-lg-5 text-right">
				<h1 class="proofn-forum">Forum</h1>
				<br>
				<h4 class="proofn-subforum">Bergabung bersama anggota proofn diluarsana untuk membantu kami mengembangkan sistem yang sudah ada.</h4>
				<br>
				<a href="<?= site_url() ?>/forum" class="btn-static-orange"><b>KUNJUNGI FORUM</b></a>
			</div>
		</div>
	</div>
	<script>

		$(document).scroll(function(){

			if ( $(document).scrollTop() < 170 ){

				$('.navbar-wrapper').css({'background-color' : 'rgba(0,0,0,0)', 'box-shadow' : 'none'});
				$('.right-navbar a').css('color', 'white');


			} else {

				$('.navbar-wrapper').css({'background-color' : 'rgb(255, 255, 255)', 'box-shadow' : '#00000026 0px 0px 10px 1px'});
				$('.right-navbar a').css('color', 'black');
			}

		});


		$('.scrolllink').click(function(){
			var target = $(this).attr('href');
			$(target).animatescroll({scrollSpeed:2000,easing:'easeOutBack'});

		console.log(history.length);

		});


	</script>
</body>
</html>