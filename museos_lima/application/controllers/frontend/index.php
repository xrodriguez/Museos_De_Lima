<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
                $this->load->model('super_model');
	}
	
        public function index_mapa()
	{
           $this->layout->setLayout('tab');
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
        
	public function index()
	{
           $this->layout->setLayout('layout_internas');
            ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("Museos");
            $this->load->model('super_model');
            $this->load->helper('my_funciones_helper');
            
            if($this->uri->segment(3))
             { $pagina=$this->uri->segment(3);
             
             }
             else
             { $pagina=0;
             }
            $porpagina=24;
            $array_museos=$this->super_model->lista_museos_hab_pag($pagina,$porpagina,"limit");
            $cuantos=$this->super_model->lista_museos_hab_pag($pagina,$porpagina,"cuantos");
            $config['base_url'] = base_url().'backend/index/listar_museos';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $this->pagination->initialize($config);
            
            
            $array_categoria =$this->super_model->listar_categoria_habilitada();
            
            $id =$this->uri->segment(3);
            if($id==""){$id=1;}
            if($this->input->post())
            {    
                 
            }
           
            //$this->layout->setSubTitle("Logueo de Usuario");
            ///////////////////////TITULOS/////////////////////  
	  $this->layout->view('galeria_museos',compact("id","array_museos","array_categoria","cuantos","pagina","porpagina"));
          
	}//fin de la funcion
        
        
        public function detalle_museo($id,$pagina)
	{
           $this->layout->setLayout('layout_internas');
            ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("Museos");
            $this->load->model('super_model');
            $this->load->helper('my_funciones_helper');
            
            
            
            $id =$this->uri->segment(3);
            if($id==""){$id=1;}
            $pagina =$this->uri->segment(4);
            if($pagina==""){$pagina=1;}
            if($this->input->post())
            {    
                 
            }
            $data_museo =$this->super_model->buscarmuseo_xid($id);
            
            //$this->layout->setSubTitle("Logueo de Usuario");
            ///////////////////////TITULOS/////////////////////  
	  $this->layout->view('detalle_museo',compact("id","pagina","data_museo"));
          
	}//fin de la funcion
       
      
}//fin del controlador

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */