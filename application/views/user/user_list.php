<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">User List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('user/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('user/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>User Username</th>
                <th>User Nama</th>
                <th>Kontak</th>
                <th>User Email</th>
                <th>User Hak Akses</th>
                <th>Action</th>
                </tr><?php
                foreach ($user_data as $user)
                {
                ?>
                <tr>
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $user->user_username ?></td>
                    <td><?php echo $user->user_nama ?></td>
                    <td><?php echo $user->kontak ?></td>
                    <td><?php echo $user->user_email ?></td>
                    <td><?php echo $user->user_hak_akses ?></td>
                    <td style="text-align:center" width="300px">
				<?php 
			
                echo '<a href="' . site_url('user/update/'.$user->id) . '" class="btn btn-primary" > Update </a>'; 
                
                echo '<a style="margin-left: 10px" href="' . site_url('user/delete/'.$user->id) . '" class="btn btn-danger " onclick="return confirm(\'Anda yakin ?\')"> Hapus </a>'; 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <?php $this->load->view('layout/footer');?>