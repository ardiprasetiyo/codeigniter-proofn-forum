<div class="data">
<?php if( !$kategoriForum ) : ?>

	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h3>Belum Ada Forum</h3>
						<p>Sepertinya forum belum tersedia saat ini</p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php foreach( $kategoriForum as $kategori ) : ?>

	<h3 class="forum-category"><?= $kategori['judul_kategori'] ?></h3>

	<div class="card">
		<div class="card-body">
			<p>List Topik</p>
			<div class="row">
				<div class="col-lg-5">
					<input type="text" name="search" class="form-control search-<?= $kategori['id_kategori'] ?>" placeholder="Cari Topik">
				</div>

				<script>

				$(document).ready(function(){


					var forumContent = $('.forum-wrap-<?= $kategori['id_kategori'] ?>').html();


					$('.search-<?= $kategori['id_kategori'] ?>').keyup(function(){

						var key = $(this).val();
						var keyword = key.replace(' ', '%20');

						$('.forum-wrap-<?= $kategori['id_kategori'] ?>').html('<img src="<?= base_url() ?>/asset/images/loading.gif" class="img-fluid mx-auto d-block"/> <p class="text-center"><b>Sedang Mencari Topik ... </b></p>');

						if( keyword != '' ){
							$('.forum-wrap-<?= $kategori['id_kategori'] ?>').load('<?= site_url() ?>/app/forum/search/category/<?= $kategori['id_kategori'] ?>?keyword=' + keyword);
						} else {
							$('.forum-wrap-<?= $kategori['id_kategori'] ?>').html(forumContent);
						}

					});

				});

				</script>

				<div class="col-lg-7">
					<a href="<?= site_url() ?>/forum/createthread/kategori/<?= $kategori['id_kategori'] ?>" class="float-right">Buat Topik</a>
				</div>
			</div>
			<br>
			<div class="forum-wrapper forum-wrap-<?= $kategori['id_kategori'] ?>">


			<?php if( !$this->Forum_model->getAllThreadByKategori($kategori['id_kategori']) ) : ?>

				<div class="card forum-list">
					<div class="card-body text-center">
						<h3>Belum Ada Topik</h3>
						<p>Jadilah yang pertama membuat topik di forum ini</p>
					</div>
				</div>

			<?php endif; ?>

			<?php foreach( $this->Forum_model->getAllThreadByKategori($kategori['id_kategori']) as $thread ) : ?>


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

			<?php endforeach; ?>
			

			</div>

		</div>
	</div>

	<?php endforeach; ?>

</div>

<script>
	
</script>