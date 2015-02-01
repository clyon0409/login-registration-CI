<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('index');
		
	}

	public function register()
	{
		$info = $this->input->post();

		if($info('action')  == 'register')
		{
			$this->load->library('form_validation');

			echo 'loaded form_validation library';
			if($this->form_validation->run() == FALSE)
			{
				echo 'form validation returned false';
				$this->load->view('index');
			}
			else
			{
				echo 'form validation returned true';
				$this->load->view('success');
			}
		}
	}
}

//end of main controller