<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		
	
        $this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
	}
	
	
	public function index()
	{	
		redirect('/Beranda');
	}

	
	
	public function login()
	{
		$this->load->view('login');
	}
	
	public function register()
	{
		$data = array(
            'username' => set_value('username'),
            'password' => set_value('password'),
            'repassword' => set_value('repassword'),
            'nama' => set_value('nama'),
            'hak_akses' => set_value('hak_akses'),
        );
		$this->load->view('register',$data);
	}

	public function forgot_password()
	{
		$this->load->view('forgot_password');
	}
	
	public function aksi_login()
	{
	
	
		$this->login_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->login();
		} else {
			$data = array(
				'user_username' => $this->input->post('username', TRUE),
			);

			$get = $this->user_model->get_row_where($data);
			@$this->session->set_flashdata('message', 'Selamat datang ' . $get->user_nama . '!');

			if ($get != null) {
				if ($this->input->post('password', true) == $this->user_model->decrypt($get->user_password)) {
					$this->session->set_userdata((array) $get);
					$this->session->unset_userdata('user_password');
					redirect('beranda', 'refresh');
				} else {
					$this->session->set_flashdata('error_login', 'Username atau password salah !');
					$this->load->view('login');
				}
			} else {
				$this->session->set_flashdata('error_login', 'Username atau password salah !');
				$this->load->view('login');
			}
		}
	}

	public function aksi_register()
	{
		$this->register_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
			$data = array(
				'username' => $this->input->post('username',TRUE),
                'user_password' => $this->user_model->encrypt($this->input->post('password',TRUE)),
                'user_nama' => $this->input->post('nama',TRUE),
                'user_hak_akses' => 'petugas',
			);

			$username_check = $this->input->post('username');

			$username_check = $this->user_model->get_where(['username'=>$username_check]);

			if ($username_check != null) {
				$this->session->set_flashdata('error_username_exist', 'Username Telah terdaftar !');
				$this->register();
				return;
			}

			//$check_user = $this->user_model->get_by_id($insertId);



            $insert = $this->user_model->insert($data);
			$insertId = $this->db->insert_id();
			$get = $this->user_model->get_by_id($insertId);
            $this->session->set_flashdata('message', 'Selamat datang '.$get->user_nama.'!');
			
			if ($get!=null) {
				$this->session->set_userdata( (array) $get );
				$this->session->unset_userdata('user_password');
				$this->log_model->record('melakukan register akun baru',$insertId);
				redirect('/welcome','refresh');
			} else {
				$this->register();
			}
        }
	}

	public function aksi_forgot_password()
	{
		$username = $this->input->post('username');
		$user_email = $this->input->post('email');
		$data = array(
			'username' => $this->input->post('username',TRUE),
			'user_email' => $this->input->post('email',TRUE),
		);
		$get = $this->user_model->get_row_where($data);
		if ($get) {
			$this->email_recover($get->user_email,$get);
			$this->log_model->record('mengirim email pemulihan akun ke '.$get->user_email,$get->user_id);
			$this->load->view('forgot_password',['pesan'=>'Email pemulihan akun telah terkirim, silahkan cek kotak masuk email anda.']);
		}
	}

	public function aksi_reset_password()
	{
		$this->reset_password_rules();
		if ($this->form_validation->run() == FALSE) {
            $this->reset_password(TRUE);
        } else {
			$user_id = $this->input->post('user_id');
			$data = array(
                'user_password' => $this->user_model->encrypt($this->input->post('password',TRUE)),
			);
            $insert = $this->user_model->insert($data);
			$get = $this->user_model->get_by_id($user_id);
            $this->session->set_flashdata('message', 'Selamat datang '.$get->user_nama.'!');
			if ($get!=null) {
				$this->session->set_userdata( (array) $get );
				$this->session->unset_userdata('user_password');
				$this->log_model->record('mereset password akun',$user_id);
				redirect('/welcome','refresh');
			} else {
				$this->register();
			}
        }
	}

	public function logout()
	{
		$data = [
			'id','companny_id','role_id','username','password','email'
		];
		$this->session->unset_userdata($data);
		redirect('welcome/login','refresh');
	}

    public function login_rules() 
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-warning">', '</span>');
	}

	function encrypt($plain_text='123', $password = 'PASTIAMAN', $iv_len = 16)
	{
		$plain_text .= "\2008A";
		$n = strlen($plain_text);
		if ($n % 16) 
			$plain_text .= str_repeat("\0", 16 - ($n % 16));
		$i = 0;
		$enc_text = $this->getRandomCode($iv_len);
		$iv = substr($password ^ $enc_text, 0, 512);
		while ($i < $n) 
		{
			$block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
			$enc_text .= $block;
			$iv = substr($block . $iv, 0, 512) ^ $password;
			$i += 16;
		}
		echo base64_encode($enc_text);
	}
	
	function getRandomCode($iv_len)
    {
		$iv = '';
		while ($iv_len-- > 0) 
		{
			$iv .= chr(mt_rand() & 0xff);
		}
		return $iv;
    }

    public function register_rules() 
    {
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('repassword', 'Konfirmasi password', 'trim|required|matches[password]',[
			'matches'=>'maaf, password dan konfirmasi password anda tidak sesuai'
		]);
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-warning">', '</span>');
	}
	
	public function reset_password_rules()
	{
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('repassword', 'Konfirmasi password', 'trim|required|matches[password]',[
			'matches'=>'maaf, password dan konfirmasi password anda tidak sesuai'
		]);
		$this->form_validation->set_rules('user_id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-warning">', '</span>');
	}
	
    public function profil()
    {
		if ($this->session->userdata('id') == null) redirect('/login', 'refresh');
        $id = $this->session->userdata('id');
        $row = $this->users_model->get_by_id($id);

        $data = array(
			'id' => $this->session->userdata('>id'),
            'username' => $this->session->userdata('username'),
            'password' => $row->password,
            'hak_akses' => $row->role_id,
            'nama_halaman' => 'user',
            'judul_halaman' => 'Profil',
    
        );
		// var_dump($row); die;
        $this->load->view('user/user_profil', $data);
	}
	
	public function profil_update()
    {
			if ($this->session->userdata('id') == null) redirect('/login', 'refresh');
        $id = $this->session->userdata('id');
        $row = $this->users_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_action'),
                'id' => set_value('id', $row->id),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $this->users_model->decrypt($row->password)),
                'hak_akses' => set_value('hak_akses', $row->role_id),
            );
            $this->load->view('user/user_profil_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function profil_update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->profil_update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'username' => $this->input->post('username',TRUE),
                'password' => $this->users_model->pass_encrypt($this->input->post('password',TRUE)),
                // 'user_nama' => $this->input->post('nama',TRUE),
                //'user_email' => $this->input->post('email',TRUE),
            );
		

			$this->users_model->update($this->input->post('id', TRUE), $data);
			
			$this->session->set_userdata( $data );
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('/welcome'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password_lama', 'password lama', 'trim|required|min_length[6]|callback_password_lama');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
      //  $this->form_validation->set_rules('email', 'email', 'email|trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function password_lama($pass)
	{
		$id = $this->session->userdata('id');
        $get = $this->users_model->get_by_id($id);
		$password_benar = ($pass == $this->users_model->pass_decrypt($get->password));
		if (!$password_benar)
		{
			$this->form_validation->set_message('password_lama', 'maaf, password anda salah');
		}
		return $password_benar;
	}

	
    function pass_decrypt($password='nyjLFl24+IwYuVZEcr9N1o0s9VMB8VV71ItNHFMQv/M=',$decryp_key_1 = 'nb0JTiLSbq01wqjzoU',$decrypt_key_2 = 'sGJmTnSf6Ub8Z89Bc5' ){

        $decry_1 = 'nb0JTiLSbq01wqjzoU';
        $decry_2 = 'sGJmTnSf6Ub8Z89Bc5';

        if ($decryp_key_1 != $decry_1 ) {
            echo '404';
            die;
        }
        if ($decrypt_key_2 != $decry_2 ) {
            echo '404';
            die;
        }


        $password = substr($password,20);
        $value=$password;
        $key="83238123982124928412484832193942";
        $iv="1234567890123412"; // 16 bytes
        $value = base64_decode($value);
        $data = openssl_decrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
		echo 'tes';
		echo $data;
        return $data;
        // var_dump($data);
    }


	


}


