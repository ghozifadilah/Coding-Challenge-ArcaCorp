<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Pembayaran Read</h2>
        <table class="table">
	    <tr><td>Pembayaran</td><td><?php echo $pembayaran; ?></td></tr>
	    <tr><td>Timestamp</td><td><?php echo $timestamp; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pembayaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>