<?php if( $highestVotes['votes'] > 0 ) : ?>

<h5>Votes Terbanyak</h5>

<hr>
<br>


<div class="col-lg-12 card-soft light-shadow">
		<div class="container">
			<div class="row">
				<div class="col-lg-1 offset-lg-1">
					<div class="profile-pic conversation" style="background-image: url('<?= $highestVotes['profile_picture'] ?>');"></div>
				</div>

				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-12 mt-1">
							<h6><?= strtoupper($highestVotes['username']) ?></h6>
							<p class="color-grey">Pada <b><?= date('d M Y H:i', strtotime($highestVotes['tanggal_post'])) ?></b></p>
							<p>Mengatakan :</p>
						</div>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<?= $highestVotes['isi_post'] ?>
								</div>
							</div>
						</div>
					</div>
					<br>
					<a href="#!" data-idpost="<?= $highestVotes['id_post'] ?>" class="float-right reply-post">Balas Komentar</a>
					<span><?= $highestVotes['votes'] ?> Vote</span>
				</div>


			</div>
		</div>
	</div>
</div>

<hr>
<br>

<?php endif; ?>


<?php foreach( $dataPost as $post ) : ?>

	<?php if( $post['status_post'] == 1 ) : ?>

	<div class="col-lg-12 card-soft light-shadow">
		<div class="container">
			<div class="row">
				<div class="col-lg-1 offset-lg-1">
					<div class="profile-pic conversation" style="background-image: url('<?= $post['profile_picture'] ?>');"></div>
				</div>



				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-12 mt-1">
							<h6><?= strtoupper($post['username']) ?></h6>

							<?php if( $post['id_post'] == $highestVotes['id_post'] ) : ?>
								<span class="color-grey"><b>( Vote Terbanyak )</b></span>
							<?php endif; ?>

							<?php if( $this->Forum_model->markedPost($dataThread[0]['id'], $post['id_post']) ) : ?>
								<span class="orange-proofn"> <b>( Jawaban Terbaik )</b></span>
								<br> <br>
							<?php endif; ?>

							<p class="color-grey">Pada <b><?= date('d M Y H:i', strtotime($post['tanggal_post'])) ?></b></p>
							<p>Mengatakan :</p>
						</div>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body" id="post-<?= $post['id_post']?>">
									<?= $post['isi_post'] ?>
								</div>
							</div>
						</div>
					</div>
					<br>		
					<?php if( $this->session->has_userdata('userinfo') == TRUE ) : ?>

						<span ><?= $this->Forum_model->countVotesByPost($post['id_post']) ?></span>

							<?php if( $this->session->userdata('userinfo')['id'] == $post['id'] ) : ?>

								<a href="#!" data-toggle="modal" data-target="#myModal" data-id="<?= $post['id_post'] ?>" data-idthread="<?= $dataThread[0]['id_thread'] ?>" class="float-right ml-4 hapus-balasan">Hapus Balasan</a>

							<?php endif; ?>

						<?php if( $this->session->userdata('userinfo')['id'] != $post['id'] ) : ?>

							<?php if( $this->Forum_model->hasVote( $this->session->userdata('userinfo')['id'], $post['id_post'] ) == 0 ) : ?>

							<?php if( $this->session->userdata('userinfo')['id'] == $dataThread[0]['id'] ) : ?>
							<span> Vote </span>
							<a href="#!" class="markAsBest" data-id="<?= $post['id_post'] ?>" data-idthread="<?= $dataThread[0]['id_thread'] ?>">&nbsp Tandai Jawaban Terbaik</a>

							<?php else :  ?>

								<a href="#!" class="vote-post" data-id="<?= $post['id_post'] ?>" data-idthread="<?= $dataThread[0]['id_thread'] ?>">Vote</a>

							<?php endif; ?>


							<?php else : ?>

								<a href="#!" class="unvote-post" data-id="<?= $post['id_post'] ?>" data-idthread="<?= $dataThread[0]['id_thread'] ?>">Unvote</a>

							<?php endif; ?>



						<?php else : ?>


							<span> Vote</span>

						<?php endif; ?>

						<a href="#!" data-idpost="<?= $post['id_post'] ?>" data-userpost="<?= $post['username'] ?>" class="float-right reply-post">Kutip Balasan</a>

					<?php endif; ?>


				</div>
			</div>
		</div>
	</div>

	<?php else : ?>

		<div class="col-lg-12 card-soft light-shadow">

			<div class="container">
			<div class="row">
				<div class="col-lg-1 offset-lg-1">
					<div class="profile-pic conversation" style="background-image: url('<?= $post['profile_picture'] ?>');"></div>
				</div>

				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-12 mt-1">
							<h6><?= strtoupper($post['username']) ?></h6>
							<?php if( $post['id_post'] == $highestVotes['id_post'] ) : ?>
								<span class="color-grey"><b>( Jawaban Terbaik )</b></span>
								<br> <br>
							<?php endif; ?>
							<p class="color-grey">Pada <b><?= date('d M Y H:i', strtotime($post['tanggal_post'])) ?></b></p>
							<p>Mengatakan :</p>
						</div>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<p class="color-grey"><i>Balasan Telah Dihapus Oleh Pengguna</i></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>

		</div>

	<?php endif; ?>

<?php endforeach; ?>

<script>
	$(document).ready(function(){
			$('.reply-post').click(function(){
				var idPost = $(this).attr('data-idpost');
				var userTarget = $(this).attr('data-userpost');
				var targetPost = '#post-' + idPost;
				var dataBefore = CKEDITOR.instances['post-create'].getData();

				var post =  $(targetPost).html() + '( Balasan : ' + userTarget + ' )';
				CKEDITOR.instances['post-create'].setData(dataBefore + post);
				$('#balas-thread').animatescroll({scrollSpeed:2000,easing:'easeOutBack'});
			});


			$('.vote-post').click(function(){
				if( $(this).attr('class') != '' ){
					$(this).removeClass('vote-post');
					$(this).html('<span class="color-grey">Vote</span>');
					var idPost = $(this).attr('data-id');
					var idThread = $(this).attr('data-idthread');
					var sent = $.post({
					url: "<?= site_url() ?>/forum/topik/submit-vote/post/" + idPost + "/thread/" + idThread
				});
				} else {
					alert('Sedang Diproses');
				}

			});

			$('.markAsBest').click(function(){
				if( $(this).attr('class') != '' ){
					$(this).removeClass('markAsBest');
					$(this).html('<span class="color-grey">Menandai</span>');
					var idPost = $(this).attr('data-id');
					var idThread = $(this).attr('data-idthread');
					var sent = $.post({
					url: "<?= site_url() ?>/forum/topik/markAnswer/post/" + idPost + "/thread/" + idThread
				});
					$('#balasan').load('<?= site_url() ?>/app/thread/balasan/<?= $dataThread[0]["id_thread"] ?>');
				} else {
					alert('Sedang Diproses');
				}

			});

			$('.unvote-post').click(function(){
				if( $(this).attr('class') != '' ){
				$(this).removeClass('unvote-post');
				$(this).html('<span class="color-grey">Unvote</span>');
				var idPost = $(this).attr('data-id');
				var idThread = $(this).attr('data-idthread');
				var sent = $.post({
					url: "<?= site_url() ?>/forum/topik/unvote/post/" + idPost + "/thread/" + idThread
				});

				} else {
					alert('Sedang Diproses');
				}

			});


			$('.hapus-balasan').click(function(){
				var idPost = $(this).attr('data-id');
				var idThread = $(this).attr('data-idthread');
				$('.modal-title').html('Hapus Balasan');
				$('.modal-body').html('Anda yakin ingin menghapus balasan ini?');
				$('.modal-footer').html('<a href="<?= site_url() ?>/forum/topik/hapus-balasan/id/' + idPost +'/' + idThread +'/" class="btn btn-proofn">Ya</a> <a href="#!" class="btn btn-navy" data-dismiss="modal"">Tidak</a>');
			});
	});
</script>