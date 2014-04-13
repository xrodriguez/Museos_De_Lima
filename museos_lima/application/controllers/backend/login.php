<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	private $session_id;
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('login_backend');
		$this->load->model('login_model'); //Llamado del modelo para la clase
		$this->session_id = $this->session->userdata('login');
	}
	
	public function index()
	{
		if($this->input->post())
		{
			//die(sha1($this->input->post("pass",true)));
			$datos=$this->login_model->logueo($this->input->post("login",true),sha1($this->input->post("pass",true)));
			 //echo $datos;exit;
			 if(!empty($datos->user_username) && !empty($datos->user_password))
			 {
				 $this->session->set_userdata("taller_ci");
                                 $this->session->set_userdata('login', $this->input->post('login',true));
				 $this->session->set_userdata('nivel', $datos->user_nivel);
				 $this->session->set_userdata('id_usuario', $datos->id_usuario);
				//$this->session->set_userdata('saludo','hola te saludo desde la sessión');
				//echo $this->session->userdata('saludo');
				//$session_id = $this->session->userdata('id_usuario');
				//echo $session_id;
                                //exit();
				 if($this->session->userdata('nivel')=="superadmin")
				 {
					redirect(base_url().'backend',  301); 
				 }
				 elseif($this->session->userdata('nivel')=="admin")
				 {
					redirect(base_url().'backend/admin',  301);
				 } 
				 elseif($this->session->userdata('nivel')=="delivery")
				 {
					 redirect(base_url().'backend/delivery',  301);
				 }
				 elseif($this->session->userdata('nivel')=="asistente")
				 {
					 redirect(base_url().'backend/asistente',  301);
				 }
			 }
			 else
			 {
				 $this->session->set_flashdata('ControllerMessage','Usuario y/o clave incorrecta');
				 redirect(base_url().'backend/login', 301);
			 }
		}
		
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{
		  redirect(base_url().'backend',  301); 
		}
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="delivery")
		{
		   redirect(base_url().'backend/delivery',  301);
		}
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="asistente")
		{
		   redirect(base_url().'backend/asistente',  301);
		}
		else
		{
			$this->layout->setTitle("Login");
			$this->layout->view('index');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata(array('login' => ''));
		$this->session->sess_destroy("taller_ci");
		redirect(base_url().'backend/login',  301);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */