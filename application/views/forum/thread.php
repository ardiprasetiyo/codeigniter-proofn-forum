<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       	<div class="container">
       		<div class="row">
       			<div class="col-lg-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
       			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
       			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
       			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
       			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
       			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
       			<div class="col-lg-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
       			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
       			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
       			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
       			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
       			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
       			<div class="col-lg-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
       			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
       			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
       			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
       			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
       			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
       		</div>
       	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      
      </div>

    </div>
  </div>
</div>




<?php foreach( $dataThread as $thread ) : ?>

<div class="container">
	<div class="col-lg-12 card-soft light-shadow">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-1 offset-lg-1">
					<a href="<?= site_url() ?>/forum/member/id/<?= $thread['id'] ?>/<?= $thread['username'] ?>">
						<div class="profile-pic" style="background-image: url('<?= $thread['profile_picture'] ?>'); padding: 30px;"></div>
					</a>
					</div>

					<div class="col-lg-6">
						<h4><?= $thread['judul_thread'] ?></h4>
						<p class="color-grey">Pada <b><?= date('d M Y H:i', strtotime($thread['tanggal_dibuat'])) ?></b></p>
						<p>Mengatakan :</p>
					</div>

					<div class="col-lg-3 offset-lg-1">
						<p class="color-grey">Oleh <b><a href="<?= site_url() ?>/forum/member/id/<?= $thread['id'] ?>/<?= $thread['username'] ?>"><?= strtoupper($thread['username'])?></a></b></p>
					</div>



					<div class="col-lg-10 offset-lg-1">
						<br> 
						<div class="card">
							<div class="card-body">
								<?= $thread['deskripsi_thread'] ?>
							</div>
						</div>
						<br>


						<?php if( $this->session->has_userdata('userinfo') == TRUE ) : ?>
							<?php if( $thread['id'] == $this->session->userdata('userinfo')['id'] ) : ?>
								<a href="<?= site_url() ?>/forum/topik/edit/id/<?= $thread['id_thread'] ?>/<?= $thread['kategori_forum'] ?>" class="float-right ml-4">Edit Thread</a>
								<a href="#!" id="hapus-thread" data-toggle="modal" data-idthread="<?= $thread['id_thread'] ?>" data-target="#myModal" class="float-right ml-4">Hapus Thread</a>
							<?php endif; ?>
						<?php endif; ?>

					</div>

				</div>
			</div>
		</div>
		</div>
	</div>

<?php endforeach; ?>

<div class="col-lg-12">
	<div class="container">
		<p>Balasan</p>
		<br>
	</div>

<div id="balasan">

	<div class="col-lg-4 offset-lg-5">
		<img src="<?= base_url() ?>/asset/images/loading.gif" class="img-fluid">
		<br>
		<h4>Harap Menunggu ...</h4>
		<br> <br>
	</div>

</div> 

<script>

	$(document).ready(function(){


	var after = $.get("<?= site_url() ?>/app/thread/balasan/<?= $dataThread[0]["id_thread"] ?>");
	setInterval(function(){

		$.get("<?= site_url() ?>/app/thread/test-connect", function(data){

			before = data;
			if( before > after || before < after ){
				$('#balasan').load('<?= site_url() ?>/app/thread/balasan/<?= $dataThread[0]["id_thread"] ?>');
			}
			after = before;

		});

	}, 2000);

	});
	
</script>


<?php if( $this->session->userdata('userinfo') == TRUE ) : ?>



<input type="text" hidden  id="thread-id" name="id-thread" value="<?= $dataThread[0]['id_thread'] ?>">


<div class="col-lg-12 card-soft light-shadow" id="balas-thread">
	<div class="container">
		<div class="col-lg-12">
		<h3>Balas Thread</h3>
		<p>Kirim Balasan Kepada <b>Thread</b></p>
		<textarea class="form-control post-create" name="post" id="post-create" rows="10"></textarea> <br>
		<button type="submit" id="submit-post" name="submit-tanggapan" class="btn btn-proofn">Kirim Balasan</button>
		<a href="../../" class="btn btn-navy">Kembali</a>
		<br>
		</div>
	</div>
</div>


<script>
	CKEDITOR.replace('post-create');

	$(document).ready(function(){

				$('#hapus-thread').click(function(){
					var idThread = $(this).attr('data-idthread');
					$('.modal-title').html('Hapus Thread');
					$('.modal-body').html('Anda yakin ingin menghapus thread ini?');
					$('.modal-footer').html('<a href="<?= site_url() ?>/forum/topik/hapus-topik/id/' +  idThread + '" class="btn btn-proofn">Ya</a> <a href="#!" class="btn btn-navy" data-dismiss="modal"">Tidak</a>')
				});

				$('#submit-post').click(function(){

					var idThread = $('#thread-id').val();
					var post = CKEDITOR.instances['post-create'].getData();
 
					$.post({
						type: "POST",
						url: "<?= site_url() ?>/forum/topik/postsubmit/",
						data: {'id-thread' : idThread, 'post' : post}
					});

					CKEDITOR.instances['post-create'].setData('');
						
				});

	});

</script>

<?php endif; ?>