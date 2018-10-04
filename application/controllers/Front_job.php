<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_job extends CI_Controller {
  /**
   *  =======   Author  : Anggi Fitrahandika         =======
   *  =======   Email   : anggifitra141@gmail.com    =======
   *  =======   Version : V.1.0                      =======
   *  ===========       Copyright 2018          ===========
  */
   public function __construct()
		{
			parent::__construct();
      $this->load->model('M_front_job');

		}

	public function index()
	{
		$this->load->view('front_job');
	}

  public function ajax_list()
  {
      $list = $this->M_front_job->Get_All();
      $data = array();
      $no = 1;
      foreach ($list as $item) {
          $row = array();
          $row[] = $no++;
          $row[] = $item->job_no;
          $row[] = $item->customer_ref_no;
          $row[] = $item->stuffing;
          $row[] = $item->closing_cy;
          $row[] = $item->quantity;
          $row[] = $item->pod;
          $row[] = $this->IndonesiaTgl($item->etd);
          $row[] = $this->IndonesiaTgl($item->eta);
          $row[] = $item->status;
          $row[] = $this->IndonesiaTgl($item->lift_on);
          $row[] = $this->IndonesiaTgl($item->lift_off);
          $row[] = $this->IndonesiaTgl($item->input_vgm);
          $row[] = $this->IndonesiaTgl($item->final_si);
          $row[] = $this->IndonesiaTgl($item->bl_date);
          $row[] = $this->IndonesiaTgl($item->collect_bl);

          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_front_job->count_all(),
                      "recordsFiltered" => $this->M_front_job->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
  }

  public function IndonesiaTgl($tanggal)
  {
    	$tgl=substr($tanggal,8,2);
    	$bln=substr($tanggal,5,2);
    	$thn=substr($tanggal,0,4);
    	$tanggal="$tgl-$bln-$thn";
    	return $tanggal;
  }
}
