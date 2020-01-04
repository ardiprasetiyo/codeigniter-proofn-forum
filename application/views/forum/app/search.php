<?php if( !empty($searchResult) ) : ?>

<?php foreach( $searchResult as $thread ) : ?>

<div class="col-lg-12">


	<div class="card forum-list">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-8">
					<a href="<?= site_url() ?>/forum/topik/id/<?= $thread['id_thread'] ?>"><b><?= $thread['judul_thread'] ?></b></a> <br>
					<p class="color-grey"><i><?= date('d-M-Y H:i', strtotime($thread['tanggal_dibuat'])) ?></i></p>
						</div>
				<div class="col-lg-2">
					<span>Dibuat oleh</span><a href="<?= site_url() ?>/forum/member/id/<?= $thread['moderator'] ?>/<?= $thread['username'] ?>"> <?= strtoupper($thread['username']) ?></a>
					<p><?= $this->Forum_model->countPostByThread($thread['id_thread']) ?> Balasan</p>
						</div>
				<div class="col-lg-2">
					<a href="">Laporkan Topik</a>
				</div>
			</div>
		</div>
	</div>
	

</div>

<?php endforeach; ?>

<?php else : ?>

	<div class="col-lg-12">
		<p class="text-grey text-center mt-0 mb-0">Topik yang anda cari tidak ditemukan</p>
	</div>

<?php endif; ?>