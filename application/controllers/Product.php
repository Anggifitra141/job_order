<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
  /**
   *  =======   Author  : Anggi Fitrahandika         =======
   *  =======   Email   : anggifitra141@gmail.com    =======
   *  =======   Version : V.1.0                      =======
   *  ===========       Copyright 2018          ===========
  */
  public function __construct()
	 {
  		parent::__construct();
      $this->load->database();
      $this->load->model('M_product');
      if(!$this->session->userdata('logged_in'))
      {
        $data=array();
				$data['msg'] = "Maaf Anda tidak punya akses ke halaman ini !";
				$content = $this->load->view('errors/html/error_sessi', $data, TRUE);
				exit($content);
      }
	 }

	public function index()
  {
      $data=[];
      $data['content'] = $this->load->view('product', $data, TRUE);
			$this->load->view('layout', $data);
  }

  public function ajax_list()
  {
      $list = $this->M_product->Get_All();
      $data = array();
      $no = 1;
      foreach ($list as $item) {
          $row = array();
          $row[] = $no++;
          $row[] = $item->code;
          $row[] = $item->description;
          $row[] = $item->remarks;
          $row[] = '<a onclick="get_product('.$item->id_product.')" class="btn btn-sm green btn-outline sbold"><i class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>&nbsp;&nbsp;<a onclick="delete_product('.$item->id_product.')" class="btn btn-sm red btn-outline sbold"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_product->count_all(),
                      "recordsFiltered" => $this->M_product->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
  }

  public function get_product($id_product)
  {
      $data = $this->M_product->get_product($id_product);
      echo json_encode($data);
  }

  public function tambah_product()
  {
      $data = array(
        'code' => $this->input->post('code'),
        'description' => $this->input->post('description'),
        'remarks' => $this->input->post('remarks'),
        'activation_date' => date('Y-m-d'),
       );
       $this->M_product->tambah_product($data);
       echo json_encode(array("status" => TRUE ));
  }

  public function update_product()
  {
      $data = array(
        'code' => $this->input->post('code'),
        'description' => $this->input->post('description'),
        'remarks' => $this->input->post('remarks'),
       );
       $this->M_product->update_product(array('id_product' => $this->input->post('id_product')), $data);
       echo json_encode(array("status" => TRUE ));
  }

  public function delete_product($id_product)
  {
    $this->M_product->delete_product($id_product);
    echo json_encode(array("status" => TRUE));
  }

}
