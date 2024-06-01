<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px" > <i class="fa fa-edit"></i> Users <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="int">Perushaan <?php echo form_error('company_id') ?></label>
          <select class="form-control form-select" name="company_id" id="">
            <option value="">Pilih Perushaan</option>
            <?php 
            foreach ($data_company as $key ) { ?>
            
            <?php if ($company_id == $key->id ) { ?>
                 <option selected value="<?= $key->id ?>"><?= $key->name ?></option>
            <?php }else{ ?>
                 <option value="<?= $key->id ?>"><?= $key->name ?></option>
              <?php } ?>

           <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label for="int">Role <?php echo form_error('role_id') ?></label>
          <select class="form-control form-select" name="role_id" id="">
            <option value="">Pilih Role</option>
            <?php 
            foreach ($role_data as $key_r ) { ?>
               <?php if ($role_id == $key_r->id ) { ?>
                <option selected value="<?= $key_r->id ?>"><?= $key_r->name ?></option>
            <?php }else{ ?>
              <option value="<?= $key_r->id ?>"><?= $key_r->name ?></option>
              <?php } ?>
              
           <?php }   ?>
          </select>
        </div>
	    <!-- <div class="form-group">
            <label for="varchar">Role Id <?php echo form_error('role_id') ?></label>
            <input type="text" class="form-control" name="role_id" id="role_id" placeholder="Role Id" value="<?php echo $role_id; ?>" />
        </div> -->
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
	</form>
<?php $this->load->view('layout/footer');?>