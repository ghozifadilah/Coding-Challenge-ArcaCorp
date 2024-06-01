<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'user_company';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    
    public function order($key,$direction='desc')
    {
        $this->db->order_by($key,$direction);
        return $this;
    }

    public function join($table_name,$condition,$type = null)
    {
        $this->db->join($table_name,$condition,$type);
        return $this;
    }

    public function select($key='*')
    {
        $this->db->select($key);
        return $this;
    }

    function get_where($where)
    {
        $this->db->where($where);
        return $this->db->get($this->table)->result();
    }

    function where($where)
    {
        $this->db->where($where);
        return $this;
    }

    public function get_row_where($where)
    {
        $this->db->from('user_roles');
        $this->db->where($where);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
    }

    public function limit($limit)
    {
        $this->db->limit($limit);
        return $this;
    }


    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
		$this->db->or_like('company_id', $q);
		$this->db->or_like('role_id', $q);
		$this->db->or_like('username', $q);
		$this->db->or_like('password', $q);
		$this->db->or_like('email', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        // $this->db->join('users', 'comments.id = blogs.id', 'left');
      
		$this->db->or_like('role_id', $q);
		$this->db->or_like('username ', $q);
		$this->db->or_like('password ', $q);
		$this->db->or_like('email ', $q);
		$this->db->limit($limit, $start);
        return $this->db->query("SELECT users.id,users.role_id,users.username,users.password,users.email,companies.id as company_id,companies.name as company_name from users inner join companies on users.company_id = companies.id Limit $start,$limit ")->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert('users', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function encrypt($plain_text, $password = 'PASTIAMAN', $iv_len = 16)
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
		return base64_encode($enc_text);
	}

	function decrypt($enc_text, $password = 'PASTIAMAN', $iv_len = 16)
	{
		$enc_text = base64_decode($enc_text);
		$n = strlen($enc_text);
		$i = $iv_len;
		$plain_text = '';
		$iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
		while ($i < $n) 
		{
			$block = substr($enc_text, $i, 16);
			$plain_text .= $block ^ pack('H*', md5($iv));
			$iv = substr($block . $iv, 0, 512) ^ $password;
			$i += 16;
		}
		return preg_replace('/\\2008A\\x00*$/', '', $plain_text);
	}


    function pass_encrypt($password){
        
      
        $value="$password";

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)]; //20 word
        }

        // $key="01234567890123456789012345678901"; // 32 bytes
        $key="83238123982124928412484832193942";
        $iv="1234567890123412"; // 16 bytes
        $encrypted_data = openssl_encrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        $randomString .= $encrypted_data;
		echo  base64_encode($randomString);
        return base64_encode($randomString);
    }

    function pass_decrypt($password,$decryp_key_1 = 'nb0JTiLSbq01wqjzoU',$decrypt_key_2 = 'sGJmTnSf6Ub8Z89Bc5' ){

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
        return $data;
        // var_dump($data);
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

}

