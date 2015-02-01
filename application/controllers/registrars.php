<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrars extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
		$this->load->model('Registrar');
	}

	public function index()
	{
		$this->load->view('index');
		
	}

	public function process()
	{
		$info = $this->input->post();
		$this->load->library('form_validation');


		if($this->input->post('action')  == 'register')
		{
			$this->set_rules('register');

			if($this->form_validation->run() == FALSE)
			{
				// echo 'form validation returned false';
				// var_dump(validation_errors());
				$this->session->set_flashdata('errors',validation_errors());
				redirect('index');
			}
			else
			{
				$user['first_name'] = $this->input->post('first_name');
				$user['last_name'] = $this->input->post('last_name');
				$user['email'] = $this->input->post('email');
				$user['password'] = $this->input->post('password');

				$this->Registrar->add_user($user);

				$data['user'] = $user;
				$this->load->view('success', $data);
			}
		}
		elseif($this->input->post('action')  == 'login')
		{
			$this->set_rules('login');
			$user = $this->Registrar->get_user_by_email($this->input->post('email'));
		
			if(!empty($user))
			{
				if($this->input->post('password') == $user['password'])
				{
					$this->session->set_userdata('user_id',$user['id']);
					$info['user']=$user;
					$this->load->view('success', $info);
				}
				else
				{
					$this->session->set_flashdata('errors', 'You entered an invalid password');
					redirect('index');
				}
			}
			else
			{
				$this->session->set_flashdata('errors', 'Could not find email address');
				redirect('index');
			}
		}
	}

	public function logoff()
	{
		redirect('index');
	}

	private function set_rules($action)
	{
		if($action == 'register')
		{
			$config = array(
	           'member/signup' => array(
	                                    array(
	                                            'field' => 'first_name',
	                                            'label' => 'First Name',
	                                            'rules' => 'trim|required|alpha'
	                                         ),
	                                    array(
	                                            'field' => 'last_name',
	                                            'label' => 'Last Name',
	                                            'rules' => 'trim|required|alpha'
	                                         ),
	                                    array(
	                                            'field' => 'email',
	                                            'label' => 'Email Address',
	                                            'rules' => 'trim|required|valid_email|is_unique[users.email]'
	                                         ),
	                                    array(
	                                            'field' => 'password',
	                                            'label' => 'Password',
	                                            'rules' => 'trim|required|min_length[8]'
	                                         ),
	                                    array(
	                                            'field' => 'confirm_password',
	                                            'label' => 'Confirm password',
	                                            'rules' => 'trim|required|matches[password]'
	                                         )
	                                    )
	               );
		}
		elseif($action == 'login')
		{
			$config = array(
	           'member/signup' => array(
	                                    array(
	                                            'field' => 'email',
	                                            'label' => 'Email Address',
	                                            'rules' => 'trim|required|valid_email'
	                                         ),
	                                    array(
	                                            'field' => 'password',
	                                            'label' => 'Password',
	                                            'rules' => 'trim|required|min_length[8]'
	                                         )
	                                    )
	               );
		}

		$this->form_validation->set_rules($config['member/signup']);
	}

}