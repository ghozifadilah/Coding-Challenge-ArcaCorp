<?php $this->load->view('layout/header');?>
    <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password Baru <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password Lama<?php echo form_error('password_lama') ?></label>
            <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama" value="" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('profil') ?>" class="btn btn-default">Batal</a>
	</form>
<?php $this->load->view('layout/footer');?>