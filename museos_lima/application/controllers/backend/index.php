<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// INDEX del backend - modo Superadmin
class Index extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('backend');
		$this->session_id = $this->session->userdata('login');
		$this->load->model('super_model');
                $this->load->helper(array('dompdf', 'file','form', 'url'));     
	}
	public function index()
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{
		  	$this->layout->setTitle("Yaqua - Cpanel");
                        $this->layout->setSubTitle("Panel Administrativo");
                        //$this->layout->setBreadcrumb("<a href='#' class='current'>Inventario General</a>");
                    
                        $saludo=$this->session_id;
			$this->layout->view('index');			
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
			redirect(base_url().'backend/login',  301);
		}
	}   
       
	/* ====================================
	==========================================*/
        
       public function listar_distritos()
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{
			                       
                        if($this->input->post())//Codicional Tipo de Datos que Recibe
                        {
                            
                            $id = $this->input->post("id_distrito",true);
                            $tipo_proceso = $this->input->post("tipo_proceso",true);
                            $pagina_post = $this->input->post("pagina_post",true);
                            if($tipo_proceso=="suspender")
                            {    
                             $data_formulario_uno=array
                             ( 'dis_estado' => 'deshabilitado'
                              );
                              $this->super_model->actualizar_distrito($data_formulario_uno,$id);
                            
                              $this->session->set_flashdata('ControllerMessage', 'Se procedio a la anulacion con exito');//Mensaje a mostrar si es True
                              $this->session->set_flashdata('ControllerMessageTipo','mensaje_exito' );//tipo de mensaje a mostrar 
                              redirect(base_url().'backend/index/listar_distritos/'.$pagina_post,  301);
                            
                            }
                        } //fin del post
                        // ------- Inicio del listar 	
			 //Creamos el codigo de la paginacion
			 if($this->uri->segment(4))
			 { $pagina=$this->uri->segment(4);
			 }
			 else
			 { $pagina=0;
			 }
			$porpagina=500;
			$datos=$this->super_model->lista_distritos_all($pagina,$porpagina,"limit");
			$cuantos=$this->super_model->lista_distritos_all($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'backend/index/listar_distritos';
			$config['total_rows'] = $cuantos;
			$config['per_page'] = $porpagina;
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['first_link'] = 'Primero';
			$config['next_link'] = 'Siguiente';
			$config['prev_link'] = 'Anterior';
			$config['last_link'] = 'Ultimo';
			$this->pagination->initialize($config);
			
                        $datos_ciudad = $this->super_model->listar_ciudades_habilitadas();
                        ///////////////////////TITULOS/////////////////////
			$this->layout->setTitle("Yaqua");
			$this->layout->setSubTitle("Lista de Distritos");
			$this->layout->setBreadcrumb("<a class='current' href='".base_url()."/backend/index/listar_distritos'>Listado de Distritos</a> ");
			///////////////////////TITULOS/////////////////////
                        //
			// Cargamos la vista con los datos
			$this->layout->view("listar_distritos",compact("datos","datos_ciudad","cuantos","pagina","porpagina"));
			
			// ------- fin del listar distribuidor			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
			redirect(base_url().'backend/login',  301);
		}
	}//fin del metodo listar
        
        public function edit_distrito($id=0)
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{// inicio de la session valida
		if(!$id)
		{ show_404();
		}
		 if($this->input->post())//Codicional Tipo de Datos que Recibe
                 {    
                   
                   $this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required');
                   $this->form_validation->set_rules('url_mapa', 'URL', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('estado', 'Estado', 'trim|required');

                   //$this->form_validation->set_message('required', 'El campo %s es obligatorio');
                   $this->form_validation->set_message('required', 'Requerido');
                 

                    if($this->form_validation->run()!=FALSE){

                       $id = $this->input->post("id",true);
                       $data_formulario_uno=array //Llenamos el array con los datos del formulario
                       (
                           'id_ciudad' => $this->input->post("ciudad",true),
                           'dis_descripcion' => htmlspecialchars(stripslashes($this->input->post("descripcion",true))),
                           'dis_mapa' => $this->input->post("url_mapa",true),
                           'dis_estado' => $this->input->post("estado",true)
                        );
                       $this->super_model->actualizar_distrito($data_formulario_uno,$id);
                       
                       $this->session->set_flashdata('ControllerMessage', 'Se ha Modificado el registro exitosamente.');//Mensaje a mostrar si es True
			redirect(base_url().'backend/index/edit_distrito/'.$id,  301);
                        
                    } //fin de la validacion  
                  }//fin del post
		
		//consultamos a la bd 	
		$datos=$this->super_model->buscardistrito_xid($id);	
		if($datos==FALSE)
		{ show_404();
		} 
                else {
                 $datos_ciudad=$this->super_model->listar_ciudades_habilitadas();	
                }
                
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Yaqua");
                $this->layout->setSubTitle("Editar Distrito");
                $this->layout->setBreadcrumb("<a href='".base_url()."/backend/index/listar_distritos'>Listar Distritos</a> <a href='#' class='current'>Editar Distrito</a>");
                ///////////////////////TITULOS/////////////////////
                       
		//carga la vista
		$this->layout->view("edit_distrito",compact('id','datos','datos_ciudad'));	
			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
		    redirect(base_url().'backend/login',  301);
		}
			  
	}// fin de la funcion editar
	
         public function edit_museo($id=0)
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{// inicio de la session valida
		if(!$id)
		{ show_404();
		}
		 if($this->input->post())//Codicional Tipo de Datos que Recibe
                 {    
                   
                   $this->form_validation->set_rules('Nombre', 'Nombre', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('categoria', 'categoria', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('Ubicacion', 'Ubicacion', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('Horario', 'Horario', 'trim |xss_clean');
                   $this->form_validation->set_rules('Costo', 'Costo', 'trim|xss_clean');
                   $this->form_validation->set_rules('Telefono', 'Telefono', 'trim|xss_clean');

                   $this->form_validation->set_rules('Correo', 'Correo', 'trim');
                   $this->form_validation->set_rules('Web', 'Web', 'trim|xss_clean');

                   $this->form_validation->set_rules('url_mapa', 'URL', 'trim|xss_clean');
                   $this->form_validation->set_rules('estado', 'Estado', 'trim|required');

                   
                   //$this->form_validation->set_message('required', 'El campo %s es obligatorio');
                   $this->form_validation->set_message('required', 'Requerido');
                 

                    if($this->form_validation->run()!=FALSE){

                       $id = $this->input->post("id",true);
                       $data_formulario_uno=array //Llenamos el array con los datos del formulario
                       (
                            'Nombre' => $this->input->post("Nombre",true),
                           'id_categ' => htmlspecialchars(stripslashes($this->input->post("categoria",true))),
                           'Ubicacion' => htmlspecialchars(stripslashes($this->input->post("Ubicacion",true))),
                           'Direccion' => htmlspecialchars(stripslashes($this->input->post("Direccion",true))),
                           'Horario' => htmlspecialchars(stripslashes($this->input->post("Horario",true))),
                           'Telefono' => htmlspecialchars(stripslashes($this->input->post("Telefono",true))),
                           'Correo' => htmlspecialchars(stripslashes($this->input->post("Correo",true))),
                           'Web' => htmlspecialchars(stripslashes($this->input->post("Web",true))),

                           'url' => $this->input->post("url_mapa",true),
                           'estado' => $this->input->post("estado",true)
                        );
                       $this->super_model->actualizar_museo($data_formulario_uno,$id);
                       
                       $this->session->set_flashdata('ControllerMessage', 'Se ha Modificado el registro exitosamente.');//Mensaje a mostrar si es True
			redirect(base_url().'backend/index/edit_museo/'.$id,  301);
                        
                    } //fin de la validacion  
                  }//fin del post
		
		//consultamos a la bd 	
		$datos=$this->super_model->buscarmuseo_xid($id);	
		if($datos==FALSE)
		{ show_404();
		} 
                else {
                 $datos_ciudad=$this->super_model->listar_categoria_habilitada();	
                }
                
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Museos");
                $this->layout->setSubTitle("Editar Museo");
                $this->layout->setBreadcrumb("<a href='".base_url()."/backend/index/listar_museos'>Listar Museos</a> <a href='#' class='current'>Editar Museos</a>");
                ///////////////////////TITULOS/////////////////////
                       
		//carga la vista
		$this->layout->view("edit_museo",compact('id','datos','datos_ciudad'));	
			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
		    redirect(base_url().'backend/login',  301);
		}
			  
	}// fin de la funcion editar
	
        
         public function add_museo()
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{// inicio de la session valida
		
		 if($this->input->post())//Codicional Tipo de Datos que Recibe
                 {    
                   
                   $this->form_validation->set_rules('Nombre', 'Nombre', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('categoria', 'categoria', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('Ubicacion', 'Ubicacion', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('Horario', 'Horario', 'trim |xss_clean');
                   $this->form_validation->set_rules('Costo', 'Costo', 'trim|xss_clean');
                   $this->form_validation->set_rules('Telefono', 'Telefono', 'trim|xss_clean');

                   $this->form_validation->set_rules('Correo', 'Correo', 'trim');
                   $this->form_validation->set_rules('Web', 'Web', 'trim|xss_clean');

                   $this->form_validation->set_rules('url_mapa', 'URL', 'trim|xss_clean');
                   $this->form_validation->set_rules('estado', 'Estado', 'trim|required');

                   //$this->form_validation->set_message('required', 'El campo %s es obligatorio');
                   $this->form_validation->set_message('required', 'Requerido');
                 

                    if($this->form_validation->run()!=FALSE){

                       
                       $data_formulario_uno=array //Llenamos el array con los datos del formulario
                       (
                           'Nombre' => $this->input->post("Nombre",true),
                           'id_categ' => htmlspecialchars(stripslashes($this->input->post("categoria",true))),
                           'Ubicacion' => htmlspecialchars(stripslashes($this->input->post("Ubicacion",true))),
                           'Direccion' => htmlspecialchars(stripslashes($this->input->post("Direccion",true))),
                           'Horario' => htmlspecialchars(stripslashes($this->input->post("Horario",true))),
                           'Telefono' => htmlspecialchars(stripslashes($this->input->post("Telefono",true))),
                           'Correo' => htmlspecialchars(stripslashes($this->input->post("Correo",true))),
                           'Web' => htmlspecialchars(stripslashes($this->input->post("Web",true))),

                           'url' => $this->input->post("url_mapa",true),
                           'estado' => $this->input->post("estado",true)
                        );
                       $this->super_model->insertar_museo($data_formulario_uno);
                       
                       $this->session->set_flashdata('ControllerMessage', 'Se ha Agregado exitosamente el registro.');//Mensaje a mostrar si es True
			redirect(base_url().'backend/index/listar_museos/',  301);
                        
                    } //fin de la validacion  
                  }//fin del post
		
		//consultamos a la bd 	
		
                $datos_categoria=$this->super_model->listar_categoria_habilitada();	
               
                
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Museos");
                $this->layout->setSubTitle("Agregar Museo");
                $this->layout->setBreadcrumb("<a href='".base_url()."/backend/index/listar_museos'>Listar Museos</a> <a href='#' class='current'>Agregar Museo</a>");
                ///////////////////////TITULOS/////////////////////
                       
		//carga la vista
		$this->layout->view("add_museo",compact('datos_categoria'));	
			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
		    redirect(base_url().'backend/login',  301);
		}
		
		
			  
	}// fin de la funcion add
        
    
    /* ====================================
	==========================================*/
	
        public function listar_museos()
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{
			                       
                        if($this->input->post())//Codicional Tipo de Datos que Recibe
                        {
                            
                            $id = $this->input->post("id",true);
                            $tipo_proceso = $this->input->post("tipo_proceso",true);
                            $pagina_post = $this->input->post("pagina_post",true);
                            if($tipo_proceso=="suspender")
                            {    
                             $data_formulario_uno=array
                             ( 'estado' => 'deshabilitado'
                              );
                              $this->super_model->actualizar_museo($data_formulario_uno,$id);
                            
                              $this->session->set_flashdata('ControllerMessage', 'Se procedio a la anulacion con exito');//Mensaje a mostrar si es True
                              $this->session->set_flashdata('ControllerMessageTipo','mensaje_exito' );//tipo de mensaje a mostrar 
                              redirect(base_url().'backend/index/listar_museos/'.$pagina_post,  301);
                            
                            }
                        } //fin del post
                        // ------- Inicio del listar 	
			 //Creamos el codigo de la paginacion
			 if($this->uri->segment(4))
			 { $pagina=$this->uri->segment(4);
			 }
			 else
			 { $pagina=0;
			 }
			$porpagina=500;
			$datos=$this->super_model->lista_museos_all($pagina,$porpagina,"limit");
			$cuantos=$this->super_model->lista_museos_all($pagina,$porpagina,"cuantos");
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
			
                        $datos_ciudad = $this->super_model->listar_categoria_habilitada();
                        ///////////////////////TITULOS/////////////////////
			$this->layout->setTitle("Museos");
			$this->layout->setSubTitle("Lista de Museos");
			$this->layout->setBreadcrumb("<a class='current' href='".base_url()."/backend/index/listar_museos'>Listado de Museos</a> ");
			///////////////////////TITULOS/////////////////////
                        //
			// Cargamos la vista con los datos
			$this->layout->view("listar_museos",compact("datos","datos_ciudad","cuantos","pagina","porpagina"));
			
			// ------- fin del listar distribuidor			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
			redirect(base_url().'backend/login',  301);
		}
	}//fin del metodo listar
        
        
	
	 public function listar_categorias()
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{
			                       
                        if($this->input->post())//Codicional Tipo de Datos que Recibe
                        {
                            
                            $id = $this->input->post("id_categ",true);
                            $tipo_proceso = $this->input->post("tipo_proceso",true);
                            $pagina_post = $this->input->post("pagina_post",true);
                            if($tipo_proceso=="suspender")
                            {    
                             $data_formulario_uno=array
                             ( 'estado' => 'deshabilitado'
                              );
                              $this->super_model->actualizar_categoria($data_formulario_uno,$id);
                            
                              $this->session->set_flashdata('ControllerMessage', 'Se procedio a la anulacion con exito');//Mensaje a mostrar si es True
                              $this->session->set_flashdata('ControllerMessageTipo','mensaje_exito' );//tipo de mensaje a mostrar 
                              redirect(base_url().'backend/index/listar_categorias/'.$pagina_post,  301);
                            
                            }
                        } //fin del post
                        // ------- Inicio del listar 	
			 //Creamos el codigo de la paginacion
			 if($this->uri->segment(4))
			 { $pagina=$this->uri->segment(4);
			 }
			 else
			 { $pagina=0;
			 }
			$porpagina=500;
			$datos=$this->super_model->lista_categorias_all($pagina,$porpagina,"limit");
			$cuantos=$this->super_model->lista_categorias_all($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'backend/index/listar_categorias';
			$config['total_rows'] = $cuantos;
			$config['per_page'] = $porpagina;
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['first_link'] = 'Primero';
			$config['next_link'] = 'Siguiente';
			$config['prev_link'] = 'Anterior';
			$config['last_link'] = 'Ultimo';
			$this->pagination->initialize($config);
			
                        $datos_ciudad = $this->super_model->listar_categoria_habilitada();
                        ///////////////////////TITULOS/////////////////////
			$this->layout->setTitle("Categorias");
			$this->layout->setSubTitle("Lista de Categorias");
			$this->layout->setBreadcrumb("<a class='current' href='".base_url()."/backend/index/listar_categorias'>Listado de Categorias</a> ");
			///////////////////////TITULOS/////////////////////
                        //
			// Cargamos la vista con los datos
			$this->layout->view("listar_categorias",compact("datos","datos_ciudad","cuantos","pagina","porpagina"));
			
			// ------- fin del listar distribuidor			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
			redirect(base_url().'backend/login',  301);
		}
	}//fin del metodo listar
    
	 public function edit_categorias($id=0)
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{// inicio de la session valida
		if(!$id)
		{ show_404();
		}
		 if($this->input->post())//Codicional Tipo de Datos que Recibe
                 {    
                   
                   $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
                   
                   $this->form_validation->set_rules('estado', 'Estado', 'trim|required');

                   
                   //$this->form_validation->set_message('required', 'El campo %s es obligatorio');
                   $this->form_validation->set_message('required', 'Requerido');
                 

                    if($this->form_validation->run()!=FALSE){

                       $id = $this->input->post("id",true);
                       $data_formulario_uno=array //Llenamos el array con los datos del formulario
                       (
                            'nombre' => $this->input->post("nombre",true),
                           'estado' => $this->input->post("estado",true)
                        );
                       $this->super_model->actualizar_categoria($data_formulario_uno,$id);
                       
                       $this->session->set_flashdata('ControllerMessage', 'Se ha Modificado el registro exitosamente.');//Mensaje a mostrar si es True
			redirect(base_url().'backend/index/edit_categorias/'.$id,  301);
                        
                    } //fin de la validacion  
                  }//fin del post
		
		//consultamos a la bd 	
		$datos=$this->super_model->buscarcategoria_xid($id);	
		if($datos==FALSE)
		{ show_404();
		} 
                else {
                 $datos_ciudad=$this->super_model->listar_categoria_habilitada();	
                }
                
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Categorias de Museos");
                $this->layout->setSubTitle("Editar Categoria");
                $this->layout->setBreadcrumb("<a href='".base_url()."/backend/index/listar_categorias'>Listar Categorias</a> <a href='#' class='current'>Editar Categoria</a>");
                ///////////////////////TITULOS/////////////////////
                       
		//carga la vista
		$this->layout->view("edit_categorias",compact('id','datos','datos_ciudad'));	
			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
		    redirect(base_url().'backend/login',  301);
		}
			  
	}// fin de la funcion editar
        
            public function add_categoria()
	{
		if(!empty($this->session_id) && $this->session->userdata('nivel')=="superadmin")
		{// inicio de la session valida
		
		 if($this->input->post())//Codicional Tipo de Datos que Recibe
                 {    
                   
                   $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
                   $this->form_validation->set_rules('estado', 'Estado', 'trim|required');

                   //$this->form_validation->set_message('required', 'El campo %s es obligatorio');
                   $this->form_validation->set_message('required', 'Requerido');
                 

                    if($this->form_validation->run()!=FALSE){

                       
                       $data_formulario_uno=array //Llenamos el array con los datos del formulario
                       (
                           'nombre' => $this->input->post("nombre",true),
                           'estado' => $this->input->post("estado",true)
                        );
                       $this->super_model->insertar_categoria($data_formulario_uno);
                       
                       $this->session->set_flashdata('ControllerMessage', 'Se ha Agregado exitosamente el registro.');//Mensaje a mostrar si es True
			redirect(base_url().'backend/index/listar_categorias/',  301);
                        
                    } //fin de la validacion  
                  }//fin del post
		
		//consultamos a la bd 	
		
                $datos_categoria=$this->super_model->listar_categoria_habilitada();	
               
                
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Categoriaa");
                $this->layout->setSubTitle("Agregar Categoria de Museo");
                $this->layout->setBreadcrumb("<a href='".base_url()."/backend/index/listar_categorias'>Listar Categorias</a> <a href='#' class='current'>Agregar Categoria</a>");
                ///////////////////////TITULOS/////////////////////
                       
		//carga la vista
		$this->layout->view("add_categoria",compact('datos_categoria'));	
			
		} //fin de la session valida
		elseif(!empty($this->session_id) && $this->session->userdata('nivel')=="admin")
		{
		  redirect(base_url().'backend/admin',  301);
		} 
		
		else
		{
		    redirect(base_url().'backend/login',  301);
		}
		
		
			  
	}// fin de la funcion add
}//fin de la clase

