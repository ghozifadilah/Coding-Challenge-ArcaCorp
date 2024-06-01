<?php $this->load->view('layout/header');?>
<h3 style="margin-top:0px"> <i class="fa fa-home"></i> Dashboard</h3>
         
		 <hr>

		<div class="row">
			<div class="col-md-4">
				<div class="card" >
				<div class="card-body">
					<h5 class="card-title">Pembayaran</h5>
					<p class="card-text">Halmaan yang mengelola pembayaran dan bonus buruh</p>
					<a href="<?php echo base_url('pembayaran') ?>"  class="btn btn-primary">Pembayaran</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" >
				<div class="card-body">
					<h5 class="card-title">List Buruh</h5>
					<p class="card-text">Halmaan yang mengelola Data Buruh</p>
					<a href="<?php echo base_url('buruh') ?>"  class="btn btn-primary">Buruh</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" >
				<div class="card-body">
					<h5 class="card-title">User List</h5>
					<p class="card-text">Halmaan yang mengelola Daftar User Dashboard</p>
					<a href="<?php echo base_url('user') ?>"  class="btn btn-primary">user</a>
					</div>
				</div>
			</div>


		</div>


	



<?php $this->load->view('layout/footer');?>

