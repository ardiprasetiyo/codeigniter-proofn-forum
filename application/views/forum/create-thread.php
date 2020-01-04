<div class="col-lg-12 card-soft light-shadow">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<h4>Buat Topik</h4>
				<p>Buat Topik Baru Anda</p>

				<?php if( $this->session->flashdata('valid_err') == TRUE ) : ?>

					<div class="card bg-danger text-white">
						<div class="card-body">
							<?= $this->session->flashdata('valid_err'); ?>	
						</div>
					</div>

				<?php endif; ?>

				<br>

				<?= form_open(site_url() . '/forum/createthread/post/'); ?>

				<p class="color-grey">Judul Topik</p>
				<input type="text" name="judul-thread" class="form-control" placeholder="Masukan judul thread anda">

				<br>

				<p class="color-grey">Kategori Forum</p>
				<select name="kategori-forum" class="form-control">
					<?php foreach( $kategori['listKategori'] as $data ) :?>
							<?php if( $data['id_kategori'] == $kategori['selectedKategori'] ) : ?>
								<option selected="selected" value="<?= $data['id_kategori'] ?>"><?= $data['judul_kategori'] ?></option>
							<?php else : ?>
								<option value="<?= $data['id_kategori'] ?>"><?= $data['judul_kategori'] ?></option>
							<?php endif; ?>

					<?php endforeach ?>
				</select>

				<br>

				<p class="color-grey">Isi Topik</p>
				<textarea name="deskripsi-thread" id="thread-editor" class="form-control" rows="10"></textarea>
				<script>
					CKEDITOR.replace('thread-editor');
				</script>

				<br>

				<button type="submit" name="buat-thread
				" class="btn btn-proofn">Buat Topik</button>

				<a href="../../" class="btn btn-navy">Kembali</a>

				</form>

			</div>
		</div>
	</div>
</div>