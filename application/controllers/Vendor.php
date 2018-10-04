<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
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
      $this->load->model('M_vendor');
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
      $data['content'] = $this->load->view('vendor', $data, TRUE);
			$this->load->view('layout', $data);
  }

  public function ajax_list()
  {
      $list = $this->M_vendor->Get_All();
      $data = array();
      $no = 1;
      foreach ($list as $item) {
          $row = array();
          $row[] = $no++;
          $row[] = $item->code;
          $row[] = $item->nama_vendor;
          $row[] = $item->alamat1;
          $row[] = $item->alamat2;
          $row[] = $item->alamat3;
          $row[] = $item->kota;
          $row[] = $item->negara;
          $row[] = $item->kode_pos;
          $row[] = $item->phone_no;
          $row[] = $item->fax_no;
          $row[] = $item->email;
          $row[] = $item->credit_terms;
          $row[] = '<a onclick="get_vendor('.$item->id_vendor.')" class="btn btn-sm green btn-outline sbold"><i class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>&nbsp;&nbsp;<a onclick="delete_vendor('.$item->id_vendor.')" class="btn btn-sm red btn-outline sbold"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_vendor->count_all(),
                      "recordsFiltered" => $this->M_vendor->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
  }

  public function get_vendor($id_vendor)
  {
      $data = $this->M_vendor->get_vendor($id_vendor);
      echo json_encode($data);
  }

  public function tambah_vendor()
  {
      $data = array(
        'code' => $this->input->post('code'),
        'nama_vendor' => $this->input->post('nama_vendor'),
        'alamat1' => $this->input->post('alamat1'),
        'alamat2' => $this->input->post('alamat2'),
        'alamat3' => $this->input->post('alamat3'),
        'kota' => $this->input->post('kota'),
        'negara' => $this->input->post('negara'),
        'kode_pos' => $this->input->post('kode_pos'),
        'phone_no' => $this->input->post('phone_no'),
        'fax_no' => $this->input->post('fax_no'),
        'email' => $this->input->post('email'),
        'bank_name1' => $this->input->post('bank_name1'),
        'bank_account1' => $this->input->post('bank_account1'),
        'bank_name2' => $this->input->post('bank_name2'),
        'bank_account2' => $this->input->post('bank_account2'),
        'contact_name' => $this->input->post('contact_name'),
        'credit_terms' => $this->input->post('credit_terms'),
        'activation_date' => date('Y-m-d'),
       );
       $this->M_vendor->tambah_vendor($data);
       echo json_encode(array("status" => TRUE ));
  }

  public function update_vendor()
  {
      $data = array(
        'code' => $this->input->post('code'),
        'nama_vendor' => $this->input->post('nama_vendor'),
        'alamat1' => $this->input->post('alamat1'),
        'alamat2' => $this->input->post('alamat2'),
        'alamat3' => $this->input->post('alamat3'),
        'kota' => $this->input->post('kota'),
        'negara' => $this->input->post('negara'),
        'kode_pos' => $this->input->post('kode_pos'),
        'phone_no' => $this->input->post('phone_no'),
        'fax_no' => $this->input->post('fax_no'),
        'email' => $this->input->post('email'),
        'bank_name1' => $this->input->post('bank_name1'),
        'bank_account1' => $this->input->post('bank_account1'),
        'bank_name2' => $this->input->post('bank_name2'),
        'bank_account2' => $this->input->post('bank_account2'),
        'contact_name' => $this->input->post('contact_name'),
        'credit_terms' => $this->input->post('credit_terms'),
       );
       $this->M_vendor->update_vendor(array('id_vendor' => $this->input->post('id_vendor')), $data);
       echo json_encode(array("status" => TRUE ));
  }

  public function delete_vendor($id_vendor)
  {
    $this->M_vendor->delete_vendor($id_vendor);
    echo json_encode(array("status" => TRUE));
  }

}
