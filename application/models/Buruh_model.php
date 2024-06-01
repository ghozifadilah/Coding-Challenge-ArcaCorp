<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buruh_model extends CI_Model
{

    public $table = 'buruh';
    public $id = 'ID';
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
        $this->db->from($this->table);
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
        $this->db->like('ID', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('tempatTinggal', $q);
		$this->db->or_like('posisi', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('ID', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('tempatTinggal', $q);
		$this->db->or_like('posisi', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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
