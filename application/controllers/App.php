<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
  /**
   *  =======   Author  : Anggi Fitrahandika         =======
   *  =======   Email   : anggifitra141@gmail.com    =======
   *  =======   Version : V.1.0                      =======
   *  ===========       Copyright 2018          ===========
  */

   public function __construct()
 		{
 			parent::__construct();
      $this->load->model('M_app');
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
      $data['job_order'] = $this->M_app->job_order();
      $data['customer'] = $this->M_app->customer();
      $data['vendor'] = $this->M_app->vendor();
      $data['consignee'] = $this->M_app->consignee();
      $data['user'] = $this->M_app->user();
      $data['product'] = $this->M_app->product();
      $data['content'] = $this->load->view('dashboard', $data, TRUE);
			$this->load->view('layout', $data);
  	}
}
