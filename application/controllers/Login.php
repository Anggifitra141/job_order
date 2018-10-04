<?php
defined('BASEPATH') OR exit('Akses Tidak di izinkan boss...');

class Login extends CI_Controller {
	/**
   *  =======   Author  : Anggi Fitrahandika         =======
   *  =======   Email   : anggifitra141@gmail.com    =======
   *  =======   Version : V.1.0                      =======
   *  ===========       Copyright 2018          ===========
  */
	function __construct()
    {
    parent::__construct();
		$this->load->model('M_login');

    }

	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('app');
		}
		else
		{
			$data['title'] = 'Login';
			$this->load->view('login/index');
		}
	}

	public function check()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
		if($this->form_validation->run() == TRUE)
		{
			$data = $this->M_login->check();

			if($data == TRUE)
			{
					$output = [];
          $output["success"] = "Success, Redirecting....";
          $this->load->view("login/index", $output);
					echo '<script>
                            function refresh() {
                                window.location = "'.base_url().'app/";
							}
                            setTimeout("refresh()", 1200);
						</script>';
			}
			else
			{
					$output = [];
          $output["error"] = "Username Or Password Does Not match !.";
          $this->load->view("login/index", $output);

			}
		}
		else
		{
			echo validation_errors('<div class="bs-example">
										<div class="alert alert-danger alert-error">
        									<button class="close" data-dismiss="alert">&times;</button>
        									<strong>Error! </strong>'
											,
										'</div>
									</div>');
		}
	}

	function signout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>
