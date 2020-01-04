<h4>Aktivitas Topik Saya</h4>
<br>

<div class="col-lg-12 card-soft light-shadow">
	<div class="container">
		<div class="col-lg-12">
			
			<h5>Topik List</h5>
			<hr>
			<br>

			<?php if( !$threadData ) : ?>

				<div class="row">
					<div class="col-lg-12"></div>
					<div class="col-lg-8 offset-lg-2 text-center">
						<h3>Belum Ada Topik</h3>
						<p>Mulai buat topik pertama anda sekarang!</p>
					</div>
				</div>

			<?php else : ?>

			<?php foreach( $threadData as $thread ) : ?>

			<?php if( $this->Forum_model->getLatestPostByThreadId($thread['id_thread']) == TRUE ) : ?>

			<?php foreach( $this->Forum_model->getLatestPostByThreadId($thread['id_thread']) as $post ) : ?>

				<div class="card forum-list">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<a href="<?= site_url() ?>/forum/topik/id/<?= $thread['id_thread'] ?>"><b><?= $thread['judul_thread'] ?></b></a>
							<p class="color-grey">Pada <b><i><?= date('d M Y H:i', strtotime($thread['tanggal_dibuat'])) ?></i></b></p>
						</div>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-8">
									<span> Balasan Terakhir Oleh </span> <a href="<?= site_url() ?>/forum/member/id/<?= $post['id'] ?>/<?= $post['username'] ?>"><?= strtolower($post['username']) ?></a> 
									<br>
									<p><b><?= $this->Forum_model->countPostByThread($thread['id_thread']) ?></b> <span class="color-grey">Post</span></p>
								</div>
								<div class="col-lg-4">
									Terakhir pada <br> <?= date('d M Y - H:i', strtotime($post['tanggal_post'])) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php endforeach; ?>

			<?php else : ?>

				<div class="card forum-list">
					<div class="card-body">
						<div class="row">

							<div class="col-lg-6">
								<a href="<?= site_url() ?>/forum/topik/id/<?= $thread['id_thread'] ?>"><b><?= $thread['judul_thread'] ?></b></a>
								<p class="color-grey">Pada <b><i><?= date('d M Y H:i', strtotime($thread['tanggal_dibuat']))?>
								</i></b></p>
							</div>

							<div class="col-lg-6 text-center">
								<div class="col-lg-12 mt-3">
									<p>Belum Ada Perkembangan Aktivitas Pada Topik Ini</p>
								</div>
							</div>

						</div>
					</div>
				</div>

			<?php endif; ?>

			<?php endforeach; ?>

		<?php endif; ?>

		</div>
	</div>
</div>