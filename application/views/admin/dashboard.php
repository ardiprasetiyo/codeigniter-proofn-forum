	
<div class="col-lg-12 mb-3">
	<div class="row">
		<div class="col-lg-12">
			<h3>Dashboard</h3>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12 content p-4 bg-kelly text-white card-hover">
				<div class="row">
					<div class="col-lg-9">
						<span><b>KUNJUNGAN SITUS</b></span> <br>	
						<h1><b>30</b></h1>
					</div>
					<div class="col-lg-3">
						<i class="material-icons mx-auto d-block" style="font-size:55px">public</i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="col-lg-12 content p-4 bg-royal-blue text-white card-hover">
			 <div class="row">
					<div class="col-lg-9">
						<span><b>MEMBER KOMUNITAS</b></span> <br>	
						<h1><b><?= $memberStats['total-member'] ?></b></h1>
					</div>
					<div class="col-lg-3">
						<i class="material-icons mx-auto d-block" style="font-size:55px">supervisor_account</i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="col-lg-12 content p-4 bg-the-red text-white card-hover">
				<div class="row">
					<div class="col-lg-9">
						<span><b>FEEDBACK DITERIMA</b></span> <br>	
						<h1><b><?= $feedbackStats['total-feedback'] ?></b></h1>
					</div>
					<div class="col-lg-3">
						<i class="material-icons mx-auto d-block" style="font-size:55px">feedback</i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
		<div class='row'>
			<div class='col-lg-4 mt-5'>
				<div class="ct-chart ct-perfect-fourth" id="chart-visitor"></div>
					<script>
						var data = {
							labels : ['Januari','Februari','Maret'],

							series :[[0,1,32,]]

						};

						new Chartist.Line('.ct-chart', data);
					</script>

			</div>

			<div class='col-lg-4 mt-5'>
				<div class="ct-chart-member ct-perfect-fourth" id="chart-member"></div>
					<script>
						var data = {
							labels : [
							<?php foreach( $memberStats['stats'] as $data ){
							  echo   '"' . $data['date'] . '",';
							}?>],

							series :[[<?php foreach( $memberStats['stats'] as $data ){
							  echo  $data['member'] . ',';
							}?>]]

						};

						new Chartist.Line('.ct-chart-member', data);
					</script>

			</div>

			<div class='col-lg-4 mt-5'>
				<div class="ct-chart-feedback ct-perfect-fourth" id="chart-feedback"></div>
					<script>
						var data = {
							
							labels : [
							<?php foreach( $feedbackStats['stats'] as $data ){
							  echo   '"' . $data['date'] . '",';
							}?>],

							series :[[<?php foreach( $feedbackStats['stats'] as $data ){
							  echo  $data['feedback'] . ',';
							}?>]]

						};

						new Chartist.Line('.ct-chart-feedback', data);
					</script>

			</div>
		</div>
</div>

<script>
	$(document).ready(function(){
		//
	});
</script>