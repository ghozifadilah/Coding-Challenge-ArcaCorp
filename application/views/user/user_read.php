<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">User Read</h2>
        <table class="table">
	    <tr><td>User Group Id</td><td><?php echo $user_group_id; ?></td></tr>
	    <tr><td>User Username</td><td><?php echo $user_username; ?></td></tr>
	    <tr><td>User Password</td><td><?php echo $user_password; ?></td></tr>
	    <tr><td>User Nama</td><td><?php echo $user_nama; ?></td></tr>
	    <tr><td>Kontak</td><td><?php echo $kontak; ?></td></tr>
	    <tr><td>User Email</td><td><?php echo $user_email; ?></td></tr>
	    <tr><td>User Hak Akses</td><td><?php echo $user_hak_akses; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
<?php $this->load->view('layout/footer');?>