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
       
			<?php if( $this->session->flashdata('valid_result') == TRUE ) : ?>

					<p class="text-danger"><?= $this->session->flashdata('valid_result') ?></p>

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
				var notif =  '<?= is_null($this->session->flashdata('valid_result')) ?>';
				if( notif == ''){
					$('#notifModal').modal('show');
				}
			});

</script>

<div class="col-lg-12 card-soft light-shadow">
	<div class="container">
		<div class="col-lg-10 offset-lg-1">
			<h4>Edit Profile</h4>

			<br>
			<?= form_open_multipart(site_url() . 'forum/updateProfile/'); ?>
			<p class="color-grey">Email</p>
			<input type="email" name="email" class="form-control" placeholder="Perbarui Email Anda" value="<?= $userData[0]['email'] ?>"> <br>
			<p class="color-grey">Jenis Kelamin</p>
			<select class="form-control" name="gender">
				<?php if( $userData[0]['gender'] == 'pria' ) : ?>
					<option value="pria" selected>Pria</option>
					<option value="wanita">Wanita</option>
				<?php else : ?>
					<option value="pria">Pria</option>
					<option value="wanita" selected>Wanita</option>
				<?php endif; ?>
			</select> <br>
			<p class="color-grey">Bio Tentang Anda</p>
			<textarea class="form-control" name="bio" rows="10"><?= $userData[0]['bio'] ?></textarea>
			<br>
			<div class="row">
				<div class="col-lg-2">
					<div class="profile-pic" style="padding: 50%; background-image: url('<?= $userData[0]['profile_picture'] ?>"></div>
				</div>
				<div class="col-lg-9 mt-4">
					<p class="color-grey">Ubah Foto Profile Anda</p>
					<input type="file" name="profile-pic"> <br> <br>
				</div>
			</div>
			<br><br>
			<button type="submit" name="submit" class="btn btn-proofn">Simpan Perubahan</button>
			<a href="<?= site_url() ?>/forum/member/id/<?= $this->session->userdata('userinfo')['id'] ?>/<?= $this->session->userdata('userinfo')['username'] ?>" class="btn btn-navy">Kembali</a>
			</form>
		</div>
	</div>
</div>