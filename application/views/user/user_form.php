<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">User <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	   
	    <div class="form-group">
            <label for="varchar">User Username <?php echo form_error('user_username') ?></label>
            <input type="text" class="form-control" name="user_username" id="user_username" placeholder="User Username" value="<?php echo $user_username; ?>" />
        </div>
	    <div class="form-group">
            <label for="user_password">User Password <?php echo form_error('user_password') ?></label>
            <input type="password" class="form-control" rows="3" name="user_password" id="user_password" placeholder="User Password" value="<?php echo $user_password; ?>"></input>
        </div>
	    <div class="form-group">
            <label for="varchar">User Nama <?php echo form_error('user_nama') ?></label>
            <input type="text" class="form-control" name="user_nama" id="user_nama" placeholder="User Nama" value="<?php echo $user_nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kontak <?php echo form_error('kontak') ?></label>
            <input type="text" class="form-control" name="kontak" id="kontak" placeholder="Kontak" value="<?php echo $kontak; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">User Email <?php echo form_error('user_email') ?></label>
            <input type="text" class="form-control" name="user_email" id="user_email" placeholder="User Email" value="<?php echo $user_email; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">User Hak Akses <?php echo form_error('user_hak_akses') ?></label>

            <select name="user_hak_akses" id="user_hak_akses" class="form-control">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>

        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>