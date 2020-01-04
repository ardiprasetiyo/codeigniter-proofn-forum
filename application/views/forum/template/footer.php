	</div>
</div>

<br> <br>

<?php if( !$this->session->userdata('userinfo') ) : ?>

<div class="col-lg-12 text-center mb-4 mt-3">
	<p><b>Belum Punya Akun?</b></p>
	<p class="color-grey"><a href="<?= site_url() ?>/signup?redirect=forum">Gabung Sekarang</a> Untuk Berinteraksi Dengan Komunitas</p>
</div>

<?php endif; ?>

</body>
</html>