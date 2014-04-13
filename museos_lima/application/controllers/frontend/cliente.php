<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('frontend_cliente');
                $this->load->model('model_wz');
                 $this->load->helper('my_funciones_helper');
	}
	
	public function index()
	{
            $this->micta();
            
	}//fin de la funcion
	
        function logout(){
            $this->session->sess_destroy(); 
            redirect('index/login');
         }
    
        public function micta($id=0)
	{
          if(isset($this->session->userdata['user_id']))
          {  
            $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            $datos= $this->model_wz->buscarcliente_xid($id_cli);
            if($datos!=FALSE)
            {    
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Mi cuenta");
                $this->layout->view('cli_micta',compact("datos"));
            }
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion
        
        
        public function datospersonales()
        {
          if(isset($this->session->userdata['user_id']))
          {  
             $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            if($this->input->post())//Codicional Tipo de Datos que Recibe
            { 
             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');

            $this->form_validation->set_rules('nombres', 'Nombre', 'trim|required|xss_clean');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|xss_clean');
            $this->form_validation->set_rules('celular', 'Celular', 'trim|required|numeric|min_length[9]');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|xss_clean');
            $this->form_validation->set_rules('telefono2', 'Telefono2', 'trim|xss_clean');
            $this->form_validation->set_rules('anexo2', 'Anexo 2', 'trim|xss_clean');
            
            $this->form_validation->set_message('required', 'Requerido');
            $this->form_validation->set_message('numeric', 'El campo %s debe ser solo numeros ');
            $this->form_validation->set_message('exact_length', 'El campo %s debe tener 8 Digitos');
            $this->form_validation->set_message('min_length', 'El %s debe contener minimo de 9 digitos');
        
             if($this->form_validation->run()!=FALSE){
              
              $id_cli =  $this->input->post("id_cliente", true);   
              $data_formulario_uno=array //Llenamos el array con los datos del formulario
              (
                  'cli_nombres' => $this->input->post("nombres",true),
                  'cli_apellidos' => $this->input->post("apellidos",true),
                  'cli_celular' => $this->input->post("celular",true),
                  'cli_telefono1' => $this->input->post("telefono",true),
                  'cli_telefono2' => $this->input->post("telefono2",true),
                  'cli_anexo2' => $this->input->post("anexo2",true)
               );
              $datos_a_guardar = $this->model_wz->actualizar_cliente($data_formulario_uno,$id_cli);
              //var_dump($id_cli);
              //var_dump($data_formulario_uno);
              if($data_formulario_uno)
              {    
                $tipo_mensaje="mensaje_exito"; 
                $mensaje='Se actualizo los datos con exito';
              }             
             }
            
            }//fin del post
            
            $datos= $this->model_wz->buscarcliente_xid($id_cli);
            if($datos!=FALSE)
            {    
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Datos Personales");
                $this->layout->view('cli_datospersonales',compact("datos","tipo_mensaje","mensaje"));
            }
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        public function direccion()
        {
          if(isset($this->session->userdata['user_id']))
          {  
             $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            if($this->input->post())//Codicional Tipo de Datos que Recibe
            { 
             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
            // var_dump($_POST);
             
            $this->form_validation->set_rules('dir_envio', 'Direccion de Envio', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nro_envio', 'Nro envio', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dpto', 'Dpto envio', 'trim|xss_clean');
            $this->form_validation->set_rules('dis_envio', 'Distrito envio', 'trim|required');
            $this->form_validation->set_rules('ci_envio1', 'Ciudad envio', 'trim|required');
            $this->form_validation->set_rules('referencia', 'Referencia Envio', 'trim|required|xss_clean');
           
            $this->form_validation->set_rules('fac_direccion', 'Direccion laboral', 'trim|required|xss_clean');
            $this->form_validation->set_rules('fac_nro', 'Nro laboral', 'trim|required|xss_clean');
            $this->form_validation->set_rules('fac_dpto', 'Dpto laboral', 'trim|xss_clean');
            $this->form_validation->set_rules('fac_distrito', 'Distrito Laboral', 'trim|required');
            $this->form_validation->set_rules('fac_ciudad1', 'Ciudad Laboral', 'trim|required');
            $this->form_validation->set_rules('fac_referencia', 'Referencia Laboral', 'trim|required|xss_clean');
            
            
            $this->form_validation->set_message('required', 'El campo %s es Requerido');
            
             if($this->form_validation->run()!=FALSE){
              
              $id_envio =  $this->input->post("id_envio", true);   
              $data_formulario_uno=array //Llenamos el array con los datos del formulario
              (
                  'dir_nro' => $this->input->post("nro_envio",true),
                  'dir_dpto' => $this->input->post("dpto",true),
                  'dir_direccion' => $this->input->post("dir_envio",true),
                  'dir_ciudad' => $this->input->post("ci_envio1",true),
                  'dir_referencia' => $this->input->post("referencia",true),
                  'id_distrito' => $this->input->post("dis_envio",true)
               );
              $id_fac =  $this->input->post("fac_id", true);   
              $data_formulario_dos=array //Llenamos el array con los datos del formulario
              (
                  'dir_nro' => $this->input->post("fac_nro",true),
                  'dir_dpto' => $this->input->post("fac_dpto",true),
                  'dir_direccion' => $this->input->post("fac_direccion",true),
                  'dir_ciudad' => $this->input->post("fac_ciudad1",true),
                  'dir_referencia' => $this->input->post("fac_referencia",true),
                  'id_distrito' => $this->input->post("fac_distrito",true)
               );
              $datos_a_guardar = $this->model_wz->actualizar_direccion($data_formulario_uno,$id_envio);
              $datos_a_guardar1 = $this->model_wz->actualizar_direccion($data_formulario_dos,$id_fac);
              //var_dump($id_cli);
              //var_dump($data_formulario_uno);
              if($data_formulario_uno AND $data_formulario_dos)
              {    
                $tipo_mensaje="mensaje_exito"; 
                $mensaje='Se actualizo los datos con exito';
              }    
                    
             }
            
            }//fin del post
            
            $datos= $this->model_wz->buscarcliente_xid($id_cli);
            //var_dump($datos);exit();
            if($datos!=FALSE)
            {    
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Direcciones");
                $this->layout->view('cli_direcciones',compact("datos","tipo_mensaje","mensaje"));
            }
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        public function suscripcion()
        {
          if(isset($this->session->userdata['user_id']))
          {  
             $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            if($this->input->post())//Codicional Tipo de Datos que Recibe
            { 
             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');

            $this->form_validation->set_rules('banco', 'Banco', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tipo', 'Tipo', 'required');
            $this->form_validation->set_rules('nro_tarj', 'Nro de tarjeta', 'trim|required|xss_clean|exact_length[16]');
            $this->form_validation->set_rules('cod_seguridad', 'Codigo de seguridad', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('mes_cad', 'Mes', 'trim|required|numeric');
            $this->form_validation->set_rules('anio_cad', 'Año', 'trim|required|numeric');

            $this->form_validation->set_message('required', 'El %s es obligatorio');
            $this->form_validation->set_message('numeric', 'El %s debe contener solo Numeros');
            $this->form_validation->set_message('exact_length', 'El %s debe contener 16 Digitos');
            
             if($this->form_validation->run()!=FALSE){
              
              $id_tarjeta =  $this->input->post("id_tarjeta", true);   
              $data_formulario_uno=array //Llenamos el array con los datos del formulario
              (
                  'tarj_nro' => $this->input->post("nro_tarj",true),
                  'tarj_banco' => strtoupper($this->input->post("banco",true)),
                  'tarj_cvv2' => $this->input->post("cod_seguridad",true),
                  'tarj_mes' => $this->input->post("mes_cad",true),
                  'tarj_anio' => $this->input->post("anio_cad",true),
                  'id_tipotarjeta' => $this->input->post("tipo",true)
               );
             $datos_a_guardar = $this->model_wz->actualizar_tarjeta($data_formulario_uno,$id_tarjeta);
              //var_dump($id_cli);
              //var_dump($data_formulario_uno);
              if($data_formulario_uno)
              {    
                $tipo_mensaje="mensaje_exito"; 
                $mensaje='Se actualizo los datos con exito';
              }             
             }//fin de la validacion
            
            }//fin del post
            
            $datos= $this->model_wz->consultar_tarj_xidcli($id_cli);
            $suscripcion= $this->model_wz->busq_Suscripx_idcli($id_cli);
            
              
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Tarjeta Suscrita");
                $this->layout->view('cli_suscripcion',compact("datos","suscripcion","tipo_mensaje","mensaje"));
           
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        public function cambiarpass()
        {
          if(isset($this->session->userdata['user_id']))
          {  
             $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            if($this->input->post())//Codicional Tipo de Datos que Recibe
            { 
             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');

             $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|md5');
             $this->form_validation->set_rules('repassword', 'Re-password', 'trim|required|xss_clean|matches[password]|md5');

            $this->form_validation->set_message('required', 'El %s es obligatorio');
            $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
            
             if($this->form_validation->run()!=FALSE){
              
              $id_cli =  $this->input->post("id_cliente", true);   
              $data_formulario_uno=array //Llenamos el array con los datos del formulario
              (   'cli_password' => $this->input->post("password",true)
               );
             $datos_a_guardar = $this->model_wz->actualizar_cliente($data_formulario_uno,$id_cli);
              //var_dump($id_cli);
              //var_dump($data_formulario_uno);
              if($data_formulario_uno)
              {    
                $tipo_mensaje="mensaje_exito"; 
                $mensaje='Se actualizo los datos con exito';
                $this->session->sess_destroy(); 
              }             
             }//fin de la validacion
            
            }//fin del post
            
            $datos= $this->model_wz->consultar_tarj_xidcli($id_cli);
            
            if($datos!=FALSE)
            {    
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Actualizar Password");
                $this->layout->view('cli_actpassword',compact("datos","tipo_mensaje","mensaje"));
            }
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        public function estadocta()
        {
          if(isset($this->session->userdata['user_id']))
          {  
            $id =$this->session->userdata['user_id'];
            if($this->uri->segment(4))
            { $pagina=$this->uri->segment(4);
            }
            else
            { $pagina=0;
            }
            $porpagina=1000;
            $datos=$this->model_wz->lista_estcta_cli_all($pagina,$porpagina,"limit",$id);
            $aux=$this->model_wz->lista_estcta_cli_all($pagina,$porpagina,"cuantos",$id);
            $cuantos =(int)$aux[0]->numrows;
            $config['base_url'] = base_url().'cliente/estadocta';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $this->pagination->initialize($config);
            
             ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("Cliente - Smartgamers");
            $this->layout->setSubTitle("Estado Cta");
            $this->layout->view('cli_estadocta',compact("datos","cuantos"));
            
          }
          else
          {
             redirect(base_url().'index/login',  301);
          } 
	}//fin de la funcion    
        
        public function pedidos()
        {
          if(isset($this->session->userdata['user_id']))
          {  
             $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            
            
            $juegos_ped = $this->model_wz->ordenpedidos_xidcli($id_cli,"entrega");
            $juegos_xcambio= $this->model_wz->ordenpedidos_xidcli($id_cli,"devolucion");
            $juegos_act = $this->model_wz->cartpedidos_x_cli_tieneactual($id_cli);
                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Pedidos");
                $this->layout->view('cli_pedidos',compact("juegos_ped","juegos_xcambio","juegos_act"));
            
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        public function anularsuscrip()
        {
          if(isset($this->session->userdata['user_id']))
          {  
             $id_cli =$this->session->userdata['user_id'] ;
            if(!$id_cli)
            { show_404(); }
            if($this->input->post())//Codicional Tipo de Datos que Recibe
            { 
             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');

             $this->form_validation->set_rules('motivo', 'Motivo', 'trim|required');
             $this->form_validation->set_rules('referencia', 'Comentario', 'trim|required|xx_clean');

             $this->form_validation->set_message('required', 'El %s es obligatorio');
                       
             if($this->form_validation->run()!=FALSE){
              
             $data_formulario_uno=array //Llenamos el array con los datos del formulario
              (   'pedanu_motivo' => $this->input->post("motivo",true),
                  'pedanu_comentarios' => $this->input->post("referencia",true),
                  'id_alquiler' => $this->input->post("id_alquiler",true)
               );
              $datos_a_guardar = $this->model_wz->insertar_pedanulacion($data_formulario_uno);
              
              $pedidoanu = $this->model_wz->consultar_ped_anulacion($this->input->post("id_alquiler",true));
              
              //var_dump($data_formulario_uno);
              if($data_formulario_uno)
              {    
                $tipo_mensaje="mensaje_exito"; 
                $mensaje='Se envio la solicitud de anulación con exito, se genero el siguiente codigo :'.$pedidoanu[0]->id_pedanulacion;
                $this->session->sess_destroy(); 
              }             
             }//fin de la validacion
            
            }//fin del post
            
            $datos= $this->model_wz->busq_Suscripx_idcli($id_cli);
            if($datos!=FALSE)
            {   $pedianu= $this->model_wz->consultar_ped_anulacion($datos[0]->id_alquiler); 
                  ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Anular Suscripción");
                $this->layout->view('cli_anularsuscrip',compact("datos","pedianu","tipo_mensaje","mensaje"));
            }
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        
        
        public function proceso_alquiler($id_prod=0)
        {
          if(isset($this->session->userdata['user_id']))
          {  
            $tipo_mensaje="mensaje_error";
            $mensaje="";
            $id_prod =$this->uri->segment(3);
            if(!$id_prod)
            { show_404(); }
            
            //buscamos el si existe stock del producto seleccionado
            $stock= $this->model_wz->Contar_stock_diponibles($id_prod);
            if($stock <= 0)
            {
                $tipo_mensaje="mensaje_error";
                $mensaje="Los sentimos pero NO se dispone de suficiente stock del producto";  
                $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
                $this->session->set_flashdata('ControllerMessage', $mensaje);
                redirect(base_url().'cliente/carrito/',  301);  
            }
                
                
             $pedidos_entregados= $this->model_wz->cartpedidos_x_cli_tieneactual($this->session->userdata['user_id']);
            if($pedidos_entregados)
            { $nro_itemsentregados= count($pedidos_entregados);
            }else
            { $nro_itemsentregados=0;}
             
            //var_dump($nro_itemsentregados);
             
             $fecha_actual=obtenerfecha_actual();  
             $suscripcion= $this->model_wz->busq_Suscripx_idcli($this->session->userdata['user_id']);
            //var_dump($suscripcion);
             $itemstemp=$this->model_wz->itemtempcart_x_cli($this->session->userdata['user_id']);
             $cantitemtemp=(int)$itemstemp[0]->cantitem;
             $nro_itemactual =$suscripcion[0]->nro_itemactual;
             $estado_entrega =$suscripcion[0]->estado_entrega;
             $mem_nroitemcambio =$suscripcion[0]->mem_nroitemcambio;
             $itemtotal= $nro_itemactual+ $cantitemtemp;
             
             $id_alquiler =$suscripcion[0]->id_alquiler;
             $alq_fechfin =$suscripcion[0]->alq_fechfin;
             $max_item =(int)$suscripcion[0]->max_item;
             
             $alq_fechproxped =$suscripcion[0]->alq_fechproxped;
             if($alq_fechproxped !="" OR $alq_fechproxped != NULL)
             {$dias_cambio=compararFechas($alq_fechproxped,$fecha_actual);}
             else{$dias_cambio = 0;}
            //var_dump($dias_cambio);

             
             $dias_suscritos=compararFechas($alq_fechfin,$fecha_actual);   
 //        var_dump($dias_suscritos);
         //exit();
          /*   echo "dias_suscritos ".$dias_suscritos;
             echo "</br>nro_itemactual ".$nro_itemactual;
             echo "</br>max_item ".$max_item;
             echo "</br>cantitemtemp ".$cantitemtemp;
            */ 
             if($dias_suscritos < 0 )
             {
                $tipo_mensaje="mensaje_error";
                $mensaje="Lo sentimos pero su suscripción NO se encuentra activa.";
                $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
                $this->session->set_flashdata('ControllerMessage', $mensaje);
                redirect(base_url().'cliente/carrito/',  301);  
             }
             if($dias_cambio > 0 AND $nro_itemsentregados > 0 )
             {
                $tipo_mensaje="mensaje_error";
                $mensaje="Los sentimos pero aun no ha pasado el tiempo para realizar su proximo pedido.";
                $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
                $this->session->set_flashdata('ControllerMessage', $mensaje);
                redirect(base_url().'cliente/carrito/',  301);  
             }
             if($estado_entrega =="pendiente")
             {
                $tipo_mensaje="mensaje_alerta";
                $mensaje="Aun tienes pedidos pendientes de atención.";
                $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
                $this->session->set_flashdata('ControllerMessage', $mensaje);
                redirect(base_url().'cliente/carrito/',  301);  
             }    
             if($nro_itemsentregados == 0 )
             {    
               //  echo "NO se tienesn juegos entregados"; exit();
                if($max_item > $itemtotal)  
                {    
                   $ingreso=$this->addtemporal_cart($id_prod,$id_alquiler); 
                   if($ingreso)
                   {    
                      $tipo_mensaje="mensaje_exito";
                      $mensaje="Se agregado el producto exitosamente al carrito.";
                   }else
                   { $tipo_mensaje="mensaje_error";
                     $mensaje="Lo sentimos, favor de volver a intentar agregar el item";  
                   }    

                }else
                {               //  var_dump($itemtotal); exit();
                  if($itemtotal == $max_item)
                  {
                     $tipo_mensaje="mensaje_alerta";
                     $mensaje="Ha superado el maximo de items al plan suscrito.";  
                  }else {
                      $tipo_mensaje="mensaje_error";
                    $mensaje="Lo sentimos, favor de volver a intentar agregar el item";  
                  }  
                }    
             }
             else
             {    
                // echo "Se tienesn juegos entregados"; exit();
                 if($mem_nroitemcambio > $cantitemtemp)
                 {
                    $ingreso=$this->addtemporal_cart($id_prod,$id_alquiler); 
                    if($ingreso)
                    {    
                       $tipo_mensaje="mensaje_exito";
                       $mensaje="Se agregado el producto exitosamente al carrito.";
                    }else
                    { $tipo_mensaje="mensaje_error";
                      $mensaje="Lo sentimos, favor de volver a intentar agregar el item";  
                    }     
                 }else
                 {  $tipo_mensaje="mensaje_alerta";
                    $mensaje="Ha superado el maximo de items a intercambiar de acuerdo al plan suscrito.";  
                 }    
                 
             }
           
             $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
             $this->session->set_flashdata('ControllerMessage', $mensaje);
             redirect(base_url().'cliente/carrito/',  301);  
           }else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
        
        public function carrito()
        {
          if(isset($this->session->userdata['user_id']))
          {  
            //$datos= $this->model_wz->buscarcliente_xid($id);
            $carrito=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
            if($carrito!=false)
            {
                $datos=$this->model_wz->busq_detcompleto_car_xidcar($carrito[0]->id_carrito);
            }else
            { $datos="";}    
            $suscripcion= $this->model_wz->busq_Suscripx_idcli($this->session->userdata['user_id']);
            $pedidos_entregados= $this->model_wz->cartpedidos_x_cli_tieneactual($this->session->userdata['user_id']);
            if($pedidos_entregados)
            { $nro_itemsentregados= count($pedidos_entregados);
            }else
            { $nro_itemsentregados=0;}
            
            $itemstemp=$this->model_wz->itemtempcart_x_cli($this->session->userdata['user_id']);
            $cantitemtemp=(int)$itemstemp[0]->cantitem;
              
            ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("Cliente - Smartgamers");
            $this->layout->setSubTitle("Carrito");
            $this->layout->view('carrito',compact("datos","suscripcion","nro_itemsentregados","cantitemtemp"));
            
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
	}//fin de la funcion    
    
        public function addtemporal_cart($id_prod,$id_alquiler)
        {
            $tipo="temporal";
            //consultar si existen carritos temporales con el mismo cliente 
            $cart_temp=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
            //si existen carritos temporales
            if ($cart_temp){
                   $ultimoid_cart = $cart_temp[0]->id_carrito;
                   $data_formulario1=array 
                    (   'id_carrito'=>(int)$ultimoid_cart,
                        'id_producto'=>(int)$id_prod,
                        'detcar_estado'=>$tipo
                    );
                   $this->model_wz->insertar_detcart($data_formulario1);
                   return TRUE;
               } else {
                   //Se ingresa un nuevo temporal
                   $data_formulario2=array 
                    ( 
                       'id_alquiler'=>(int)$id_alquiler,
                        'tipo'=>$tipo,
                        'hora_pedido'=>  obtenerfecha_hora(),
                        'car_estado'=>$tipo
                     );
                   $this->model_wz->insertar_cart($data_formulario2);
                   $carrito =$this->model_wz->buscar_carritotemp_xidalq($id_alquiler);

                   if($carrito!=FALSE)
                   {
                       $id_carrito= (int)$carrito[0]->id_carrito; 
                       $data_formulario3=array 
                        (   'id_carrito'=>(int)$id_carrito,
                            'id_producto'=>(int)$id_prod,
                            'detcar_estado'=>$tipo
                         );        
                       $this->model_wz->insertar_detcart($data_formulario3);
                       return TRUE;
                   }    
                   else {
                       return FALSE;
                       //echo "Error de ingreso al carrito";
                   }
               }
        }//fin de funcion 
        function limpiarcarrito()
        {
          if(isset($this->session->userdata['user_id']))
          { 
            //consultar si existen carritos temporales con el mismo cliente 
            $carrito=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
            if($carrito!=false)
            {
                $datos=$this->model_wz->busq_detcompleto_car_xidcar($carrito[0]->id_carrito);
                foreach ($datos as $row):
                    $id_carrito= $row->id_carrito;
                    $id_detcarrito= $row->id_detcarrito;
                    $this->model_wz->limpiar_itemtemp_detcar($id_detcarrito,$id_carrito);
                endforeach;

                $this->model_wz->limpiar_cartemporal_xidcar($id_carrito);
            }   

            $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_exito');
            $this->session->set_flashdata('ControllerTituMessage', 'Limpiar carrito');
            $this->session->set_flashdata('ControllerMessage', 'Se ha limpiado el carrito .');
            redirect(base_url().'cliente/carrito/',  301); 
          }
          else
          {
           redirect(base_url().'index/login',  301);
          }   
        }

        function eliminaritem($id=0,$idcar=0)
        {  
            if(isset($this->session->userdata['user_id']))
            { 
                if(!$id)
                { show_404();}
                if(!$idcar)
                { show_404();}
                 $this->model_wz->limpiar_itemtemp_detcar($id,$idcar);
                 $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_exito');
                 $this->session->set_flashdata('ControllerTituMessage', 'Eliminar item');
                 $this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el item seleccionado.');
                 redirect(base_url().'cliente/carrito/',  301); 
            }
            else
            {
               redirect(base_url().'index/login',  301);
            }  
        }//fin de funcion

        public function realizarpedido()
        {
          if(isset($this->session->userdata['user_id']))
          {  
            //$datos= $this->model_wz->buscarcliente_xid($id);
            $carrito=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
            if($carrito!=false)
            {
             $aux_id_prod="";
             $cant_prod = array();
             $suma_prod= array();
             $datos=$this->model_wz->busq_detcompleto_car_xidcar($carrito[0]->id_carrito);
             
             //sumamos la cant de juegos pedidos en caso que sea repetidos
             foreach ($datos as $rowdatos)
             {  
                if(isset($suma_prod[$rowdatos->id_producto]) )
                    { $suma_prod[$rowdatos->id_producto] = array
                         (   "id_producto" =>$rowdatos->id_producto,
                             "juego" => $rowdatos->nombre, 
                             "consola" => $rowdatos->plataforma, 
                             "cantpedida" => $suma_prod[$rowdatos->id_producto]["cantpedida"]+1 
                         );
                    }
                 else
                    { $suma_prod[$rowdatos->id_producto] =array 
                        (   "id_producto" =>$rowdatos->id_producto,
                            "juego" => $rowdatos->nombre, 
                            "consola" => $rowdatos->plataforma,
                            "cantpedida" => 1 
                        );
                    }
             }
          
  
             foreach ($suma_prod as $producto )
             {  
                $stock=$this->model_wz->Contar_stock_diponibles($producto['id_producto']);
                //var_dump($stock); 
                if($stock==0)
                {    
                  $mensaje=" LO SENTIMOS PERO TE GANARON POR UN CLICK, OTRO GAMER YA CERRO EL PEDIDO, busca m&aacute;s alternativas del siguiente juego:";
                  $mensaje .=" <br>- ".$producto['juego']." - consola : ".$producto['consola'];
                  $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_alerta');
                  $this->session->set_flashdata('ControllerMessage', $mensaje);
                  redirect(base_url().'cliente/carrito/',  301); 
                   //echo "<br>no se tiene stock ".$producto['juego'];  
                }
                if($stock < $producto['cantpedida'])
                {
                  $mensaje=" LO SENTIMOS PERO NO se tiene suficiente stock para el juego :<br> ";
                   $mensaje .=$producto['juego']." - consola : ".$producto['consola'];
                   $mensaje .="<br> Por favor no coloques m&aacute;s de un juego en tu carrito";
                  $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_alerta');
                  $this->session->set_flashdata('ControllerMessage', $mensaje);
                  redirect(base_url().'cliente/carrito/',  301); 
                    //echo "<br> no tenemos suficiente stock del juego ".$producto['juego'];
                }    
             }   
            
            }else
            { $datos=FALSE;}    
            
            
            $suscripcion= $this->model_wz->busq_Suscripx_idcli($this->session->userdata['user_id']);
           // var_dump($datos);
            //var_dump($suscripcion);
            //exit();

            if($suscripcion!= FALSE AND $datos != FALSE )
            {    
                $orden= $this->model_wz->busq_pedidospendx_idcli($suscripcion[0]->id_alquiler);
                $nroitems= count($datos);
                $fecha_actual=obtenerfecha_actual();  

                $id_alquiler =$suscripcion[0]->id_alquiler;
                $alq_fechfin =$suscripcion[0]->alq_fechfin;
                $max_item =(int)$suscripcion[0]->max_item;
                $nro_itemactual =(int)$suscripcion[0]->nro_itemactual;
                $alq_fechproxped =$suscripcion[0]->alq_fechproxped;

                if($alq_fechproxped !="" OR $alq_fechproxped != NULL)
                {$dias_cambio=compararFechas($alq_fechproxped,$fecha_actual);}
                else{$dias_cambio = 0;}
                $nroitemstotal= $nro_itemactual + $nroitems;

                if($nroitemstotal < $max_item)
                {   $mensaje=" Solo en tu primer pedido debes pedir el total de juegos de acuerdo a tu plan <br> Luego dentro de 30 dias podras cambiar 1 o m&aacute;s y luego cada 30 puedes volver a cambiar.";
                    $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_alerta');
                    $this->session->set_flashdata('ControllerMessage', $mensaje);
                    redirect(base_url().'cliente/carrito/',  301);  
                }    

                if($orden!= FALSE)
                {// Si existen ordenes
                 // ------------------------------------   
                 $id_orden = $orden[0]->id_orden;
                 $det_orden = $this->model_wz->buscar_detorden_xidorden($id_orden);   
                 // ------------------------------------
                 // fin de ordenes existentes   
                }else
                { //genero una nueva orden
                  // ------------------------------------ 

                   $data_formulario_22=array 
                   (   'id_alquiler' => $id_alquiler,
                       'ord_tipo' => "entrega",
                       'ord_estado' => "pendiente"
                   );
                  $datos_a_guardar = $this->model_wz->insertar_orden($data_formulario_22);
                  //buscamos la ultima orden generada
                  $orden= $this->model_wz->ultima_orden_xid($id_alquiler,"entrega");
                  $id_orden=$orden[0]->id_orden;
                  $cliente= $this->model_wz->buscarcliente_xid($this->session->userdata['user_id']);

                    $data_formulario_10_1=array 
                    (  'diror_tipo' => "envio",
                       'diror_direccion'=> $cliente[0]->direccion_envio." #".$cliente[0]->nro_envio,
                       'diror_dpto' => $cliente[0]->nrodpto_envio,
                       'diror_ciudad' => $cliente[0]->ciudad_envio,
                       'diror_distrito' => $cliente[0]->distrito_envio,
                       'diror_referencia' =>  $cliente[0]->referencia_envio,
                       'id_orden' =>  $id_orden
                    );
                    $this->model_wz->insertar_dir_orden($data_formulario_10_1);
                    $data_formulario_10_2=array 
                    (  'diror_tipo' => "facturacion",
                       'diror_direccion'=> $cliente[0]->direccion_laboral." #".$cliente[0]->nro_laboral,
                       'diror_dpto' => $cliente[0]->nrodpto_laboral,
                       'diror_ciudad' => $cliente[0]->ciudad_laboral,
                       'diror_distrito' => $cliente[0]->distrito_laboral,
                       'diror_referencia' =>  $cliente[0]->referencia_laboral,
                       'id_orden' =>  $id_orden
                    );
                    $this->model_wz->insertar_dir_orden($data_formulario_10_2);

                 //fin de la generar la nueva orden 
                 // ------------------------------------  
                }     
    //var_dump($orden); exit();
                  //generamos los detalles de la orden
                $cod_todosprodpedidos=array(); 
                foreach ($carrito as $row):

                        
                        $id_carrito = $row->id_carrito;
                        //actualizar los carritos temporales a pendientes
                        $y=0;
                        foreach ($datos as $row2):
                            $id_prod = $row2->id_producto;
                            $id_detcarrito = $row2->id_detcarrito;

                            //buscamos los det de productos disponibles para obtener el cod de barras
                            $detprod_disp= $this->model_wz->detprod_x_produc_disponible($id_prod);
                            $id_detproducto= $detprod_disp[0]->id_detproducto;

                            
                            if(isset($cod_todosprodpedidos[$id_carrito]))
                            { $cod_todosprodpedidos[$id_carrito] .= ",".$id_detproducto; 
                            }else
                            { $cod_todosprodpedidos[$id_carrito] = $id_detproducto; }

                            //actualizamos el detprod a separado
                            $data_formulario_24=array 
                            (  'estado' => "separado"
                            );
                            $this->model_wz->actualizar_detprod($data_formulario_24,$id_detproducto);

                            // actualizo el detalle del carrito
                            $data_formulario_25=array 
                            (  'detcar_estado' => "pendiente",
                               'id_detproducto'=> $id_detproducto,
                            );
                            $this->model_wz->actualizar_detcart($data_formulario_25,$id_detcarrito);
                            $y++;
                        endforeach;

                        //insertamos detalle de orden
                        $data_formulario_23=array 
                         (   'id_orden' => $id_orden,
                             'id_carrito' => $row->id_carrito,
                             'detord_cod_detprod' => $cod_todosprodpedidos[$row->id_carrito]
                         );
                        $this->model_wz->insertar_detorden($data_formulario_23);

                        //actualizar el carrito de temporal a pendiente

                        $data_formulario_26=array 
                          (  'tipo' => 'entrega',
                             'hora_pedido'=> obtenerhora_actual(),
                             'fecha_pedido'=> obtenerfecha_hora(),
                             'car_estado'=> 'pendiente'
                          );
                          $this->model_wz->actualizar_cart($data_formulario_26,$row->id_carrito);

                  endforeach;    

                  //actualizamos la suscripcion
                  $data_formulario_27=array 
                    (  'nro_itemactual' => $nroitemstotal,
                       'estado_entrega'=> 'pendiente'
                    );
                   $this->model_wz->actualizar_suscripcion($data_formulario_27,$id_alquiler); 

                 //envio de correo de solicitud de pedido de juegos
                 $this->envio_email_pedido($this->session->userdata['user_id']);  

                $tipo_mensaje="mensaje_exito";
                $mensaje="Se ha procedido a Generar exitosamente la orden de alquiler.";
            }else
            {
                $tipo_mensaje="mensaje_error";
                $mensaje="Lo sentimos pero existe un problema al tratar de realizar su pedido.";
            }    
            $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
            $this->session->set_flashdata('ControllerMessage', $mensaje);
            redirect(base_url().'cliente/carrito/',  301);  
           }
           else
           {
              redirect(base_url().'index/login',  301);
           } 
        }//fin de la funcion    

        function envio_email_pedido($id_cli)
        {

             if(!$id_cli)
            { show_404(); }

            $cliente= $this->model_wz->buscarcliente_x_id($id_cli);
            if($cliente!=FALSE)
            {    
               $email= $cliente[0]->cli_email;
               $name= $cliente[0]->cli_nombres." ".$cliente[0]->cli_apellidos;

            //Email de confirmacion

                $this->load->library('email');
                $this->load->config('email'); 
                $this->load->helper(array('form', 'url'));

                $this->email->to($email);
                //$this->email->from('wzauma@smartgamers.com.pe');
                $this->email->from('servicios@smartgamers.com.pe');
                $this->email->subject('Registro de pedido de '.$name);
                /*
                $this->email->message('Hola '.$name.' ,favor confirma tu registro, haciendo click en el siguiente 
                    link : '.anchor('cli_controller/register_confirm/'.$activation_code,'valide su Registro en Smartgamers').' o 
                    tambien puede ingresar el codigo de manera manual en la siguiente direccion: www.smartgamers.com.pe/rent/cli_controller/confirmar_registro <br> con el siguiente codigo : '.$activation_code);
                 * 
                 */
                $message = '<html><body>';
                $message .= '<h4>Hola '.$name.'</h4>';
                $message .= '<p>Se ha generado tu pedido de alquiler y/o cambio de videojuego(s), en las pr&oacute;ximas 24 horas, a partir de las 9am y hasta las 6pm ';
                $message .= ' estaremos visit&aacute;ndote para la entrega y/o cambio del (los) videojuego(s) que has escogido.<br>';
                $message .= ' No te olvides de que alguien este disponible para recibir lo solicitado y de ser el caso tener a la mano los o el videojuego a cambiar, 
                    es b&aacute;sico para que juntos logremos que el servicio sea lo que esperamos que sea.';
                $message .= 'De no encontrarse nadie disponible, tu pedido queda anulado y debes volver a solicitarlo y de repetirse este hecho, aplicaremos la multa ';
                $message .= ' seg&uacute;n los T&eacute;rminos y Condiciones, hag&aacute;moslo bien.</p> ';
                $message .= '<p>Gracias por su preferencia.</p> ';
                $message .= '</body></html>';
                $this->email->message($message);
                if(! $this->email->send())
                {// Generate error
                     $this->email->print_debugger();
                     return FALSE;
                }else
                { return true;}    
                //fin de email de confirmacion
            }  

            //fin de email de confirmacion
        }//fin de funcion envio_email_pedido

        public function realizarcambio()
        {
            if(isset($this->session->userdata['user_id']))
            {
                //buscamos si tiene la suscripcion habilitada
                $suscripcion= $this->model_wz->busq_Suscripx_idcli($this->session->userdata['user_id']);
                if($suscripcion== FALSE)
                {
                    $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_error');
                    $this->session->set_flashdata('ControllerMessage', 'No tiene suscripcion habilitada.');
                    redirect(base_url().'cliente/carrito/',  301);  
                }
                //buscamos pedidos anteriores que tiene el cliente
                $pedidos_entregados= $this->model_wz->cartpedidos_x_cli_tieneactual($this->session->userdata['user_id']);
                if($pedidos_entregados==FALSE)
                {   $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_error');
                    $this->session->set_flashdata('ControllerMessage', 'No tiene existe pedidos anteriores para cambiar.');
                    redirect(base_url().'cliente/carrito/',  301);  
                }

                $carrito_temporal=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
                if($carrito_temporal!=false)
                {   $datos=$this->model_wz->busq_detcompleto_car_xidcar($carrito_temporal[0]->id_carrito);
                    //sumamos la cant de juegos pedidos en caso que sea repetidos
                    foreach ($datos as $rowdatos)
                    {  
                       if(isset($suma_prod[$rowdatos->id_producto]) )
                           { $suma_prod[$rowdatos->id_producto] = array
                                (   "id_producto" =>$rowdatos->id_producto,
                                    "juego" => $rowdatos->nombre, 
                                    "consola" => $rowdatos->plataforma, 
                                    "cantpedida" => $suma_prod[$rowdatos->id_producto]["cantpedida"]+1 
                                );
                           }
                        else
                           { $suma_prod[$rowdatos->id_producto] =array 
                               (   "id_producto" =>$rowdatos->id_producto,
                                   "juego" => $rowdatos->nombre, 
                                   "consola" => $rowdatos->plataforma,
                                   "cantpedida" => 1 
                               );
                           }
                    }

                    foreach ($suma_prod as $producto )
                    {  
                       $stock=$this->model_wz->Contar_stock_diponibles($producto['id_producto']);
                       //var_dump($stock); 
                       if($stock==0)
                       {    
                         $mensaje=" LO SENTIMOS PERO TE GANARON POR UN CLICK, OTRO GAMER YA CERRO EL PEDIDO, busca m&aacute;s alternativas del siguiente juego:";
                         $mensaje .=" <br>- ".$producto['juego']." - consola : ".$producto['consola'];
                         $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_alerta');
                         $this->session->set_flashdata('ControllerMessage', $mensaje);
                         redirect(base_url().'cliente/carrito/',  301); 
                          //echo "<br>no se tiene stock ".$producto['juego'];  
                       }
                       if($stock < $producto['cantpedida'])
                       {
                         $mensaje=" LO SENTIMOS PERO NO se tiene suficiente stock para el juego :<br> ";
                          $mensaje .=$producto['juego']." - consola : ".$producto['consola'];
                          $mensaje .="<br> Por favor no coloques m&aacute;s de un juego en tu carrito";
                         $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_alerta');
                         $this->session->set_flashdata('ControllerMessage', $mensaje);
                         redirect(base_url().'cliente/carrito/',  301); 
                           //echo "<br> no tenemos suficiente stock del juego ".$producto['juego'];
                       }    
                    }   
                
                }else
                {   $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_error');
                    $this->session->set_flashdata('ControllerMessage', 'No tiene items en su carrito.');
                    redirect(base_url().'cliente/carrito/',  301); 
                }    

                $itemstemp=$this->model_wz->itemtempcart_x_cli($this->session->userdata['user_id']);
                $cantitemtemp=(int)$itemstemp[0]->cantitem;

                if($this->input->post())//Codicional Tipo de Datos que Recibe
                {
                    $det_carritoseleccionados = $this->input->post("id_detcarrito",true);
                    //var_dump($det_carritoseleccionados);exit();
                    $nroitemseleccionados = count($det_carritoseleccionados);
                    //var_dump($nroitemseleccionados);
                    //var_dump($det_carrito);
                    $carrito_temporal=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
                    $datos=$this->model_wz->busq_detcompleto_car_xidcar($carrito_temporal[0]->id_carrito);
                    $nroitemcarrito = count($datos);
                    if($nroitemcarrito != $nroitemseleccionados)
                    {   $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_error');
                        $this->session->set_flashdata('ControllerMessage', 'Tiene que seleccionar el mismo nro de items que tiene en el carrito, para realizar el cambio.');
                        redirect(base_url().'cliente/realizarcambio/',  301); 
                    }else
                    {
                        $mensajeretornado = $this->generarorden_cambiovj($det_carritoseleccionados);
                        $tipo_mensaje =$mensajeretornado['tipo'];
                        $mensaje =$mensajeretornado['mensaje'];
                        $this->session->set_flashdata('ControllerMessageTipo', $tipo_mensaje);
                        $this->session->set_flashdata('ControllerMessage', $mensaje);
                        redirect(base_url().'cliente/carrito/',  301); 

                       // exit();
                    }    

                }//fin del post


                ///////////////////////TITULOS/////////////////////
                $this->layout->setTitle("Cliente - Smartgamers");
                $this->layout->setSubTitle("Carrito");
                $this->layout->view('carrito_cambiovj',compact("datos","suscripcion","itemstemp","pedidos_entregados",'cantitemtemp'));

            }else
            { redirect(base_url().'index/login',  301);
            }  
        } // finde la funcion

        function generarorden_cambiovj($det_carritoseleccionados)
        {
           if(isset($this->session->userdata['user_id']) AND $det_carritoseleccionados!= NULL)
           {
               $id_orden="";
               $carrito_temporal=$this->model_wz->cart_temporal_xcli($this->session->userdata['user_id']);
               $datos=$this->model_wz->busq_detcompleto_car_xidcar($carrito_temporal[0]->id_carrito);

               //generamos la orden de devolucion para los siguientes items.
               $auxcar="";
               
               // ingresamos en el array la lista de det_productos seleccionados 
               // para el detalle de orden
               $cod_todosprodpedidos[]=array();
               foreach ($det_carritoseleccionados as $row => $id_detcarrito)
               {
                  $det_carrito = $this->model_wz->buscar_detcarrito_xiddet($id_detcarrito);
                  //var_dump($det_carrito);
                   $id_carrito=$det_carrito[0]->id_carrito;
                   $id_detproducto=$det_carrito[0]->id_detproducto;
                   
                   if(isset($cod_todosprodpedidos[$id_carrito]))
                   { 
                       $cod_todosprodpedidos[$id_carrito] .= ",".$id_detproducto; 
                   }else
                   { 
                    $cod_todosprodpedidos[$id_carrito] = $id_detproducto;
                   
                   }   
               } 
               
               // generamos las ordenes de pedido a partir de los det carritos seleccionados
               foreach ($det_carritoseleccionados as $row => $id_detcarrito)
               {
                  $det_carrito = $this->model_wz->buscar_detcarrito_xiddet($id_detcarrito);
                 
                  $id_carrito = $det_carrito[0]->id_carrito;
                  $carrito = $this->model_wz->buscar_carrito_xidcar($id_carrito);
                  $id_alquiler= $carrito[0]->id_alquiler;
                  
                  //genero una nueva orden de devolucion
                   // ------------------------------------ 
                  if($auxcar != $id_carrito)
                  {    
                    $data_formulario_22=array 
                    (   'id_alquiler' => $id_alquiler,
                        'ord_tipo' => "devolucion",
                        'ord_estado' => "pendiente"
                    );
    // var_dump($data_formulario_22);                        
                   $this->model_wz->insertar_orden($data_formulario_22);
                   //buscamos la ultima orden generada
                   $orden= $this->model_wz->ultima_orden_xid($id_alquiler,"devolucion");
                   $id_orden=$orden[0]->id_orden;

                   //insertamos detalle de orden
                   $data_formulario_23=array 
                    (   'id_orden' => $id_orden,
                        'id_carrito' => $id_carrito,
                        'detord_cod_detprod' => $cod_todosprodpedidos[$id_carrito]
                    );
                   $this->model_wz->insertar_detorden($data_formulario_23);

                   // genero las direcciones de la orden
                   $cliente= $this->model_wz->buscarcliente_xid($this->session->userdata['user_id']);

                   $data_formulario_10_1=array 
                   (  'diror_tipo' => "envio",
                      'diror_direccion'=> $cliente[0]->direccion_envio." #".$cliente[0]->nro_envio,
                      'diror_dpto' => $cliente[0]->nrodpto_envio,
                      'diror_ciudad' => $cliente[0]->ciudad_envio,
                      'diror_distrito' => $cliente[0]->distrito_envio,
                      'diror_referencia' =>  $cliente[0]->referencia_envio,
                      'id_orden' =>  $id_orden
                   );
                   $this->model_wz->insertar_dir_orden($data_formulario_10_1);
                   $data_formulario_10_2=array 
                   (  'diror_tipo' => "facturacion",
                      'diror_direccion'=> $cliente[0]->direccion_laboral." #".$cliente[0]->nro_laboral,
                      'diror_dpto' => $cliente[0]->nrodpto_laboral,
                      'diror_ciudad' => $cliente[0]->ciudad_laboral,
                      'diror_distrito' => $cliente[0]->distrito_laboral,
                      'diror_referencia' =>  $cliente[0]->referencia_laboral,
                      'id_orden' =>  $id_orden
                   );
                   $this->model_wz->insertar_dir_orden($data_formulario_10_2);

                   $auxcar = $id_carrito;
                  }//fin del $auxcar != $id_carrito 
                  // ------------------------------------  

                  //actualizamos el carrito y det para devolucion
       //var_dump($det_carrito);
                  // actualizo el detalle del carrito
                  $data_formulario_25=array 
                  (  'detcar_estado' => "pendiente_devo"
                  );

    //var_dump($id_detcarrito);
    //var_dump($data_formulario_25);
                  $this->model_wz->actualizar_detcart($data_formulario_25,$id_detcarrito);
                  //actualizao carrito
                  $data_formulario_26=array 
                  (  'tipo' => 'devolucion',
                     'car_estado'=> 'pendiente'
                  );
    //var_dump($id_carrito);
    //var_dump($data_formulario_26);
                  $this->model_wz->actualizar_cart($data_formulario_26,$id_carrito); 
               }//fin del foreach    

               //generamos la orden de entrega para los que tiene en el carrito temporal
               $y=0;

               unset($cod_todosprodpedidos);
               $auxidalquiler="";
               $auxcar2="";
               foreach ($datos as $row2 )
               {
                   $id_alquiler = $row2->id_alquiler;
                   //genero una nueva orden
                   // ------------------------------------ 
                   if($auxidalquiler != $id_alquiler)
                   {    
                       $data_formulario_22=array 
                       (   'id_alquiler' => $id_alquiler,
                           'ord_tipo' => "entrega",
                           'ord_estado' => "pendiente"
                       );
    //var_dump($data_formulario_22); 
                       $this->model_wz->insertar_orden($data_formulario_22);
                       //buscamos la ultima orden generada
                       $orden= $this->model_wz->ultima_orden_xid($id_alquiler,"entrega");
                       $id_orden=$orden[0]->id_orden;
                       
                         // genero las direcciones de la orden
                        $cliente= $this->model_wz->buscarcliente_xid($this->session->userdata['user_id']);

                        $data_formulario_10_1=array 
                        (  'diror_tipo' => "envio",
                           'diror_direccion'=> $cliente[0]->direccion_envio." #".$cliente[0]->nro_envio,
                           'diror_dpto' => $cliente[0]->nrodpto_envio,
                           'diror_ciudad' => $cliente[0]->ciudad_envio,
                           'diror_distrito' => $cliente[0]->distrito_envio,
                           'diror_referencia' =>  $cliente[0]->referencia_envio,
                           'id_orden' =>  $id_orden
                        );
                        $this->model_wz->insertar_dir_orden($data_formulario_10_1);
                        $data_formulario_10_2=array 
                        (  'diror_tipo' => "facturacion",
                           'diror_direccion'=> $cliente[0]->direccion_laboral." #".$cliente[0]->nro_laboral,
                           'diror_dpto' => $cliente[0]->nrodpto_laboral,
                           'diror_ciudad' => $cliente[0]->ciudad_laboral,
                           'diror_distrito' => $cliente[0]->distrito_laboral,
                           'diror_referencia' =>  $cliente[0]->referencia_laboral,
                           'id_orden' =>  $id_orden
                        );
                        $this->model_wz->insertar_dir_orden($data_formulario_10_2);

                       $auxidalquiler=$id_alquiler;

                   }
                  //fin de la generar la nueva orden 
                  // ------------------------------------  

                   //actualizamos los carritos temporales a pendientes de entrega
                   // ------------------------------------  
                   $id_prod = $row2->id_producto;
                   $id_detcarrito = $row2->id_detcarrito;
                   $id_carrito = $row2->id_carrito;


                   //buscamos los det de productos disponibles para obtener el cod de barras
                   $detprod_disp= $this->model_wz->detprod_x_produc_disponible($id_prod);
                   $id_detproducto= $detprod_disp[0]->id_detproducto;
                   
                    if(isset($cod_todosprodpedidos[$id_carrito]))
                   { $cod_todosprodpedidos[$id_carrito] .= ",".$id_detproducto; 
                   }else
                   { $cod_todosprodpedidos[$id_carrito] = $id_detproducto;
                   
                   }    
                   //actualizamos el detprod a separado
                   $data_formulario_24=array 
                   (  'estado' => "separado"
                   );

   //var_dump($id_detproducto);
   //var_dump($data_formulario_24);
                   $this->model_wz->actualizar_detprod($data_formulario_24,$id_detproducto);

                   // actualizo el detalle del carrito
                   $data_formulario_25=array 
                   (  'detcar_estado' => "pendiente",
                      'id_detproducto'=> $id_detproducto,
                   );
   //var_dump($id_detcarrito);
   //var_dump($data_formulario_25);
                   $this->model_wz->actualizar_detcart($data_formulario_25,$id_detcarrito);
                   $y++; 
                    // ------------------------------------  
               }//fin del foreach    

               //Actualizamos el carrito
               // ------------------------------------  
               foreach ($datos as $row3)
               {
                   if($auxcar2 != $row3->id_carrito)
                   {
                       $id_carrito =$row3->id_carrito;
                       //insertamos detalle de orden
                       $data_formulario_23=array 
                       (   'id_orden' => $id_orden,
                           'id_carrito' => $id_carrito,
                           'detord_cod_detprod' => $cod_todosprodpedidos[$id_carrito]
                       );
   //var_dump($data_formulario_23);
                       $this->model_wz->insertar_detorden($data_formulario_23);

                       //actualizar el carrito de temporal a pendiente
                       $data_formulario_26=array 
                       (  'tipo' => 'entrega',
                          'hora_pedido'=> obtenerhora_actual(),
                          'fecha_pedido'=> obtenerfecha_hora(),
                          'car_estado'=> 'pendiente'
                       );
   //var_dump($data_formulario_26);
                       $this->model_wz->actualizar_cart($data_formulario_26,$id_carrito); 
                       $auxcar2 = $id_carrito;  
                   }//fin del if    
               }//fin del foreach    
               //fin de actualiza el carrito
               // -------------------------------------

               //actualizamos la suscripcion
               // -------------------------------------
               $data_formulario_27=array 
                 (  'estado_entrega'=> 'pendiente'
                 );
                $this->model_wz->actualizar_suscripcion($data_formulario_27,$datos[0]->id_alquiler); 
               // -------------------------------------

               $data=array 
               (  'tipo'=>"mensaje_exito",
                  'mensaje'=>"Se procedio a generar exitosamente la orden de intercambio"
               );

           }//fin del isset $this->session->userdata['user_id']
           else {
               $data=array 
               (  'tipo'=>"mensaje_error",
                  'mensaje'=>"Error al enviar datos"
               );
          }

          return $data;    
        }//fin de la funcion

    
}//fin del controlador        
?>
