	<!-- The Modal -->
<div class="modal fade" id="notifModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pemberitahuan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
			<?php if( $this->session->flashdata('valid_err') == TRUE) : ?>

					<p class="text-danger"><?= $this->session->flashdata('valid_err'); ?></p>

			<?php endif; ?>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<a href="#!" class="btn btn-proofn" data-dismiss="modal">Tutup</a>
      </div>

    </div>
  </div>
</div>
</div>

<script>
			$(document).ready(function(){
				var notif =  '<?= is_null($this->session->flashdata('valid_err')) ?>';
				if( notif == ''){
					$('#notifModal').modal('show');
				}
			});

</script>


<div class="col-lg-12 card-soft light-shadow">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<h4>Edit Topik</h4>
				<p>Buat Topik Baru Anda</p>

				<br>

				<?= form_open(site_url() . '/forum/updatethread/'); ?>

				<?php foreach( $dataThread as $thread ) : ?>

				<p class="color-grey">Judul Topik</p>
				<input type="text" name="judul-thread" class="form-control" placeholder="Masukan judul thread anda" value="<?= $thread['judul_thread'] ?>" >

				<br>

				<p class="color-grey">Kategori Forum</p>
				<select name="kategori-forum" class="form-control">
					<?php foreach( $kategori['listKategori'] as $data ) :?>
							<?php if( $data['id_kategori'] == $kategori['kategoriSelected'] ) : ?>
								<option selected="selected" value="<?= $data['id_kategori'] ?>"><?= $data['judul_kategori'] ?></option>
							<?php else : ?>
								<option value="<?= $data['id_kategori'] ?>"><?= $data['judul_kategori'] ?></option>
							<?php endif; ?>

					<?php endforeach ?>
				</select>

				<input type="text" value="<?= $thread['id_thread'] ?>" hidden name="id-thread">

				<br>

				<p class="color-grey">Isi Topik</p>
				<textarea name="deskripsi-thread" id="thread-editor" class="form-control" rows="10">
					<?= $thread['deskripsi_thread'] ?>
				</textarea>
				<script>
					CKEDITOR.replace('thread-editor');
				</script>

				<br>

				<button type="submit" name="buat-thread
				" class="btn btn-proofn">Simpan Perubahan</button>

				<a href="../../" class="btn btn-navy">Kembali</a>

				<?php endforeach; ?>

				</form>

			</div>
		</div>
	</div>
</div>