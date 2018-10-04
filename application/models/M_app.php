<?php

class M_app extends CI_model
{

	public function __construct()
	{
    $this->load->database();
		parent::__construct();
	}

  public function job_order()
  {
    $this->db->from('job_order');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function customer()
  {
    $this->db->from('customer');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function vendor()
  {
    $this->db->from('vendor');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function consignee()
  {
    $this->db->from('consignee');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function user()
  {
    $this->db->from('user');
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function product()
  {
    $this->db->from('product');
    $query = $this->db->get();
    return $query->num_rows();
  }
}
