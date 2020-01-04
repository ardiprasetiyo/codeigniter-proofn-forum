
<?php if( !empty($memberData) ) : ?>

<div class="col-lg-12 card-soft light-shadow">
	

	<div class="container">
		<div class="row">
			<div class="col-lg-2 offset-lg-1 ">
				<div class="profile-pic" style="background-image: url('<?= $memberData[0]['profile_picture'] ?>');"></div>
			</div>
			<div class="col-lg-9 mt-4">
				<h1><?= strtoupper($memberData[0]['username']) ?></h1>
				<p class="color-grey">Bergabung <b>Pada <?= date('d M Y', strtotime($memberData[0]['join_date'])) ?></b></p>
				<p>Topik <b><?= $forumData['forumActivity']['thread'] ?></b> &nbsp Balasan <b><?= $forumData['forumActivity']['post'] ?></b></p>
			</div>
		</div>
		<br> <br>
		<div class="container">
			<div class="col-lg-10 offset-lg-1">
				<b>Bio</b>
				<br> <br>
				<div class="card">
					<div class="card-body">
						<?= $memberData[0]['bio'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card mt-5 mb-5">
	<div class="card-body">
		<div class="container">
			<h3>Informasi Personal</h3>
			<br>
			<br>
			<p class="color-grey">Alamat Email</p>
			<p><?= $memberData[0]['email'] ?></p>
			<br>
			<p class="color-grey">Tanggal Lahir</p>
			<p><?= date('d M Y', strtotime($memberData[0]['birthdate'])) ?></p>
			<br>
			<p class="color-grey">Jenis Kelamin</p>
			<p><?= strtoupper($memberData[0]['gender']) ?></p>
			<br>
			<?php if( $this->session->has_userdata('userinfo') == TRUE ) : ?>
				<?php if( $this->session->userdata('userinfo')['id'] == $pageData['id'] AND $this->session->userdata('userinfo')['username'] == $pageData['username'] ) : ?>
					<a href="<?= site_url() ?>/forum/editprofile/">Ubah Informasi</a>
				<?php endif; ?>
			<?php endif; ?>
			<br> <br>
		</div>
	</div>
</div>

<?php else : ?>

	<div class="col-lg-12 card-soft light-shadow">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				
			</div>
			<div class="col-lg-8 offset-lg-2 text-center">
				<h3>Akun Tidak Ditemukan</h3>
				<p class="color-grey">Maaf, kami tidak dapat menemukan akun tersebut</p>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>
