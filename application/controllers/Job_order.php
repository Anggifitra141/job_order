<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_order extends CI_Controller {
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
      $this->load->model('M_job_order');
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
      $data['shipper'] = $this->M_job_order->get_shipper();
      $data['product'] = $this->M_job_order->get_product();
      $data['consignee'] = $this->M_job_order->get_consignee();
      //$data['no_urut'] = $this->M_job_order->no_urut();
      $data['no_urut_hbl'] = $this->M_job_order->no_urut_hbl();

      $data['content'] = $this->load->view('job_order', $data, TRUE);
      $this->update_status_closed();
			$this->load->view('layout', $data);
  }

  public function ajax_list()
  {
      $list = $this->M_job_order->Get_All();
      $data = array();
      $no = 1;
      foreach ($list as $item) {
          $row = array();
          $row[] = $no++;
            $row[] = '<a onclick="get_job_order('.$item->id_job_order.')" class="btn btn-sm green btn-outline sbold"><i class="fa fa-edit" aria-hidden="true" title="Edit"></i></a>&nbsp;&nbsp;<a onclick="delete_job_order('.$item->id_job_order.')" class="btn btn-sm red btn-outline sbold"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>';
          $row[] = $item->job_no;
          $row[] = $item->customer_ref_no;
          $row[] = $this->IndonesiaTgl($item->stuffing);
          $row[] = $this->IndonesiaTgl($item->closing_cy);
          $row[] = $item->pol;
          $row[] = $item->pod;
          $row[] = $item->quantity;
          $row[] = $this->IndonesiaTgl($item->etd);
          $row[] = $this->IndonesiaTgl($item->eta);
          $row[] = $this->IndonesiaTgl($item->lift_on);
          $row[] = $this->IndonesiaTgl($item->lift_off);
          $row[] = $this->IndonesiaTgl($item->input_vgm);
          $row[] = $this->IndonesiaTgl($item->final_si);
          $row[] = $this->IndonesiaTgl($item->bl_date);
          $row[] = $this->IndonesiaTgl($item->collect_bl);
          $row[] = $item->vessel_veeder;
          $row[] = $item->linner;
          $row[] = $item->vessel_conn;
          $row[] = $item->bl;
          $row[] = $item->hbl;
          $row[] = $item->other;
          $row[] = $item->status;
        /*  if ($item->status == "SUCCESS"){
            $row[] =  "<h5 style='color:green;  font-weight: bold;'>SUCCESS</h5>";
          }else if($item->status == "CLOSED"){
            $row[] =  "<h5 style='color:red;  font-weight: bold;'>CLOSED</h5>";
          }else{
            $row[] =  "<h5 style='color:#F3C200; font-weight: bold;'>OPEN</h5>";
          }
        */

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_job_order->count_all(),
                      "recordsFiltered" => $this->M_job_order->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
  }


  public function get_job_order($id_job_order)
  {
      $data = $this->M_job_order->get_job_order($id_job_order);
      echo json_encode($data);
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

  public function update_status_closed()
  {
    $this->M_job_order->update_status_closed();
  }

  public function get_no_urut_shipper($shipper)
  {
      $data =  $this->M_job_order->get_no_urut_shipper($shipper);
      echo json_encode($data);
  }

  public function get_no_urut_product($product)
  {
      $data =  $this->M_job_order->get_no_urut_product($product);
      echo json_encode($data);
  }

  public function tambah_job_order()
  {
      $data = array(
        'job_no' => $this->input->post('job_no'),
        'shipper' => $this->input->post('shipper'),
        'product' => $this->input->post('product'),
        'consignee' => $this->input->post('consignee'),
        'notify' => $this->input->post('notify'),
        'etd' => $this->InggrisTgl($this->input->post('etd')),
        'eta' => $this->InggrisTgl($this->input->post('eta')),
        'lift_on' => $this->InggrisTgl($this->input->post('lift_on')),
        'input_vgm' => $this->InggrisTgl($this->input->post('input_vgm')),
        'final_si' => $this->InggrisTgl($this->input->post('final_si')),
        'bl_date' => $this->InggrisTgl($this->input->post('bl_date')),
        'bl_date_fix' => date('Y-m-d', strtotime($this->input->post('bl_date'). '+ 3 days')),
        'collect_bl' => $this->InggrisTgl($this->input->post('collect_bl')),
        'lift_off' => $this->InggrisTgl($this->input->post('lift_off')),
        'customer_ref_no' => $this->input->post('customer_ref_no'),
        'stuffing' => $this->InggrisTgl($this->input->post('stuffing')),
        'closing_cy' => $this->InggrisTgl($this->input->post('closing_cy')),
        'quantity' => $this->input->post('quantity'),
        'pol' => $this->input->post('pol'),
        'pod' => $this->input->post('pod'),
        'vessel_veeder' => $this->input->post('vessel_veeder'),
        'linner' => $this->input->post('linner'),
        'vessel_conn' => $this->input->post('vessel_conn'),
        'bl' => $this->input->post('bl'),
        'hbl' => $this->input->post('hbl'),
        'other' => $this->input->post('other'),
        'status' => "OPEN",
        'activation_date' => date('Y-m-d'),
       );
       $this->M_job_order->tambah_job_order($data);
       echo json_encode(array("status" => TRUE ));
  }

  public function update_job_order()
  {
      $data = array(
        'job_no' => $this->input->post('job_no'),
        'shipper' => $this->input->post('shipper'),
        'product' => $this->input->post('product'),
        'consignee' => $this->input->post('consignee'),
        'notify' => $this->input->post('notify'),
        'etd' => $this->InggrisTgl($this->input->post('etd')),
        'eta' => $this->InggrisTgl($this->input->post('eta')),
        'lift_on' => $this->InggrisTgl($this->input->post('lift_on')),
        'input_vgm' => $this->InggrisTgl($this->input->post('input_vgm')),
        'final_si' => $this->InggrisTgl($this->input->post('final_si')),
        'bl_date' => $this->InggrisTgl($this->input->post('bl_date')),
        'bl_date_fix' => date('Y-m-d', strtotime($this->input->post('bl_date'). '+ 3 days')),
        'collect_bl' => $this->InggrisTgl($this->input->post('collect_bl')),
        'lift_off' => $this->InggrisTgl($this->input->post('lift_off')),
        'customer_ref_no' => $this->input->post('customer_ref_no'),
        'stuffing' => $this->InggrisTgl($this->input->post('stuffing')),
        'closing_cy' => $this->InggrisTgl($this->input->post('closing_cy')),
        'quantity' => $this->input->post('quantity'),
        'pol' => $this->input->post('pol'),
        'pod' => $this->input->post('pod'),
        'vessel_veeder' => $this->input->post('vessel_veeder'),
        'linner' => $this->input->post('linner'),
        'vessel_conn' => $this->input->post('vessel_conn'),
        'bl' => $this->input->post('bl'),
        'hbl' => $this->input->post('hbl'),
        'other' => $this->input->post('other'),
        'status' => $this->input->post('status')
       );
       $this->M_job_order->update_job_order(array('id_job_order' => $this->input->post('id_job_order')), $data);
       echo json_encode(array("status" => TRUE ));
       $this->M_job_order->update_status_closed();
  }

  public function delete_job_order($id_job_order)
  {
    $this->M_job_order->delete_job_order($id_job_order);
    echo json_encode(array("status" => TRUE));
  }

}
