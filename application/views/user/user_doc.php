<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>User List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>User Group Id</th>
		<th>User Username</th>
		<th>User Password</th>
		<th>User Nama</th>
		<th>User Hak Akses</th>
		
            </tr><?php
            foreach ($user_data as $user)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $user->user_group_id ?></td>
		      <td><?php echo $user->user_username ?></td>
		      <td><?php echo $user->user_password ?></td>
		      <td><?php echo $user->user_nama ?></td>
		      <td><?php echo $user->user_hak_akses ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>