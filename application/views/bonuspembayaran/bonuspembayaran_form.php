<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Bonuspembayaran <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdPembayaran <?php echo form_error('idPembayaran') ?></label>
            <input type="text" class="form-control" name="idPembayaran" id="idPembayaran" placeholder="IdPembayaran" value="<?php echo $idPembayaran; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdBuruh <?php echo form_error('idBuruh') ?></label>
            <input type="text" class="form-control" name="idBuruh" id="idBuruh" placeholder="IdBuruh" value="<?php echo $idBuruh; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Persentase <?php echo form_error('Persentase') ?></label>
            <input type="text" class="form-control" name="Persentase" id="Persentase" placeholder="Persentase" value="<?php echo $Persentase; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">TotalPembayaran <?php echo form_error('TotalPembayaran') ?></label>
            <input type="text" class="form-control" name="TotalPembayaran" id="TotalPembayaran" placeholder="TotalPembayaran" value="<?php echo $TotalPembayaran; ?>" />
        </div>
	    <input type="hidden" name="ID" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bonuspembayaran') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>