<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
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
      $this->load->model('M_customer');
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
      $data['content'] = $this->load->view('customer', $data, TRUE);
			$this->load->view('layout', $data);
  }

  public function ajax_list()
  {
      $list = $this->M_customer->Get_All();
      $data = array();
      $no = 1;
      foreach ($list as $item) {
          $row = array();
          $row[] = $no++;
          $row[] = $item->code;
          $row[] = $item->nama_customer;
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
          $row[] = '<a onclick="get_customer('.$item->id_customer.')" class="btn btn-sm green btn-outline sbold"><i class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>&nbsp;&nbsp;<a onclick="delete_customer('.$item->id_customer.')" class="btn btn-sm red btn-outline sbold"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>';

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_customer->count_all(),
                      "recordsFiltered" => $this->M_customer->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
  }

  public function get_customer($id_customer)
  {
      $data = $this->M_customer->get_customer($id_customer);
      echo json_encode($data);
  }

  public function tambah_customer()
  {
      $data = array(
        'code' => $this->input->post('code'),
        'nama_customer' => $this->input->post('nama_customer'),
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
       $this->M_customer->tambah_customer($data);
       echo json_encode(array("status" => TRUE ));
  }

  public function update_customer()
  {
      $data = array(
        'code' => $this->input->post('code'),
        'nama_customer' => $this->input->post('nama_customer'),
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
       $this->M_customer->update_customer(array('id_customer' => $this->input->post('id_customer')), $data);
       echo json_encode(array("status" => TRUE ));
  }

  public function delete_customer($id_customer)
  {
    $this->M_customer->delete_customer($id_customer);
    echo json_encode(array("status" => TRUE));
  }

}
