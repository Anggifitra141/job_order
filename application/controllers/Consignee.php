<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consignee extends CI_Controller {
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
      $this->load->model('M_consignee');
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
      $data['content'] = $this->load->view('consignee', $data, TRUE);
			$this->load->view('layout', $data);
  }

  public function ajax_list()
  {
      $list = $this->M_consignee->Get_All();
      $data = array();
      $no = 1;
      foreach ($list as $item) {
          $row = array();
          $row[] = $no++;
          $row[] = $item->nama_consignee;
          $row[] = $item->description;
          $row[] = '<a onclick="get_consignee('.$item->id_consignee.')" class="btn btn-sm green btn-outline sbold"><i class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>&nbsp;&nbsp;<a onclick="delete_consignee('.$item->id_consignee.')" class="btn btn-sm red btn-outline sbold"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_consignee->count_all(),
                      "recordsFiltered" => $this->M_consignee->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
  }

  public function get_consignee($id_consignee)
  {
      $data = $this->M_consignee->get_consignee($id_consignee);
      echo json_encode($data);
  }

  public function tambah_consignee()
  {
      $data = array(
        'nama_consignee' => $this->input->post('nama_consignee'),
        'description' => $this->input->post('description'),
        'activation_date' => date('Y-m-d'),
       );
       $this->M_consignee->tambah_consignee($data);
       echo json_encode(array("status" => TRUE ));
  }

  public function update_consignee()
  {
      $data = array(
        'nama_consignee' => $this->input->post('nama_consignee'),
        'description' => $this->input->post('description'),
       );
       $this->M_consignee->update_consignee(array('id_consignee' => $this->input->post('id_consignee')), $data);
       echo json_encode(array("status" => TRUE ));
  }

  public function delete_consignee($id_consignee)
  {
    $this->M_consignee->delete_consignee($id_consignee);
    echo json_encode(array("status" => TRUE));
  }

}
