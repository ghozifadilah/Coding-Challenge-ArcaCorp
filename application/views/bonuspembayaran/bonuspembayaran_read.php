<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Bonuspembayaran Read</h2>
        <table class="table">
	    <tr><td>IdPembayaran</td><td><?php echo $idPembayaran; ?></td></tr>
	    <tr><td>IdBuruh</td><td><?php echo $idBuruh; ?></td></tr>
	    <tr><td>Persentase</td><td><?php echo $Persentase; ?></td></tr>
	    <tr><td>TotalPembayaran</td><td><?php echo $TotalPembayaran; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('bonuspembayaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>