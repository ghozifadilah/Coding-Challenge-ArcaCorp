<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Buruh <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">TempatTinggal <?php echo form_error('tempatTinggal') ?></label>
            <input type="text" class="form-control" name="tempatTinggal" id="tempatTinggal" placeholder="TempatTinggal" value="<?php echo $tempatTinggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Posisi <?php echo form_error('posisi') ?></label>
            <input type="text" class="form-control" name="posisi" id="posisi" placeholder="Posisi" value="<?php echo $posisi; ?>" />
        </div>
	    <input type="hidden" name="ID" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('buruh') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>