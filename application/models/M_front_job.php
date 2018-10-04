<?php

class M_front_job extends CI_model
{

	public function __construct()
	{
    $this->load->database();
		parent::__construct();
	}

	var $table = 'job_order';
  var $column_order = array('id_job_order','job_no','etd','eta','customer_ref_no','stuffing','closing_cy','quantity','pol','pod','other','status','activation_date');
  var $column_search = array('id_job_order','job_no','etd','eta','customer_ref_no','stuffing','closing_cy','quantity','pol','pod','other','status','activation_date');
  var $order = array('activation_date' => 'desc');

  private function _get_datatables_query()
  {

	$this->db->from($this->table);
      $i = 0;

      foreach ($this->column_search as $row)
      {
          if($_POST['search']['value'])
          {

              if($i===0)
              {
                  $this->db->group_start();
                  $this->db->like($row, $_POST['search']['value']);
              }
              else
              {
                  $this->db->or_like($row, $_POST['search']['value']);
              }

              if(count($this->column_search) - 1 == $i)
                  $this->db->group_end();
          }
          $i++;
      }

      if(isset($_POST['order']))
      {
          $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }
      else if(isset($this->order))
      {
          $order = $this->order;
          $this->db->order_by(key($order), $order[key($order)]);
      }
  }

	public function Get_All()
	{
		$this->_get_datatables_query();
	      if($_POST['length'] != -1)
	      $this->db->limit($_POST['length'], $_POST['start']);
	      $query = $this->db->get();
	      return $query->result();
	}

  public function count_filtered()
  {
      $this->_get_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
  }

  public function count_all()
  {
      $this->db->from($this->table);
      return $this->db->count_all_results();
  }

	public function InggrisTgl($tanggal)
  {
  	$bln=substr($tanggal,3,2);
  	$tgl=substr($tanggal,0,2);
  	$thn=substr($tanggal,6,4);
  	$tanggal="$thn-$bln-$tgl";
  	return $tanggal;
  }

	public function IndonesiaTgl($tanggal){
    	$tgl=substr($tanggal,8,2);
    	$bln=substr($tanggal,5,2);
    	$thn=substr($tanggal,0,4);
    	$tanggal="$tgl-$bln-$thn";
    	return $tanggal;
    }

}
