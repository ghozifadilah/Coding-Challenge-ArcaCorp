<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Buruh Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>TempatTinggal</td><td><?php echo $tempatTinggal; ?></td></tr>
	    <tr><td>Posisi</td><td><?php echo $posisi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('buruh') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>