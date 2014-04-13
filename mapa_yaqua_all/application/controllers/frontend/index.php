<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('tab');
                $this->load->model('super_model');
	}
	
	public function index()
	{
           ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("Yaqua");
            $this->load->model('super_model');
            $this->load->helper('my_funciones_helper');
            
            $distritos =$this->super_model->listar_distritos_habilitadas();
            
            $id =$this->uri->segment(3);
            if($id==""){$id=1;}
            if($this->input->post())
            {    
                 $id = $this->input->post("distrito",true);
                 
            }
           
            //$this->layout->setSubTitle("Logueo de Usuario");
            ///////////////////////TITULOS/////////////////////  
	  $this->layout->view('index',compact("distritos","id"));
          
	}//fin de la funcion
        
       
      
}//fin del controlador

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */