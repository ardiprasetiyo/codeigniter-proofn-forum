<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/proofn.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/material-icons.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/css/chartist.min.css">
	<script src="<?= base_url() ?>/asset/js/jquery.js"></script>
	<script src="<?= base_url() ?>/asset/js/chartist.min.js"></script>
	<script src="<?= base_url() ?>/asset/js/bootstrap.js"></script>
	<script src="<?= base_url() ?>/asset/js/animatescroll.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>

		html, body{
			height: 100%;
		}

    	.popup{
    		position: fixed;
    		display: none;
    		z-index: 2;
    		width: 100%;
    		height: 100%;
    		background-color: rgba(0,0,0,0.1);
    	}

    	.content{
    		background-color: white;
			border: 1px solid rgb(235,235,235);
			box-shadow: -1px 0px 1px 0px #0000000f;	
    	}

    	.left-menu-bar{
    		border: 1px solid rgb(235,235,235);
			box-shadow: -1px 0px 1px 0px #0000000f;	
			border-left: none;
			border-top: none;
			border-bottom: none;
			top: 60px;
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

    	.top-menu-bar{
    		position: fixed;
    		width: 100%;
    		z-index: 2;
    	}

    	.proofn-color{
    		color: #fd8d2e;
    	}

    	.bg-proofn{
    		background-color: #fd8d2e;
    	}

    	.btn-white{
    		color: white;
    	}

    	.btn-white:hover{
    		color: rgba(255,255,255,0.8);
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
			background-size: cover;
			background-position: center;
			background-color: #f9f9f9;
			border: solid 1px rgba(0,0,0,0.15);
		}

		.user-icon .profile-pic{
			width: 45%;
			height: 100%;
		}

		.top-menu-bar{
			padding: 10px 0px 10px 0px;
			background-color: white;
			border: 1px solid rgb(235,235,235);
			box-shadow: -1px 0px 1px 0px #0000000f;
		}



		.text-grey{
			color: grey;
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

		.btn-proofn{
			background-color: rgb(253,141,46);
			color: white;
			transition: 0.5s;
		}

		.btn-proofn:hover{
			background-color: white;
			color: rgb(253,141,46);
		}

		/*Background Color*/

		.bg-proofn-gradient{
			background : linear-gradient(230deg, rgba(253, 141, 46, 1) 0%, rgba(255, 101, 46, 1) 100%);
		}

		.bg-the-red{
			background: rgb(228,43,66);
			background: linear-gradient(336deg, rgba(228,43,66,1) 0%, rgba(242,67,89,1) 100%);
		}

		.bg-royal-blue{
			background: rgb(25,106,226);
			background: linear-gradient(336deg, rgba(25,106,226,1) 0%, rgba(55,136,255,1) 100%);
		}

		.bg-kelly{
		
			background: rgb(50,204,136);
			background: linear-gradient(309deg, rgba(50,204,136,1) 0%, rgba(61,245,164,1) 100%);
		}

		#chart-visitor .ct-series-a .ct-line,
		#chart-visitor .ct-series-a .ct-point {
 		  stroke: rgba(50,204,136,1);
		} 

		#chart-member .ct-series-a .ct-line,
		#chart-member .ct-series-a .ct-point {
 		  stroke: rgba(25,106,226,1);
		} 

		#chart-feedback .ct-series-a .ct-line,
		#chart-feedback .ct-series-a .ct-point {
 		  stroke: rgba(228,43,66,1);
		} 

		.ct-vertical, .ct-horizontal{
			stroke: rgba(0,0,0,0.10);
		}

		.content-wrapper{
			padding-top: 80px;
		}


		::-webkit-scrollbar{
   			width:8px;
    		height:15px;
   			background: rgb(250, 250, 250);
   		}

     	::-webkit-scrollbar-thumb:vertical{
   			 width:8px;
   			 background-color: rgb(230, 230, 230);
   			 border-radius: 20px;
    	}

    	.dark-blue{
    		color: rgb(77, 84, 177);
    	}

    	.b-shadow {
			border: 1px solid rgb(235,235,235);
			box-shadow: -1px 0px 1px 0px #0000000f;	
		}

		.feedback-mgmt{
			border: 1px solid rgb(235,235,235);
			border-top: 0px;
			border-bottom: 0px;
			border-left: 0px;
		}

		.table-proofn{
			background-color: #fd8d2e; 
			color: white;
		}

		.btn-card{
			color: inherit;
			transition: 0.5s;
		}

		.btn-card:hover{
			text-decoration: none;
			color: grey;
			box-shadow: 0px 0px 10px 10px #0000000f;	
		}

	</style>
</head>
<body>

	
		<div class="top-menu-bar">
			<div class="col-lg-12"> 
			<div class="row">
				<div class="col-lg-1 mt-1 text-center">
					<img src="<?= base_url() ?>/asset/images/icon/proofn-icon.png" width="35px" class="img-fluid mx-auto d-block">
				</div>
				<div class="col-lg-10 proofn-color mt-1">
					<div class="title d-inline-block mr-2">
						<h5><i>Admin Panel</i></h5>
					</div>
					<div class="sub-title d-inline-block">
						<span class="text-grey">Proofn Community</span>
					</div>
				</div>
				<div class="col-lg-1 user-icon">
					<div class="profile-pic mx-auto" style="background-image: url('<?= base_url() ?>/asset/images/profilepic/no-pic.png')">
					</div>
				</div>
			</div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-1 left-menu-bar bg-proofn" style="position: fixed; height: 100%">
					<div class="container text-white">
						<div class="row text-center mx-auto d-block mt-4">
							<a href="#!" id="home-button" class="btn btn-white"><i class="material-icons" style="font-size: 35px;">home</i></a>
						</div>

						<div class="row text-center mx-auto d-block mt-4">
							<a href="#!" id="feedback-button" class="btn btn-white">
								<i class="material-icons mx-auto d-block" style="font-size:35px">feedback</i>
							</a>
						</div>


						<div class="row text-center mx-auto d-block mt-5">
							<a href="#!" id="member-button" class="btn btn-white">
								<i class="material-icons mx-auto d-block" style="font-size:35px">people</i>
							</a>
						</div>

						<div class="row text-center mx-auto d-block mt-5">
							<a href="#!" id="feedback-button" class="btn btn-white">
								<i class="material-icons mx-auto d-block" style="font-size:35px">settings_applications</i>
							</a>
						</div>


						<div class="row text-center mx-auto d-block mt-5 ">
							<a href="<?= site_url() ?>/admin/logout/" class="btn btn-white"><i class="material-icons" style="font-size: 35px;">exit_to_app</i></a>
						</div>

					</div>
				</div>
				<div class="offset-lg-1 col-lg-11 p-4mt-1 content-wrapper" id="main-content">
		