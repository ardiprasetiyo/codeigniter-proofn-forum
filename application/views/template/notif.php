<div class="wrapper popup">
		<div class="col-lg-6 offset-lg-3 card-popup card">
			<div class="card-body">

				<?php if($this->session->flashdata('notification')) : ?>
				<div class="row">
					<div class="col-lg-6 offset-lg-1">
						<br>
						<h1><b><?= $this->session->flashdata('notification')['notif_title'] ?></b></h1>
						<br>
						<p><?= $this->session->flashdata('notification')['notif_text'] ?></p>
						<br>
						<a href="#!" id="close_btn" class="btn btn-static-orange"><b>Tutup</b></a>
					</div>

					<?php if( $this->session->flashdata('notification')['config'] == TRUE) : ?>

					<div class="col-lg-<?= $this->session->flashdata('notification')['config']['width'] ?>">
						<img src="<?= $this->session->flashdata('notification')['notif_image'] ?>" class="img-fluid">
					</div>

					<?php else :  ?>

					<div class="col-lg-3">
						<img src="<?= $this->session->flashdata('notification')['notif_image'] ?>" class="img-fluid">
					</div>

					<?php endif; ?>


				</div>

					<script>
						$('.wrapper').fadeIn(500);
						$('#close_btn').click(function(){
							$('.popup').fadeOut(500);
						});
					</script>

				<?php endif; ?>

			</div>
		</div>
	</div>