<?php

class M_job_order extends CI_model
{

	public function __construct()
	{
    $this->load->database();
		parent::__construct();
	}

	var $table = 'job_order';
  var $column_order = array('id_job_order','job_no','shipping_type','shipping_mode','product','shipper','consignee','notify','etd','eta','customer_ref_no','stuffing','closing_cy','quantity','pol','pod','vessel_veeder','linner','vessel_conn','bl','hbl','other','status','activation_date');
  var $column_search = array('id_job_order','job_no','shipping_type','shipping_mode','product','shipper','consignee','notify','etd','eta','customer_ref_no','stuffing','closing_cy','quantity','pol','pod','vessel_veeder','linner','vessel_conn','bl','hbl','other','status','activation_date');
  var $order = array('activation_date' => 'desc');

  private function _get_datatables_query()
  {
		// filter
		$start_date =$this->InggrisTgl($this->input->post('start_date'));
		$end_date = $this->InggrisTgl($this->input->post('end_date'));
		$status  = $this->input->post('status');
		$is_date_search  = $this->input->post('is_date_search');

		$sessi = array(
						'start_date' =>$this->IndonesiaTgl($start_date),
						'end_date' =>$this->IndonesiaTgl($end_date),
						'status' => $status,
						);
		$this->session->set_userdata($sessi);

		if($is_date_search == "yes")
		{
			if(!empty($start_date)){
        $this->db->where('activation_date >=', date('Y-m-d', strtotime($start_date))." 00:00:00");
      }
      if(!empty($end_date)){
        $this->db->where('activation_date <=', date('Y-m-d', strtotime($end_date))." 23:59:59");
      }
      if(!empty($status != "")){
        $this->db->where('status', $status);
      }
		}

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


	public function get_job_order($id_job_order)
	{
			$this->db->from($this->table);
			$this->db->where('id_job_order', $id_job_order);
			$query = $this->db->get();
			return $query->row();
	}

  public function get_shipper()
  {
    $this->db->select('code, nama_customer');
    $this->db->from('customer');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_product()
  {
    $this->db->select('code, description');
    $this->db->from('product');
    $query = $this->db->get();
    return $query->result_array();
  }

	public function get_consignee()
  {
    $this->db->select('*');
    $this->db->from('consignee');
    $query = $this->db->get();
    return $query->result_array();
  }

	public function no_urut()
	{
		$this->db->from($this->table);
		$query = $this->db->get()->num_rows();
		if ($query) {
			$value = $query + 1;
			return $value;
		}else {
			$value = 1;
			return $value;
		}
	}

	public function no_urut_hbl()
	{
		$this->db->from($this->table);
		$query = $this->db->get()->num_rows();
		if ($query) {
			$value = $query + 1;
			return $value;
		}else {
			$value = 1;
			return $value;
		}
	}

	public function get_no_urut_shipper($shipper)
	{
		$this->db->from($this->table);
		$this->db->where('shipper', $shipper);
		$query = $this->db->get()->num_rows();
		if ($query) {
			$value = $query + 1;
			return $value;
		}else {
			$value = 1;
			return $value;
		}
	}

	public function get_no_urut_product($product)
	{
		$this->db->from($this->table);
		$this->db->where('product', $product);
		$query2 = $this->db->get()->num_rows();
		if ($query2) {
			$value2 = $query2 + 1;
			return $value2;
		}else {
			$value2 = 1;
			return $value2;
		}
	}

	public function get_etd_fix()
	{
		$data=array();
		$this->db->select('*');
		$this->db->from('job_order');
		$this->db->where('etd_fix =', date('Y-m-d'));
		$query = $this->db->get();

		if($query->num_rows() > 0)
			{
			foreach($query->result_array() as $row)
				{
					$data[]=$row;
				}
			}
		$query->result();
		return $data;
	}

	public function update_status_closed()
	{
		$this->db->query("UPDATE job_order SET status = 'CLOSED' WHERE bl_date_fix <= date(now())");
	}

	public function tambah_job_order($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update_job_order($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_job_order($id_job_order)
	{
		$this->db->where('id_job_order', $id_job_order);
		$this->db->delete($this->table);
	}

}
