<?php

class M_product extends CI_model
{

	public function __construct()
	{
    $this->load->database();
		parent::__construct();
	}

	var $table = 'product';
  var $column_order = array('id_product','code','description','remarks');
  var $column_search = array('id_product','code','description','remarks');
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

  public function get_product($id_product)
  {
      $this->db->from($this->table);
      $this->db->where('id_product', $id_product);
      $query = $this->db->get();
      return $query->row();
  }

  public function tambah_product($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update_product($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_product($id_product)
  {
    $this->db->where('id_product', $id_product);
    $this->db->delete($this->table);
  }

}
