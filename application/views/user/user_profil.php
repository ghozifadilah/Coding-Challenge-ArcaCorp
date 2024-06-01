<?php $this->load->view('layout/header');?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6 mt-5">
		<h3> <i class="fa fa-user"></i> Ubah Profil User</h3>
		<hr>
		<table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Hak Akses</td><td><?php echo $hak_akses; ?></td></tr>
	    <tr>
			<td></td>
			<td>
				<a href="<?php echo site_url('welcome') ?>" class="btn btn-default">Kembali</a>
				<a href="<?php echo site_url('profil/update') ?>" class="btn btn-primary">Ubah Profil</a>
			</td>
		</tr>
	</table>
		</div>
	</div>
</div>

   
<?php $this->load->view('layout/footer');?>